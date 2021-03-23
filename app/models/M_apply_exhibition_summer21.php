<?php

class M_apply_exhibition_summer21 extends MY_Model
{
	// テーブル名
	const TBL  = 't_apply_exhibition_summer21';

	function __construct()
	{
		parent::__construct();
	}

	public function get_applied($exhibition_id)
	{
		if( empty($exhibition_id) ) {
			return FALSE;
		}

		$where = array(
			'ed.exhibition_summer21_id'	=> $exhibition_id,
			'ae.status'					=> '0'
		);

		$this->db->from(SELF::TBL . ' ae')
			 ->join('t_exhibition_detail_summer21 ed', 'ed.exhibition_detail_summer21_id = ae.exhibition_detail_summer21_id AND ed.status = "0"', 'left')
			 ->where($where);

		$query = $this->db->get();
		return $query->num_rows();
	}

	public function delete_by_exhibition_id($exhibition_id)
	{
		if( empty($exhibition_id) ) {
			return FALSE;
		}

		$sql = "
			UPDATE t_apply_exhibition_summer21
			SET status = '9'
			WHERE exhibition_detail_summer21_id IN (
				SELECT exhibition_detail_summer21_id
				FROM t_exhibition_detail_summer21
				WHERE exhibition_summer21_id = $exhibition_id
				  AND status = '0'
			)
		";

		return $this->db->query($sql);
	}
}
