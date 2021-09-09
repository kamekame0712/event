<?php

class M_analytics extends MY_Model
{
	// テーブル名
	const TBL  = 't_analytics';

	function __construct()
	{
		parent::__construct();
	}

	public function get_direct_count($from = '')
	{
		if( $from == '' ) {
			$from = date('Y-m-d H:i:s');
		}

		$sql = '
			SELECT COUNT(*) AS CNT FROM t_analytics
			WHERE referer IS NULL
			AND url = "winter21"
			AND regist_time >= "' . $from . '"
		';

		$query = $this->db->query($sql);
		if( $query->num_rows() > 0 ) {
			$result = $query->row_array();
			if( isset($result['CNT']) ) {
				return intval($result['CNT']);
			}
			else {
				return 0;
			}
		}

		return 0;
	}
}
