<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Analytics extends MY_Controller
{
	private $ip_chushikoku;

	public function __construct()
	{
		parent::__construct();

		$this->ip_chushikoku = '210.136.39.236';

		// モデルロード
		$this->load->model('m_analytics');
	}

	public function index()
	{
		// ログイン済みチェック
		if( !$this->chk_logged_in_admin() ) {
			redirect('admin');
			return;
		}

		$view_data = array(
			'TOP_C'		=> $this->m_analytics->get_count(array('url' => 'summer21/chushikoku', 'remote_addr !=' => $this->ip_chushikoku)),
			'TOP_Q'		=> $this->m_analytics->get_count(array('url' => 'summer21/kyushu', 'remote_addr !=' => $this->ip_chushikoku)),
			'APPLY_C'	=> $this->m_analytics->get_count(array('url' => 'summer21/apply_exhibition/chushikoku', 'remote_addr !=' => $this->ip_chushikoku)),
			'APPLY_Q'	=> $this->m_analytics->get_count(array('url' => 'summer21/apply_seminar/kyushu', 'remote_addr !=' => $this->ip_chushikoku)),
			'COM'		=> $this->m_analytics->get_count(array('referer' => 'com', 'remote_addr !=' => $this->ip_chushikoku)),
			'COJP'		=> $this->m_analytics->get_count(array('referer' => 'cojp', 'remote_addr !=' => $this->ip_chushikoku)),
			'SHOP'		=> $this->m_analytics->get_count(array('referer' => 'netshop', 'remote_addr !=' => $this->ip_chushikoku)),
			'DIRECT'	=> $this->m_analytics->get_direct_count()
		);

		$this->load->view('admin/analytics/index', $view_data);
	}

	public function dl()
	{
		// ログイン済みチェック
		if( !$this->chk_logged_in_admin() ) {
			redirect('admin');
			return;
		}

		$analytics_data = $this->m_analytics->get_list(array('remote_addr !=' => $this->ip_chushikoku), 'regist_time ASC');

		// タイムアウトさせない
		set_time_limit(0);

		$fp = fopen('php://output', 'w');
		stream_filter_append($fp, 'convert.iconv.UTF-8/CP932//TRANSLIT', STREAM_FILTER_WRITE);

		header("Content-Type: application/octet-stream");
		header("Content-Disposition: attachment; filename=" . 'analytics' . date('YmdHis') . '.csv');

		if( empty($analytics_data) ) {
			fputs($fp, 'no data');
		}
		else {
			$csv_array = array(
				'参照ページ',
				'リンク元',
				'IPアドレス',
				'ユーザーエージェント',
				'アクセス時間'
			);
			fputcsv($fp, $csv_array);

			foreach( $analytics_data as $val ) {
				$csv_array = array(
					str_replace('summer21/', '', $val['url']),
					$val['referer'],
					$val['remote_addr'],
					$val['user_agent'],
					$val['regist_time']
				);
				fputcsv($fp, $csv_array);
			}
		}

		fclose($fp);
	}
}
