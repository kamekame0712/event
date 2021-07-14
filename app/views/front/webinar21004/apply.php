<?php $this->load->view('inc/_head', array('TITLE' => SITE_NAME, 'CSS' => 'style.webinar21004.css')); ?>

<body>
	<div class="wrapper">
		<?php $this->load->view('front/webinar21004/header'); ?>

		<div class="container">
			<h1 class="title">参加お申し込みフォーム</h1>

			<ul class="breadcrumb-list">
				<li class="current">情報の入力</li>
				<li>入力内容の確認</li>
				<li>受付完了</li>
			</ul>

			ご希望の日程をお選びいただき、必要事項をご入力の上、「入力内容の確認画面へ」をクリックしてください。<br>
			※日程は複数選択していただけます。

			<?php echo form_open('webinar21004/confirm'); ?>
				<div class="form-box">
					<dl class="item-box">
						<dt class="item-title required">ご希望の日程<br class="for-pc">（複数選択可）</dt>
						<dd>
							<?php if( strtotime(date('Y-m-d')) > strtotime('2021-09-10') || $NUM1 >= 900 ): ?>
								<p class="full-capacity">９月１６日（木）<br class="for-sp">【中学生に必要な英語力】</p>
							<?php else: ?>
								<?php echo form_checkbox(array(
									'name'	=> 'seminar[]',
									'id'	=> 'seminar_1',
									'value'	=> '1',
									'checked'	=> set_checkbox('seminar[]', '1', FALSE)
								)); ?>
								<?php echo form_label('９月１６日（木）<br class="for-sp">【中学生に必要な英語力】', 'seminar_1', array('class' => 'for-checkbox seminar-label')); ?>
							<?php endif; ?>

							<?php if( strtotime(date('Y-m-d')) > strtotime('2021-09-25') || $NUM2 >= 900 ): ?>
								<p class="full-capacity">１０月１日（金）<br class="for-sp">【いまからできる大学入試対策】</p>
							<?php else: ?>
								<?php echo form_checkbox(array(
									'name'	=> 'seminar[]',
									'id'	=> 'seminar_2',
									'value'	=> '2',
									'checked'	=> set_checkbox('seminar[]', '2', FALSE)
								)); ?>
								<?php echo form_label('１０月１日（金）<br class="for-sp">【いまからできる大学入試対策】', 'seminar_2', array('class' => 'for-checkbox seminar-label')); ?>
							<?php endif; ?>

							<?php echo form_error('seminar[]'); ?>
						</dd>

						<dt class="item-title required">貴塾名</dt>
						<dd>
							<?php echo form_input(array(
								'name'			=> 'juku_name',
								'value'			=> set_value('juku_name', ''),
								'placeholder'	=> '例）中央塾'
							)); ?>
							<?php echo form_error('juku_name'); ?>
						</dd>

						<dt class="item-title optional">教室名</dt>
						<dd>
							<?php echo form_input(array(
								'name'			=> 'classroom',
								'value'			=> set_value('classroom', ''),
								'placeholder'	=> '例）八丁堀教室'
							)); ?>
							<?php echo form_error('classroom'); ?>
						</dd>

						<dt class="item-title required">ご参加者氏名</dt>
						<dd>
							<?php echo form_input(array(
								'name'			=> 'participant',
								'value'			=> set_value('participant', ''),
								'placeholder'	=> '例）中央 太郎'
							)); ?>
							<?php echo form_error('participant'); ?>
						</dd>

						<dt class="item-title optional">役職</dt>
						<dd>
							<?php echo form_input(array(
								'name'			=> 'position',
								'value'			=> set_value('position', ''),
								'placeholder'	=> '例）教室長'
							)); ?>
							<?php echo form_error('position'); ?>
						</dd>

						<dt class="item-title required">ご住所(都道府県)</dt>
						<dd>
							<?php echo form_dropdown('pref', $CONF['pref'], set_value('pref', '')); ?>
							<?php echo form_error('pref'); ?>
						</dd>

						<dt class="item-title required">電話番号</dt>
						<dd>
							<?php echo form_input(array(
								'name'			=> 'tel',
								'value'			=> set_value('tel', ''),
								'placeholder'	=> '例）082-227-3999'
							)); ?>
							<?php echo form_error('tel'); ?>
						</dd>

						<dt class="item-title required">メールアドレス</dt>
						<dd>
							<?php echo form_input(array(
								'name'			=> 'email',
								'value'			=> set_value('email', ''),
								'placeholder'	=> '例）info@chuoh-kyouiku.co.jp'
							)); ?>
							<?php echo form_error('email'); ?>
						</dd>
					</dl>
				</div> <!-- end of .form-box -->

				<div id="confirm_area">
					<div class="text-center">
						<?php echo form_checkbox(array(
							'name'	=> 'agreement',
							'id'	=> 'agreement'
						)); ?>
						<?php echo form_label('<a href="javascript:void(0);" data-featherlight="#privacy">個人情報の取扱い</a>に同意する。', 'agreement', array('class' => 'for-checkbox')); ?>
					</div>

					<div class="text-center">
						<?php echo form_checkbox(array(
							'name'	=> 'newsletter',
							'id'	=> 'newsletter',
							'checked'	=> 'checked'
						)); ?>
						<?php echo form_label('CHUOHメルマガへの会員登録（無料）を行う。', 'newsletter', array('class' => 'for-checkbox')); ?>
						<p id="newsletter_required" class="text-danger" style="display:none;">※オンラインセミナーへのお申し込みはCHUOHメルマガへの会員登録（無料）が必須となっております。<br>（すでにご登録いただいている方につきましては重複して登録されることはございませんので、チェックを付けてお進みください。）</p>
					</div>

					<div class="container-fluid mt-3 mb-4">
						<div class="row justify-content-center">
							<div class="col-12 col-md-4">
								<?php echo form_button(array(
									'name'		=> 'btn-submit',
									'id'		=> 'btn_disabled',
									'class'		=> 'btn-base btn-disabled',
									'content'	=> '入力内容の確認画面へ&nbsp;&nbsp;&nbsp;<i class="fas fa-chevron-right"></i>'
								)); ?>

								<?php echo form_button(array(
									'name'		=> 'btn-submit',
									'id'		=> 'btn_enabled',
									'type'		=> 'submit',
									'class'		=> 'btn-base btn-enabled',
									'style'		=> 'display:none;',
									'content'	=> '入力内容の確認画面へ&nbsp;&nbsp;&nbsp;<i class="fas fa-chevron-right"></i>'
								)); ?>
							</div>
						</div> <!-- end of .row -->
					</div> <!-- end of .container-fluid -->
				</div> <!-- end of #confirm_area -->
			<?php echo form_close(); ?>

			<div class="anchor-to-back">
				<a href="<?= site_url('webinar21004') ?>">トップページに戻る</a>
			</div>
		</div> <!-- end of container -->

		<?php $this->load->view('front/webinar21004/footer'); ?>
	</div> <!-- end of .wrappewr -->

	<?php /* feather lightbox用に個人情報の取扱をロードしておく */ ?>
	<div id="privacy-box" style="display:none;">
		<div id="privacy">
			<?php $this->load->view('inc/privacy'); ?>
		</div>
	</div>
	<?php /* feather lightbox用に個人情報の取扱をロードしておく ここまで */ ?>

	<?php $this->load->view('inc/_foot'); ?>

	<script src="<?= base_url('js/front/webinar21004_apply.js') ?>?var=<?= CACHES_CLEAR_VERSION ?>"></script>
</body>
</html>
