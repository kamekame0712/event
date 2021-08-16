<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Webinar21004 extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();

		// モデルロード
		$this->load->model('m_apply_webinar21004');
		$this->load->model('m_mail');

		// 設定ファイルロード
		$this->config->load('config_disp', TRUE, TRUE);
		$this->conf = $this->config->item('disp', 'config_disp');

		$this->config->load('config_mail', TRUE, TRUE);
		$this->conf_mail = $this->config->item('mail', 'config_mail');

		// バリデーションエラー設定
		$this->form_validation->set_error_delimiters('<p class="error-msg">', '</p>');
	}

	public function index()
	{
		$this->load->view('front/webinar21004/index');
	}

	public function apply()
	{
		// リロード対策
		if( $this->input->cookie('apply_webinar') ) {
			delete_cookie('apply_webinar');
		}

		$num1 = $this->m_apply_webinar21004->get_count('( seminar = "1" OR seminar = "3" )');
		$num2 = $this->m_apply_webinar21004->get_count('( seminar = "2" OR seminar = "3" )');

		$view_data = array(
			'NUM1'	=> $num1,
			'NUM2'	=> $num2,
			'CONF'	=> $this->conf
		);

		$this->load->view('front/webinar21004/apply', $view_data);
	}

	public function confirm()
	{
		// リロード対策
		if( $this->input->cookie('apply_webinar') ) {
			delete_cookie('apply_webinar');
		}

		// バリデーションチェック
		if( $this->form_validation->run('webinar21004') == FALSE ) {
			$this->apply();
			return;
		}

		$view_data = array(
			'CONF'	=> $this->conf,
			'PDATA'	=> $this->input->post()
		);

		$this->load->view('front/webinar21004/confirm', $view_data);
	}

	public function complete()
	{
		$post_data = $this->input->post();
		$seminar = !empty($post_data['seminar']) ? $post_data['seminar'] : array();
		$juku_name = isset($post_data['juku_name']) ? $post_data['juku_name'] : '';
		$classroom = isset($post_data['classroom']) ? $post_data['classroom'] : '';
		$participant = isset($post_data['participant']) ? $post_data['participant'] : '';
		$position = isset($post_data['position']) ? $post_data['position'] : '';
		$pref = isset($post_data['pref']) ? $post_data['pref'] : '';
		$tel = isset($post_data['tel']) ? $post_data['tel'] : '';
		$email = isset($post_data['email']) ? $post_data['email'] : '';

		// リロード対策
		if( $this->input->cookie('apply_webinar') ) {
			redirect('webinar21004');
		}
		else {
			$cookie_data = array(
				'name'	=> 'apply_webinar',
				'value'	=> '1',
				'expire'=> '86400'
			);
			$this->input->set_cookie($cookie_data);
		}

		if( empty($seminar) || $juku_name == '' || $participant == '' || $pref == '' || $tel == '' || $email == '' ) {
			$error_msg = 'パラメーターエラーが発生しました。';
		}
		else {
			$now = date('Y-m-d H:i:s');
			$insert_data = array(
				'seminar'		=> count($seminar) == 1 ? $seminar[0] : '3',
				'juku_name'		=> $juku_name,
				'classroom'		=> $classroom,
				'participant'	=> $participant,
				'position'		=> $position,
				'pref'			=> $pref,
				'tel'			=> $tel,
				'email'			=> $email,
				'regist_time'	=> $now,
				'update_time'	=> $now,
				'status'		=> '0'
			);

			$error_msg = '';
			if( $this->m_apply_webinar21004->insert($insert_data) ) {
				switch( $insert_data['seminar'] ) {
					case '1': $seminar_str = '９月１６日（木）【中学生に必要な英語力】';	break;
					case '2': $seminar_str = '１０月１日（金）【今からできる大学入試対策】';	break;
					default:  $seminar_str = '９月１６日（木）【中学生に必要な英語力】、１０月１日（金）【今からできる大学入試対策】';	break;
				}

				$mail_data = array(
					'juku'			=> $juku_name . ( !empty($classroom) ? ( '　' . $classroom ) : '' ),
					'participant'	=> !empty($position) ? ( $position . '　' . $participant ) : $participant,
					'seminar'		=> $seminar_str,
					'address'		=> $this->conf['pref'][$pref],
					'tel'			=> $tel
				);

				$mail_body = $this->load->view('mail/tmpl_apply_webinar21004', $mail_data, TRUE);

				$params = array(
					'from'		=> $this->conf_mail['apply_webinar21004_comp_to_customer']['from'],
					'from_name'	=> $this->conf_mail['apply_webinar21004_comp_to_customer']['from_name'],
					'to'		=> $email,
					'subject'	=> 'オンラインセミナーへのお申し込みありがとうございます【中央教育研究所(株)】',
					'message'	=> $mail_body
				);

				$this->m_mail->send($params);
			}
			else {
				$error_msg = 'データベースエラーが発生しました。';
			}
		}

		$view_data = array(
			'EMAIL'	=> $email,
			'ERRMSG'=> $error_msg
		);

		$this->load->view('front/webinar21004/complete', $view_data);
	}

	public function archive()
	{
		$get_data = $this->input->get();
		$seminar = isset($get_data['seminar']) ? $get_data['seminar'] : '';

		$movie = '';
		$today = new DateTime();
		$seminar1_start = new DateTime('2021-09-16 12:30:00');
		$seminar1_end = new DateTime('2021-09-30 23:59:59');
		$seminar2_start = new DateTime('2021-10-01 12:30:00');
		$seminar2_end = new DateTime('2021-10-15 23:59:59');

		if( $seminar == '210040916' && ( $today >= $seminar1_start ) && ( $today <= $seminar1_end ) ) {
			$movie = '1';
		}
		else if( $seminar == '210041001' && ( $today >= $seminar2_start ) && ( $today <= $seminar2_end ) ) {
			$movie = '2';
		}

		$view_data = array(
			'MOVIE'	=> $movie
		);

		$this->load->view('front/webinar21004/archive', $view_data);
	}
}
