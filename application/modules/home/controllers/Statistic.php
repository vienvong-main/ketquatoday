<?php
/**
 * Default Controller
 * 
 * Default page will be load from here
 */
class Statistic extends CI_Controller {
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
		$init['enddate'] = date('Y-m-d');
		$inienddate = new DateTime($init['enddate']);
		$inienddate->modify('- 365 days');
		$init['startdate'] = $inienddate->format('Y-m-d');
		$init['total_loto'] = 0;

		$cities = $this->MCity->allCity('_id, city');
		$init['cities'] = $cities['result'];

		if(($startdate = filter_input(INPUT_POST, 'startdate')) && ($enddate = filter_input(INPUT_POST, 'enddate'))) {
			$init['startdate'] = $startdate;
			$init['enddate'] = $enddate;
		}

		$startdateConvert = new DateTime($init['startdate']);
		$startdate = $startdateConvert->format('Y/m/d');
		
		$enddateConvert = new DateTime($init['enddate']);
		$enddate = $enddateConvert->format('Y/m/d');

		$filter = array('date >= ' => $startdate, 'date <=' => $enddate, 'cityCode' => '00');
		$filter_in = array();

		if($city = filter_input(INPUT_POST, 'city')) {
			if($city < 10) {
				$filter['cityCode'] = $city;
			}else {
				$filter['cityCode'] = (int) $city;
			}
		}

		if($listnumber = filter_input(INPUT_POST, 'listnumber')) {
			$listnumber = str_replace(' ', ',', $listnumber);
			$explode = explode(',', $listnumber);
			$listnumber = array();
			foreach ($explode as $value) {
				if(is_numeric($value)) {
					$listnumber[] = $value;
				}
			}

			$filter_in['loto'] = $listnumber; 
		}

		$statistic = $this->MResult->statistic($filter, $filter_in, 'loto, date, date2');

		$init['result'] = $statistic['result'];
		$init['total_date'] = $this->_count_date($startdate, $enddate);
		$init['total_loto'] = $statistic['total_loto'];

		$this->load->set('title', 'Thống kê nhanh');
		$this->load->render('VThongke', $init);
	}

	// ------------------------------------------------------------------
	/**
	 * Count date
	 * 
	 * @param date $startdate
	 * @param date $enddate
	 * 
	 * @return int;
	 */
	private function _count_date($startdate, $enddate) {
		$startdate = strtotime($startdate);
		$enddate = strtotime($enddate);

		$date = ceil(($enddate - $startdate)/(3600*24));

		return $date?$date:1;
	}
}