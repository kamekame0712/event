<?php $this->load->view('inc/_head', array('TITLE' => SITE_NAME, 'CSS' => array('style.summer21.css', 'style.summer21_chushikoku.css'))); ?>

<body>
	<div class="wrapper">
		<?php $this->load->view('front/summer21/header_chushikoku'); ?>

		<section>
			<div class="container">
				<div class="top-image">
					<img src="<?= base_url('img/summer21/new.png') ?>" alt="改訂・新版多数" class="new-label">
					<h2>2021年は中学校教科書改訂年度！</h2>
				</div> <!-- end of .top-image -->
			</div> <!-- end of container -->

			<div class="guide">
				<div class="container">
					<div class="guide-content">
						<h3>夏期講習用&amp;後期改訂・新刊テキストを一斉展示します！</h3>

						<div class="row justify-content-center mt-3">
							<div class="col-12 col-md-8">
								<p>
									基礎・基本の復習から秋以降の予習・受験対策まで、
									学力レベルにあわせた夏期講習用テキストや今夏に改定・発刊予定のテキストを一斉展示します。
									テキストの内容や組み合わせなど、手にとってご確認ください。
								</p>
							</div>
						</div>
					</div>
				</div> <!-- end of container -->
			</div> <!-- end of .guide -->

			<div class="measures">
				<div class="container">
					<div class="measures-content">
						<p class="description">
							新型コロナウイルス感染予防対策として、以下の取り組みを実施いたします。<br>
							皆様に安心してご来場いただけるように、ご理解・ご協力のほどよろしくお願いいたします。
						</p>

						<div class="measures-list">
							<img src="<?= base_url('img/summer21/measures1.png') ?>" alt="感染対策">
							<img src="<?= base_url('img/summer21/measures2.png') ?>" alt="感染対策">
							<img src="<?= base_url('img/summer21/measures3.png') ?>" alt="感染対策">
							<img src="<?= base_url('img/summer21/measures3.png') ?>" alt="感染対策">
							<img src="<?= base_url('img/summer21/measures3.png') ?>" alt="感染対策">
						</div>

						<p class="description note">
							※展示会開催前に、主催のスタッフを対象にＰＣＲ検査を行います。
							各会場は、陰性が確認されたスタッフのみ参加いたします。
						</p>
					</div> <!-- end of .measures-content -->
				</div> <!-- end of container -->
			</div> <!-- end of .measures -->
		</section>

		<div class="container">
			<h1 class="title">来場お申込み方法</h1>
			<p class="info-apply-method">
				新型コロナウィルス感染予防対策として、展示会場内に密が発生することを避けるために、
				ご来場時間帯を事前にお知らせください。
				下のご来場のお申込みフォームからお申込みをお願いします。<br>
				申込フォームを送信すると、受付票をダウンロードしていただけますので、保存をお願いいたします。
				また、入力いただいたメールアドレスにも受付票のＵＲＬを送らせていただきます。
				セミナー当日は、受付票を必ずご持参いただき、受付にお見せください。
			</p>
			<div class="apply-method-image">
				<img src="<?= base_url('img/summer21/how_to_apply1.png') ?>" alt="フォーム入力">
				<div class="arrow-triangle-right"></div>
				<img src="<?= base_url('img/summer21/how_to_apply2.png') ?>" alt="受付票を保存">
				<div class="arrow-triangle-right"></div>
				<img src="<?= base_url('img/summer21/how_to_apply3.png') ?>" alt="受付票を当日持参">
			</div>

			<div class="row justify-content-center">
				<div class="col-12 col-md-4 mb-5">
					<?php echo form_button(array(
						'name'		=> 'btn_apply_seminar',
						'content'	=> 'ご来場のお申込み&nbsp;&nbsp;&nbsp;<i class="fas fa-chevron-right"></i>',
						'class'		=> 'btn-summer21 btn-enabled',
						'onclick'	=> 'location.href=\'' . site_url('summer21/apply_exhibition/chushikoku') . '\''
					)); ?>
				</div>
			</div> <!-- end of .row -->

			<h1 class="title mt-md-5">会場一覧（参加無料&nbsp;/&nbsp;事前申込制）</h1>

			<div class="row">
				<div class="col-12 col-md-6">
					<p class="venue-name">米子</p>
					<div class="container-fluid">
						<div class="row">
							<div class="col-12 col-md-6 px-0 venue-box">
								<p class="date">5月25日（火）</p>
								<p class="name">米子コンベンションセンター</p>
								<p class="room">1F情報プラザ</p>
								<p class="address">
									〒683-0043<br>
									鳥取県米子市末広町294<br>
									TEL(0859)35-8111
								</p>
							</div>

							<div class="col-12 col-md-6 px-0 pr-md-3">
								<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3251.3595596531122!2d133.3311499156398!3d35.421122051799856!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3556f77c1e58e6df%3A0xe6da5c20ccd6ad8b!2z57Gz5a2Q44Kz44Oz44OZ44Oz44K344On44Oz44K744Oz44K_44O8ICjjg5Pjg4PjgrDjgrfjg4Pjg5fvvIk!5e0!3m2!1sja!2sjp!4v1617258786042!5m2!1sja!2sjp" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
							</div>
						</div> <!-- end of .row -->
					</div> <!-- end of .container-fluid -->
				</div>

				<div class="col-12 col-md-6">
					<p class="venue-name">広島</p>
					<div class="container-fluid">
						<div class="row">
							<div class="col-12 col-md-6 px-0 venue-box">
								<p class="date">5月26日（水）</p>
								<p class="name">広島県立総合体育館</p>
								<p class="room">中会議室</p>
								<p class="address">
									〒730-0011<br>
									広島県広島市中区基町4-1<br>
									TEL(082)228-1111
								</p>
							</div>

							<div class="col-12 col-md-6 px-0 pr-md-3">
								<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3292.075502046655!2d132.4528409156216!3d34.39942680680046!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3545353a7cd5eed9%3A0x2478f8040f8287f9!2z5bqD5bO255yM56uL57eP5ZCI5L2T6IKy6aSoKOW6g-WztuOCsOODquODvOODs-OCouODquODvOODiik!5e0!3m2!1sja!2sjp!4v1617258872748!5m2!1sja!2sjp" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
							</div>
						</div> <!-- end of .row -->
					</div> <!-- end of .container-fluid -->
				</div>
			</div> <!-- end of .row -->

			<div class="row">
				<div class="col-12 col-md-6">
					<p class="venue-name">松山</p>
					<div class="container-fluid">
						<div class="row">
							<div class="col-12 col-md-6 px-0 venue-box">
								<p class="date">5月27日（木）</p>
								<p class="name">松山市総合<br>コミュニティセンター</p>
								<p class="room">3F大会議室</p>
								<p class="address">
									〒790-0012<br>
									愛媛県松山市湊町7-5<br>
									TEL(089)921-8222
								</p>
							</div>

							<div class="col-12 col-md-6 px-0 pr-md-3">
								<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3314.0881360187095!2d132.75298101561177!3d33.835837636549705!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x354fe5879569be7f%3A0x976b2f8146df6e64!2z44CSNzkwLTAwMTIg5oSb5aqb55yM5p2-5bGx5biC5rmK55S677yX5LiB55uu77yVIOadvuWxseW4gue3j-WQiOOCs-ODn-ODpeODi-ODhuOCo-OCu-ODs-OCv-ODvA!5e0!3m2!1sja!2sjp!4v1617258908564!5m2!1sja!2sjp" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
							</div>
						</div> <!-- end of .row -->
					</div> <!-- end of .container-fluid -->
				</div>

				<div class="col-12 col-md-6">
					<p class="venue-name">福山</p>
					<div class="container-fluid">
						<div class="row">
							<div class="col-12 col-md-6 px-0 venue-box">
								<p class="date">5月28日（金）</p>
								<p class="name">まなびの館ローズコム</p>
								<p class="room">中会議室</p>
								<p class="address">
									〒720-0812<br>
									広島県福山市霞町1-10-1<br>
									TEL(084)932-7265
								</p>
							</div>

							<div class="col-12 col-md-6 px-0 pr-md-3">
								<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3288.7918614303876!2d133.3638350156232!3d34.48280400236378!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x355110fdcf2f6629%3A0xfbe824161a218bc2!2z44G-44Gq44Gz44Gu6aSo44Ot44O844K644Kz44Og!5e0!3m2!1sja!2sjp!4v1617258943459!5m2!1sja!2sjp" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
							</div>
						</div> <!-- end of .row -->
					</div> <!-- end of .container-fluid -->
				</div>
			</div> <!-- end of .row -->

			<div class="row">
				<div class="col-12 col-md-6">
					<p class="venue-name">岡山</p>
					<div class="container-fluid">
						<div class="row">
							<div class="col-12 col-md-6 px-0 venue-box">
								<p class="date">5月31日（月）</p>
								<p class="name">岡山コンベンションセンター</p>
								<p class="room">407会議室</p>
								<p class="address">
									〒700-0024<br>
									岡山県岡山市北区駅元町14-1<br>
									TEL(086)214-1000
								</p>
							</div>

							<div class="col-12 col-md-6 px-0 pr-md-3">
								<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3281.5266893389703!2d133.91254461562625!3d34.66665439254767!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3554065280b5aca1%3A0xd9a1e231a2681c35!2z5bKh5bGx44Kz44Oz44OZ44Oz44K344On44Oz44K744Oz44K_44O8!5e0!3m2!1sja!2sjp!4v1617258980691!5m2!1sja!2sjp" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
							</div>
						</div> <!-- end of .row -->
					</div> <!-- end of .container-fluid -->
				</div>
			</div> <!-- end of .row -->

			<div class="row justify-content-center mt-5">
				<p class="text-attention">当展示会は、事前のお申込みが必要となります。</p>
			</div>

			<div class="row justify-content-center mb-5">
				<div class="col-12 col-md-4">
					<?php echo form_button(array(
						'name'		=> 'btn_apply_seminar',
						'content'	=> 'ご来場のお申込み&nbsp;&nbsp;&nbsp;<i class="fas fa-chevron-right"></i>',
						'class'		=> 'btn-summer21 btn-enabled',
						'onclick'	=> 'location.href=\'' . site_url('summer21/apply_exhibition/chushikoku') . '\''
					)); ?>
				</div>
			</div> <!-- end of .row -->
		</div> <!-- end of container -->

		<?php $this->load->view('front/summer21/footer'); ?>
	</div> <!-- end of .wrappewr -->

	<?php $this->load->view('inc/_foot'); ?>
</body>
</html>
