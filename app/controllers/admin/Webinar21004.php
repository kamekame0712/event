<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Webinar21004 extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();

		// モデルロード
		$this->load->model('m_apply_webinar21004');

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

		$num1 = $this->m_apply_webinar21004->get_count('( seminar = "1" OR seminar = "3" )');
		$num2 = $this->m_apply_webinar21004->get_count('( seminar = "2" OR seminar = "3" )');

		$view_data = array(
			'NUM1'	=> $num1,
			'NUM2'	=> $num2,
			'CONF'	=> $this->conf
		);

		$this->load->view('admin/webinar21004/index', $view_data);
	}

	public function dl_apply()
	{
		// ログイン済みチェック
		if( !$this->chk_logged_in_admin() ) {
			redirect('admin');
			return;
		}

		$aw_data = $this->m_apply_webinar21004->get_list('', 'regist_time ASC');

		// タイムアウトさせない
		set_time_limit(0);

		$fp = fopen('php://output', 'w');
		stream_filter_append($fp, 'convert.iconv.UTF-8/CP932//TRANSLIT', STREAM_FILTER_WRITE);

		header("Content-Type: application/octet-stream");
		header("Content-Disposition: attachment; filename=" . 'webinar21004' . date('YmdHis') . '.csv');

		if( empty($aw_data) ) {
			fputs($fp, 'no data');
		}
		else {
			$csv_array = array(
				'申込日時',
				'塾名',
				'教室名',
				'参加者名',
				'役職',
				'9/16 1:申込',
				'10/1 1:申込',
				'都道府県',
				'電話番号',
				'メールアドレス'
			);
			fputcsv($fp, $csv_array);

			foreach( $aw_data as $val ) {
				$csv_array = array(
					$val['regist_time'],
					$val['juku_name'],
					$val['classroom'],
					$val['participant'],
					$val['position'],
					( $val['seminar'] == '1' || $val['seminar'] == '3' ) ? '1' : '0',
					( $val['seminar'] == '2' || $val['seminar'] == '3' ) ? '1' : '0',
					$this->conf['pref'][$val['pref']],
					$val['tel'],
					$val['email']
				);
				fputcsv($fp, $csv_array);
			}
		}

		fclose($fp);
	}



	/******************************************/
	/*                ajax関数                */
	/******************************************/
	public function ajax_cancel_apply()
	{
		$post_data = $this->input->post();
		$apply_webinar21004_id = isset($post_data['apply_webinar21004_id']) ? $post_data['apply_webinar21004_id'] : '';

		$ret_val = array(
			'status'		=> FALSE,
			'err_msg'		=> ''
		);

		if( $apply_webinar21004_id == '' ) {
			$ret_val['err_msg'] = 'パラメータエラーが発生しました。';
		}
		else {
			$aw_data = $this->m_apply_webinar21004->get_one(array('apply_webinar21004_id' => $apply_webinar21004_id));
			if( empty($aw_data) ) {
				$ret_val['err_msg'] = 'キャンセルする申し込み情報が存在しません。';
			}
			else {
				$update_data = array(
					'update_time'	=> date('Y-m-d H:i:s'),
					'status'		=> '9'
				);

				if( $this->m_apply_webinar21004->update(array('apply_webinar21004_id' => $apply_webinar21004_id), $update_data) ) {
					$ret_val['status'] = TRUE;
				}
				else {
					$ret_val['err_msg'] = 'データベースエラーが発生しました。';
				}
			}
		}

		$this->ajax_out(json_encode($ret_val));
	}



	/******************************************/
	/*          ajax関数(bootgrid用)          */
	/******************************************/
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

		$aw21004_data = $this->m_apply_webinar21004->get_list($where, $sort_str, $limit_array);
		$aw21004_all_data = $this->m_apply_webinar21004->get_list($where);

		$row_val = array();

		if( !empty($aw21004_data) ) {
			foreach( $aw21004_data as $val ) {
				$row_val[] = array(
					'apply_webinar21004_id'		=> $val['apply_webinar21004_id'],
					'juku_name'		=> $val['juku_name'],
					'classroom'		=> $val['classroom'],
					'participant'	=> $val['participant'],
					'position'		=> $val['position'],
					'apply1'		=> ( $val['seminar'] == '1' || $val['seminar'] == '3' ) ? '◯' : '',
					'apply2'		=> ( $val['seminar'] == '2' || $val['seminar'] == '3' ) ? '◯' : '',
					'pref'			=> $this->conf['pref'][$val['pref']],
					'tel'			=> $val['tel'],
					'email'			=> $val['email'],
					'regist_time'	=> $val['regist_time']
				);
			}
		}

		$ret_val = array(
			'current'	=> $current,
			'rowCount'	=> $rowCount,
			'total'		=> count($aw21004_all_data),
			'rows'		=> $row_val
		);

		$this->ajax_out(json_encode($ret_val));
	}
}
