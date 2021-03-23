<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Summer21 extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();

		// モデルロード
		$this->load->model('m_seminar_summer21', 'm_seminar');
		$this->load->model('m_exhibition_summer21', 'm_exhibition');
		$this->load->model('m_apply_seminar_summer21', 'm_apply_seminar');
		$this->load->model('m_apply_exhibition_summer21', 'm_apply_exhibition');

		// 設定ファイルロード
		$this->config->load('config_disp', TRUE, TRUE);
		$this->conf = $this->config->item('disp', 'config_disp');

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

		$remain_seminar = array();
		$remain_exhibition = array();
		switch( $office ) {
			case 'kansai':
				$view_file = 'front/summer21/apply_seminar_kansai';
				$seminar_data = $this->m_seminar->get_list(array('office' => '2'));	// 2:関西オフィス
				if( !empty($seminar_data) ) {
					foreach( $seminar_data as $seminar ) {
						$remain_seminar[$seminar['place_summer21']] = intval($seminar['capacity']) - intval($seminar['reserved']);
					}
				}
				break;
			default:
				redirect('errors/error_404');
				return;
		}

		$view_data = array(
			'OFFICE'			=> $office,
			'REMAIN_SEMINAR'	=> $remain_seminar
		);

		$this->load->view($view_file, $view_data);
	}

	public function confirm_seminar()
	{
		// リロード対策
		if( $this->input->cookie('apply_seminar') ) {
			delete_cookie('apply_seminar');
		}

		// バリデーションチェック
		if( $this->form_validation->run('apply_seminar') == FALSE ) {
			$post_data = $this->input->post();
			$office = isset($post_data['office']) ? $post_data['office'] : '';

			$this->apply_seminar($office);
			return;
		}





	}


}
