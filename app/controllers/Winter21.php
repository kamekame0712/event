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
		$this->load->model('m_mail');

		// 設定ファイルロード
		$this->config->load('config_disp', TRUE, TRUE);
		$this->conf = $this->config->item('disp', 'config_disp');

		$this->config->load('config_mail', TRUE, TRUE);
		$this->conf_mail = $this->config->item('mail', 'config_mail');

		// バリデーションエラー設定
		$this->form_validation->set_error_delimiters('<p class="error-msg">', '</p>');

		// アクセスログ記録
		$get_data = $this->input->get();
		$referer = isset($get_data['referer']) ? $get_data['referer'] : NULL;
		$this->set_analytics($referer);
	}

	public function index()
	{
		$this->load->view('front/winter21/index');
	}

	public function apply()
	{
		// リロード対策
		if( $this->input->cookie('apply_exhibition') ) {
			delete_cookie('apply_exhibition');
		}

		$remain_exhibition = array();
		$exhibition_data = $this->m_exhibition->get_list('', 'event_date ASC');
		if( !empty($exhibition_data) ) {
			foreach( $exhibition_data as $exhibition ) {
				$detail_data = $this->m_exhibition_detail->get_list(array('exhibition_winter21_id' => $exhibition['exhibition_winter21_id']), 'serial_number ASC');
				if( !empty($detail_data) ) {
					foreach( $detail_data as $detail ) {
						$remain_exhibition[$exhibition['place_winter21']][$detail['serial_number']] = array(
							'detail_id'	=> $detail['exhibition_detail_winter21_id'],
							'start'		=> $detail['exhibition_time_start'],
							'end'		=> $detail['exhibition_time_end'],
							'remain'	=> intval($detail['capacity']) - intval($detail['reserved'])
						);
					}
				}
			}
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
			'REMAIN_EXHIBITION'	=> $remain_exhibition,
			'GLIST'		=> $guest_num_list
		);

		$this->load->view('front/winter21/apply', $view_data);
	}

	public function confirm()
	{
		// リロード対策
		if( $this->input->cookie('apply_exhibition') ) {
			delete_cookie('apply_exhibition');
		}

		$post_data = $this->input->post();

		// バリデーションチェック
		if( $this->form_validation->run('apply_exhibition') == FALSE ) {
			$this->apply();
			return;
		}

		$place = isset($post_data['place']) ? $post_data['place'] : '';
		$time = isset($post_data['time']) ? $post_data['time'] : '';
		$wk_detail = $this->m_exhibition_detail->get_one(array('exhibition_detail_winter21_id' => $time));
		$exhibition_time = date('H:i', strtotime($wk_detail['exhibition_time_start'])) . '～' . date('H:i', strtotime($wk_detail['exhibition_time_end']));

		$area = '';
		switch( $place ) {
			case '1':
				$area = '岡山会場［10月28日（木）］';
				break;
			case '2':
				$area = '福山会場［10月29日（金）］';
				break;
			case '3':
				$area = '広島会場［11月4日（木）］';
				break;
			case '4':
				$area = '松山会場［11月5日（金）］';
				break;
		}

		$view_data = array(
			'AREA'		=> $area,
			'PDATA'		=> $post_data,
			'TIME'		=> $exhibition_time
		);

		$this->load->view('front/winter21/confirm', $view_data);
	}

	public function complete()
	{
		$post_data = $this->input->post();
		$place_winter21 = isset($post_data['place']) ? $post_data['place'] : '';
		$exhibition_detail_winter21_id = isset($post_data['time']) ? $post_data['time'] : '';
		$guest_num = isset($post_data['guest_num']) ? $post_data['guest_num'] : '';
		$juku_name = isset($post_data['juku_name']) ? $post_data['juku_name'] : '';
		$zip = isset($post_data['zip']) ? $post_data['zip'] : '';
		$address = isset($post_data['address']) ? $post_data['address'] : '';
		$tel = isset($post_data['tel']) ? $post_data['tel'] : '';
		$email = isset($post_data['email']) ? $post_data['email'] : '';

		// リロード対策
		if( $this->input->cookie('apply_exhibition') ) {
			redirect('winter21');
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
			$wk_apply_exhibition = $this->m_apply_exhibition->get_one(array('reception_slip_no' => $reception_slip_no));
		} while( !empty($wk_apply_exhibition) );

		$this->db->trans_start();

		$err_str = '';
		$wk_exhibition_detail = $this->m_exhibition_detail->get_one(array('exhibition_detail_winter21_id' => $exhibition_detail_winter21_id));
		if( empty($wk_exhibition_detail) ) {
			$err_str = '展示会の情報が存在しません。';
		}
		else {
			$insert_data_apply_exhibition = array(
				'exhibition_detail_winter21_id'	=> $exhibition_detail_winter21_id,
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
			$this->m_exhibition_detail->update(array('exhibition_detail_winter21_id' => $wk_exhibition_detail['exhibition_detail_winter21_id']), $update_data_exhibition_detail);
		}

		$this->db->trans_complete();

		if( $this->db->trans_status() === FALSE ) {
			$err_str = 'データベースエラーが発生しました。';
		}

		if( $err_str == '' ) {
			// 受付票のURLをメールでお知らせ
			$wk_detail = $this->m_exhibition_detail->get_one(array('exhibition_detail_winter21_id' => $exhibition_detail_winter21_id));
			$exhibition_time = date('H:i', strtotime($wk_detail['exhibition_time_start'])) . '～' . date('H:i', strtotime($wk_detail['exhibition_time_end']));

			$area = $date = '';
			switch( $place_winter21 ) {
				case '1':
					$area = '岡山会場［10月28日（木）］';
					break;
				case '2':
					$area = '福山会場［10月29日（金）］';
					break;
				case '3':
					$area = '広島会場［11月4日（木）］';
					break;
				case '4':
					$area = '松山会場［11月5日（金）］';
					break;
			}

			$mail_data = array(
				'ADATA'		=> $insert_data_apply_exhibition,
				'AREA'		=> $area,
				'TIME'		=> $exhibition_time
			);
			$mail_body = $this->load->view('mail/tmpl_apply_complete_winter21', $mail_data, TRUE);

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

		$this->load->view('front/winter21/complete', $view_data);
	}

	public function reception()
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

		$detail_data = $this->m_exhibition_detail->get_one(array('exhibition_detail_winter21_id' => $apply_exhibition_data['exhibition_detail_winter21_id']));
		if( empty($detail_data) ) {
			redirect('errors/error_404');
			return;
		}

		$exhibition_data = $this->m_exhibition->get_one(array('exhibition_winter21_id' => $detail_data['exhibition_winter21_id']));
		if( empty($exhibition_data) ) {
			redirect('errors/error_404');
			return;
		}

		$area = '';
		switch( $exhibition_data['place_winter21'] ) {
			case '1':
				$area = '岡山会場［10月28日（木）］';
				break;
			case '2':
				$area = '福山会場［10月29日（金）］';
				break;
			case '3':
				$area = '広島会場［11月4日（木）］';
				break;
			case '4':
				$area = '松山会場［11月5日（金）］';
				break;
		}

		$exhibition_time = date('H:i', strtotime($detail_data['exhibition_time_start'])) . '～' . date('H:i', strtotime($detail_data['exhibition_time_end']));

		$view_data = array(
			'ADATA'		=> $apply_exhibition_data,
			'AREA'		=> $area,
			'TIME'		=> $exhibition_time
		);

		$this->load->view('front/winter21/reception', $view_data);
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

		$detail_data = $this->m_exhibition_detail->get_one(array('exhibition_detail_winter21_id' => $apply_exhibition_data['exhibition_detail_winter21_id']));
		if( empty($detail_data) ) {
			redirect('errors/error_404');
			return;
		}

		$exhibition_data = $this->m_exhibition->get_one(array('exhibition_winter21_id' => $detail_data['exhibition_winter21_id']));
		if( empty($exhibition_data) ) {
			redirect('errors/error_404');
			return;
		}

		$area = $date = '';
		switch( $exhibition_data['place_winter21'] ) {
			case '1':
				$area = '岡山会場';
				$date = '10月28日（木）';
				break;
			case '2':
				$area = '福山会場';
				$date = '10月29日（金）';
				break;
			case '3':
				$area = '広島会場';
				$date = '11月4日（木）';
				break;
			case '4':
				$area = '松山会場';
				$date = '11月5日（金）';
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

		$pdf->setSourceFile(PDF_FOLDER . 'reception_slip_exhibition_c.pdf');
		$pdf->AddPage();
		$tpl = $pdf->importPage(1);
		$pdf->useTemplate($tpl);
		$pdf->SetFont('kozgopromedium', '', 28);

		$pdf->Text(73, 49.5, $area);
		$pdf->Text(73, 72, $date);
		$pdf->Text(73, 95.6, $apply_exhibition_data['juku_name']);
		$pdf->Text(73, 120.3, $apply_exhibition_data['guest_num'] . '名');
		$pdf->Text(73, 148.7, $exhibition_time);

		$pdf->Output();
	}
}
