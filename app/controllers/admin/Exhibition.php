<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Exhibition extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();

		// モデルロード
		$this->load->model('m_exhibition_summer21', 'm_exhibition');
		$this->load->model('m_exhibition_detail_summer21', 'm_exhibition_detail');
		$this->load->model('m_apply_exhibition_summer21', 'm_apply_exhibition');

		// 設定ファイルロード
		$this->config->load('config_disp', TRUE, TRUE);
		$this->conf = $this->config->item('disp', 'config_disp');

		// バリデーションエラー設定
		$this->form_validation->set_error_delimiters('<p class="error-msg">', '</p>');
	}

	public function index($result = '')
	{
		// ログイン済みチェック
		if( !$this->chk_logged_in_admin() ) {
			redirect('admin');
			return;
		}

		$view_data = array(
			'CONF'		=> $this->conf,
			'RESULT'	=> $result
		);

		$this->load->view('admin/exhibition/index', $view_data);
	}

	public function add()
	{
		// ログイン済みチェック
		if( !$this->chk_logged_in_admin() ) {
			redirect('admin');
			return;
		}

		$view_data = array(
			'KIND'	=> 'add',
			'CONF'	=> $this->conf,
			'EID'	=> '',
			'EDATA'	=> array(),
			'DDATA'	=> array()
		);

		$this->load->view('admin/exhibition/input', $view_data);
	}

	public function mod($exhibition_id = '')
	{
		// ログイン済みチェック
		if( !$this->chk_logged_in_admin() ) {
			redirect('admin');
			return;
		}

		$exhibition_data = $this->m_exhibition->get_one(array('exhibition_summer21_id' => $exhibition_id));
		$detail_data = $this->m_exhibition_detail->get_list(array('exhibition_summer21_id' => $exhibition_id));

		$view_data = array(
			'KIND'	=> 'mod',
			'CONF'	=> $this->conf,
			'EID'	=> $exhibition_id,
			'EDATA'	=> $exhibition_data,
			'DDATA'	=> $detail_data
		);

		$this->load->view('admin/exhibition/input', $view_data);
	}

	public function confirm()
	{
		// ログイン済みチェック
		if( !$this->chk_logged_in_admin() ) {
			redirect('admin');
			return;
		}

		$post_data = $this->input->post();

		// バリデーションチェック
		if( $this->form_validation->run('admin/exhibition') == FALSE ) {
			$view_data = array(
				'KIND'	=> isset($post_data['kind']) ? $post_data['kind'] : 'add',
				'CONF'	=> $this->conf,
				'EID'	=> isset($post_data['exhibition_id']) ? $post_data['exhibition_id'] : '',
				'EDATA'	=> array(),
				'DDATA'	=> array()
			);

			$this->load->view('admin/exhibition/input', $view_data);
		}

		$week = array('日', '月', '火', '水', '木', '金', '土');
		$show_event_date = isset($post_data['event_date']) ? date('n月j日', strtotime($post_data['event_date'])) . '（' . $week[date('w', strtotime($post_data['event_date']))] . '）' : '';

		$detail = array();
		$default_array = array('', '', '', '', '', '');
		$exhibition_time_start = !empty($post_data['exhibition_time_start']) ? $post_data['exhibition_time_start'] : $default_array;
		$exhibition_time_end = !empty($post_data['exhibition_time_end']) ? $post_data['exhibition_time_end'] : $default_array;
		$capacity = !empty($post_data['capacity']) ? $post_data['capacity'] : $default_array;

		for( $i = 0; $i < EXHIBITION_PERIOD_NUM; $i++ ) {
			if( !empty($exhibition_time_start[$i]) && !empty($exhibition_time_end[$i]) && !empty($capacity[$i]) ) {
				$detail[] = array(
					'start'		=> $exhibition_time_start[$i],
					'end'		=> $exhibition_time_end[$i],
					'capacity'	=> $capacity[$i]
				);
			}
		}

		$view_data = array(
			'CONF'		=> $this->conf,
			'PDATA'		=> $post_data,
			'DATE'		=> $show_event_date,
			'DETAIL'	=> $detail
		);

		$this->load->view('admin/exhibition/confirm', $view_data);
	}

	public function complete()
	{
		// ログイン済みチェック
		if( !$this->chk_logged_in_admin() ) {
			redirect('admin');
			return;
		}

		$default_array = array('', '', '', '', '', '');

		$post_data = $this->input->post();
		$kind = isset($post_data['kind']) ? $post_data['kind'] : 'add';
		$exhibition_id = isset($post_data['exhibition_id']) ? $post_data['exhibition_id'] : '';
		$office = isset($post_data['office']) ? $post_data['office'] : '';
		$place = isset($post_data['place']) ? $post_data['place'] : '';
		$event_date = isset($post_data['event_date']) ? $post_data['event_date'] : '';
		$exhibition_time_start = !empty($post_data['exhibition_time_start']) ? $post_data['exhibition_time_start'] : $default_array;
		$exhibition_time_end = !empty($post_data['exhibition_time_end']) ? $post_data['exhibition_time_end'] : $default_array;
		$capacity = !empty($post_data['capacity']) ? $post_data['capacity'] : $default_array;

		$week = array('日', '月', '火', '水', '木', '金', '土');
		$show_event_date = isset($event_date) ? date('n月j日', strtotime($event_date)) . '（' . $week[date('w', strtotime($event_date))] . '）' : '';

		for( $i = 0; $i < EXHIBITION_PERIOD_NUM; $i++ ) {
			if( !empty($exhibition_time_start[$i]) && !empty($exhibition_time_end[$i]) && !empty($capacity[$i]) ) {
				$detail[] = array(
					'start'		=> $exhibition_time_start[$i],
					'end'		=> $exhibition_time_end[$i],
					'capacity'	=> $capacity[$i]
				);
			}
		}

		$now = date('Y-m-d H:i:s');

		$this->db->trans_start();

		if( $kind == 'add' ) {
			$insert_data_exhibition = array(
				'office'			=> $office,
				'place_summer21'	=> $place,
				'event_date'		=> $event_date,
				'show_event_date'	=> $show_event_date,
				'regist_time'		=> $now,
				'update_time'		=> $now,
				'status'			=> '0'
			);
			$exhibition_summer21_id = $this->m_exhibition->insert($insert_data_exhibition);

			if( !empty($detail) ) {
				$sn = 1;
				foreach( $detail as $val ) {
					$insert_data_detail = array(
						'exhibition_summer21_id'	=> $exhibition_summer21_id,
						'serial_number'				=> $sn++,
						'exhibition_time_start'		=> $val['start'],
						'exhibition_time_end'		=> $val['end'],
						'capacity'		=> $val['capacity'],
						'reserved'		=> 0,
						'regist_time'	=> $now,
						'update_time'	=> $now,
						'status'		=> '0'
					);
					$this->m_exhibition_detail->insert($insert_data_detail);
				}
			}
		}
		else {
			$exhibition_data = $this->m_exhibition->get_one(array('exhibition_summer21_id' => $exhibition_id));
			if( empty($exhibition_data) ) {
				redirect('admin/exhibition/index/err2');
				return;
			}
			else {
				// 開催時間は一旦削除し、作成し直す
				$update_data_delete = array(
					'update_time'	=> $now,
					'status'		=> '9'
				);
				$this->m_exhibition_detail->update(array('exhibition_summer21_id' => $exhibition_id), $update_data_delete);

				$update_data_exhibition = array(
					'office'			=> $office,
					'place_summer21'	=> $place,
					'event_date'		=> $event_date,
					'show_event_date'	=> $show_event_date,
					'update_time'		=> $now
				);
				$this->m_exhibition->update(array('exhibition_summer21_id' => $exhibition_id), $update_data_exhibition);

				if( !empty($detail) ) {
					$sn = 1;
					foreach( $detail as $val ) {
						$insert_data_detail = array(
							'exhibition_summer21_id'	=> $exhibition_id,
							'serial_number'				=> $sn++,
							'exhibition_time_start'		=> $val['start'],
							'exhibition_time_end'		=> $val['end'],
							'capacity'		=> $val['capacity'],
							'reserved'		=> 0,
							'regist_time'	=> $now,
							'update_time'	=> $now,
							'status'		=> '0'
						);
						$this->m_exhibition_detail->insert($insert_data_detail);
					}
				}
			}
		}

		$this->db->trans_complete();

		if( $this->db->trans_status() === FALSE ) {
			redirect('admin/exhibition/index/err1');
			return;
		}

		redirect('admin/exhibition/index/ok');
		return;
	}

	public function apply_confirm($exhibition_id = '')
	{
		// ログイン済みチェック
		if( !$this->chk_logged_in_admin() ) {
			redirect('admin');
			return;
		}

		$exhibition_data = $this->m_exhibition->get_one(array('exhibition_summer21_id' => $exhibition_id));
		$apply_data = array();
		$detail_data = $this->m_exhibition_detail->get_list(array('exhibition_summer21_id' => $exhibition_id), 'serial_number ASC');
		if( !empty($detail_data) ) {
			foreach( $detail_data as $detail_val ) {
				if( !array_key_exists($detail_val['exhibition_detail_summer21_id'], $apply_data) ) {
					$apply_data[$detail_val['exhibition_detail_summer21_id']] = array(
						'serial_number'			=> $detail_val['serial_number'],
						'exhibition_time_start'	=> $detail_val['exhibition_time_start'],
						'exhibition_time_end'	=> $detail_val['exhibition_time_end'],
						'reserved'				=> $detail_val['reserved'],
						'apply'					=> array()
					);
				}

				$wk_apply_data = $this->m_apply_exhibition->get_list(array('exhibition_detail_summer21_id' => $detail_val['exhibition_detail_summer21_id']));
				if( !empty($wk_apply_data) ) {
					foreach( $wk_apply_data as $apply_val ) {
						if( !array_key_exists($apply_val['apply_exhibition_summer21_id'], $apply_data[$detail_val['exhibition_detail_summer21_id']]['apply']) ) {
							$apply_data[$detail_val['exhibition_detail_summer21_id']]['apply'][$apply_val['apply_exhibition_summer21_id']] = array(
								'juku_name'			=> $apply_val['juku_name'],
								'guest_num'			=> $apply_val['guest_num'],
								'zip'				=> $apply_val['zip'],
								'address'			=> $apply_val['address'],
								'tel'				=> $apply_val['tel'],
								'email'				=> $apply_val['email'],
								'regist_time'		=> $apply_val['regist_time'],
							);
						}
					}
				}
			}
		}

		$view_data = array(
			'CONF'	=> $this->conf,
			'EDATA'	=> $exhibition_data,
			'ADATA'	=> $apply_data,
			'EID'	=> $exhibition_id
		);

		$this->load->view('admin/exhibition/apply_confirm', $view_data);
	}

	public function dl($exhibition_id = '')
	{
		// ログイン済みチェック
		if( !$this->chk_logged_in_admin() ) {
			redirect('admin');
			return;
		}

		$apply_exhibition_data = $this->m_apply_exhibition->get_list_for_dl($exhibition_id);

		// タイムアウトさせない
		set_time_limit(0);

		$fp = fopen('php://output', 'w');
		stream_filter_append($fp, 'convert.iconv.UTF-8/CP932//TRANSLIT', STREAM_FILTER_WRITE);

		header("Content-Type: application/octet-stream");
		header("Content-Disposition: attachment; filename=" . 'exhibition' . date('YmdHis') . '.csv');

		if( empty($apply_exhibition_data) ) {
			fputs($fp, 'no data');
		}
		else {
			$csv_array = array(
				'開催時間',
				'塾名',
				'人数',
				'郵便番号',
				'住所',
				'電話番号',
				'メールアドレス',
				'申込日時'
			);
			fputcsv($fp, $csv_array);

			foreach( $apply_exhibition_data as $val ) {
				$csv_array = array(
					date('H:i', strtotime($val['exhibition_time_start'])) . '～' . date('H:i', strtotime($val['exhibition_time_end'])),
					$val['juku_name'],
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
	// 申込み済みデータが無いかチェック
	public function ajax_chk_applied()
	{
		$post_data = $this->input->post();
		$exhibition_id = isset($post_data['exhibition_id']) ? $post_data['exhibition_id'] : '';
		$apply_num = $this->m_apply_exhibition->get_applied($exhibition_id);

		$ret_val = array(
			'flg_exists'	=> $apply_num > 0 ? TRUE : FALSE
		);

		$this->ajax_out(json_encode($ret_val));
	}

	// 削除
	public function ajax_del()
	{
		$post_data = $this->input->post();
		$exhibition_id = isset($post_data['exhibition_id']) ? $post_data['exhibition_id'] : '';

		$ret_val = array(
			'status'		=> FALSE,
			'err_msg'		=> ''
		);

		if( $exhibition_id == '' ) {
			$ret_val['err_msg'] = 'パラメータエラーが発生しました。';
		}
		else {
			$exhibition_data = $this->m_exhibition->get_one(array('exhibition_summer21_id' => $exhibition_id));
			if( empty($exhibition_data) ) {
				$ret_val['err_msg'] = '削除する展示会情報が存在しません。';
			}
			else {
				$update_data = array(
					'update_time'	=> date('Y-m-d H:i:s'),
					'status'		=> '9'
				);

				$this->db->trans_start();

				// 申込データも削除
				$this->m_apply_exhibition->delete_by_exhibition_id($exhibition_id);

				// detailも削除
				$this->m_exhibition_detail->update(array('exhibition_summer21_id' => $exhibition_id), $update_data);

				// 展示会削除
				$this->m_exhibition->update(array('exhibition_summer21_id' => $exhibition_id), $update_data);

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
		$apply_exhibition_summer21_id = isset($post_data['apply_id']) ? $post_data['apply_id'] : '';

		$now = date('Y-m-d H:i:s');

		$this->db->trans_start();

		$apply_exhibition_data = $this->m_apply_exhibition->get_one(array('apply_exhibition_summer21_id' => $apply_exhibition_summer21_id));
		if( !empty($apply_exhibition_data) ) {
			$update_data_apply = array(
				'update_time'	=> $now,
				'status'		=> '9'
			);
			$this->m_apply_exhibition->update(array('apply_exhibition_summer21_id' => $apply_exhibition_summer21_id), $update_data_apply);

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

		$this->db->trans_complete();

		if( $this->db->trans_status() === FALSE ) {
			$ret_val['err_msg'] = 'データベースエラーが発生しました。';
		}
		else {
			$ret_val['status'] = TRUE;
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

		$exhibition_data = $this->m_exhibition->get_list('', $sort_str, $limit_array);
		$exhibition_all_data = $this->m_exhibition->get_list();

		$row_val = array();

		if( !empty($exhibition_data) ) {
			foreach( $exhibition_data as $val ) {
				$guest_total = 0;
				$wk_detail_data = $this->m_exhibition_detail->get_list(array('exhibition_summer21_id' => $val['exhibition_summer21_id']));
				if( !empty($wk_detail_data) ) {
					foreach( $wk_detail_data as $detail ) {
						$guest_total += intval($detail['reserved']);
					}
				}

				$row_val[] = array(
					'exhibition_id'		=> $val['exhibition_summer21_id'],
					'office_id'			=> $val['office'],
					'office'			=> isset($this->conf['office'][$val['office']]) ? $this->conf['office'][$val['office']] : '',
					'place_id'			=> $val['place_summer21'],
					'place'				=> isset($this->conf['place_summer21'][$val['place_summer21']]) ? $this->conf['place_summer21'][$val['place_summer21']] : '',
					'event_date'		=> $val['show_event_date'],
					'event_date_data'	=> $val['event_date'],
					'guest_total'		=> $guest_total
				);
			}
		}

		$ret_val = array(
			'current'	=> $current,
			'rowCount'	=> $rowCount,
			'total'		=> count($exhibition_all_data),
			'rows'		=> $row_val
		);

		$this->ajax_out(json_encode($ret_val));
	}
}
