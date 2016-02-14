<?php 

class MResult extends CI_Model {

	/**
	 * Table name
	 */
	private $table = 'result';
	// -------------------------------------------------------------------------
	/**
	 * constructor
	 */
	public function __construct() {
		parent::__construct();
		$this->load->database();
	}
	// -------------------------------------------------------------------------
	/**
	 * Insert data into table
	 *
	 * @param array $data data needed input
	 * @param bool $batch is insert batch
	 *
	 * @return array
	 */
	public function insert($data, $batch = false) {
		if(!$batch) {
			$insert = $this->db->insert($this->table, $data);
		}else {
			$insert = $this->db->insert_batch($this->table, $data);
		}

		return $insert;
	}
	// -------------------------------------------------------------------------
	/**
	 * Get result from table
	 *
	 * @param array $filter filter conditions
	 * @param array $filter_in filter conditions
	 * @param mixed $select fields need get
	 *
	 * @return array
	 */
	public function get($filter, $filter_in = array(), $select = '*') {
		$get = $this->db->select($select)->where($filter);

		if(!empty($filter_in)) {
			foreach ($filter_in as $key => $value) {
				$get->where_in($key, $value);
			}
		}

		return $get->get($this->table);
	}
	// -------------------------------------------------------------------------
	/**
	 * Get result in day
	 *
	 * @param date $date date need get result
	 * @param array $select field need get
	 *
	 * @return array
	 */
	public function getResultInDay($date, $cityCode, $select = '*') {
		$filter = array('date' => $date, 'cityCode' => $cityCode);
		$get = $this->db->select($select)->where($filter)->order_by('award', 1);
		$result = $get->get($this->table);
		return $result;
	}
	// -------------------------------------------------------------------------
	/**
	 * Get group by
	 *
	 * @param array $filter list filter where conditions
	 * @param mixed $group_by list field using to group by
	 * @param mixed $order_by sort order
	 * @param mixed $select list field needed get
	 * 
	 * @return array 
	 */
	public function getGroupBy($filter, $group_by, $order_by = array(), $select = '*') {
		$get = $this->db->select($select)->where($filter)->order_by($order_by)->group_by($group_by);
		// $get = $this->db->select($select)->where($filter)->order_by('loto', 1)->select_count('loto')->group_by('loto')->select_max('date');
		// var_dump($get->get_compiled_select($this->table)); die();
		return $get->get($this->table);
	}
	// -------------------------------------------------------------------------
	/**
	 * Max Date
	 *
	 * @param number $citiCOde
	 *
	 * @return array
	 */
	public function getMaxDate($cityCode) {
		$get = $this->db->where('cityCode', $cityCode)->select_max('date');
		$maxDate = $get->get($this->table);
		if(!empty($maxDate['result'])) {
			return $maxDate['result'][0]['date_MAX'];
		}else {
			return 0;
		}
	}
	// -------------------------------------------------------------------------
	/**
	 * Statistic
	 *
	 * @param array $filter filter conditions
	 * @param array $filter_in filter conditions
	 * @param mixed $select fields need get
	 *
	 * @return array
	 */
	public function statistic($filter, $filter_in = array(), $select = '*') {
		$get = $this->db->select($select)->where($filter)->order_by('loto', 1)->select_count('loto')->group_by('loto')->select_max('date');
		if(!empty($filter_in)) {
			foreach ($filter_in as $key => $value) {
				$get->where_in($key, $value);
			}
		}

		$statistic = $get->get($this->table);

		$time = time();
		$statistic['total_loto'] = 0;
		foreach ($statistic['result'] as $key => $value) {
			$statistic['total_loto'] += $value['_id']['loto'];
			$endtime = new DateTime($statistic['result'][$key]['date_MAX']);
			$endtime = strtotime($endtime->format('Y/m/d 00:00:00'));
			$statistic['result'][$key]['long'] = floor(($time - $endtime)/(3600*24));
		}

		return $statistic;
	}
	// -------------------------------------------------------------------------
	/**
	 * Statistic Advanced
	 *
	 * @param array $filter filter conditions
	 * @param array $filter_in filter conditions
	 * @param mixed $select fields need get
	 *
	 * @return array
	 */
	public function statisticAdvance($filter, $filter_in = array(), $select = '*') {
		$statistic = $this->statistic($filter, $filter_in, $select);

		if($statistic['ok'] && count($statistic['result'])) {
			$count = array();

			foreach ($statistic['result'] as $key => $value) {
				$count[$value['_id']['loto']] = count($value['date']);

				if($value['long'] >= 10) {
					$statistic['lo_khan'][$value['_id']['loto']] = $value['long'];
				}

				if($value['long'] < 1 || ($value['long'] <= 1 && date('H:i:s') <= '18:15:00')) {
					$series = $this->_days_series($value['date'], 'Y/m/d', 1);

					if(!empty($series[0]) && ($series = count($series[0]))) {
						$statistic['lo_roi'][$value['_id']['loto']] = $series + 1;
					}
				} 
			}

			arsort($count);
			$loop = 0;
			foreach ($count as $key => $value) {
				if($loop < 9) {
					$statistic['lo_nhieu'][$key] = $value;
				}elseif($loop >= 91) {
					$statistic['lo_it'][$key] = $value;
				}
				$loop ++;
			}
		}

		return $statistic;
	}
	// -------------------------------------------------------------------------
	/**
	 * Update data in table
	 *
	 * @param array $data data need update
	 * @param array $fitler filter conditions
	 *
	 * @return array;
	 */
	public function update($data, $filter) {
		return $this->db->update($this->table, $data, $filter);
	}

	// -------------------------------------------------------------------------
	/**
	 * Remake result key
	 *
	 * @param mixed $levelKey
	 * @param array $result
	 * 
	 * @return array
	 */
	private function _remake_key($levelKey, $result) {
		$convert = array();

		// build level key array
		if(!is_array($levelKey)) {
			$levelKey = explode(',', str_replace(' ', null, $levelKey));
		}

		// remake array
		foreach ($result as $value) {
			$next['key'] = null;
			$next['value'] = $value;

			foreach ($levelKey as $key) {
				$next['key'] = $key;
				$next['value'] = $next['value'][$key];
			}

			$convert[$next['value']] = $value;
		}

		return $convert;
	}
	// -------------------------------------------------------------------------
	/**
	 * Get days series
	 * 
	 * @param array $days list day
	 * @param string $format format of datetime 
	 * @param number $number_group number group need get. If '0' is get all
	 *
	 * @return array
	 */
	private function _days_series($days, $format = 'Y/m/d', $number_group = 0) {
		arsort($days);
		$next = null;
		$group = array();
		$count = 0;
		foreach ($days as $value) {
			if($next == null) {
				$next = $value;
			}else{
				$after = new DateTime($next);
				$after = $after->modify('-1 day');
				if($after->format($format) == $value) {
					$group[$count][] = $value;
				}else {
					$count ++;
				}
				$next = $value;
			}

			if($number_group && $number_group == $count) {
				return $group;
			}
		}

		return $group;
	}

}