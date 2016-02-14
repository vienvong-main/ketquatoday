<?php
/**
 * Default Controller
 * 
 * Default page will be load from here
 */
class Home extends CI_Controller {
	/**
	 * ----------------------------------------------------------------
	 * Setup layout using by current controller
	 * ----------------------------------------------------------------
	 */
	public $layout = 'main';
	/**
	 * ----------------------------------------------------------------
	 * Constructor
	 * ----------------------------------------------------------------
	 */
	public function __construct() {
		parent::__construct();
	}
	/**
	 * ----------------------------------------------------------------
	 * Index page
	 * ----------------------------------------------------------------
	 */
	public function index() {
		// Setup date to get result
		$day = new DateTime();
		if(date('H:m:i') < '18:15:00') {
			$day = $day->modify('-1 day');
		}

		$dayGet = $day->format('Y/m/d');

		if(!empty($_POST['date'])) {
			$day = $day::createFromFormat('m/d/Y', $_POST['date']);
			$dayGet = $day->format('Y/m/d');
		}else {
			// Get statistic from database
			$startdate = $day->modify('-100 days');
			$filter = array('date >= ' => $startdate->format('Y/m/d'), 'date <=' => $dayGet, 'cityCode' => '00');
			$statistic = $this->MResult->statisticAdvance($filter, null, 'loto, date, date2, number, award');
			$data['statistic'] = $statistic;
		}

		// Get result from database
		$result = $this->MResult->getResultInDay($dayGet, '00');
		$data['date'] = $dayGet;
		$data['result'] = $result;

		$this->load->set('title', 'Home');
		$this->load->render('VHome', $data);
	}

	/**
	 * ----------------------------------------------------------------
	 * Get list result
	 * ----------------------------------------------------------------
	 */
	public function listdate() {
		$day = new DateTime();
		if(date('H:m:i') < '18:15:00') {
			$day = $day->modify('-1 day');
		}

		$enddate = $day->format('Y/m/d');

		$day->modify('-30 days');
		$startdate = $day->format('Y/m/d');

		$filter['date >='] = $startdate;
		$filter['date <='] = $enddate;
		$filter['cityCode'] = '00';
		$group = 'date';
		$order = array('date' => -1, 'award' => 1);

		$list = $this->MResult->getGroupBy($filter, $group, $order, 'number, loto, date, date2, award, head');
		$data['result'] = $list['result'];

		$this->load->set('title', 'Sổ kết quả');
		$this->load->render('VList', $data);
	}
	/**
	 * ----------------------------------------------------------------
	 * Crawl result
	 * ----------------------------------------------------------------
	 */
	public function crawl() {
		$maxDate = $this->MResult->getMaxDate('00');

		$date = new DateTime();
		$day = $date->format('Y/m/d');

		while ( $day > $maxDate) {
			$list = $this->MCity->cityInday($day);
			// var_dump($list); die();
			foreach ($list['result'] as $xslocal) {
				$xslocal['link'] = $this->_friendly($xslocal['city']);

				do {
					try{
						$ketqua = fopen('http://ketqua.org/xo-so-' .$xslocal['link']. '.php?ngay='.$date->format('d/m/Y'), 'r');
						$contents = stream_get_contents($ketqua);
						fclose($ketqua);
					}catch(Exception $e) {
						echo "Error in day: " . $date->format('d/m/Y');
					}
				}while (!$ketqua);

				$anchor = array(
					0 => array(
						'start' => '<table cellpadding="0" cellspacing="0" width="394" class="tbl_home_result">',
						'end' => '</table><table cellpadding="0" cellspacing="0" width="194" class="tbl_home_head_tail" style="float:right;">'
					),
					1 => array(
						'start' => '<table cellpadding="0" cellspacing="0" width="594" class="tbl_home_result">',
						'end' => '</table>'
					),
				);

				$typeAnchor = 0;

				$explode = explode($anchor[$typeAnchor]['start'], $contents);

				if(!isset($explode[1])) {
					$typeAnchor += 1;
					$explode = explode($anchor[$typeAnchor]['start'], $contents);
				}

				if(isset($explode[1])) {
					$table = substr($explode[1], 0, strpos($explode[1], $anchor[$typeAnchor]['end']));

					if($typeAnchor == 1) {
						$table = str_replace('</td>', PHP_EOL . '</tb>', $table);
					}

					$list = filter_var($table, FILTER_SANITIZE_STRING);

					$data = explode(PHP_EOL, $list);

					$count = 0;

					$set = array();

					foreach ($data as $value) {
						$value = trim($value);

						if (is_numeric($value)) {
							$set[$count]['_id'] = $xslocal['code'] . $date->format('Ymd') . $count;
							$set[$count]['number'] = $value;
							$set[$count]['state'] = $xslocal['local'];
							$set[$count]['name'] = $xslocal['city'];
							$set[$count]['cityCode'] = $xslocal['code'];
							$set[$count]['date'] = $day;
							$set[$count]['date2'] = $date->format('d/m/Y');
							$set[$count]['award'] = $xslocal['award'][$count];

							$lenght = strlen($set[$count]['number']);
							if($lenght > 1) {
								$set[$count]['head'] = $set[$count]['number'][$lenght - 2];
								$set[$count]['foot'] = $set[$count]['number'][$lenght - 1];
								$set[$count]['loto'] = $set[$count]['head'] . $set[$count]['foot'];
							}

							$count++;
						}
					}
					// var_dump($set);
					$this->MResult->insert($set, true);
				}else {
					var_dump($day);
					echo '<br>';
				}
			}

			$date->modify('-1 day');
			$day = $date->format('Y/m/d');
		}
	}

	private function _friendly($string) {
		$aPattern = array (
			"a" => "á|à|ạ|ả|ã|ă|ắ|ằ|ặ|ẳ|ẵ|â|ấ|ầ|ậ|ẩ|ẫ|Á|À|Ạ|Ả|Ã|Ă|Ắ|Ằ|Ặ|Ẳ|Ẵ|Â|Ấ|Ầ|Ậ|Ẩ|Ẫ",
			"o" => "ó|ò|ọ|ỏ|õ|ô|ố|ồ|ộ|ổ|ỗ|ơ|ớ|ờ|ợ|ở|ỡ|Ó|Ò|Ọ|Ỏ|Õ|Ô|Ố|Ồ|Ộ|Ổ|Ỗ|Ơ|Ớ|Ờ|Ợ|Ở|Ỡ",
			"e" => "é|è|ẹ|ẻ|ẽ|ê|ế|ề|ệ|ể|ễ|É|È|Ẹ|Ẻ|Ẽ|Ê|Ế|Ề|Ệ|Ể|Ễ",
			"u" => "ú|ù|ụ|ủ|ũ|ư|ứ|ừ|ự|ử|ữ|Ú|Ù|Ụ|Ủ|Ũ|Ư|Ứ|Ừ|Ự|Ử|Ữ",
			"i" => "í|ì|ị|ỉ|ĩ|Í|Ì|Ị|Ỉ|Ĩ",
			"y" => "ý|ỳ|ỵ|ỷ|ỹ|Ý|Ỳ|Ỵ|Ỷ|Ỹ",
			"d" => "đ|Đ",
			"-" => " "
		);

		while(list($key,$value) = each($aPattern)) {
			$string = preg_replace('/'.$value.'/i', $key, $string);
		}

		return strtolower($string);
	}
}