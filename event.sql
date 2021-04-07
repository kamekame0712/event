CREATE TABLE `t_admin` (
  `admin_id` int(7) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `email` varchar(256) DEFAULT NULL COMMENT 'メールアドレス',
  `password` varchar(256) NOT NULL COMMENT 'パスワード',
  `name` varchar(128) NOT NULL COMMENT '管理者名',
  `regist_time` datetime NOT NULL COMMENT '登録日',
  `update_time` datetime NOT NULL COMMENT '更新日',
  `status` varchar(1) DEFAULT '0' COMMENT '状態 0:通常 9:削除済',

  PRIMARY KEY (admin_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `t_seminar_summer21` (
  `seminar_summer21_id` int(7) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `office` varchar(1) NOT NULL COMMENT '主催オフィス（config値）',
  `place_summer21` varchar(2) NOT NULL COMMENT '会場（config値）',
  `event_date` date NOT NULL COMMENT '開催日',
  `show_event_date` varchar(32) NOT NULL COMMENT '開催日（表示用）',
  `capacity` int(3) NOT NULL COMMENT '座席数',
  `reserved` int(3) DEFAULT 0 COMMENT '予約数',
  `regist_time` datetime NOT NULL COMMENT '登録日',
  `update_time` datetime NOT NULL COMMENT '更新日',
  `status` varchar(1) DEFAULT '0' COMMENT '状態 0:通常 9:削除済',

  PRIMARY KEY (seminar_summer21_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `t_apply_seminar_summer21` (
  `apply_seminar_summer21_id` int(7) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `seminar_summer21_id` int(7) NOT NULL COMMENT 't_seminar_summer21のID',
  `guest_name1` varchar(64) DEFAULT NULL COMMENT '参加者名1',
  `guest_name2` varchar(64) DEFAULT NULL COMMENT '参加者名2',
  `juku_name` varchar(128) NOT NULL COMMENT '塾名',
  `zip` varchar(8) NOT NULL COMMENT '郵便番号',
  `address` varchar(256) NOT NULL COMMENT '住所',
  `tel` varchar(16) NOT NULL COMMENT '電話番号',
  `email` varchar(256) DEFAULT NULL COMMENT 'メールアドレス',
  `attend_exhibition` varchar(1) DEFAULT '1' COMMENT '展示会 1:参加 2:不参加',
  `reception_slip_no` varchar(64) DEFAULT NULL COMMENT '受付票の表示文字列',
  `regist_time` datetime NOT NULL COMMENT '登録日',
  `update_time` datetime NOT NULL COMMENT '更新日',
  `status` varchar(1) DEFAULT '0' COMMENT '状態 0:通常 9:削除済',

  PRIMARY KEY (apply_seminar_summer21_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `t_apply_seminar_summer21_kyushu` (
  `apply_seminar_summer21_kyushu_id` int(7) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `guest_num` int DEFAULT 0 COMMENT '参加人数',
  `charge` varchar(64) NOT NULL COMMENT 'お申込担当者名',
  `juku_name` varchar(128) NOT NULL COMMENT '塾名',
  `zip` varchar(8) NOT NULL COMMENT '郵便番号',
  `address` varchar(256) NOT NULL COMMENT '住所',
  `tel` varchar(16) NOT NULL COMMENT '電話番号',
  `email` varchar(256) DEFAULT NULL COMMENT 'メールアドレス',
  `regist_time` datetime NOT NULL COMMENT '登録日',
  `update_time` datetime NOT NULL COMMENT '更新日',
  `status` varchar(1) DEFAULT '0' COMMENT '状態 0:通常 9:削除済',

  PRIMARY KEY (apply_seminar_summer21_kyushu_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `t_exhibition_summer21` (
  `exhibition_summer21_id` int(7) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `office` varchar(1) NOT NULL COMMENT '主催オフィス（config値）',
  `place_summer21` varchar(2) NOT NULL COMMENT '会場（config値）',
  `event_date` date NOT NULL COMMENT '開催日',
  `show_event_date` varchar(32) NOT NULL COMMENT '開催日（表示用）',
  `regist_time` datetime NOT NULL COMMENT '登録日',
  `update_time` datetime NOT NULL COMMENT '更新日',
  `status` varchar(1) DEFAULT '0' COMMENT '状態 0:通常 9:削除済',

  PRIMARY KEY (exhibition_summer21_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `t_exhibition_detail_summer21` (
  `exhibition_detail_summer21_id` int(7) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `exhibition_summer21_id` int(7) NOT NULL COMMENT 't_exhibition_summer21のID',
  `serial_number` int(2) DEFAULT 1 COMMENT '時間順の連番',
  `exhibition_time_start` time NOT NULL COMMENT '来場開始時間',
  `exhibition_time_end` time NOT NULL COMMENT '来場終了時間',
  `capacity` int(3) NOT NULL COMMENT '座席数',
  `reserved` int(3) DEFAULT 0 COMMENT '予約数',
  `regist_time` datetime NOT NULL COMMENT '登録日',
  `update_time` datetime NOT NULL COMMENT '更新日',
  `status` varchar(1) DEFAULT '0' COMMENT '状態 0:通常 9:削除済',

  PRIMARY KEY (exhibition_detail_summer21_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `t_apply_exhibition_summer21` (
  `apply_exhibition_summer21_id` int(7) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `exhibition_detail_summer21_id` int(7) NOT NULL COMMENT 't_exhibition_detail_summer21のID',
  `apply_seminar_summer21_id` int(7) DEFAULT NULL COMMENT 't_apply_seminar_summer21のID',
  `guest_num` int DEFAULT 0 COMMENT '参加人数',
  `juku_name` varchar(128) NOT NULL COMMENT '塾名',
  `zip` varchar(8) NOT NULL COMMENT '郵便番号',
  `address` varchar(256) NOT NULL COMMENT '住所',
  `tel` varchar(16) NOT NULL COMMENT '電話番号',
  `email` varchar(256) DEFAULT NULL COMMENT 'メールアドレス',
  `reception_slip_no` varchar(64) DEFAULT NULL COMMENT '受付票の表示文字列',
  `regist_time` datetime NOT NULL COMMENT '登録日',
  `update_time` datetime NOT NULL COMMENT '更新日',
  `status` varchar(1) DEFAULT '0' COMMENT '状態 0:通常 9:削除済',

  PRIMARY KEY (apply_exhibition_summer21_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
