<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Seminar extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();

		// モデルロード
		$this->load->model('m_seminar_summer21', 'm_seminar');
		$this->load->model('m_apply_seminar_summer21', 'm_apply_seminar');
		$this->load->model('m_exhibition_detail_summer21', 'm_exhibition_detail');
		$this->load->model('m_apply_exhibition_summer21', 'm_apply_exhibition');

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

		$this->load->view('admin/seminar/index', $view_data);
	}

	public function apply_confirm($seminar_id = '')
	{
		// ログイン済みチェック
		if( !$this->chk_logged_in_admin() ) {
			redirect('admin');
			return;
		}

		$seminar_data = $this->m_seminar->get_one(array('seminar_summer21_id' => $seminar_id));
		$apply_data = $this->m_apply_seminar->get_list(array('seminar_summer21_id' => $seminar_id), 'regist_time ASC');

		$view_data = array(
			'CONF'	=> $this->conf,
			'SDATA'	=> $seminar_data,
			'ADATA'	=> $apply_data,
			'SID'	=> $seminar_id
		);

		$this->load->view('admin/seminar/apply_confirm', $view_data);
	}

	public function dl($seminar_id = '')
	{
		// ログイン済みチェック
		if( !$this->chk_logged_in_admin() ) {
			redirect('admin');
			return;
		}

		$apply_seminar_data = $this->m_apply_seminar->get_list(array('seminar_summer21_id' => $seminar_id));

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
				'参加者1',
				'参加者2',
				'郵便番号',
				'住所',
				'電話番号',
				'メールアドレス',
				'展示会（1:参加 2:不参加）',
				'申込日時'
			);
			fputcsv($fp, $csv_array);

			foreach( $apply_seminar_data as $val ) {
				$csv_array = array(
					$val['juku_name'],
					$val['guest_name1'],
					$val['guest_name2'],
					$val['zip'],
					$val['address'],
					$val['tel'],
					$val['email'],
					$val['attend_exhibition'],
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
	// 新規追加
	public function ajax_add()
	{
		$post_data = $this->input->post();
		$office = isset($post_data['office']) ? $post_data['office'] : '';
		$place = isset($post_data['place']) ? $post_data['place'] : '';
		$event_date = isset($post_data['event_date']) ? $post_data['event_date'] : '';
		$capacity = isset($post_data['capacity']) ? $post_data['capacity'] : '0';

		$ret_val = array(
			'status'	=> FALSE,
			'err_msg'	=> ''
		);

		if( $office == '' || $place == '' || $event_date == '' ) {
			$ret_val['err_msg'] = '主催オフィス、会場、開催日は必須項目です。';
		}
		else {
			$week = array('日', '月', '火', '水', '木', '金', '土');
			$show = date('n月j日', strtotime($event_date)) . '（' . $week[date('w', strtotime($event_date))] . '）';
			$now = date('Y-m-d H:i:s');

			$insert_data = array(
				'office'			=> $office,
				'place_summer21'	=> $place,
				'event_date'		=> $event_date,
				'show_event_date'	=> $show,
				'capacity'			=> $capacity,
				'reserved'			=> 0,
				'regist_time'		=> $now,
				'update_time'		=> $now,
				'status'			=> '0'
			);

			if( $this->m_seminar->insert($insert_data) ) {
				$ret_val['status'] = TRUE;
			}
			else {
				$ret_val['err_msg'] = 'データベースエラーが発生しました。';
			}
		}

		$this->ajax_out(json_encode($ret_val));
	}

	// 修正
	public function ajax_mod()
	{
		$post_data = $this->input->post();
		$seminar_id = isset($post_data['seminar_id']) ? $post_data['seminar_id'] : '';
		$office = isset($post_data['office']) ? $post_data['office'] : '';
		$place = isset($post_data['place']) ? $post_data['place'] : '';
		$event_date = isset($post_data['event_date']) ? $post_data['event_date'] : '';
		$capacity = isset($post_data['capacity']) ? $post_data['capacity'] : '0';

		$ret_val = array(
			'status'	=> FALSE,
			'err_msg'	=> ''
		);

		if( $office == '' || $place == '' || $event_date == '' ) {
			$ret_val['err_msg'] = '主催オフィス、会場、開催日は必須項目です。';
		}
		else {
			$seminar_data = $this->m_seminar->get_one(array('seminar_summer21_id' => $seminar_id));
			if( empty($seminar_data) ) {
				$ret_val['err_msg'] = '修正するセミナー情報が存在しません。';
			}
			else {
				$week = array('日', '月', '火', '水', '木', '金', '土');
				$show = date('n月j日', strtotime($event_date)) . '（' . $week[date('w', strtotime($event_date))] . '）';
				$now = date('Y-m-d H:i:s');

				$update_data = array(
					'office'			=> $office,
					'place_summer21'	=> $place,
					'event_date'		=> $event_date,
					'show_event_date'	=> $show,
					'capacity'			=> $capacity,
					'update_time'		=> $now
				);

				if( $this->m_seminar->update(array('seminar_summer21_id' => $seminar_id), $update_data) ) {
					$ret_val['status'] = TRUE;
				}
				else {
					$ret_val['err_msg'] = 'データベースエラーが発生しました。';
				}
			}
		}

		$this->ajax_out(json_encode($ret_val));
	}

	// 申込み済みデータが無いかチェック
	public function ajax_chk_applied()
	{
		$post_data = $this->input->post();
		$seminar_id = isset($post_data['seminar_id']) ? $post_data['seminar_id'] : '';
		$apply_data = $this->m_apply_seminar->get_list(array('seminar_summer21_id' => $seminar_id));

		$ret_val = array(
			'flg_exists'	=> !empty($apply_data) ? TRUE : FALSE
		);

		$this->ajax_out(json_encode($ret_val));
	}

	// 削除
	public function ajax_del()
	{
		$post_data = $this->input->post();
		$seminar_id = isset($post_data['seminar_id']) ? $post_data['seminar_id'] : '';

		$ret_val = array(
			'status'			=> FALSE,
			'err_msg'			=> ''
		);

		if( $seminar_id == '' ) {
			$ret_val['err_msg'] = 'パラメータエラーが発生しました。';
		}
		else {
			$seminar_data = $this->m_seminar->get_one(array('seminar_summer21_id' => $seminar_id));
			if( empty($seminar_data) ) {
				$ret_val['err_msg'] = '削除するセミナー情報が存在しません。';
			}
			else {
				$update_data = array(
					'update_time'	=> date('Y-m-d H:i:s'),
					'status'		=> '9'
				);

				$this->db->trans_start();

				// 申込データも削除
				$this->m_apply_seminar->update(array('seminar_summer21_id' => $seminar_id), $update_data);

				// セミナー削除
				$this->m_seminar->update(array('seminar_summer21_id' => $seminar_id), $update_data);

				$this->db->trans_complete();

				if( $this->db->trans_status() === FALSE ) {
					$ret_val['err_msg'] = 'データベースエラーが発生しました。';
				}
				else {
					$ret_val['status'] = TRUE;
				}
			}
		}

		$this->ajax_out(json_encode($ret_val));
	}

	// キャンセル
	public function ajax_cancel()
	{
		$post_data = $this->input->post();
		$apply_seminar_summer21_id = isset($post_data['apply_id']) ? $post_data['apply_id'] : '';

		$ret_val = array(
			'status'			=> FALSE,
			'err_msg'			=> ''
		);

		$apply_data = $this->m_apply_seminar->get_one(array('apply_seminar_summer21_id' => $apply_seminar_summer21_id));
		if( empty($apply_data) ) {
			$ret_val['err_msg'] = '削除するセミナー申込情報が存在しません。';
		}
		else {
			$seminar_data = $this->m_seminar->get_one(array('seminar_summer21_id' => $apply_data['seminar_summer21_id']));
			if( empty($seminar_data) ) {
				$ret_val['err_msg'] = '更新するセミナー情報が存在しません。';
			}
			else {
				$now = date('Y-m-d H:i:s');

				$this->db->trans_start();

				$update_data_apply = array(
					'update_time'	=> $now,
					'status'		=> '9'
				);
				$this->m_apply_seminar->update(array('apply_seminar_summer21_id' => $apply_seminar_summer21_id), $update_data_apply);

				$apply_num = empty($apply_data['guest_name2']) ? 1 : 2;
				$new_num = intval($seminar_data['reserved']) - $apply_num;

				$update_data_seminar = array(
					'reserved'		=> $new_num,
					'update_time'	=> $now
				);
				$this->m_seminar->update(array('seminar_summer21_id' => $seminar_data['seminar_summer21_id']), $update_data_seminar);

				// 展示会も参加する場合はも展示会申込みも削除
				if( $apply_data['attend_exhibition'] == '1' ) {
					$apply_exhibition_data = $this->m_apply_exhibition->get_one(array('apply_seminar_summer21_id' => $apply_seminar_summer21_id));
					if( !empty($apply_exhibition_data) ) {
						$update_data_apply = array(
							'update_time'	=> $now,
							'status'		=> '9'
						);
						$this->m_apply_exhibition->update(array('apply_seminar_summer21_id' => $apply_seminar_summer21_id), $update_data_apply);

						$detail_data = $this->m_exhibition_detail->get_one(array('exhibition_detail_summer21_id' => $apply_exhibition_data['exhibition_detail_summer21_id']));
						if( !empty($detail_data) ) {
							$new_num = intval($detail_data['reserved']) - intval($apply_exhibition_data['guest_num']);

							$update_data_detail = array(
								'reserved'		=> $new_num,
								'update_time'	=> $now
							);
							$this->m_exhibition_detail->update(array('exhibition_detail_summer21_id' => $detail_data['exhibition_detail_summer21_id']), $update_data_detail);
						}
					}
				}

				$this->db->trans_complete();

				if( $this->db->trans_status() === FALSE ) {
					$ret_val['err_msg'] = 'データベースエラーが発生しました。';
				}
				else {
					$ret_val['status'] = TRUE;
				}
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

		$seminar_data = $this->m_seminar->get_list('', $sort_str, $limit_array);
		$seminar_all_data = $this->m_seminar->get_list();

		$row_val = array();

		if( !empty($seminar_data) ) {
			foreach( $seminar_data as $val ) {
				$row_val[] = array(
					'seminar_id'		=> $val['seminar_summer21_id'],
					'office_id'			=> $val['office'],
					'office'			=> $this->conf['office'][$val['office']],
					'place_id'			=> $val['place_summer21'],
					'place'				=> $this->conf['place_summer21'][$val['place_summer21']],
					'event_date'		=> $val['show_event_date'],
					'event_date_data'	=> $val['event_date'],
					'capacity'			=> $val['capacity'],
					'reserved'			=> $val['reserved']
				);
			}
		}

		$ret_val = array(
			'current'	=> $current,
			'rowCount'	=> $rowCount,
			'total'		=> count($seminar_all_data),
			'rows'		=> $row_val
		);

		$this->ajax_out(json_encode($ret_val));
	}
}
