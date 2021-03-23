<?php
	$active_seminar = $active_exhibition = $active_manage = '';

	switch( $current ) {
		case 'seminar':				$active_seminar = 'class="active"';				break;
		case 'exhibition':			$active_exhibition = 'class="active"';			break;
		case 'manage':				$active_manage = 'class="active"';				break;
	}
?>

<div class="main-sidebar sidebar-style-2">
	<aside id="sidebar-wrapper">
		<div class="sidebar-brand">
			<a href="<?= site_url('admin') ?>">セミナー・展示会管理</a>
		</div>
		<div class="sidebar-brand sidebar-brand-sm">
			<a href="<?= site_url('admin') ?>">セミナー</a>
		</div>

		<ul class="sidebar-menu">
			<li <?= $active_seminar ?>><a class="nav-link" href="<?= site_url('admin/seminar') ?>"><i class="fas fa-chalkboard-teacher"></i><span>セミナー管理</span></a></li>
			<li <?= $active_exhibition ?>><a class="nav-link" href="<?= site_url('admin/exhibition') ?>"><i class="fas fa-book-reader"></i><span>展示会管理</span></a></li>
			<li <?= $active_manage ?>><a class="nav-link" href="<?= site_url('admin/manage') ?>"><i class="fas fa-user-tie"></i><span>管理者管理</span></a></li>
		</ul>
	</aside>
</div>
