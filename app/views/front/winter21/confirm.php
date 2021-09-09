<?php $this->load->view('inc/_head', array('TITLE' => SITE_NAME, 'CSS' => 'style.winter21.css')); ?>

<body>
	<div class="wrapper">
		<?php $this->load->view('front/winter21/header_form'); ?>

		<div class="container">
			<h1 class="title">展示会&nbsp;ご来場お申込みフォーム</h1>

			<ul class="breadcrumb-list">
				<li>情報の入力</li>
				<li class="current">入力内容の確認</li>
				<li>受付完了</li>
			</ul>

			入力いただいた内容は以下の通りです。誤りがないかご確認ください。

			<div class="form-box">
				<dl class="item-box">
					<dt class="item-title">お申込み会場</dt>
					<dd><?= $AREA ?></dd>

					<dt class="item-title">時間帯</dt>
					<dd><?= $TIME ?></dd>

					<dt class="item-title">ご来場人数</dt>
					<dd><?= $PDATA['guest_num'] ?>名</dd>
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

			<?php echo form_open('winter21', array('id' => 'frm_confirm')); ?>
				<?php echo form_hidden($PDATA); ?>

				<div class="container-fluid mt-3 mb-4">
					<div class="row justify-content-center">
						<div class="col-12 col-md-4 mb-2">
							<?php echo form_button(array(
								'name'		=> 'btn-submit',
								'id'		=> 'btn_enabled',
								'class'		=> 'btn-winter21 btn-back',
								'content'	=> '<i class="fas fa-chevron-left"></i>&nbsp;&nbsp;&nbsp;戻る',
								'onclick'	=> 'do_submit(\'1\');'
							)); ?>
						</div>

						<div class="col-12 col-md-4 mb-2">
							<?php echo form_button(array(
								'name'		=> 'btn-submit',
								'id'		=> 'btn_enabled',
								'class'		=> 'btn-winter21 btn-enabled',
								'content'	=> 'この内容で送信する&nbsp;&nbsp;&nbsp;<i class="fas fa-chevron-right"></i>',
								'onclick'	=> 'do_submit(\'2\');'
							)); ?>
						</div>
					</div> <!-- end of .row -->
				</div> <!-- end of .container-fluid -->
			<?php echo form_close(); ?>
		</div> <!-- end of container -->

		<?php $this->load->view('front/winter21/footer'); ?>
	</div> <!-- end of .wrappewr -->

	<?php $this->load->view('inc/_foot'); ?>

	<script src="<?= base_url('js/front/winter21_exhibition_confirm.js') ?>?var=<?= CACHES_CLEAR_VERSION ?>"></script>
</body>
</html>
