<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config = array(

	// ログイン（管理画面）
	'login_admin' => array(
		array(
			'field' => 'email',
			'label' => 'メールアドレス',
			'rules' => 'required'
		),

		array(
			'field' => 'password',
			'label' => 'パスワード',
			'rules' => 'required|callback_possible_admin_login'
		)
	),

	// 展示会登録（管理画面）
	'admin/exhibition' => array(
		array(
			'field' => 'office',
			'label' => '主催オフィス',
			'rules' => 'required'
		),

		array(
			'field' => 'place',
			'label' => '会場',
			'rules' => 'required'
		),

		array(
			'field' => 'event_date',
			'label' => '開催日',
			'rules' => 'required|callback_chk_date'
		),

		array(
			'field' => 'exhibition_time_start[]',
			'label' => '開催時間（入場時間）',
			'rules' => 'callback_chk_exhibition_time'
		),
	),

	// セミナー参加申込フォーム
	'apply_seminar' => array(
		array(
			'field' => 'place',
			'label' => '会場（日程）',
			'rules' => 'required'
		),

		array(
			'field' => 'guest_name1',
			'label' => '参加者氏名',
			'rules' => 'callback_chk_guest'
		),

		array(
			'field' => 'time',
			'label' => '夏期テキスト展示のご希望時間帯',
			'rules' => 'required'
		),

		array(
			'field' => 'juku_name',
			'label' => '貴塾名',
			'rules' => 'required'
		),

		array(
			'field' => 'zip',
			'label' => '郵便番号',
			'rules' => 'required'
		),

		array(
			'field' => 'address',
			'label' => 'ご住所',
			'rules' => 'required'
		),

		array(
			'field' => 'tel',
			'label' => '電話番号',
			'rules' => 'required'
		),

		array(
			'field' => 'email',
			'label' => 'メールアドレス',
			'rules' => 'required'
		)
	),

	// テキスト展示参加申込フォーム
	'apply_exhibition' => array(
		array(
			'field' => 'place',
			'label' => '会場（日程）',
			'rules' => 'required'
		),

		array(
			'field' => 'time',
			'label' => 'ご希望時間帯',
			'rules' => 'required'
		),

		array(
			'field' => 'guest_num',
			'label' => 'ご来場人数',
			'rules' => 'required'
		),

		array(
			'field' => 'juku_name',
			'label' => '貴塾名',
			'rules' => 'required'
		),

		array(
			'field' => 'zip',
			'label' => '郵便番号',
			'rules' => 'required'
		),

		array(
			'field' => 'address',
			'label' => 'ご住所',
			'rules' => 'required'
		),

		array(
			'field' => 'tel',
			'label' => '電話番号',
			'rules' => 'required'
		),

		array(
			'field' => 'email',
			'label' => 'メールアドレス',
			'rules' => 'required'
		)
	),

	// セミナー参加申込フォーム（九州専用）
	'apply_seminar_kyushu' => array(
		array(
			'field' => 'guest_num',
			'label' => 'お申込み人数',
			'rules' => 'required'
		),

		array(
			'field' => 'juku_name',
			'label' => '貴塾名',
			'rules' => 'required'
		),

		array(
			'field' => 'zip',
			'label' => '郵便番号',
			'rules' => 'required'
		),

		array(
			'field' => 'address',
			'label' => 'ご住所',
			'rules' => 'required'
		),

		array(
			'field' => 'tel',
			'label' => '電話番号',
			'rules' => 'required'
		),

		array(
			'field' => 'email',
			'label' => 'メールアドレス',
			'rules' => 'required'
		)
	),


);
