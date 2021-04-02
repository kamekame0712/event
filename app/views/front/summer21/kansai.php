<?php $this->load->view('inc/_head', array('TITLE' => SITE_NAME, 'CSS' => array('style.summer21.css', 'style.summer21_kansai.css'))); ?>

<body>
	<div class="wrapper">
		<?php $this->load->view('front/summer21/header'); ?>

		<div class="container mb-5 mb-md-0">
			<div class="area-box">
				<span>OSAKA/KYOTO/KOBE/HIMEJI</span><br>
				関西４会場でプレミアムセミナー開催！<br>
				中学校の教科書改訂を受けて、<br class="for-sp">これからの英語教育のあり方に迫る！
			</div>
		</div> <!-- end of container -->

		<hr class="for-pc">

		<div class="container">
			<section>
				<p class="venue-arrow">OSAKA/KYOTO</p>

				<div class="detail-box for-pc" id="detail_box">
					<div class="container-fluid">
						<div class="row align-items-end">
							<div class="col-12 col-md-6 px-md-0 py-md-o">
								<h3 class="speaker-name">安河内 哲也<span>氏</span></h3>
								<p>
									英語教育改革が進むなか、今の子どもたちに必要な英語とは何か。
									安河内先生よりお話していただきます。
								</p>
								<dl class="event-data">
									<dt class="event-date">開催日</dt>
									<dd class="event-date">
										大阪<span>６/１</span>(火)　京都<span>６/２</span>(水)
									</dd>

									<dt>時　間</dt>
									<dd>
										11:00～12:15　講演<br>
										12:15～12:30　質疑応答
									</dd>
								</dl>

								<div class="limit-num" id="limit_num">
									<img src="<?= base_url('img/summer21/limit.png') ?>" alt="１塾２名限定">

									<h4>定員</h4>

									<div class="place-limit">
										<span class="place-name">大阪</span>会場
										<span class="first-come">先着</span>
										<span class="number">150</span>
										<span class="first-come">名</span>
									</div>

									<div class="place-limit">
										<span class="place-name">京都</span>会場
										<span class="first-come">先着</span>
										<span class="number">&nbsp;80</span>
										<span class="first-come">名</span>
									</div>
								</div>
							</div>

							<div class="col-12 col-md-6 px-md-0 py-md-0">
								<div class="speaker-box" id=speaker_box>
									<h3 class="seminar-title">今の子どもたちに<br>必要な英語とは</h3>
									<div class="speaker-info">
										<div class="container-fluid">
											<div class="row">
												<div class="col-8">
													<div class="text-center">
														<h4>講師紹介</h4>
													</div>
													<p>
														1967年福岡県北九州市生まれ。上智大学外国語学部英語学科卒。
														東進ハイスクール・東進ビジネススクール英語科講師。
														言語活動型英語授業を促進するために、スピーキングテスト、４技能試験の導入にむけて各所で活動中。
														学校での講演の他、大手メーカーや金融機関でのグローバル化研修、教育委員会主催の教員研修事業の講師も務めている。
													</p>
												</div>
											</div> <!-- end of .row -->
										</div> <!-- end of .container-fluid -->

										<img src="<?= base_url('img/summer21/speaker.png') ?>" alt="安河内哲也氏">
									</div>
								</div> <!-- end of .speaker-box -->
							</div>
						</div> <!-- end of .row -->

					</div> <!-- end of .container-fluid -->
				</div> <!-- end of .detail-box -->

				<div class="detail-box-sp for-sp">
					<div class="text-center">
						<h3 class="speaker-name">安河内 哲也<span>氏</span></h3>
						<h3 class="seminar-title">今の子どもたちに<br>必要な英語とは</h3>
					</div>
					<p>
						英語教育改革が進むなか、今の子どもたちに必要な英語とは何か。
						安河内先生よりお話していただきます。
					</p>

					<div class="event-data-box">
						<dl class="event-data">
							<dt class="event-date">開催日</dt>
							<dd class="event-date">
								大阪<span class="ym">６/１</span>(火)　<br>
								京都<span class="ym">６/２</span>(水)
							</dd>

							<dt>時　間</dt>
							<dd>
								<span class="overlapping">11:00～12:15　講演</span><br>
								<span class="overlapping">12:15～12:30　質疑応答</span>
							</dd>
						</dl>

						<img src="<?= base_url('img/summer21/speaker_sp.png') ?>" alt="安河内哲也氏">
					</div>

					<div class="speaker-box">
						<div class="text-center">
							<h4>講師紹介</h4>
						</div>

						1967年福岡県北九州市生まれ。上智大学外国語学部英語学科卒。
						東進ハイスクール・東進ビジネススクール英語科講師。
						言語活動型英語授業を促進するために、スピーキングテスト、４技能試験の導入にむけて各所で活動中。
						学校での講演の他、大手メーカーや金融機関でのグローバル化研修、教育委員会主催の教員研修事業の講師も務めている。
					</div> <!-- end of .speaker-box -->

					<div class="limit-num">
						<img src="<?= base_url('img/summer21/limit.png') ?>" alt="１塾２名限定">

						<h4>定員</h4>

						<div class="place-limit">
							<span class="place-name">大阪</span>会場
							<span class="first-come">先着</span>
							<span class="number">150</span>
							<span class="first-come">名</span>
						</div>

						<div class="place-limit">
							<span class="place-name">京都</span>会場
							<span class="first-come">先着</span>
							<span class="number">&nbsp;80</span>
							<span class="first-come">名</span>
						</div>
					</div> <!-- end of .limit-num -->
				</div> <!-- end of .detail-box-sp -->

				<section class="for-sp">
					<div class="row justify-content-center">
						<p class="text-attention">当イベントは、事前のお申込みが必要となります。</p>
					</div> <!-- end of .row -->

					<div class="row justify-content-center mb-5">
						<div class="col-12 col-md-4 text-right">
							<?php echo form_button(array(
								'name'		=> 'btn_apply_seminar',
								'content'	=> 'セミナー&amp;テキスト展示のお申込み&nbsp;&nbsp;&nbsp;<i class="fas fa-chevron-right"></i>',
								'class'		=> 'btn-summer21 btn-enabled',
								'onclick'	=> 'location.href=\'' . site_url('summer21/apply_seminar/kansai') . '\''
							)); ?>
						</div>

						<div class="col-12 col-md-4 text-left">
							<?php echo form_button(array(
								'name'		=> 'btn_apply_seminar',
								'content'	=> '展示会のみのお申込み&nbsp;&nbsp;&nbsp;<i class="fas fa-chevron-right"></i>',
								'class'		=> 'btn-summer21 btn-enabled mt-3 mt-md-0',
								'onclick'	=> 'location.href=\'' . site_url('summer21/apply_exhibition/kansai') . '\''
							)); ?>
						</div>
					</div> <!-- end of .row -->
				</section>

				<h1 class="title">会場一覧（参加無料&nbsp;/&nbsp;事前申込制）</h1>

				<div class="row">
					<div class="col-12 col-md-6">
						<p class="venue-name">大阪</p>
						<div class="container-fluid">
							<div class="row">
								<div class="col-12 col-md-6 px-0 venue-box">
									<p class="date">6月1日（火）</p>
									<p class="name">新大阪丸ビル 別館</p>
									<p class="room">10F セミナールーム</p>
									<p class="address">
										〒533-0033<br>
										大阪市東淀川区東中島1-18-22<br>
										TEL(06)6325-1302
									</p>
								</div>

								<div class="col-12 col-md-6 px-0 pr-md-3">
									<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3278.8860960366314!2d135.50125931562758!3d34.73326538898025!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6000e43c377a16fb%3A0xeaf2120d2477e0f8!2z5paw5aSn6Ziq5Li444OT44Or5Yil6aSo!5e0!3m2!1sja!2sjp!4v1617012647626!5m2!1sja!2sjp" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
								</div>
							</div> <!-- end of .row -->
						</div> <!-- end of .container-fluid -->
					</div>

					<div class="col-12 col-md-6">
						<p class="venue-name">京都</p>
						<div class="container-fluid">
							<div class="row">
								<div class="col-12 col-md-6 px-0 venue-box">
									<p class="date">6月2日（水）</p>
									<p class="name">メルパルク京都</p>
									<p class="room">7F 大会場オリオン</p>
									<p class="address">
										〒600-8216<br>
										京都市下京区東洞院通七条下ル<br>
										東塩小路町676-13<br>
										TEL(075)352-7444
									</p>
								</div>

								<div class="col-12 col-md-6 px-0 pl-md-3">
									<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3268.807254204109!2d135.75872031563213!3d34.98649237536503!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x600108ae40317485%3A0x1849263269aab061!2z44Oh44Or44OR44Or44Kv5Lqs6YO9!5e0!3m2!1sja!2sjp!4v1617013995709!5m2!1sja!2sjp" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
								</div>
							</div> <!-- end of .row -->
						</div> <!-- end of .container-fluid -->
					</div>
				</div> <!-- end of .row -->

				<div class="row justify-content-center mt-5">
					<p class="text-attention mt-md-5">当イベントは、事前のお申込みが必要となります。</p>
				</div> <!-- end of .row -->

				<div class="row justify-content-center mb-5">
					<div class="col-12 col-md-4 text-right">
						<?php echo form_button(array(
							'name'		=> 'btn_apply_seminar',
							'content'	=> 'セミナー&amp;テキスト展示のお申込み&nbsp;&nbsp;&nbsp;<i class="fas fa-chevron-right"></i>',
							'class'		=> 'btn-summer21 btn-enabled',
							'onclick'	=> 'location.href=\'' . site_url('summer21/apply_seminar/kansai') . '\''
						)); ?>
					</div>

					<div class="col-12 col-md-4 text-left">
						<?php echo form_button(array(
							'name'		=> 'btn_apply_seminar',
							'content'	=> '展示会のみのお申込み&nbsp;&nbsp;&nbsp;<i class="fas fa-chevron-right"></i>',
							'class'		=> 'btn-summer21 btn-enabled mt-3 mt-md-0',
							'onclick'	=> 'location.href=\'' . site_url('summer21/apply_exhibition/kansai') . '\''
						)); ?>
					</div>
				</div> <!-- end of .row -->
			</section> <!-- end of OSAKA/KYOTO -->

			<section>
				<p class="venue-arrow mt-5">KOBE/HIMEJI</p>

				<div class="detail-box2 for-pc">
					<img src="<?= base_url('img/summer21/text_image1.png') ?>" alt="テキスト" class="text-image1">
					<img src="<?= base_url('img/summer21/text_image2.png') ?>" alt="テキスト" class="text-image2">

					<h3 class="seminar-title">新学習指導要領に伴う英語教育改革</h3>
					<dl class="event-data">
						<dt>講　師</dt>
						<dd class="en">
							株式会社エデュケーショナルネットワーク<br>
							<p class="text-center">向井 菜穂子氏</p>
						</dd>
						<dt class="event-date">開催日</dt>
						<dd class="event-date">
							神戸<span>６/３</span>(木)　姫路<span>６/４</span>(金)
						</dd>

						<dt>時　間</dt>
						<dd>
							11:00～12:30　講演<br>
							12:30～12:40　質疑応答
						</dd>
					</dl>
					<p class="note">
						新学習指導要領の全面実施により、小学校・中学校・高校の英語がどう変わり、今後どんな学習を行うべきなのか。
						様々な分析を行っている業界最大手の出版社エデュケーショナルネットワークよりお話していただきます。
					</p>

					<div class="limit-num">
						<h4>定員</h4>

						<div class="place-limit">
							<span class="place-name">神戸</span>会場
							<span class="first-come">先着</span>
							<span class="number">50</span>
							<span class="first-come">名</span>
						</div>

						<div class="place-limit">
							<span class="place-name">姫路</span>会場
							<span class="first-come">先着</span>
							<span class="number">60</span>
							<span class="first-come">名</span>
						</div>
					</div> <!-- end of .limit-num -->
				</div> <!-- end of .detail-box2 -->

				<div class="detail-box2-sp for-sp">
					<h3 class="seminar-title">新学習指導要領に伴う<br>英語教育改革</h3>
					<dl class="event-data">
						<dt>講　師</dt>
						<dd class="en">
							株式会社エデュケーショナルネットワーク<br>
							<p class="text-center">向井 菜穂子氏</p>
							<div class="text-center">
								<img src="<?= base_url('img/summer21/text_image1.png') ?>" alt="テキスト" class="text-image">
								<img src="<?= base_url('img/summer21/text_image2.png') ?>" alt="テキスト" class="text-image">
							</div>
						</dd>
						<dt class="event-date">開催日</dt>
						<dd class="event-date">
							神戸<span>6/3</span>(木)　姫路<span>6/4</span>(金)
						</dd>

						<dt>時　間</dt>
						<dd>
							11:00～12:30　講演<br>
							12:30～12:40　質疑応答
						</dd>
					</dl>
					<p class="note">
						新学習指導要領の全面実施により、小学校・中学校・高校の英語がどう変わり、今後どんな学習を行うべきなのか。
						様々な分析を行っている業界最大手の出版社エデュケーショナルネットワークよりお話していただきます。
					</p>

					<div class="limit-num">
						<h4>定員</h4>

						<div class="place-limit">
							<span class="place-name">神戸</span>会場
							<span class="first-come">先着</span>
							<span class="number">50</span>
							<span class="first-come">名</span>
						</div>

						<div class="place-limit">
							<span class="place-name">姫路</span>会場
							<span class="first-come">先着</span>
							<span class="number">60</span>
							<span class="first-come">名</span>
						</div>
					</div> <!-- end of .limit-num -->
				</div> <!-- end of .detail-box2-sp -->

				<section class="for-sp">
					<div class="row justify-content-center">
						<p class="text-attention">当イベントは、事前のお申込みが必要となります。</p>
					</div> <!-- end of .row -->

					<div class="row justify-content-center mb-5">
						<div class="col-12 col-md-4 text-right">
							<?php echo form_button(array(
								'name'		=> 'btn_apply_seminar',
								'content'	=> 'セミナー&amp;テキスト展示のお申込み&nbsp;&nbsp;&nbsp;<i class="fas fa-chevron-right"></i>',
								'class'		=> 'btn-summer21 btn-enabled',
								'onclick'	=> 'location.href=\'' . site_url('summer21/apply_seminar/kansai') . '\''
							)); ?>
						</div>

						<div class="col-12 col-md-4 text-left">
							<?php echo form_button(array(
								'name'		=> 'btn_apply_seminar',
								'content'	=> '展示会のみのお申込み&nbsp;&nbsp;&nbsp;<i class="fas fa-chevron-right"></i>',
								'class'		=> 'btn-summer21 btn-enabled mt-3 mt-md-0',
								'onclick'	=> 'location.href=\'' . site_url('summer21/apply_exhibition/kansai') . '\''
							)); ?>
						</div>
					</div> <!-- end of .row -->
				</section>

				<h1 class="title">会場一覧（参加無料&nbsp;/&nbsp;事前申込制）</h1>

				<div class="row">
					<div class="col-12 col-md-6">
						<p class="venue-name">神戸</p>
						<div class="container-fluid">
							<div class="row">
								<div class="col-12 col-md-6 px-0 venue-box">
									<p class="date">6月3日（木）</p>
									<p class="name">神戸市産業振興センター</p>
									<p class="room">901会議室</p>
									<p class="address">
										〒650-0044<br>
										兵庫県神戸市中央区東川崎町1-8-4<br>
										(神戸ハーバーランド内)<br>
										TEL(078)360-3200
									</p>
								</div>

								<div class="col-12 col-md-6 px-0 pr-md-3">
									<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3280.9723447222364!2d135.1796349656266!3d34.68064744179886!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x60008f072904df45%3A0x7788e11bf24b6de1!2z56We5oi45biC55Sj5qWt5oyv6IiI44K744Oz44K_44O8!5e0!3m2!1sja!2sjp!4v1617155479274!5m2!1sja!2sjp" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
								</div>
							</div> <!-- end of .row -->
						</div> <!-- end of .container-fluid -->
					</div>

					<div class="col-12 col-md-6">
						<p class="venue-name">姫路</p>
						<div class="container-fluid">
							<div class="row">
								<div class="col-12 col-md-6 px-0 venue-box">
									<p class="date">6月4日（金）</p>
									<p class="name">姫路商工会議所</p>
									<p class="room">本館1F　展示場</p>
									<p class="address">
										〒670-8505<br>
										兵庫県姫路市下寺町43<br>
										TEL(079)222-6001
									</p>
								</div>

								<div class="col-12 col-md-6 px-0 pl-md-3">
									<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3274.9461937292513!2d134.69879591562955!3d34.832445333657795!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3554dffd834ba325%3A0x768cd4cc78a7769f!2z5aer6Lev5ZWG5bel5Lya6K2w5omA!5e0!3m2!1sja!2sjp!4v1617155540845!5m2!1sja!2sjp" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
								</div>
							</div> <!-- end of .row -->
						</div> <!-- end of .container-fluid -->
					</div>
				</div> <!-- end of .row -->

				<div class="row justify-content-center mt-5">
					<p class="text-attention mt-md-5">当イベントは、事前のお申込みが必要となります。</p>
				</div> <!-- end of .row -->

				<div class="row justify-content-center mb-5">
					<div class="col-12 col-md-4 text-right">
						<?php echo form_button(array(
							'name'		=> 'btn_apply_seminar',
							'content'	=> 'セミナー&amp;テキスト展示のお申込み&nbsp;&nbsp;&nbsp;<i class="fas fa-chevron-right"></i>',
							'class'		=> 'btn-summer21 btn-enabled',
							'onclick'	=> 'location.href=\'' . site_url('summer21/apply_seminar/kansai') . '\''
						)); ?>
					</div>

					<div class="col-12 col-md-4 text-left">
						<?php echo form_button(array(
							'name'		=> 'btn_apply_seminar',
							'content'	=> '展示会のみのお申込み&nbsp;&nbsp;&nbsp;<i class="fas fa-chevron-right"></i>',
							'class'		=> 'btn-summer21 btn-enabled mt-3 mt-md-0',
							'onclick'	=> 'location.href=\'' . site_url('summer21/apply_exhibition/kansai') . '\''
						)); ?>
					</div>
				</div> <!-- end of .row -->
			</section> <!-- end of KOBE/HIMEJI -->
		</div>

		<section>
			<div class="measures">
				<div class="container">
					<div class="measures-content">
						<p class="description">
							新型コロナウイルス感染予防対策として、以下の取り組みを実施いたします。<br>
							皆様に安心してご来場いただけるように、ご理解・ご協力のほどよろしくお願いいたします。
						</p>

						<div class="measures-list">
							<div class="image-wrapper narrow">
								<img src="<?= base_url('img/summer21/measures1.png') ?>" alt="感染対策">
							</div>
							<div class="image-wrapper narrow">
								<img src="<?= base_url('img/summer21/measures2.png') ?>" alt="感染対策">
							</div>
							<div class="image-wrapper narrow">
								<img src="<?= base_url('img/summer21/measures3.png') ?>" alt="感染対策">
							</div>
							<div class="image-wrapper narrow">
								<img src="<?= base_url('img/summer21/measures4.png') ?>" alt="感染対策">
							</div>
							<div class="image-wrapper wide">
								<img src="<?= base_url('img/summer21/measures5.png') ?>" alt="感染対策">
							</div>
						</div>

						<p class="description note for-pc">
							※展示会開催前に、主催のスタッフを対象にＰＣＲ検査を行います。
							各会場は、陰性が確認されたスタッフのみ参加いたします。
						</p>
					</div> <!-- end of .measures-content -->
				</div> <!-- end of container -->
			</div> <!-- end of .measures -->

			<div class="lineup">
				<div class="container">
					<div class="lineup-content">
						<img src="<?= base_url('img/summer21/new.png') ?>" alt="改訂・新版多数" class="new-label">
						<div class="lineup-lead">
							<p class="venue-arrow">TEXT LINE UP!</p>
							<p class="lead">2021年は中学校教科書改訂年度！</p>
						</div>
						<h3>夏期講習用＆後期改訂・新刊テキストも併設展示します！</h3>

						<div class="text-list">
							<div class="image-wrapper">
								<img src="<?= base_url('img/summer21/text_image1.png') ?>" alt="夏期テキスト">
							</div>
							<div class="image-wrapper">
								<img src="<?= base_url('img/summer21/text_image1.png') ?>" alt="夏期テキスト">
							</div>
							<div class="image-wrapper">
								<img src="<?= base_url('img/summer21/text_image1.png') ?>" alt="夏期テキスト">
							</div>
							<div class="image-wrapper">
								<img src="<?= base_url('img/summer21/text_image1.png') ?>" alt="夏期テキスト">
							</div>
							<div class="image-wrapper">
								<img src="<?= base_url('img/summer21/text_image1.png') ?>" alt="夏期テキスト">
							</div>
						</div>
					</div> <!-- end of .lineup-content -->
				</div> <!-- end of container -->
			</div> <!-- end of .lineup -->
		</section>

		<div class="container">
			<section>
				<h1 class="title">参加お申込み方法</h1>
				<p class="info-apply-method">
					セミナーにご参加いただくには、事前のお申し込みが必要となります。
					下のお申込みフォームからお申し込みください。<br>
					申込フォームを送信すると、受付票をダウンロードしていただけますので、保存をお願いいたします。
					また、入力いただいたメールアドレスにも受付票のＵＲＬを送らせていただきます。
					セミナー当日は、受付票を必ずご持参いただき、受付にお見せください。
				</p>
				<div class="apply-method-image">
					<siv class="image-wrapper">
						<img src="<?= base_url('img/summer21/how_to_apply1.png') ?>" alt="フォーム入力">
					</siv>
					<div class="arrow-triangle-right"></div>
					<siv class="image-wrapper">
						<img src="<?= base_url('img/summer21/how_to_apply2.png') ?>" alt="受付票を保存">
					</siv>
					<div class="arrow-triangle-right"></div>
					<siv class="image-wrapper">
						<img src="<?= base_url('img/summer21/how_to_apply3.png') ?>" alt="受付票を当日持参">
					</siv>
				</div>

				<div class="row justify-content-center mb-5">
					<div class="col-12 col-md-4 text-right">
						<?php echo form_button(array(
							'name'		=> 'btn_apply_seminar',
							'content'	=> 'セミナー&amp;テキスト展示のお申込み&nbsp;&nbsp;&nbsp;<i class="fas fa-chevron-right"></i>',
							'class'		=> 'btn-summer21 btn-enabled',
							'onclick'	=> 'location.href=\'' . site_url('summer21/apply_seminar/kansai') . '\''
						)); ?>
					</div>

					<div class="col-12 col-md-4 text-left">
						<?php echo form_button(array(
							'name'		=> 'btn_apply_seminar',
							'content'	=> '展示会のみのお申込み&nbsp;&nbsp;&nbsp;<i class="fas fa-chevron-right"></i>',
							'class'		=> 'btn-summer21 btn-enabled mt-3 mt-md-0',
							'onclick'	=> 'location.href=\'' . site_url('summer21/apply_exhibition/kansai') . '\''
						)); ?>
					</div>
				</div> <!-- end of .row -->
			</section>
		</div> <!-- end of container -->

		<?php $this->load->view('front/summer21/footer'); ?>
	</div> <!-- end of .wrappewr -->

	<?php $this->load->view('inc/_foot'); ?>
</body>
</html>
