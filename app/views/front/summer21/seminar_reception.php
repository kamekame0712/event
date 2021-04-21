<?php $this->load->view('inc/_head', array('TITLE' => SITE_NAME, 'CSS' => 'style.summer21.css')); ?>

<body>
	<div class="wrapper">
		<?php $this->load->view('front/summer21/header'); ?>

		<div class="container">
			<h1 class="title">受付票</h1>

			当日、受付でこの画面をお見せいただくか、「PDFダウンロード」をクリックし、PDFを印刷したものを受付にお見せください。

			<div class="form-box">
				<div class="seminar-detail">
					<p class="place"><?= $VENUE ?></p>
					<h2><?= $TITLE ?></h2>
				</div>

				<dl class="item-box">
					<dt class="item-title">お申込み会場</dt>
					<dd><?= $AREA ?><br><?= $PERIOD ?></dd>

					<dt class="item-title">お申込み人数</dt>
					<dd><?= empty($ADATA['guest_name2']) ? '１' : '２' ?>名</dd>

					<dt class="item-title">お名前</dt>
					<dd>
						<?= $ADATA['guest_name1'] ?>&nbsp;様
						<?php if( !empty($ADATA['guest_name2']) ): ?>
							<br><?= $ADATA['guest_name2'] ?>&nbsp;様
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
					<dd><?= $ADATA['juku_name'] ?></dd>

					<dt class="item-title">郵便番号</dt>
					<dd><?= $ADATA['zip'] ?></dd>

					<dt class="item-title">ご住所</dt>
					<dd><?= $ADATA['address'] ?></dd>

					<dt class="item-title">電話番号</dt>
					<dd><?= $ADATA['tel'] ?></dd>

					<dt class="item-title">メールアドレス</dt>
					<dd><?= $ADATA['email'] ?></dd>
				</dl>
			</div> <!-- end of .form-box -->

			<div class="container-fluid mt-3 mb-4">
				<div class="row justify-content-center">
					<div class="col-12 col-md-4 mb-2">
						<?php echo form_open('summer21/dl_seminar'); ?>
							<?php echo form_hidden('reception_slip_no', $ADATA['reception_slip_no']); ?>

							<?php echo form_button(array(
								'name'		=> 'btn-submit',
								'class'		=> 'btn-summer21 btn-enabled',
								'type'		=> 'submit',
								'content'	=> 'PDFダウンロード&nbsp;&nbsp;&nbsp;<i class="fas fa-chevron-right"></i>'
							)); ?>
						<?php echo form_close(); ?>
					</div>
				</div> <!-- end of .row -->
			</div> <!-- end of .container-fluid -->

			<div class="anchor-to-back">
				<a href="<?= site_url('summer21/' . $OFFICE . '?referer=seminar_reception') ?>">トップに戻る</a>
			</div>
		</div> <!-- end of container -->

		<?php $this->load->view('front/summer21/footer'); ?>
	</div> <!-- end of .wrappewr -->

	<?php $this->load->view('inc/_foot'); ?>
</body>
</html>
