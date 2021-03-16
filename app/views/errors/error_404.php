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

		<?php $this->load->view('inc/footer'); ?>
	</div> <!-- end of .wrappewr -->

	<?php $this->load->view('inc/_foot'); ?>
</body>
</html>
