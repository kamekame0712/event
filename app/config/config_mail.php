<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//****** メール関連config ******

$config['mail'] = array(

	// 管理画面から管理者へ
	'management_to_admin' => array(
		'from'		=> 'info@chuoh-kyouiku.co.jp',
		'from_name'	=> 'セミナー・展示会 管理画面'
	),

	// 参加申込フォームから申込者へ
	'apply_comp_to_customer' => array(
		'from'		=> 'info@chuoh-kyouiku.co.jp',
		'from_name'	=> 'セミナー・展示会参加申込フォーム'
	),

	// オンラインセミナー参加申込フォームから申込者へ
	'apply_webinar21004_comp_to_customer' => array(
		'from'		=> 'info@chuoh-kyouiku.co.jp',
		'from_name'	=> 'オンラインセミナー参加申込フォーム'
	),

	// 参加申込フォームから関西営業へ
	'apply_comp_to_kansai' => array(
		'from'		=> 'info@chuoh-kyouiku.co.jp',
		'from_name'	=> 'セミナー・展示会 管理画面',
		'to'		=> 's-kamei@chuoh-kyouiku.co.jp;kamekame0712@gmail.com;kame_5131@yahoo.co.jp'
	),

);
