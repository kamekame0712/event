<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Seminar_kyushu extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();

		// モデルロード
		$this->load->model('m_apply_seminar_summer21_kyushu', 'm_apply_kyushu');

		// 設定ファイルロード
		$this->config->load('config_disp', TRUE, TRUE);
		$this->conf = $this->config->item('disp', 'config_disp');
	}

	public function index()
	{
		// ログイン済みチェック
		if( !$this->chk_logged_in_admin() ) {
			redirect('admin');
			return;
		}

		$view_data = array(
			'CONF'	=> $this->conf
		);

		$this->load->view('admin/seminar_kyushu/index', $view_data);
	}

	public function dl()
	{
		// ログイン済みチェック
		if( !$this->chk_logged_in_admin() ) {
			redirect('admin');
			return;
		}

		$apply_seminar_data = $this->m_apply_kyushu->get_list('', 'regist_time ASC');

		// タイムアウトさせない
		set_time_limit(0);

		$fp = fopen('php://output', 'w');
		stream_filter_append($fp, 'convert.iconv.UTF-8/CP932//TRANSLIT', STREAM_FILTER_WRITE);

		header("Content-Type: application/octet-stream");
		header("Content-Disposition: attachment; filename=" . 'seminar' . date('YmdHis') . '.csv');

		if( empty($apply_seminar_data) ) {
			fputs($fp, 'no data');
		}
		else {
			$csv_array = array(
				'塾名',
				'申込担当者名',
				'申込人数',
				'郵便番号',
				'住所',
				'電話番号',
				'メールアドレス',
				'申込日時'
			);
			fputcsv($fp, $csv_array);

			foreach( $apply_seminar_data as $val ) {
				$csv_array = array(
					$val['juku_name'],
					$val['charge'],
					$val['guest_num'],
					$val['zip'],
					$val['address'],
					$val['tel'],
					$val['email'],
					$val['regist_time']
				);
				fputcsv($fp, $csv_array);
			}
		}

		fclose($fp);
	}



	/*******************************************/
	/*                ajax関数                 */
	/*******************************************/
	// キャンセル
	public function ajax_cancel()
	{
		$post_data = $this->input->post();
		$apply_seminar_summer21_kyushu_id = isset($post_data['apply_id']) ? $post_data['apply_id'] : '';

		$ret_val = array(
			'status'			=> FALSE,
			'err_msg'			=> ''
		);

		$apply_data = $this->m_apply_kyushu->get_one(array('apply_seminar_summer21_kyushu_id' => $apply_seminar_summer21_kyushu_id));
		if( empty($apply_data) ) {
			$ret_val['err_msg'] = '削除するセミナー申込情報が存在しません。';
		}
		else {
			$update_data_apply = array(
				'update_time'	=> date('Y-m-d H:i:s'),
				'status'		=> '9'
			);

			if( !$this->m_apply_kyushu->update(array('apply_seminar_summer21_kyushu_id' => $apply_seminar_summer21_kyushu_id), $update_data_apply) ) {
				$ret_val['err_msg'] = 'データベースエラーが発生しました。';
			}
			else {
				$ret_val['status'] = TRUE;
			}
		}

		$this->ajax_out(json_encode($ret_val));
	}



	/*******************************************/
	/*          ajax関数(bootgrid用)           */
	/*******************************************/
	public function get_bootgrid()
	{
		$post_data = $this->input->post();
		$current = isset($post_data['current']) ? intval($post_data['current']) : 1;
		$rowCount = isset($post_data['rowCount']) ? intval($post_data['rowCount']) : 10;
		$searchPhrase = isset($post_data['searchPhrase']) ? $post_data['searchPhrase'] : '';
		$sort = isset($post_data['sort']) ? $post_data['sort'] : array();

		$sort_str = '';
		foreach( $sort as $sort_key => $sort_val ) {
			$sort_str .= $sort_key . ' ' . $sort_val;
		}

		if( $rowCount != -1 ) {
			$limit_array = array($rowCount, ($current - 1) * $rowCount);
		}
		else {
			$limit_array = '';
		}

		if( $searchPhrase != '' ) {
			$where = 'juku_name LIKE "%' . $searchPhrase . '%"';
		}
		else {
			$where = '';
		}

		$kyushu_data = $this->m_apply_kyushu->get_list($where, $sort_str, $limit_array);
		$kyushu_all_data = $this->m_apply_kyushu->get_list($where);

		$row_val = array();

		if( !empty($kyushu_data) ) {
			foreach( $kyushu_data as $val ) {
				$row_val[] = array(
					'apply_id'		=> $val['apply_seminar_summer21_kyushu_id'],
					'guest_num'		=> $val['guest_num'],
					'juku_name'		=> $val['juku_name'],
					'charge'		=> $val['charge'],
					'zip'			=> $val['zip'],
					'address'		=> $val['address'],
					'tel'			=> $val['tel'],
					'email'			=> $val['email'],
					'regist_time'	=> $val['regist_time']
				);
			}
		}

		$ret_val = array(
			'current'	=> $current,
			'rowCount'	=> $rowCount,
			'total'		=> count($kyushu_all_data),
			'rows'		=> $row_val
		);

		$this->ajax_out(json_encode($ret_val));
	}
}
