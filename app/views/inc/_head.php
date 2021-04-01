<!DOCTYPE html>
<html class="perfect-scrollbar-on" lang="ja">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="format-detection" content="telephone=no">
	<meta name="viewport" content="initial-scale=1">
	<meta name="description" content="中央教育研究所株式会社主催のセミナー及び、学習塾専用テキスト・システム展示会のご案内サイトです。">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css">
	<link rel="stylesheet" href="<?= base_url('css/thirdparty/featherlight.css')?>">

	<link rel="stylesheet" href="<?= base_url('css/style.common.css') ?>?var=<?= CACHES_CLEAR_VERSION ?>">

	<?php if( isset($CSS) ): ?>
		<?php if( is_array($CSS) ): ?>
			<?php foreach( $CSS as $val ): ?>
				<link rel="stylesheet" href="<?= base_url('css/' . $val) ?>?var=<?= CACHES_CLEAR_VERSION ?>">
			<?php endforeach; ?>
		<?php else: ?>
			<link rel="stylesheet" href="<?= base_url('css/' . $CSS) ?>?var=<?= CACHES_CLEAR_VERSION ?>">
		<?php endif; ?>
	<?php endif; ?>

	<title><?= $TITLE ?></title>
</head>
