<?php $this->load->view('inc/_head', array('TITLE' => SITE_NAME, 'CSS' => 'style.summer21.css')); ?>

<body>
	<div class="wrapper">
		<?php $this->load->view('front/summer21/header'); ?>

		<div class="container">
			<div class="area-box">
				<span>OSAKA/KYOTO/KOBE/HIMEJI</span><br>
				関西４会場でプレミアムセミナー開催！<br>
				中学校の教科書改訂を受けて、これからの英語教育のあり方に迫る！
			</div>




















			２１年夏　関西


			<?php echo form_button(array(
				'name'		=> 'btn_apply_seminar',
				'content'	=> 'セミナー申込み',
				'onclick'	=> 'location.href=\'' . site_url('summer21/apply_seminar/kansai') . '\''
			)); ?>

			<?php echo form_button(array(
				'name'		=> 'btn_apply_seminar',
				'content'	=> '展示会申込み',
				'onclick'	=> 'location.href=\'' . site_url('summer21/apply_exhibition/kansai') . '\''
			)); ?>



		</div> <!-- end of container -->

		<?php $this->load->view('front/summer21/footer'); ?>
	</div> <!-- end of .wrappewr -->

	<?php $this->load->view('inc/_foot'); ?>
</body>
</html>
