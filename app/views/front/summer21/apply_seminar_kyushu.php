<?php $this->load->view('inc/_head', array('TITLE' => SITE_NAME, 'CSS' => array('style.summer21.css', 'style.summer21_kyushu.css'))); ?>

<body>
	<div class="wrapper">
		<?php $this->load->view('front/summer21/header'); ?>

		<div class="container">
			<h1 class="title">セミナー参加申込フォーム</h1>

			<ul class="breadcrumb-list">
				<li class="current">情報の入力</li>
				<li>入力内容の確認</li>
				<li>受付完了</li>
			</ul>

			セミナーの参加申し込みを受け付けております。
			必要事項をご入力の上、「入力内容の確認画面へ」をクリックしてください。

			<?php echo form_open('summer21/confirm_seminar_kyushu'); ?>
				<div class="form-box">
					<dl class="event-info">
						<dt>開催日</dt>
						<dd>5月25日(火)</dd>
						<dt>時間</dt>
						<dd>
							11:00～12:30
							<span>※受付は10:00から行っております。</span>
						</dd>
						<dt>会場</dt>
						<dd>福岡会場［リファレンス駅東&nbsp;3階会議室H-2］</dd>
					</dl>

					<dl class="item-box">
						<?php
							$guest_num_list = array(
								''		=> '選択してください',
								'1'		=> '1',
								'2'		=> '2',
								'3'		=> '3',
								'4'		=> '4',
								'5'		=> '5',
								'6'		=> '6',
								'7'		=> '7',
								'8'		=> '8',
								'9'		=> '9',
								'10'	=> '10'
							);
						?>

						<dt class="item-title">お申込み人数</dt>
						<dd>
							<?php echo form_dropdown('guest_num', $guest_num_list, set_value('guest_num', '')); ?>名
							<?php echo form_error('guest_num'); ?>
						</dd>
					</dl>

					<h1 class="title mt-5 mb-4">お客様情報をご入力ください（※全て必須項目）</h1>

					<dl class="item-box">
						<dt class="item-title">貴塾名</dt>
						<dd>
							<?php echo form_input(array(
								'name'	=> 'juku_name',
								'value'	=> set_value('juku_name', '')
							)); ?>
							<?php echo form_error('juku_name'); ?>
						</dd>

						<dt class="item-title">お申込担当者名</dt>
						<dd>
							<?php echo form_input(array(
								'name'	=> 'charge',
								'value'	=> set_value('charge', '')
							)); ?>
							<?php echo form_error('charge'); ?>
						</dd>

						<dt class="item-title">郵便番号</dt>
						<dd>
							<?php echo form_input(array(
								'name'	=> 'zip',
								'id'	=> 'zip',
								'value'	=> set_value('zip', '')
							)); ?>
							<?php echo form_error('zip'); ?>
						</dd>

						<dt class="item-title">ご住所</dt>
						<dd>
							<?php echo form_input(array(
								'name'	=> 'address',
								'id'	=> 'address',
								'value'	=> set_value('address', '')
							)); ?>
							<?php echo form_error('address'); ?>
						</dd>

						<dt class="item-title">電話番号</dt>
						<dd>
							<?php echo form_input(array(
								'name'	=> 'tel',
								'value'	=> set_value('tel', '')
							)); ?>
							<?php echo form_error('tel'); ?>
						</dd>

						<dt class="item-title">メールアドレス</dt>
						<dd>
							<?php echo form_input(array(
								'name'	=> 'email',
								'value'	=> set_value('email', '')
							)); ?>
							<?php echo form_error('email'); ?>
						</dd>
					</dl>
				</div> <!-- end of .form-box -->

				<div class="text-center">
					<?php echo form_checkbox(array(
						'name'	=> 'agreement',
						'id'	=> 'agreement'
					)); ?>
					<?php echo form_label('<a href="javascript:void(0);" data-featherlight="#privacy">個人情報の取扱い</a>に同意する。', 'agreement', array('class' => 'for-checkbox')); ?>
				</div>

				<div class="container-fluid mt-3 mb-4">
					<div class="row justify-content-center">
						<div class="col-12 col-md-4">
							<?php echo form_button(array(
								'name'		=> 'btn-submit',
								'id'		=> 'btn_disabled',
								'class'		=> 'btn-summer21 btn-disabled',
								'content'	=> '入力内容の確認画面へ&nbsp;&nbsp;&nbsp;<i class="fas fa-chevron-right"></i>'
							)); ?>

							<?php echo form_button(array(
								'name'		=> 'btn-submit',
								'id'		=> 'btn_enabled',
								'type'		=> 'submit',
								'class'		=> 'btn-summer21 btn-enabled',
								'style'		=> 'display:none;',
								'content'	=> '入力内容の確認画面へ&nbsp;&nbsp;&nbsp;<i class="fas fa-chevron-right"></i>'
							)); ?>
						</div>
					</div> <!-- end of .row -->
				</div> <!-- end of .container-fluid -->
			<?php echo form_close(); ?>

			<div class="anchor-to-back">
				<a href="<?= site_url('summer21/kyushu?referer=apply_seminar') ?>">トップに戻る</a>
			</div>
		</div> <!-- end of container -->

		<?php $this->load->view('front/summer21/footer'); ?>
	</div> <!-- end of .wrappewr -->

	<?php /* feather lightbox用に個人情報の取扱をロードしておく */ ?>
	<div id="privacy-box" style="display:none;">
		<div id="privacy">
			<?php $this->load->view('inc/privacy'); ?>
		</div>
	</div>
	<?php /* feather lightbox用に個人情報の取扱をロードしておく ここまで */ ?>

	<?php $this->load->view('inc/_foot'); ?>

	<script src="//ajaxzip3.github.io/ajaxzip3.js"></script>
	<script src="<?= base_url('js/front/summer21_seminar_kyushu.js') ?>?var=<?= CACHES_CLEAR_VERSION ?>"></script>
</body>
</html>
