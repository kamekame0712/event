<?php $this->load->view('inc/_head', array('TITLE' => SITE_NAME, 'CSS' => 'style.webinar21004.css')); ?>

<body>
	<div class="wrapper">
		<?php $this->load->view('front/webinar21004/header'); ?>

		<div class="container">
			<h1 class="title">アーカイブ配信</h1>
			現在視聴可能なアーカイブ配信は以下の通りです。

			<div class="row justify-content-center my-md-2">
				<div class="col-12">
					<div class="archive-box">
						<?php if( $MOVIE == '1' ): ?>
							<h2>
								９月１６日（木）<br class="for-sp">
								【中学生に必要な英語力】<br class="for-sp">
								<span>視聴期限：2021年9月30日まで</span>
							</h2>
							<div class="content">
								<iframe src="https://player.vimeo.com/video/573805185" allow="autoplay; fullscreen" allowfullscreen></iframe>
							</div>
						<?php elseif( $MOVIE == '2' ): ?>
							<h2>
								１０月１日（金）<br class="for-sp">
								【今からできる大学入試対策】
								<span>視聴期限：2021年10月15日まで</span>
							</h2>
							<div class="content">
								<iframe src="https://player.vimeo.com/video/573805085" allow="autoplay; fullscreen" allowfullscreen></iframe>
							</div>
						<?php else: ?>
							<div class="content">現在ご覧いただけるアーカイブ配信はございません。</div>
						<?php endif; ?>
					</div> <!-- end of .archive-box -->
				</div>
			</div> <!-- end of .row -->
		</div> <!-- end of .container -->

		<?php $this->load->view('front/webinar21004/footer'); ?>
	</div> <!-- end of .wrappewr -->

	<?php $this->load->view('inc/_foot'); ?>
</body>
</html>
