<?php $this->load->view('inc/_head', array('TITLE' => SITE_NAME, 'CSS' => 'style.summer21.css')); ?>

<body>
	<div class="wrapper">
		<?php $this->load->view('front/summer21/header'); ?>

		<div class="container">
			<h1 class="title">セミナー参加申込フォーム</h1>

			<ul class="breadcrumb-list">
				<li>情報の入力</li>
				<li class="current">入力内容の確認</li>
				<li>受付完了</li>
			</ul>

			入力いただいた内容は以下の通りです。誤りがないかご確認ください。

			<div class="form-box">
				<div class="seminar-detail">
					<p class="place"><?= $VENUE ?></p>
					<h2><?= $TITLE ?></h2>
				</div>

				<dl class="item-box">
					<dt class="item-title">お申込み会場</dt>
					<dd><?= $AREA ?><br><?= $PERIOD ?></dd>

					<dt class="item-title">お申込み人数</dt>
					<dd><?= empty($PDATA['guest_name2']) ? '１' : '２' ?>名</dd>

					<dt class="item-title">お名前</dt>
					<dd>
						<?= $PDATA['guest_name1'] ?>&nbsp;様
						<?php if( !empty($PDATA['guest_name2']) ): ?>
							<br><?= $PDATA['guest_name2'] ?>&nbsp;様
						<?php endif; ?>
					</dd>

					<dt class="item-title">夏期テキスト展示</dt>
					<dd>
						<?= $EX ?>
						<?php if( !empty($EX_TIME) ): ?>
							<br><?= $EX_TIME ?>
						<?php endif; ?>
					</dd>
				</dl>

				<h1 class="title mt-5 mb-4">お客様情報</h1>

				<dl class="item-box">
					<dt class="item-title">貴塾名</dt>
					<dd><?= $PDATA['juku_name'] ?></dd>

					<dt class="item-title">郵便番号</dt>
					<dd><?= $PDATA['zip'] ?></dd>

					<dt class="item-title">ご住所</dt>
					<dd><?= $PDATA['address'] ?></dd>

					<dt class="item-title">電話番号</dt>
					<dd><?= $PDATA['tel'] ?></dd>

					<dt class="item-title">メールアドレス</dt>
					<dd><?= $PDATA['email'] ?></dd>
				</dl>
			</div> <!-- end of .form-box -->

			<?php echo form_open('summer21', array('id' => 'frm_seminar_confirm')); ?>
				<?php echo form_hidden($PDATA); ?>

				<div class="container-fluid mt-3 mb-4">
					<div class="row justify-content-center">
						<div class="col-12 col-md-4 mb-2">
							<?php echo form_button(array(
								'name'		=> 'btn-submit',
								'id'		=> 'btn_enabled',
								'class'		=> 'btn-summer21 btn-back',
								'content'	=> '<i class="fas fa-chevron-left"></i>&nbsp;&nbsp;&nbsp;戻る',
								'onclick'	=> 'do_submit(\'1\', \'' . $PDATA['office'] . '\');'
							)); ?>
						</div>

						<div class="col-12 col-md-4 mb-2">
							<?php echo form_button(array(
								'name'		=> 'btn-submit',
								'id'		=> 'btn_enabled',
								'class'		=> 'btn-summer21 btn-enabled',
								'content'	=> 'この内容で送信する&nbsp;&nbsp;&nbsp;<i class="fas fa-chevron-right"></i>',
								'onclick'	=> 'do_submit(\'2\', \'' . $PDATA['office'] . '\');'
							)); ?>
						</div>
					</div> <!-- end of .row -->
				</div> <!-- end of .container-fluid -->
			<?php echo form_close(); ?>
		</div> <!-- end of container -->

		<?php $this->load->view('front/summer21/footer'); ?>
	</div> <!-- end of .wrappewr -->

	<?php $this->load->view('inc/_foot'); ?>

	<script src="<?= base_url('js/front/summer21_seminar_confirm.js') ?>?var=<?= CACHES_CLEAR_VERSION ?>"></script>
</body>
</html>
