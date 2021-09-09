<?php $this->load->view('inc/_head', array('TITLE' => SITE_NAME, 'CSS' => 'style.winter21.css')); ?>

<body>
	<div class="wrapper">
		<?php $this->load->view('front/winter21/header'); ?>

		<div class="container">
			<div class="row justify-content-center mb-5">
				<div class="col-12 col-md-8">
					新学習指導要領の全面実施、そして中学校教科書の改訂により、今年度は各教科の指導内容・方法が大きく変わりました。
					特に英語は内容が難しくなっただけでなく、小学校の教科書で扱っている単語や表現の学習が前提となるため、生徒の学び不足が心配されます。
					この冬は、今までの総復習や弱点克服に力を入れて、次年度以降つまずかないようにする絶好の機会です。<br>
					本展示会では、子どもたちを確実にフォローし、冬以降の学習に繋げるためのテキスト・ツールを展示いたします。
					貴塾の冬期講習に最適なテキストを選ぶために、是非会場にてご確認ください。
				</div>
			</div> <!-- end of .row -->

			<div class="row justify-content-center">
				<div class="col-12 col-md-4 mb-5">
					<p class="apply-attention">当展示会は、事前のお申込みが必要となります。</p>

					<?php echo form_button(array(
						'name'		=> 'btn_apply_seminar',
						'content'	=> 'ご来場のお申込み&nbsp;&nbsp;&nbsp;<i class="fas fa-chevron-right"></i>',
						'class'		=> 'btn-winter21 btn-enabled',
						'onclick'	=> 'location.href=\'' . site_url('winter21/apply') . '\''
					)); ?>
				</div>
			</div> <!-- end of .row -->
		</div> <!-- end of .container -->

		<div class="text-list">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-12 col-md-9">
						<img src="<?= base_url('img/winter21/text_pc.png') ?>" alt="テキスト一覧" class="for-pc">
						<img src="<?= base_url('img/winter21/text_sp.png') ?>" alt="テキスト一覧" class="for-sp">
					</div>
				</div>
			</div> <!-- end of .container -->
		</div> <!-- end of .text-list -->

		<div class="container mt-5">
			<h1 class="title">来場お申込み方法</h1>

			<div class="row justify-content-center">
				<div class="col-12 col-md-8">
					展示会場に密が発生することを避けるため、事前申込み制とさせていただきます。<br>
					下のご来場お申込みフォームからお申込みをお願いいたします。

					<div class="how-to-apply">
						<div class="step-box">
							<img src="<?= base_url('img/winter21/process01.png') ?>" alt="お申込み方法">
							ご来場お申込みフォームに必要事項をご入力いただき、送信してください。
						</div>

						<div class="down-arrow"></div>

						<div class="step-box">
							<img src="<?= base_url('img/winter21/process02.png') ?>" alt="お申込み方法">
							フォームを送信すると、受付票をダウンロードしていただけますので、保存をお願いいたします。
							入力いただいたメールアドレスにも受付票のＵＲＬを送らせていただきます。
						</div>

						<div class="down-arrow"></div>

						<div class="step-box">
							<img src="<?= base_url('img/winter21/process03.png') ?>" alt="お申込み方法">
							セミナー当日は、受付票を必ずご持参いただき、受付にお見せください。
						</div>
					</div>
				</div>
			</div> <!-- end of .row -->

			<div class="row justify-content-center">
				<div class="col-12 col-md-4">
					<?php echo form_button(array(
						'name'		=> 'btn_apply_seminar',
						'content'	=> 'ご来場のお申込み&nbsp;&nbsp;&nbsp;<i class="fas fa-chevron-right"></i>',
						'class'		=> 'btn-winter21 btn-enabled',
						'onclick'	=> 'location.href=\'' . site_url('winter21/apply') . '\''
					)); ?>
				</div>
			</div> <!-- end of .row -->
			<p class="text-center mt-2">※開催日の3日前までにお申込みいただくよう、お願いいたします。</p>

			<h1 class="title mt-5">会場一覧</h1>

			<div class="row">
				<div class="col-12 col-md-6">
					<p class="venue-name">岡山</p>
					<div class="container-fluid">
						<div class="row">
							<div class="col-12 col-md-6 px-0 venue-box">
								<p class="date">10月28日（木）</p>
								<p class="name">岡山コンベンションセンター</p>
								<p class="room">4階&nbsp;407会議室</p>
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

				<div class="col-12 col-md-6">
				<p class="venue-name">福山</p>
					<div class="container-fluid">
						<div class="row">
							<div class="col-12 col-md-6 px-0 venue-box">
								<p class="date">10月29日（金）</p>
								<p class="name">まなびの館ローズコム</p>
								<p class="room">4階&nbsp;大会議室</p>
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
					<p class="venue-name">広島</p>
					<div class="container-fluid">
						<div class="row">
							<div class="col-12 col-md-6 px-0 venue-box">
								<p class="date">11月4日（木）</p>
								<p class="name">広島県立総合体育館</p>
								<p class="room">地下1階&nbsp;大会議室</p>
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

				<div class="col-12 col-md-6">
					<p class="venue-name">松山</p>
					<div class="container-fluid">
						<div class="row">
							<div class="col-12 col-md-6 px-0 venue-box">
								<p class="date">11月5日（金）</p>
								<p class="name">松山市総合<br>コミュニティセンター</p>
								<p class="room">2階&nbsp;第1･2会議室</p>
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
			</div> <!-- end of .row -->

			<div class="row justify-content-center">
				<div class="col-12 col-md-4 my-5">
					<p class="apply-attention">当展示会は、事前のお申込みが必要となります。</p>

					<?php echo form_button(array(
						'name'		=> 'btn_apply_seminar',
						'content'	=> 'ご来場のお申込み&nbsp;&nbsp;&nbsp;<i class="fas fa-chevron-right"></i>',
						'class'		=> 'btn-winter21 btn-enabled',
						'onclick'	=> 'location.href=\'' . site_url('winter21/apply') . '\''
					)); ?>
				</div>
			</div> <!-- end of .row -->

			<h2 class="attempt">開催にあたり、以下の取り組みにご理解・ご協力よろしくお願いいたします。</h2>

			<div class="for-pc">
				<div class="attempt-box">
					<div class="box-row">
						<div class="box-cell">
							<img src="<?= base_url('img/winter21/attempt01.png') ?>" alt="取り組み">
						</div>
						<div class="box-cell">
							<img src="<?= base_url('img/winter21/attempt02.png') ?>" alt="取り組み">
						</div>
						<div class="box-cell">
							<img src="<?= base_url('img/winter21/attempt03.png') ?>" alt="取り組み">
						</div>
						<div class="box-cell">
							<img src="<?= base_url('img/winter21/attempt04.png') ?>" alt="取り組み">
						</div>
					</div> <!-- end of .box-row -->

					<div class="box-row">
						<div class="box-cell">マスクの着用</div>
						<div class="box-cell">手指の消毒</div>
						<div class="box-cell">受付時の検温</div>
						<div class="box-cell">ソーシャル<br>ディスタンス</div>
					</div> <!-- end of .box-row -->
				</div> <!-- end of .attemt-box -->
			</div>

			<div class="for-sp">
				<div class="attempt-box">
					<div class="box-row">
						<div class="box-cell">
							<img src="<?= base_url('img/winter21/attempt01.png') ?>" alt="取り組み">
						</div>
						<div class="box-cell">
							<img src="<?= base_url('img/winter21/attempt02.png') ?>" alt="取り組み">
						</div>
					</div> <!-- end of .box-row -->

					<div class="box-row">
						<div class="box-cell">マスクの着用</div>
						<div class="box-cell">手指の消毒</div>
						</div> <!-- end of .box-row -->

					<div class="box-row">
						<div class="box-cell">
							<img src="<?= base_url('img/winter21/attempt03.png') ?>" alt="取り組み">
						</div>
						<div class="box-cell">
							<img src="<?= base_url('img/winter21/attempt04.png') ?>" alt="取り組み">
						</div>
					</div> <!-- end of .box-row -->

					<div class="box-row">
						<div class="box-cell">受付時の検温</div>
						<div class="box-cell">ソーシャル<br>ディスタンス</div>
					</div> <!-- end of .box-row -->
				</div> <!-- end of .attemt-box -->
			</div>
		</div> <!-- end of container -->

		<?php $this->load->view('front/winter21/footer'); ?>
	</div> <!-- end of .wrappewr -->

	<?php $this->load->view('inc/_foot'); ?>
</body>
</html>
