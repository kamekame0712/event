<?php
/**
 * 共通コントローラ
 */
class MY_Controller extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		// 言語ヘルパー
		$this->load->helper(array('language'));

		date_default_timezone_set('Asia/Tokyo');
	}



	/*****************************************/
	/*                                       */
	/*    各コントローラー共通の関数         */
	/*                                       */
	/*****************************************/
	// ログイン済みチェック（管理画面）
	protected function chk_logged_in_admin()
	{
		if( $this->session->userdata('admin_id') == FALSE ) {
			return FALSE;
		}
		else {
			return TRUE;
		}
	}

	// Ajax出力
	protected function ajax_out($data)
	{
		$this->output
			->set_content_type('json','utf-8')
			->set_header('Cache-Control: no-cache, must-revalidate')
			->set_header('Pragma: no-cache')
			->set_output($data);
	}

	// アクセスログの記録
	public function set_analytics($referer = NULL)
	{
		// モデルロード
		$this->load->model('m_analytics');

		$now = date('Y-m-d H:i:s');
		$insert_data = array(
			'referer'	=> $referer,
			'url'		=> uri_string(),
			'remote_addr'	=> $this->input->server('REMOTE_ADDR'),
			'user_agent'	=> $this->input->server('HTTP_USER_AGENT'),
			'regist_time'	=> $now,
			'update_time'	=> $now,
			'status'		=> '0'
		);

		$this->m_analytics->insert($insert_data);
	}



	/*****************************************/
	/*                                       */
	/*    バリデーション コールバック関数    */
	/*                                       */
	/*****************************************/
	// ログイン（管理画面）
	public function possible_admin_login()
	{
		// モデルロード
		$this->load->model('m_admin');

		$email = isset($_POST['email']) ? $_POST['email'] : '';
		$password = isset($_POST['password']) ? $_POST['password'] : '';

		$login_flg = $this->m_admin->possible_login($email, $password);
		if( $login_flg == FALSE ) {
			$this->form_validation->set_message('possible_admin_login', '入力内容に誤りがあります。');
			return FALSE;
		}

		return TRUE;
	}

	// 参加者氏名（セミナー申込みフォーム）
	public function chk_guest()
	{
		$guest_name1 = isset($_POST['guest_name1']) ? $_POST['guest_name1'] : '';
		$guest_name2 = isset($_POST['guest_name2']) ? $_POST['guest_name2'] : '';

		if( $guest_name1 == '' && $guest_name2 == '' ) {
			$this->form_validation->set_message('chk_guest', '%s 欄は必須です。');
			return FALSE;
		}

		return TRUE;
	}

	// 日付チェック
	public function chk_date($date)
	{
		if( empty($date) ) {
			$this->form_validation->set_message('chk_date', '%s 欄は必須です。');
			return FALSE;
		}

		if( !preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/', $date) ) {
			$this->form_validation->set_message('chk_date', '%s 欄はyyyy-mm-ddで指定してください。');
			return FALSE;
		}

		$date_array = explode('-', $date);
		$y = intval($date_array[0]);
		$m = intval($date_array[1]);
		$d = intval($date_array[2]);

		if( !checkdate($m, $d, $y) ) {
			$this->form_validation->set_message('chk_date', '%s 欄に存在しない日付が指定されました。');
			return FALSE;
		}

		return TRUE;
	}

	// 開催時間チェック（管理画面 ⇒ 展示会登録）
	public function chk_exhibition_time()
	{
		$exhibition_time_start = isset($_POST['exhibition_time_start']) ? $_POST['exhibition_time_start'] : '';
		$exhibition_time_end = isset($_POST['exhibition_time_end']) ? $_POST['exhibition_time_end'] : '';
		$capacity = isset($_POST['capacity']) ? $_POST['capacity'] : '';

		if( ( empty($exhibition_time_start) || empty($exhibition_time_end) || empty($capacity) ) ||
			( count($exhibition_time_start) != EXHIBITION_PERIOD_NUM || count($exhibition_time_end) != EXHIBITION_PERIOD_NUM || count($capacity) != EXHIBITION_PERIOD_NUM ) )
		{
			$this->form_validation->set_message('chk_exhibition_time', '%s 欄は必須です。');
			return FALSE;
		}

		$flg_exists = FALSE;
		for( $i = 0; $i < EXHIBITION_PERIOD_NUM; $i++ ) {
			if( !empty($exhibition_time_start[$i]) && !empty($exhibition_time_end[$i]) && !empty($capacity[$i]) ) {
				$flg_exists = TRUE;
				if( !preg_match('/^[0-2][0-9]:[0-5][0-9]$/', $exhibition_time_start[$i]) ) {
					$this->form_validation->set_message('chk_exhibition_time', '%s 欄はhh:mmで指定してください。');
					return FALSE;
				}

				$wk = explode(':', $exhibition_time_start[$i]);
				$wk_h = intval($wk[0]);
				$wk_m = intval($wk[1]);
				$wk_start = $wk_h * 60 + $wk_m;
				if( $wk_h >= 24 || $wk_m >= 60 ) {
					$this->form_validation->set_message('chk_exhibition_time', '%s 欄に存在しない時刻が指定されました。');
					return FALSE;
				}

				if( !preg_match('/^[0-2][0-9]:[0-5][0-9]$/', $exhibition_time_end[$i]) ) {
					$this->form_validation->set_message('chk_exhibition_time', '%s 欄はhh:mmで指定してください。');
					return FALSE;
				}

				$wk = explode(':', $exhibition_time_end[$i]);
				$wk_h = intval($wk[0]);
				$wk_m = intval($wk[1]);
				$wk_end = $wk_h * 60 + $wk_m;
				if( $wk_h >= 24 || $wk_m >= 60 ) {
					$this->form_validation->set_message('chk_exhibition_time', '%s 欄に存在しない時刻が指定されました。');
					return FALSE;
				}

				if( !is_numeric($capacity[$i]) ) {
					$this->form_validation->set_message('chk_exhibition_time', '入場者制限 欄は数値を指定してください。');
					return FALSE;
				}

				if( $wk_start > $wk_end ) {
					$this->form_validation->set_message('chk_exhibition_time', '開始時間より終了時間が早い時刻になっています。');
					return FALSE;
				}
			}
			else if( !empty($exhibition_time_start[$i]) || !empty($exhibition_time_end[$i]) || !empty($capacity[$i]) ) {
				$this->form_validation->set_message('chk_exhibition_time', '開始時間、終了時間、入場者制限 欄は全て指定するか、全く指定しないかにしてください。');
				return FALSE;
			}
		}

		if( !$flg_exists ) {
			$this->form_validation->set_message('chk_exhibition_time', '%s 欄は必須です。');
			return FALSE;
		}

		return TRUE;
	}
}
