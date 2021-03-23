<?php $this->load->view('inc/_head', array('TITLE' => SITE_NAME)); ?>

<body>
	<div class="wrapper">
		<div class="error-header">
			<h1 class="error-title">404</h1>
			<p class="error-lead">Page Not Found.</p>
		</div>

		<div class="container">
			<p class="error-comment">
				お探しのページは見つかりませんでした。<br>
				以下のサイトもご覧ください。
			</p>

			<div class="row justify-content-center">
				<div class="col-6 col-md-2">
					<div class="anchor-box">
						<a href="http://www.chuoh-kyouiku.com/" target="_blank">
							<img src="<?= base_url('img/error/copo.png') ?>" alt="コーポレートサイト">
						</a>
					</div>
				</div>

				<div class="col-6 col-md-2">
					<div class="anchor-box">
						<a href="https://www.shop-chuoh.com/" target="_blank">
							<img src="<?= base_url('img/error/netshop.png') ?>" alt="CHUOHネットショップ">
						</a>
					</div>
				</div>
			</div> <!-- end of .row -->
		</div> <!-- end of container -->

		<footer class="error-footer">
			<div class="container">
				<div class="text-center mb-3">
					<a href="http://www.chuoh-kyouiku.com/" target="_blank">
						<img src="<?= base_url('img/logo.png') ?>" class="logo">
					</a>
				</div>

				<div class="row justify-content-center">
					<div class="col-6 col-md-3 mt-4">
						広島本社・中四国オフィス<br>
						TEL:082-227-3999 / FAX:082-227-4000
					</div>

					<div class="col-6 col-md-3 mt-4">
						東京オフィス<br>
						TEL:03-5283-5677 / FAX:03-5283-5685
					</div>

					<div class="col-6 col-md-3 mt-4">
						関西オフィス<br>
						TEL:06-6399-1400 / FAX:06-6399-1415
					</div>

					<div class="col-6 col-md-3 mt-4">
						九州オフィス<br>
						TEL:092-471-7188 / FAX:092-471-7189
					</div>
				</div> <!-- end of .row -->

				<p class="copyright">&copy;Chuoh&nbsp;Kyouiku&nbsp;Kenkyusyo,Inc.&nbsp;All&nbsp;Rights&nbsp;Reserved.</p>
			</div> <!-- end of container -->
		</footer>
	</div> <!-- end of .wrappewr -->

	<?php $this->load->view('inc/_foot'); ?>
</body>
</html>
