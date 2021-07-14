<?php $this->load->view('inc/_head', array('TITLE' => SITE_NAME, 'CSS' => 'style.webinar21004.css')); ?>

<body>
	<div class="wrapper">
		<?php $this->load->view('front/webinar21004/header'); ?>

		<div class="container">
			<h1 class="title">参加お申し込みフォーム</h1>

			<ul class="breadcrumb-list">
				<li>情報の入力</li>
				<li class="current">入力内容の確認</li>
				<li>受付完了</li>
			</ul>

			入力いただいた内容は以下の通りです。誤りがないかご確認ください。

			<div class="form-box">
				<dl class="item-box">
					<dt class="item-title">ご希望の日程</dt>
					<dd>
						<?php
							if( in_array('1', $PDATA['seminar'], TRUE) && in_array('2', $PDATA['seminar'], TRUE) ) {
								$seminar = '９月１６日（木）<br class="for-sp">【中学生に必要な英語力】<br>１０月１日（金）<br class="for-sp">【いまからできる大学入試対策】';
							}
							else if( in_array('1', $PDATA['seminar'], TRUE) ) {
								$seminar = '９月１６日（木）<br class="for-sp">【中学生に必要な英語力】';
							}
							else {
								$seminar = '１０月１日（金）<br class="for-sp">【いまからできる大学入試対策】';
							}
						?>
						<?= $seminar ?>
					</dd>

					<dt class="item-title">貴塾名</dt>
					<dd><?= $PDATA['juku_name'] ?></dd>

					<dt class="item-title">教室名</dt>
					<dd><?= !empty($PDATA['classroom']) ? $PDATA['classroom'] : '&nbsp;' ?></dd>

					<dt class="item-title">ご参加者氏名</dt>
					<dd><?= $PDATA['participant'] ?>　様</dd>

					<dt class="item-title">役職</dt>
					<dd><?= !empty($PDATA['position']) ? $PDATA['position'] : '&nbsp;' ?></dd>

					<dt class="item-title">ご住所(都道府県)</dt>
					<dd><?= $CONF['pref'][$PDATA['pref']] ?></dd>

					<dt class="item-title">電話番号</dt>
					<dd><?= $PDATA['tel'] ?></dd>

					<dt class="item-title">メールアドレス</dt>
					<dd><?= $PDATA['email'] ?></dd>
				</dl>
			</div> <!-- end of .form-box -->

			<?php echo form_open('webinar21004/complete', array('id' => 'frm_webinar')); ?>
				<?php echo form_hidden($PDATA); ?>

				<div class="container-fluid mt-3 mb-4">
					<div class="row justify-content-center">
						<div class="col-12 col-md-4">
							<?php echo form_button(array(
								'name'		=> 'btn-back',
								'class'		=> 'btn-base btn-back',
								'content'	=> '<i class="fas fa-chevron-left"></i>&nbsp;&nbsp;&nbsp;戻る',
								'onclick'	=> 'do_submit(1);'
							)); ?>
						</div>

						<div class="col-12 col-md-4">
							<?php echo form_button(array(
								'name'		=> 'btn-submit',
								'class'		=> 'btn-base btn-enabled mt-3 mt-md-0',
								'content'	=> 'この内容で送信する&nbsp;&nbsp;&nbsp;<i class="fas fa-chevron-right"></i>',
								'onclick'	=> 'do_submit(2);'
							)); ?>
						</div>
					</div> <!-- end of .row -->
				</div> <!-- end of .container-fluid -->
			<?php echo form_close(); ?>
		</div> <!-- end of container -->

		<?php $this->load->view('front/webinar21004/footer'); ?>
	</div> <!-- end of .wrappewr -->

	<?php $this->load->view('inc/_foot'); ?>

	<script src="<?= base_url('js/front/webinar21004_confirm.js') ?>?var=<?= CACHES_CLEAR_VERSION ?>"></script>
</body>
</html>
