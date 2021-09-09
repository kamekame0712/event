<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Analytics extends MY_Controller
{
	private $ip_chushikoku;
	private $from_date;

	public function __construct()
	{
		parent::__construct();

		$this->ip_chushikoku = '210.136.39.236';
		$this->from_date = '2021-09-01 00:00:00';

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
			'TOP'		=> $this->m_analytics->get_count(array('url' => 'winter21', 'remote_addr !=' => $this->ip_chushikoku, 'regist_time >=' => $this->from_date)),
			'APPLY'		=> $this->m_analytics->get_count(array('url' => 'winter21/apply', 'remote_addr !=' => $this->ip_chushikoku, 'regist_time >=' => $this->from_date)),
			'COM'		=> $this->m_analytics->get_count(array('referer' => 'com', 'remote_addr !=' => $this->ip_chushikoku, 'regist_time >=' => $this->from_date)),
			'COJP'		=> $this->m_analytics->get_count(array('referer' => 'cojp', 'remote_addr !=' => $this->ip_chushikoku, 'regist_time >=' => $this->from_date)),
			'SHOP'		=> $this->m_analytics->get_count(array('referer' => 'netshop', 'remote_addr !=' => $this->ip_chushikoku, 'regist_time >=' => $this->from_date)),
			'DM'		=> $this->m_analytics->get_count(array('referer' => 'dm', 'remote_addr !=' => $this->ip_chushikoku, 'regist_time >=' => $this->from_date)),
			'DIRECT'	=> $this->m_analytics->get_direct_count($this->from_date)
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

		$analytics_data = $this->m_analytics->get_list(array('remote_addr !=' => $this->ip_chushikoku, 'regist_time >=' => $this->from_date), 'regist_time ASC');

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
					str_replace('winter21/', '', $val['url']),
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
