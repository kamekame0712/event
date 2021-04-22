<?php

class M_analytics extends MY_Model
{
	// テーブル名
	const TBL  = 't_analytics';

	function __construct()
	{
		parent::__construct();
	}

	public function get_direct_count()
	{
		$sql = '
			SELECT COUNT(*) AS CNT FROM t_analytics
			WHERE referer IS NULL
			AND (
				url = "summer21/chushikoku"
		  		OR url = "summer21/kyushu"
			)
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
