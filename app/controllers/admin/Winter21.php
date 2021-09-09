<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Winter21 extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();

		// モデルロード
		$this->load->model('m_exhibition_winter21', 'm_exhibition');
		$this->load->model('m_exhibition_detail_winter21', 'm_exhibition_detail');
		$this->load->model('m_apply_exhibition_winter21', 'm_apply_exhibition');

		// 設定ファイルロード
		$this->config->load('config_disp', TRUE, TRUE);
		$this->conf = $this->config->item('disp', 'config_disp');

		// バリデーションエラー設定
		$this->form_validation->set_error_delimiters('<p class="error-msg">', '</p>');
	}

	public function index()
	{
		// ログイン済みチェック
		if( !$this->chk_logged_in_admin() ) {
			redirect('admin');
			return;
		}

		$this->load->view('admin/winter21/index');
	}

	public function apply_confirm($exhibition_id = '')
	{
		// ログイン済みチェック
		if( !$this->chk_logged_in_admin() ) {
			redirect('admin');
			return;
		}

		$exhibition_data = $this->m_exhibition->get_one(array('exhibition_winter21_id' => $exhibition_id));
		$apply_data = array();
		$detail_data = $this->m_exhibition_detail->get_list(array('exhibition_winter21_id' => $exhibition_id), 'serial_number ASC');
		if( !empty($detail_data) ) {
			foreach( $detail_data as $detail_val ) {
				if( !array_key_exists($detail_val['exhibition_detail_winter21_id'], $apply_data) ) {
					$apply_data[$detail_val['exhibition_detail_winter21_id']] = array(
						'serial_number'			=> $detail_val['serial_number'],
						'exhibition_time_start'	=> $detail_val['exhibition_time_start'],
						'exhibition_time_end'	=> $detail_val['exhibition_time_end'],
						'reserved'				=> $detail_val['reserved'],
						'apply'					=> array()
					);
				}

				$wk_apply_data = $this->m_apply_exhibition->get_list(array('exhibition_detail_winter21_id' => $detail_val['exhibition_detail_winter21_id']));
				if( !empty($wk_apply_data) ) {
					foreach( $wk_apply_data as $apply_val ) {
						if( !array_key_exists($apply_val['apply_exhibition_winter21_id'], $apply_data[$detail_val['exhibition_detail_winter21_id']]['apply']) ) {
							$apply_data[$detail_val['exhibition_detail_winter21_id']]['apply'][$apply_val['apply_exhibition_winter21_id']] = array(
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

		$this->load->view('admin/winter21/apply_confirm', $view_data);
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
	// キャンセル
	public function ajax_cancel()
	{
		$post_data = $this->input->post();
		$apply_exhibition_winter21_id = isset($post_data['apply_id']) ? $post_data['apply_id'] : '';

		$now = date('Y-m-d H:i:s');

		$this->db->trans_start();

		$apply_exhibition_data = $this->m_apply_exhibition->get_one(array('apply_exhibition_winter21_id' => $apply_exhibition_winter21_id));
		if( !empty($apply_exhibition_data) ) {
			$update_data_apply = array(
				'update_time'	=> $now,
				'status'		=> '9'
			);
			$this->m_apply_exhibition->update(array('apply_exhibition_winter21_id' => $apply_exhibition_winter21_id), $update_data_apply);

			$detail_data = $this->m_exhibition_detail->get_one(array('exhibition_detail_winter21_id' => $apply_exhibition_data['exhibition_detail_winter21_id']));
			if( !empty($detail_data) ) {
				$new_num = intval($detail_data['reserved']) - intval($apply_exhibition_data['guest_num']);

				$update_data_detail = array(
					'reserved'		=> $new_num,
					'update_time'	=> $now
				);
				$this->m_exhibition_detail->update(array('exhibition_detail_winter21_id' => $detail_data['exhibition_detail_winter21_id']), $update_data_detail);
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
		$rowCount = isset($post_data['rowCount']) ? intval($post_data['rowCount']) : 15;
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
				$reserved = array('1' => 0, '2' => 0, '3' => 0, '4' => 0, '5' => 0);

				for( $i = 1; $i <= 5; $i++ ) {
					$wk_detail_data = $this->m_exhibition_detail->get_one(array('exhibition_winter21_id' => $val['exhibition_winter21_id'], 'serial_number' => $i));
					if( !empty($wk_detail_data) ) {
						$reserved[$i] = $wk_detail_data['reserved'];
					}
				}

				$row_val[] = array(
					'exhibition_id'		=> $val['exhibition_winter21_id'],
					'place'				=> isset($this->conf['place_winter21'][$val['place_winter21']]) ? $this->conf['place_winter21'][$val['place_winter21']] : '',
					'event_date'		=> $val['show_event_date'],
					'guest_num1'		=> $reserved[1],
					'guest_num2'		=> $reserved[2],
					'guest_num3'		=> $reserved[3],
					'guest_num4'		=> $reserved[4],
					'guest_num5'		=> $reserved[5]
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
