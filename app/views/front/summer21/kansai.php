<?php $this->load->view('inc/_head', array('TITLE' => SITE_NAME, 'CSS' => 'style.summer21.css')); ?>

<body>
	<div class="wrapper">
		<?php $this->load->view('front/summer21/header'); ?>

		<div class="container">
			２１年夏　関西


			<?php echo form_button(array(
				'name'		=> 'btn_apply_seminar',
				'content'	=> 'セミナー申込み',
				'onclick'	=> 'location.href=\'' . site_url('summer21/apply_seminar/kansai') . '\''
			)); ?>




		</div> <!-- end of container -->

		<?php $this->load->view('front/summer21/footer'); ?>
	</div> <!-- end of .wrappewr -->

	<?php $this->load->view('inc/_foot'); ?>
</body>
</html>
