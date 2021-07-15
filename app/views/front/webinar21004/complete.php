<?php $this->load->view('inc/_head', array('TITLE' => SITE_NAME, 'CSS' => 'style.webinar21004.css')); ?>

<body>
	<div class="wrapper">
		<?php $this->load->view('front/webinar21004/header'); ?>

		<div class="container">
			<h1 class="title">参加お申し込みフォーム</h1>

			<ul class="breadcrumb-list">
				<li>情報の入力</li>
				<li>入力内容の確認</li>
				<li class="current">受付完了</li>
			</ul>

			<?php if( $ERRMSG == '' ): ?>
				<h2 class="complete-comment">お申し込みいただき、ありがとうございます。</h2>

				<div class="row justify-content-center my-md-5">
					<div class="col-12">
						ご入力いただきましたメールアドレス（<?= $EMAIL ?>）宛てに確認メールを送信いたしました。<br>
						ご参加いただくための<span class="text-danger font-weight-bold">Zoomの招待URLは後日メールにてお知らせいたします</span>ので、ご面倒ではございますが、必ずご確認ください。<br>
						※Zoomの詳細は下記『ご案内』をご覧ください。

						<section class="for-pc my-5">
							<div class="how-to-apply">
								<div class="d-flex justify-content-center">
									<img src="<?= base_url('img/webinar21004/method_1_gray.png') ?>" alt="申込方法1">
									<div class="arrow-triangle-right"></div>
									<img src="<?= base_url('img/webinar21004/method_2_gray.png') ?>" alt="申込方法2">
									<div class="arrow-triangle-right"></div>
									<img src="<?= base_url('img/webinar21004/method_3.png') ?>" alt="申込方法3">
								</div>
							</div>

							<div class="how-to-apply">
								<div class="d-flex justify-content-center">
									<img src="<?= base_url('img/webinar21004/method_4.png') ?>" alt="申込方法4">
									<div class="arrow-triangle-right"></div>
									<img src="<?= base_url('img/webinar21004/method_5.png') ?>" alt="申込方法5">
									<div class="arrow-triangle-right"></div>
									<img src="<?= base_url('img/webinar21004/method_plus.png') ?>" alt="申込方法+">
								</div>
							</div>
						</section>

						<section class="for-sp">
							<div class="how-to-apply">
								<div class="d-flex justify-content-center">
									<img src="<?= base_url('img/webinar21004/method_1_gray.png') ?>" alt="申込方法1">
									<div class="arrow-triangle-right"></div>
									<img src="<?= base_url('img/webinar21004/method_2_gray.png') ?>" alt="申込方法2">
								</div>
							</div>

							<div class="how-to-apply">
								<div class="d-flex justify-content-center">
									<img src="<?= base_url('img/webinar21004/method_3.png') ?>" alt="申込方法3">
									<div class="arrow-triangle-right"></div>
									<img src="<?= base_url('img/webinar21004/method_4.png') ?>" alt="申込方法4">
								</div>
							</div>

							<div class="how-to-apply">
								<div class="d-flex justify-content-center">
									<img src="<?= base_url('img/webinar21004/method_5.png') ?>" alt="申込方法5">
									<div class="arrow-triangle-right"></div>
									<img src="<?= base_url('img/webinar21004/method_plus.png') ?>" alt="申込方法+">
								</div>
							</div>
						</section>

						<div class="attention-box">
							<h2>ご案内</h2>

							<div class="content">
								当日はZoomというWeb会議サービスを利用して行います。<br>
								Zoomを初めてご利用される方は、ご視聴いただくデバイス（PCなど）にZoomをダウンロードしていただく必要がございます。<br>
								※アカウントの取得（＝無料サインアップ）の必要はございません。<br>
								　また、招待URLにつきましては、後日メールにてお知らせいたします。<br>

								<dl>
									<dt>〇パソコンからご参加いただく場合</dt>
									<dd>
										以下のURLから、事前に「ミーティング用Zoomクライアント」をダウンロードして実行してください。<br>
										<a href="https://zoom.us/download" target="_blank">https://zoom.us/download</a>（Zoomダウンロードセンター）
									</dd>

									<dt>〇スマートフォン、タブレットからご参加いただく場合</dt>
									<dd>
										以下のURLから、事前に「Zoom Cloud Meeting」をダウンロードしてください。<br>
										・iPhone / iPad: <a href="https://apps.apple.com/jp/app/zoom-cloud-meetings/id546505307" target="_blank">https://apps.apple.com/jp/app/zoom-cloud-meetings/id546505307</a><br>
										・Android: <a href="https://play.google.com/store/apps/details?id=us.zoom.videomeetings&hl=ja" target="_blank">https://play.google.com/store/apps/details?id=us.zoom.videomeetings&hl=ja</a>
									</dd>
								</dl>
							</div> <!-- end of .content -->
						</div> <!-- end of .attention-box -->

						<div class="attention-box">
							<h2>確認メールが届かない場合</h2>

							<div class="content">
								<p>
									確認メールはご登録のメールアドレスに自動送信しておりますが、メールの特性上、遅延、未着となる場合があります。<br>
									その際はお手数ですが、直接お電話でご連絡いただきますようお願いいたします。<br>
									また、以下の点もご確認ください。
								</p>

								<dl>
									<dt>〇メール受信拒否設定をしていませんか？</dt>
									<dd>
										ドメイン（@マーク以降）が[chuoh-kyouiku.co.jp]からのメールが受信できるようにご設定ください。
									</dd>

									<dt>〇迷惑メールやゴミ箱に振り分けられていませんか？</dt>
									<dd>
										お使いのセキュリティソフトやメールソフトによっては迷惑メールやゴミ箱に振り分けられている可能性があります。ご確認ください。
									</dd>

									<dt>〇登録されたメールアドレスに間違いはありませんか？</dt>
									<dd>
										登録されたメールアドレスは「<?= $EMAIL ?>」です。
									</dd>
								</dl>
							</div> <!-- end of .content -->
						</div> <!-- end of .attention-box -->
					</div>
				</div> <!-- end of .row -->
			<?php else: ?>
				<h2 class="complete-comment"><?= $ERRMSG ?></h2>

				<div class="row justify-content-center my-md-5">
					<div class="col-12 col-md-8">
						大変お手数ですが、もう一度最初からお申込みをお願いします。<br>
						エラーが続くようでしたら、直接お電話でお問い合わせくださいますようお願いいたします。
					</div>
				</div>
			<?php endif; ?>

			<div class="anchor-to-back">
				<a href="<?= site_url('webinar21004') ?>">トップページに戻る</a>
			</div>
		</div> <!-- end of container -->

		<?php $this->load->view('front/webinar21004/footer'); ?>
	</div> <!-- end of .wrappewr -->

	<?php $this->load->view('inc/_foot'); ?>
</body>
</html>
