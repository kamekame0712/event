<?php $this->load->view('inc/_head', array('TITLE' => SITE_NAME, 'CSS' => 'style.summer21.css')); ?>

<body>
	<div class="wrapper">
		<?php $this->load->view('front/summer21/header'); ?>

		<div class="container">
			<h1 class="title">セミナー参加申込フォーム</h1>

			<ul class="breadcrumb-list">
				<li>情報の入力</li>
				<li>入力内容の確認</li>
				<li class="current">受付完了</li>
			</ul>

			<?php if( $ERR_STR == '' ): ?>
				<h2 class="complete-comment">お申込みいただき、ありがとうございます。</h2>
				<h2 class="complete-comment"><span>受付票のダウンロードをお願いいたします。</span></h2>

				<div class="reception-slip-info my-5">
					<div class="image-wrapper">
						<img src="<?= base_url('img/summer21/how_to_apply2.png') ?>" alt="受付票を保存">
					</div>
					<div class="arrow-triangle-right"></div>
					<div class="image-wrapper">
						<img src="<?= base_url('img/summer21/how_to_apply3.png') ?>" alt="受付票を当日持参">
					</div>
				</div>

				<div class="row justify-content-center my-5">
					<div class="col-12 col-md-8">
						下の「受付票」から、受付票をダウンロードしていただけますので、保存をお願いいたします。<br>
						入力いただいたメールアドレスにも受付票のＵＲＬを送らせていただきます。<br>
						セミナー当日は、受付票を必ずご持参いただき、受付にお見せください。
					</div>
				</div>

				<h2 class="complete-comment"><span>受付票は大切に保管いただき、セミナー当日必ずご持参ください。</span></h2>

				<div class="row justify-content-center my-5">
					<div class="col-12 col-md-8">
						受付時に、受付票の画面をお見せいただくか、受付票を印刷したものをお持ちいただくことで、ご本人確認をいたします。　
					</div>
				</div>

				<div class="row justify-content-center my-5">
					<div class="col-12 col-md-4 mb-2">
						<a href="<?= site_url('summer21/seminar_reception?reception=' . $RECEPTION) ?>" class="btn-summer21 btn-enabled">受付票&nbsp;&nbsp;&nbsp;<i class="fas fa-chevron-right"></i></a>
					</div>
				</div> <!-- end of .row -->
			<?php else: ?>
				<h2 class="complete-comment"><?= $ERR_STR ?></h2>

				<div class="row justify-content-center my-5">
					<div class="col-12 col-md-8">
						大変お手数ですが、もう一度最初からお申込みをお願いします。<br>
						エラーが続くようでしたら、直接お電話でお問い合わせくださいますようお願いいたします。
					</div>
				</div>
			<?php endif; ?>

			<div class="anchor-to-back">
				<a href="<?= site_url('summer21/' . $OFFICE) ?>">トップに戻る</a>
			</div>
		</div> <!-- end of container -->

		<?php $this->load->view('front/summer21/footer'); ?>
	</div> <!-- end of .wrappewr -->

	<?php $this->load->view('inc/_foot'); ?>
</body>
</html>
