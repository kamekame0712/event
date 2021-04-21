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
				<h2 class="complete-comment">後日郵送にて、受付票を送らせていただきます。</h2>

				<div class="reception-slip-info my-5">
					<div class="image-wrapper">
						<img src="<?= base_url('img/summer21/how_to_apply4.png') ?>" alt="受付票が届く">
					</div>
					<div class="arrow-triangle-right"></div>
					<div class="image-wrapper">
						<img src="<?= base_url('img/summer21/how_to_apply3.png') ?>" alt="受付票を当日持参">
					</div>
				</div>

				<h2 class="complete-comment"><span>受付票は大切に保管いただき、セミナー当日必ずご持参ください。</span></h2>

				<div class="row justify-content-center my-5">
					<div class="col-12 col-md-8 text-center">
						受付時に、受付票をお持ちいただくことで、ご本人確認をいたします。　
					</div>
				</div>
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
				<a href="<?= site_url('summer21/kyushu?referer=seminar_complete') ?>">トップに戻る</a>
			</div>
		</div> <!-- end of container -->

		<?php $this->load->view('front/summer21/footer'); ?>
	</div> <!-- end of .wrappewr -->

	<?php $this->load->view('inc/_foot'); ?>
</body>
</html>
