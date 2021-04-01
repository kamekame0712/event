<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Summer21 extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();

		// モデルロード
		$this->load->model('m_seminar_summer21', 'm_seminar');
		$this->load->model('m_exhibition_summer21', 'm_exhibition');
		$this->load->model('m_exhibition_detail_summer21', 'm_exhibition_detail');
		$this->load->model('m_apply_seminar_summer21', 'm_apply_seminar');
		$this->load->model('m_apply_exhibition_summer21', 'm_apply_exhibition');
		$this->load->model('m_mail');

		// 設定ファイルロード
		$this->config->load('config_disp', TRUE, TRUE);
		$this->conf = $this->config->item('disp', 'config_disp');

		$this->config->load('config_mail', TRUE, TRUE);
		$this->conf_mail = $this->config->item('mail', 'config_mail');

		// バリデーションエラー設定
		$this->form_validation->set_error_delimiters('<p class="error-msg">', '</p>');
	}

	public function kansai()
	{
		$this->load->view('front/summer21/kansai');
	}

	public function chushikoku()
	{
		$this->load->view('front/summer21/chushikoku');
	}

	public function kyushu()
	{
		$this->load->view('front/summer21/kyushu');
	}

	public function apply_seminar($office = '')
	{
		if( $office == '' ) {
			redirect('errors/error_404');
			return;
		}

		// リロード対策
		if( $this->input->cookie('apply_seminar') ) {
			delete_cookie('apply_seminar');
		}

		$remain_seminar = array();
		$remain_exhibition = array();
		switch( $office ) {
			case 'kansai':
				$view_file = 'front/summer21/apply_seminar_kansai';
				$seminar_data = $this->m_seminar->get_list(array('office' => '2'), 'event_date ASC, place_summer21 ASC');	// 2:関西オフィス
				if( !empty($seminar_data) ) {
					foreach( $seminar_data as $seminar ) {
						$remain_seminar[$seminar['place_summer21']] = intval($seminar['capacity']) - intval($seminar['reserved']);
					}
				}

				$exhibition_data = $this->m_exhibition->get_list(array('office' => '2'), 'event_date ASC, place_summer21 ASC');	// 2:関西オフィス
				if( !empty($exhibition_data) ) {
					foreach( $exhibition_data as $exhibition ) {
						$detail_data = $this->m_exhibition_detail->get_list(array('exhibition_summer21_id' => $exhibition['exhibition_summer21_id']), 'serial_number ASC');
						if( !empty($detail_data) ) {
							foreach( $detail_data as $detail ) {
								$remain_exhibition[$exhibition['place_summer21']][$detail['serial_number']] = array(
									'detail_id'	=> $detail['exhibition_detail_summer21_id'],
									'start'		=> $detail['exhibition_time_start'],
									'end'		=> $detail['exhibition_time_end'],
									'remain'	=> intval($detail['capacity']) - intval($detail['reserved'])
								);
							}
						}
					}
				}

				break;
			default:
				redirect('errors/error_404');
				return;
		}

		$view_data = array(
			'OFFICE'			=> $office,
			'REMAIN_SEMINAR'	=> $remain_seminar,
			'REMAIN_EXHIBITION'	=> $remain_exhibition
		);

		$this->load->view($view_file, $view_data);
	}

	public function confirm_seminar()
	{
		// リロード対策
		if( $this->input->cookie('apply_seminar') ) {
			delete_cookie('apply_seminar');
		}

		$post_data = $this->input->post();

		// バリデーションチェック
		if( $this->form_validation->run('apply_seminar') == FALSE ) {
			$office = isset($post_data['office']) ? $post_data['office'] : '';
			$this->apply_seminar($office);
			return;
		}

		$place = isset($post_data['place']) ? $post_data['place'] : '';
		$time = isset($post_data['time']) ? $post_data['time'] : '';

		$venue = $title = $area = $period = '';
		switch( $place ) {
			case '7':
				$venue = 'OSAKA&nbsp;/&nbsp;KYOTO';
				$title = '安河内 哲也氏「今の子どもたちに必要な英語とは」';
				$area = '大阪会場［６月１日（火）］';
				$period = '11:00～12:30';
				break;

			case '8':
				$venue = 'OSAKA&nbsp;/&nbsp;KYOTO';
				$title = '安河内 哲也氏「今の子どもたちに必要な英語とは」';
				$area = '京都会場［６月２日（水）］';
				$period = '11:00～12:30';
				break;

			case '9':
				$venue = 'KOBE&nbsp;/&nbsp;HIMEJI';
				$title = '向井 菜穂子氏「新学習指導要領に伴う英語教育改革」';
				$area = '神戸会場［６月３日（木）］';
				$period = '11:00～12:40';
				break;

			case '10':
				$venue = 'KOBE&nbsp;/&nbsp;HIMEJI';
				$title = '向井 菜穂子氏「新学習指導要領に伴う英語教育改革」';
				$area = '姫路会場［６月４日（金）］';
				$period = '11:00～12:40';
				break;
		}

		if( empty($post_data['guest_name1']) && !empty($post_data['guest_name2']) ) {
			$post_data['guest_name1'] = $post_data['guest_name2'];
			$post_data['guest_name2'] = '';
		}

		if( substr($time, 0, 1) != '0' ) {
			$wk_detail = $this->m_exhibition_detail->get_one(array('exhibition_detail_summer21_id' => $time));
			if( !empty($wk_detail) ) {
				$exhibition = '希望する';
				$exhibition_time = date('H:i', strtotime($wk_detail['exhibition_time_start'])) . '～' . date('H:i', strtotime($wk_detail['exhibition_time_end']));
			}
			else {
				$exhibition = '希望する';
				$exhibition_time = '';
			}
		}
		else {
			$exhibition = '希望しない';
			$exhibition_time = '';
		}

		$view_data = array(
			'PDATA'		=> $post_data,
			'VENUE'		=> $venue,
			'TITLE'		=> $title,
			'AREA'		=> $area,
			'PERIOD'	=> $period,
			'EX'		=> $exhibition,
			'EX_TIME'	=> $exhibition_time
		);

		$this->load->view('front/summer21/apply_seminar_confirm', $view_data);
	}

	public function complete_seminar()
	{
		$post_data = $this->input->post();
		$place_summer21 = isset($post_data['place']) ? $post_data['place'] : '';
		$guest_name1 = isset($post_data['guest_name1']) ? $post_data['guest_name1'] : '';
		$guest_name2 = isset($post_data['guest_name2']) ? $post_data['guest_name2'] : '';
		$exhibition_detail_summer21_id = isset($post_data['time']) ? $post_data['time'] : '';
		$juku_name = isset($post_data['juku_name']) ? $post_data['juku_name'] : '';
		$zip = isset($post_data['zip']) ? $post_data['zip'] : '';
		$address = isset($post_data['address']) ? $post_data['address'] : '';
		$tel = isset($post_data['tel']) ? $post_data['tel'] : '';
		$email = isset($post_data['email']) ? $post_data['email'] : '';
		$office = isset($post_data['office']) ? $post_data['office'] : '';

		// リロード対策
		if( $this->input->cookie('apply_seminar') ) {
			redirect('summer21/' . $office);
		}
		else {
			$cookie_data = array(
				'name'	=> 'apply_seminar',
				'value'	=> '1',
				'expire'=> '86400'
			);
			$this->input->set_cookie($cookie_data);
		}

		if( substr($exhibition_detail_summer21_id, 0, 1) != '0' ) {
			$attend_exhibition = '1';
		}
		else {
			$attend_exhibition = '2';
		}

		$this->load->helper('string');
		do {
			$reception_slip_no = random_string('alnum', 17);
			$wk_aapply_seminar = $this->m_apply_seminar->get_one(array('reception_slip_no' => $reception_slip_no));
			$wk_apply_exhibition = $this->m_apply_exhibition->get_one(array('reception_slip_no' => $reception_slip_no));
		} while( !empty($wk_aapply_seminar) || !empty($wk_apply_exhibition) );

		$err_str = '';
		$wk_seminar = $this->m_seminar->get_one(array('place_summer21' => $place_summer21));
		if( empty($wk_seminar) ) {
			$err_str = 'セミナー情報が存在しません。';
		}
		else {
			$now = date('Y-m-d H:i:s');

			$this->db->trans_start();

			$insert_data_apply_seminar = array(
				'seminar_summer21_id'	=> $wk_seminar['seminar_summer21_id'],
				'guest_name1'			=> $guest_name1,
				'guest_name2'			=> $guest_name2,
				'juku_name'				=> $juku_name,
				'zip'					=> $zip,
				'address'				=> $address,
				'tel'					=> $tel,
				'email'					=> $email,
				'attend_exhibition'		=> $attend_exhibition,
				'reception_slip_no'		=> $reception_slip_no,
				'regist_time'			=> $now,
				'update_time'			=> $now,
				'status'				=> '0'
			);
			$apply_seminar_summer21_id = $this->m_apply_seminar->insert($insert_data_apply_seminar);

			$reserve_num = empty($guest_name2) ? 1 : 2;
			$new_reserved = intval($wk_seminar['reserved']) + intval($reserve_num);
			$update_data_seminar = array(
				'reserved'		=> $new_reserved,
				'update_time'	=> $now
			);
			$this->m_seminar->update(array('seminar_summer21_id' => $wk_seminar['seminar_summer21_id']), $update_data_seminar);

			if( $attend_exhibition == '1' ) {
				$wk_exhibition_detail = $this->m_exhibition_detail->get_one(array('exhibition_detail_summer21_id' => $exhibition_detail_summer21_id));
				if( empty($wk_exhibition_detail) ) {
					$err_str = '夏期テキスト展示の情報が存在しません。';
				}
				else {
					$insert_data_apply_exhibition = array(
						'exhibition_detail_summer21_id'	=> $exhibition_detail_summer21_id,
						'apply_seminar_summer21_id'		=> $apply_seminar_summer21_id,
						'guest_num'						=> $reserve_num,
						'juku_name'						=> $juku_name,
						'zip'							=> $zip,
						'address'						=> $address,
						'tel'							=> $tel,
						'email'							=> $email,
						'reception_slip_no'				=> $reception_slip_no,
						'regist_time'					=> $now,
						'update_time'					=> $now,
						'status'						=> '0'
					);
					$this->m_apply_exhibition->insert($insert_data_apply_exhibition);

					$new_reserved = intval($wk_exhibition_detail['reserved']) + intval($reserve_num);
					$update_data_exhibition_detail = array(
						'reserved'		=> $new_reserved,
						'update_time'	=> $now
					);
					$this->m_exhibition_detail->update(array('exhibition_detail_summer21_id' => $wk_exhibition_detail['exhibition_detail_summer21_id']), $update_data_exhibition_detail);
				}
			}

			$this->db->trans_complete();

			if( $this->db->trans_status() === FALSE ) {
				$err_str = 'データベースエラーが発生しました。';
			}
		}

		if( $err_str == '' ) {
			// 受付票のURLをメールでお知らせ
			$title = $area = '';
			switch( $place_summer21 ) {
				case '7':
					$title = '安河内 哲也氏「今の子どもたちに必要な英語とは」';
					$area = '大阪会場［６月１日（火）］';
					break;

				case '8':
					$title = '安河内 哲也氏「今の子どもたちに必要な英語とは」';
					$area = '京都会場［６月２日（水）］';
					break;

				case '9':
					$title = '向井 菜穂子氏「新学習指導要領に伴う英語教育改革」';
					$area = '神戸会場［６月３日（木）］';
					break;

				case '10':
					$title = '向井 菜穂子氏「新学習指導要領に伴う英語教育改革」';
					$area = '姫路会場［６月４日（金）］';
					break;
			}

			if( substr($exhibition_detail_summer21_id, 0, 1) != '0' ) {
				$wk_detail = $this->m_exhibition_detail->get_one(array('exhibition_detail_summer21_id' => $exhibition_detail_summer21_id));
				if( !empty($wk_detail) ) {
					$exhibition = '希望する';
					$exhibition_time = date('H:i', strtotime($wk_detail['exhibition_time_start'])) . '～' . date('H:i', strtotime($wk_detail['exhibition_time_end']));
				}
				else {
					$exhibition = '希望する';
					$exhibition_time = '';
				}
			}
			else {
				$exhibition = '希望しない';
				$exhibition_time = '';
			}

			switch( $office ) {
				case 'kansai':
					$office_name = '関西オフィス';
					$office_add = '〒532-0003　大阪市淀川区宮原2-14-14 新大阪グランドビル9F';
					$ofiice_tel = '06-6399-1400';
					$office_fax = '06-6399-1415';
					break;
			}

			$mail_data = array(
				'ADATA'		=> $insert_data_apply_seminar,
				'TITLE'		=> $title,
				'AREA'		=> $area,
				'EX'		=> $exhibition,
				'EX_TIME'	=> $exhibition_time,
				'OFFICE'	=> $office_name,
				'ADDRESS'	=> $office_add,
				'TEL'		=> $ofiice_tel,
				'FAX'		=> $office_fax
			);
			$mail_body = $this->load->view('mail/tmpl_apply_seminar_complete', $mail_data, TRUE);

			$params = array(
				'from'		=> $this->conf_mail['apply_comp_to_customer']['from'],
				'from_name'	=> $this->conf_mail['apply_comp_to_customer']['from_name'],
				'to'		=> $email,
				'subject'	=> 'お申し込みのお礼と受付票の送付【中央教育研究所(株)】',
				'message'	=> $mail_body
			);

			$this->m_mail->send($params);
		}

		$view_data = array(
			'ERR_STR'	=> $err_str,
			'RECEPTION'	=> $reception_slip_no
		);

		$this->load->view('front/summer21/apply_seminar_complete', $view_data);
	}

	public function seminar_reception()
	{
		$get_data = $this->input->get();
		$reception_slip_no = isset($get_data['reception']) ? $get_data['reception'] : '';

		if( empty($reception_slip_no) ) {
			redirect('errors/error_404');
			return;
		}

		$apply_seminar_data = $this->m_apply_seminar->get_one(array('reception_slip_no' => $reception_slip_no));
		if( empty($apply_seminar_data) ) {
			redirect('errors/error_404');
			return;
		}

		$seminar_data = $this->m_seminar->get_one(array('seminar_summer21_id' => $apply_seminar_data['seminar_summer21_id']));
		if( empty($seminar_data) ) {
			redirect('errors/error_404');
			return;
		}

		$exhibition_data = array();
		if( $apply_seminar_data['attend_exhibition'] == '1' ) {
			$exhibition_data = $this->m_apply_exhibition->get_time_by_seminar($apply_seminar_data['apply_seminar_summer21_id']);
			if( empty($exhibition_data) ) {
				redirect('errors/error_404');
				return;
			}
		}

		$venue = $title = $area = $period = '';
		switch( $seminar_data['place_summer21'] ) {
			case '7':
				$venue = 'OSAKA&nbsp;/&nbsp;KYOTO';
				$title = '安河内 哲也氏「今の子どもたちに必要な英語とは」';
				$area = '大阪会場［６月１日（火）］';
				$period = '11:00～12:30';
				break;

			case '8':
				$venue = 'OSAKA&nbsp;/&nbsp;KYOTO';
				$title = '安河内 哲也氏「今の子どもたちに必要な英語とは」';
				$area = '京都会場［６月２日（水）］';
				$period = '11:00～12:30';
				break;

			case '9':
				$venue = 'KOBE&nbsp;/&nbsp;HIMEJI';
				$title = '向井 菜穂子氏「新学習指導要領に伴う英語教育改革」';
				$area = '神戸会場［６月３日（木）］';
				$period = '11:00～12:40';
				break;

			case '10':
				$venue = 'KOBE&nbsp;/&nbsp;HIMEJI';
				$title = '向井 菜穂子氏「新学習指導要領に伴う英語教育改革」';
				$area = '姫路会場［６月４日（金）］';
				$period = '11:00～12:40';
				break;
		}

		if( $apply_seminar_data['attend_exhibition'] == '1' ) {
			$exhibition = '希望する';
			$exhibition_time = date('H:i', strtotime($exhibition_data['exhibition_time_start'])) . '～' . date('H:i', strtotime($exhibition_data['exhibition_time_end']));
		}
		else {
			$exhibition = '希望しない';
			$exhibition_time = '';
		}

		$view_data = array(
			'ADATA'		=> $apply_seminar_data,
			'VENUE'		=> $venue,
			'TITLE'		=> $title,
			'AREA'		=> $area,
			'PERIOD'	=> $period,
			'EX'		=> $exhibition,
			'EX_TIME'	=> $exhibition_time
		);

		$this->load->view('front/summer21/seminar_reception', $view_data);
	}

	public function dl_seminar()
	{
		$post_data = $this->input->post();
		$reception_slip_no = isset($post_data['reception_slip_no']) ? $post_data['reception_slip_no'] : '';

		if( empty($reception_slip_no) ) {
			redirect('errors/error_404');
			return;
		}

		$apply_seminar_data = $this->m_apply_seminar->get_one(array('reception_slip_no' => $reception_slip_no));
		if( empty($apply_seminar_data) ) {
			redirect('errors/error_404');
			return;
		}

		$seminar_data = $this->m_seminar->get_one(array('seminar_summer21_id' => $apply_seminar_data['seminar_summer21_id']));
		if( empty($seminar_data) ) {
			redirect('errors/error_404');
			return;
		}

		$exhibition_data = array();
		if( $apply_seminar_data['attend_exhibition'] == '1' ) {
			$exhibition_data = $this->m_apply_exhibition->get_time_by_seminar($apply_seminar_data['apply_seminar_summer21_id']);
			if( empty($exhibition_data) ) {
				redirect('errors/error_404');
				return;
			}
		}

		$source_file = $area = $date = '';
		switch( $seminar_data['place_summer21'] ) {
			case '7':
				$source_file = 'reception_slip_seminar_k.pdf';
				$area = '大阪会場';
				$date = '６月１日（火）';
				break;
			case '8':
				$source_file = 'reception_slip_seminar_k.pdf';
				$area = '京都会場';
				$date = '６月２日（水）';
				break;
			case '9':
				$source_file = 'reception_slip_seminar_k.pdf';
				$area = '神戸会場';
				$date = '６月３日（木）';
				break;
			case '10':
				$source_file = 'reception_slip_seminar_k.pdf';
				$area = '姫路会場';
				$date = '６月４日（金）';
				break;
		}

		if( $source_file == '' || $area == '' || $date == '' ) {
			redirect('errors/error_404');
			return;
		}

		if( $apply_seminar_data['attend_exhibition'] == '1' ) {
			$exhibition = '参加 ' . date('H:i', strtotime($exhibition_data['exhibition_time_start'])) . '～' . date('H:i', strtotime($exhibition_data['exhibition_time_end']));
		}
		else {
			$exhibition = '入場いただけません';
		}

		// タイムアウトさせない
		set_time_limit(0);

		require_once APPPATH . 'libraries/tcpdf/tcpdf.php';
		require_once APPPATH . 'libraries/tcpdf/fpdi/autoload.php';

		$pdf = new setasign\Fpdi\Tcpdf\Fpdi();

		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);

		$pdf->setSourceFile(PDF_FOLDER . $source_file);
		$pdf->AddPage();
		$tpl = $pdf->importPage(1);
		$pdf->useTemplate($tpl);
		$pdf->SetFont('kozgopromedium', '', 28);

		if( $seminar_data['office'] == '2' ) {
			$pdf->Text(73, 48, $area);
			$pdf->Text(73, 72.5, $date);
			$pdf->Text(73, 104, $apply_seminar_data['juku_name']);
			$pdf->Text(73, 130.5, empty($apply_seminar_data['guest_name2']) ? '1名' : '2名');
			$pdf->Text(73, 157.5, $apply_seminar_data['attend_exhibition'] == '1' ? '参加' : '不参加');
			$pdf->Text(73, 186.35, $exhibition);
		}

		$pdf->Output();
	}

	public function apply_exhibition($office = '')
	{
		if( $office == '' ) {
			redirect('errors/error_404');
			return;
		}

		// リロード対策
		if( $this->input->cookie('apply_exhibition') ) {
			delete_cookie('apply_exhibition');
		}

		$remain_exhibition = array();
		switch( $office ) {
			case 'kansai':
				$view_file = 'front/summer21/apply_exhibition_kansai';

				$exhibition_data = $this->m_exhibition->get_list(array('office' => '2'), 'event_date ASC, place_summer21 ASC');	// 2:関西オフィス
				if( !empty($exhibition_data) ) {
					foreach( $exhibition_data as $exhibition ) {
						$detail_data = $this->m_exhibition_detail->get_list(array('exhibition_summer21_id' => $exhibition['exhibition_summer21_id']), 'serial_number ASC');
						if( !empty($detail_data) ) {
							foreach( $detail_data as $detail ) {
								$remain_exhibition[$exhibition['place_summer21']][$detail['serial_number']] = array(
									'detail_id'	=> $detail['exhibition_detail_summer21_id'],
									'start'		=> $detail['exhibition_time_start'],
									'end'		=> $detail['exhibition_time_end'],
									'remain'	=> intval($detail['capacity']) - intval($detail['reserved'])
								);
							}
						}
					}
				}
				break;

			case 'chushikoku':
				$view_file = 'front/summer21/apply_exhibition_chushikoku';

				$exhibition_data = $this->m_exhibition->get_list(array('office' => '3'), 'event_date ASC, place_summer21 ASC');	// 3:中四国オフィス
				if( !empty($exhibition_data) ) {
					foreach( $exhibition_data as $exhibition ) {
						$detail_data = $this->m_exhibition_detail->get_list(array('exhibition_summer21_id' => $exhibition['exhibition_summer21_id']), 'serial_number ASC');
						if( !empty($detail_data) ) {
							foreach( $detail_data as $detail ) {
								$remain_exhibition[$exhibition['place_summer21']][$detail['serial_number']] = array(
									'detail_id'	=> $detail['exhibition_detail_summer21_id'],
									'start'		=> $detail['exhibition_time_start'],
									'end'		=> $detail['exhibition_time_end'],
									'remain'	=> intval($detail['capacity']) - intval($detail['reserved'])
								);
							}
						}
					}
				}
				break;

			default:
				redirect('errors/error_404');
				return;
		}

		$guest_num_list = array(
			''		=> '選択してください',
			'1'		=> '1',
			'2'		=> '2',
			'3'		=> '3',
			'4'		=> '4',
			'5'		=> '5',
			'6'		=> '6',
			'7'		=> '7',
			'8'		=> '8',
			'9'		=> '9',
			'10'	=> '10'
		);

		$view_data = array(
			'OFFICE'			=> $office,
			'REMAIN_EXHIBITION'	=> $remain_exhibition,
			'GLIST'		=> $guest_num_list
		);

		$this->load->view($view_file, $view_data);
	}

	public function confirm_exhibition()
	{
		// リロード対策
		if( $this->input->cookie('apply_exhibition') ) {
			delete_cookie('apply_exhibition');
		}

		$post_data = $this->input->post();

		// バリデーションチェック
		if( $this->form_validation->run('apply_exhibition') == FALSE ) {
			$office = isset($post_data['office']) ? $post_data['office'] : '';
			$this->apply_exhibition($office);
			return;
		}

		$place = isset($post_data['place']) ? $post_data['place'] : '';
		$time = isset($post_data['time']) ? $post_data['time'] : '';
		$wk_detail = $this->m_exhibition_detail->get_one(array('exhibition_detail_summer21_id' => $time));
		$exhibition_time = date('H:i', strtotime($wk_detail['exhibition_time_start'])) . '～' . date('H:i', strtotime($wk_detail['exhibition_time_end']));

		$area = '';
		switch( $place ) {
			case '2':
				$area = '広島会場［５月２６日（水）］';
				break;
			case '3':
				$area = '岡山会場［５月３１日（月）］';
				break;
			case '4':
				$area = '松山会場［５月２７日（木）］';
				break;
			case '5':
				$area = '福山会場［５月２８日（金）］';
				break;
			case '6':
				$area = '米子会場［５月２５日（火）］';
				break;
			case '7':
				$area = '大阪会場［６月１日（火）］';
				break;
			case '8':
				$area = '京都会場［６月２日（水）］';
				break;
			case '9':
				$area = '神戸会場［６月３日（木）］';
				break;
			case '10':
				$area = '姫路会場［６月４日（金）］';
				break;
		}

		$view_data = array(
			'PDATA'		=> $post_data,
			'AREA'		=> $area,
			'TIME'		=> $exhibition_time
		);

		$this->load->view('front/summer21/apply_exhibition_confirm', $view_data);
	}

	public function complete_exhibition()
	{
		$post_data = $this->input->post();
		$place_summer21 = isset($post_data['place']) ? $post_data['place'] : '';
		$exhibition_detail_summer21_id = isset($post_data['time']) ? $post_data['time'] : '';
		$guest_num = isset($post_data['guest_num']) ? $post_data['guest_num'] : '';
		$juku_name = isset($post_data['juku_name']) ? $post_data['juku_name'] : '';
		$zip = isset($post_data['zip']) ? $post_data['zip'] : '';
		$address = isset($post_data['address']) ? $post_data['address'] : '';
		$tel = isset($post_data['tel']) ? $post_data['tel'] : '';
		$email = isset($post_data['email']) ? $post_data['email'] : '';
		$office = isset($post_data['office']) ? $post_data['office'] : '';

		// リロード対策
		if( $this->input->cookie('apply_exhibition') ) {
			redirect('summer21/' . $office);
		}
		else {
			$cookie_data = array(
				'name'	=> 'apply_exhibition',
				'value'	=> '1',
				'expire'=> '86400'
			);
			$this->input->set_cookie($cookie_data);
		}

		$now = date('Y-m-d H:i:s');

		$this->load->helper('string');
		do {
			$reception_slip_no = random_string('alnum', 17);
			$wk_aapply_seminar = $this->m_apply_seminar->get_one(array('reception_slip_no' => $reception_slip_no));
			$wk_apply_exhibition = $this->m_apply_exhibition->get_one(array('reception_slip_no' => $reception_slip_no));
		} while( !empty($wk_aapply_seminar) || !empty($wk_apply_exhibition) );

		$this->db->trans_start();

		$err_str = '';
		$wk_exhibition_detail = $this->m_exhibition_detail->get_one(array('exhibition_detail_summer21_id' => $exhibition_detail_summer21_id));
		if( empty($wk_exhibition_detail) ) {
			$err_str = '夏期テキスト展示の情報が存在しません。';
		}
		else {
			$insert_data_apply_exhibition = array(
				'exhibition_detail_summer21_id'	=> $exhibition_detail_summer21_id,
				'apply_seminar_summer21_id'		=> NULL,
				'guest_num'						=> $guest_num,
				'juku_name'						=> $juku_name,
				'zip'							=> $zip,
				'address'						=> $address,
				'tel'							=> $tel,
				'email'							=> $email,
				'reception_slip_no'				=> $reception_slip_no,
				'regist_time'					=> $now,
				'update_time'					=> $now,
				'status'						=> '0'
			);
			$this->m_apply_exhibition->insert($insert_data_apply_exhibition);

			$new_reserved = intval($wk_exhibition_detail['reserved']) + intval($guest_num);
			$update_data_exhibition_detail = array(
				'reserved'		=> $new_reserved,
				'update_time'	=> $now
			);
			$this->m_exhibition_detail->update(array('exhibition_detail_summer21_id' => $wk_exhibition_detail['exhibition_detail_summer21_id']), $update_data_exhibition_detail);
		}

		$this->db->trans_complete();

		if( $this->db->trans_status() === FALSE ) {
			$err_str = 'データベースエラーが発生しました。';
		}

		if( $err_str == '' ) {
			// 受付票のURLをメールでお知らせ
			$wk_detail = $this->m_exhibition_detail->get_one(array('exhibition_detail_summer21_id' => $exhibition_detail_summer21_id));
			$exhibition_time = date('H:i', strtotime($wk_detail['exhibition_time_start'])) . '～' . date('H:i', strtotime($wk_detail['exhibition_time_end']));

			$area = $date = '';
			switch( $place_summer21 ) {
				case '2':
					$area = '広島会場［５月２６日（水）］';
					break;
				case '3':
					$area = '岡山会場［５月３１日（月）］';
					break;
				case '4':
					$area = '松山会場［５月２７日（木）］';
					break;
				case '5':
					$area = '福山会場［５月２８日（金）］';
					break;
				case '6':
					$area = '米子会場［５月２５日（火）］';
					break;
				case '7':
					$area = '大阪会場［６月１日（火）］';
					break;
				case '8':
					$area = '京都会場［６月２日（水）］';
					break;
				case '9':
					$area = '神戸会場［６月３日（木）］';
					break;
				case '10':
					$area = '姫路会場［６月４日（金）］';
					break;
			}

			switch( $office ) {
				case 'kansai':
					$office_name = '関西オフィス';
					$office_add = '〒532-0003　大阪市淀川区宮原2-14-14 新大阪グランドビル9F';
					$ofiice_tel = '06-6399-1400';
					$office_fax = '06-6399-1415';
					break;

				case 'chushikoku':
					$office_name = '中四国オフィス';
					$office_add = '〒730-0013　広島市中区八丁堀15-6 広島ちゅうぎんビル3F';
					$ofiice_tel = '082-227-3999';
					$office_fax = '082-227-4000';
					break;
			}

			$mail_data = array(
				'ADATA'		=> $insert_data_apply_exhibition,
				'AREA'		=> $area,
				'TIME'		=> $exhibition_time,
				'OFFICE'	=> $office_name,
				'ADDRESS'	=> $office_add,
				'TEL'		=> $ofiice_tel,
				'FAX'		=> $office_fax
			);
			$mail_body = $this->load->view('mail/tmpl_apply_exhibition_complete', $mail_data, TRUE);

			$params = array(
				'from'		=> $this->conf_mail['apply_comp_to_customer']['from'],
				'from_name'	=> $this->conf_mail['apply_comp_to_customer']['from_name'],
				'to'		=> $email,
				'subject'	=> 'お申し込みのお礼と受付票の送付【中央教育研究所(株)】',
				'message'	=> $mail_body
			);

			$this->m_mail->send($params);
		}

		$view_data = array(
			'ERR_STR'	=> $err_str,
			'RECEPTION'	=> $reception_slip_no,
			'OFFICE'	=> $office
		);

		$this->load->view('front/summer21/apply_exhibition_complete', $view_data);
	}

	public function exhibition_reception()
	{
		$get_data = $this->input->get();
		$reception_slip_no = isset($get_data['reception']) ? $get_data['reception'] : '';

		if( empty($reception_slip_no) ) {
			redirect('errors/error_404');
			return;
		}

		$apply_exhibition_data = $this->m_apply_exhibition->get_one(array('reception_slip_no' => $reception_slip_no));
		if( empty($apply_exhibition_data) ) {
			redirect('errors/error_404');
			return;
		}

		$detail_data = $this->m_exhibition_detail->get_one(array('exhibition_detail_summer21_id' => $apply_exhibition_data['exhibition_detail_summer21_id']));
		if( empty($detail_data) ) {
			redirect('errors/error_404');
			return;
		}

		$exhibition_data = $this->m_exhibition->get_one(array('exhibition_summer21_id' => $detail_data['exhibition_summer21_id']));
		if( empty($exhibition_data) ) {
			redirect('errors/error_404');
			return;
		}

		$area = '';
		switch( $exhibition_data['place_summer21'] ) {
			case '2':
				$area = '広島会場［５月２６日（水）］';
				break;
			case '3':
				$area = '岡山会場［５月３１日（月）］';
				break;
			case '4':
				$area = '松山会場［５月２７日（木）］';
				break;
			case '5':
				$area = '福山会場［５月２８日（金）］';
				break;
			case '6':
				$area = '米子会場［５月２５日（火）］';
				break;
			case '7':
				$area = '大阪会場［６月１日（火）］';
				break;
			case '8':
				$area = '京都会場［６月２日（水）］';
				break;
			case '9':
				$area = '神戸会場［６月３日（木）］';
				break;
			case '10':
				$area = '姫路会場［６月４日（金）］';
				break;
		}

		$exhibition_time = date('H:i', strtotime($detail_data['exhibition_time_start'])) . '～' . date('H:i', strtotime($detail_data['exhibition_time_end']));

		$view_data = array(
			'ADATA'		=> $apply_exhibition_data,
			'AREA'		=> $area,
			'TIME'		=> $exhibition_time
		);

		$this->load->view('front/summer21/exhibition_reception', $view_data);
	}

	public function dl_exhibition()
	{
		$post_data = $this->input->post();
		$reception_slip_no = isset($post_data['reception_slip_no']) ? $post_data['reception_slip_no'] : '';

		if( empty($reception_slip_no) ) {
			redirect('errors/error_404');
			return;
		}

		$apply_exhibition_data = $this->m_apply_exhibition->get_one(array('reception_slip_no' => $reception_slip_no));
		if( empty($apply_exhibition_data) ) {
			redirect('errors/error_404');
			return;
		}

		$detail_data = $this->m_exhibition_detail->get_one(array('exhibition_detail_summer21_id' => $apply_exhibition_data['exhibition_detail_summer21_id']));
		if( empty($detail_data) ) {
			redirect('errors/error_404');
			return;
		}

		$exhibition_data = $this->m_exhibition->get_one(array('exhibition_summer21_id' => $detail_data['exhibition_summer21_id']));
		if( empty($exhibition_data) ) {
			redirect('errors/error_404');
			return;
		}

		$source_file = $area = $date = '';
		switch( $exhibition_data['place_summer21'] ) {
			case '2':
				$source_file = 'reception_slip_exhibition_c.pdf';
				$area = '広島会場';
				$date = '５月２６日（水）';
				break;
			case '3':
				$source_file = 'reception_slip_exhibition_c.pdf';
				$area = '岡山会場';
				$date = '５月３１日（月）';
				break;
			case '4':
				$source_file = 'reception_slip_exhibition_c.pdf';
				$area = '松山会場';
				$date = '５月２７日（木）';
				break;
			case '5':
				$source_file = 'reception_slip_exhibition_c.pdf';
				$area = '福山会場';
				$date = '５月２８日（金）';
				break;
			case '6':
				$source_file = 'reception_slip_exhibition_c.pdf';
				$area = '米子会場';
				$date = '５月２５日（火）';
				break;
			case '7':
				$source_file = 'reception_slip_exhibition_k.pdf';
				$area = '大阪会場';
				$date = '６月１日（火）';
				break;
			case '8':
				$source_file = 'reception_slip_exhibition_k.pdf';
				$area = '京都会場';
				$date = '６月２日（水）';
				break;
			case '9':
				$source_file = 'reception_slip_exhibition_k.pdf';
				$area = '神戸会場';
				$date = '６月３日（木）';
				break;
			case '10':
				$source_file = 'reception_slip_exhibition_k.pdf';
				$area = '姫路会場';
				$date = '６月４日（金）';
				break;
		}
		$exhibition_time = date('H:i', strtotime($detail_data['exhibition_time_start'])) . '～' . date('H:i', strtotime($detail_data['exhibition_time_end']));

		// タイムアウトさせない
		set_time_limit(0);

		require_once APPPATH . 'libraries/tcpdf/tcpdf.php';
		require_once APPPATH . 'libraries/tcpdf/fpdi/autoload.php';

		$pdf = new setasign\Fpdi\Tcpdf\Fpdi();

		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);

		$pdf->setSourceFile(PDF_FOLDER . $source_file);
		$pdf->AddPage();
		$tpl = $pdf->importPage(1);
		$pdf->useTemplate($tpl);
		$pdf->SetFont('kozgopromedium', '', 28);

		if( $exhibition_data['office'] == '2' ) {
			$pdf->Text(73, 49, $area);
			$pdf->Text(73, 74.5, $date);
			$pdf->Text(73, 100, $apply_exhibition_data['juku_name']);
			$pdf->Text(73, 125.5, $apply_exhibition_data['guest_num'] . '名');
			$pdf->Text(73, 152.5, '参加 ' . $exhibition_time);
		}

		if( $exhibition_data['office'] == '3' ) {
			$pdf->Text(73, 49.5, $area);
			$pdf->Text(73, 72, $date);
			$pdf->Text(73, 95.6, $apply_exhibition_data['juku_name']);
			$pdf->Text(73, 120.3, $apply_exhibition_data['guest_num'] . '名');
			$pdf->Text(73, 148.7, $exhibition_time);
		}

		$pdf->Output();
	}
}
