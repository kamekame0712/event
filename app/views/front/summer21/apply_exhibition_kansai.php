<?php $this->load->view('inc/_head', array('TITLE' => SITE_NAME, 'CSS' => 'style.summer21.css')); ?>

<body>
	<div class="wrapper">
		<?php $this->load->view('front/summer21/header'); ?>

		<div class="container">
			<h1 class="title">テキスト展示来場申込フォーム</h1>

			<ul class="breadcrumb-list">
				<li class="current">情報の入力</li>
				<li>入力内容の確認</li>
				<li>受付完了</li>
			</ul>

			夏期テキスト展示の来場申し込みを受け付けております。<br>
			ご希望の会場（日程）をお選びいただき、必要事項をご入力の上、「入力内容の確認画面へ」をクリックしてください。

			<?php echo form_open('summer21/confirm_exhibition', array('id' => 'frm_apply_kansai')); ?>
				<?php echo form_hidden('office', $OFFICE); ?>

				<div class="form-box">
					<p class="item-title">ご希望の会場（日程）をお選びください</p>
					<div class="container-fluid">
						<div class="row">
							<div class="col-12 col-md-6">
								<?php echo form_radio(array(
									'name'	=> 'place',
									'id'	=> 'place7',
									'value'	=> '7',
									'checked'	=> set_checkbox('place', '7', FALSE)
								)); ?>
								<?php echo form_label('大阪会場［６月１日（火）］', 'place7', array('class' => 'for-radio place-label')); ?>
							</div>

							<div class="col-12 col-md-6">
								<?php echo form_radio(array(
									'name'	=> 'place',
									'id'	=> 'place8',
									'value'	=> '8',
									'checked'	=> set_checkbox('place', '8', FALSE)
								)); ?>
								<?php echo form_label('京都会場［６月２日（水）］', 'place8', array('class' => 'for-radio place-label')); ?>
							</div>
						</div> <!-- end of .row -->

						<div class="row">
							<div class="col-12 col-md-6">
								<?php echo form_radio(array(
									'name'	=> 'place',
									'id'	=> 'place9',
									'value'	=> '9',
									'checked'	=> set_checkbox('place', '9', FALSE)
								)); ?>
								<?php echo form_label('神戸会場［６月３日（木）］', 'place9', array('class' => 'for-radio place-label')); ?>
							</div>

							<div class="col-12 col-md-6">
								<?php echo form_radio(array(
									'name'	=> 'place',
									'id'	=> 'place10',
									'value'	=> '10',
									'checked'	=> set_checkbox('place', '10', FALSE)
								)); ?>
								<?php echo form_label('姫路会場［６月４日（金）］', 'place10', array('class' => 'for-radio place-label')); ?>
							</div>
						</div> <!-- end of .row -->

						<?php echo form_error('place'); ?>
					</div> <!-- end of .container-fluid -->

					<div id="input_area" style="display:none;">
						<p class="item-title mt-4">ご希望の時間帯をお選びください</p>
						<div class="container-fluid">
							<?php if( !empty($REMAIN_EXHIBITION) ): ?>
								<?php foreach( $REMAIN_EXHIBITION as $place => $exhibition ): ?>
									<div class="row" id="select_time_<?= $place ?>" style="display:none;">
										<div class="col-12 col-md-6">
											<?php if( $exhibition[3]['remain'] > 0 ): ?>
												<?php echo form_radio(array(
													'name'	=> 'time',
													'id'	=> 'time_' . $exhibition[3]['detail_id'],
													'value'	=> $exhibition[3]['detail_id'],
													'checked'	=> set_checkbox('time', $exhibition[3]['detail_id'], FALSE)
												)); ?>
												<?php echo form_label(date('H:i', strtotime($exhibition[3]['start'])) . '～' . date('H:i', strtotime($exhibition[3]['end'])) . '（40人迄）', 'time_' . $exhibition[3]['detail_id'], array('class' => 'for-radio place-label')); ?>
											<?php else: ?>
												<p class="full-capacity"><?= date('H:i', strtotime($exhibition[3]['start'])) ?>～<?= date('H:i', strtotime($exhibition[3]['end'])) ?></p>
												<span class="full-capacity-info">※満員</span>
											<?php endif; ?>
										</div>

										<div class="col-12 col-md-6">
											<?php if( $exhibition[4]['remain'] > 0 ): ?>
												<?php echo form_radio(array(
													'name'	=> 'time',
													'id'	=> 'time_' . $exhibition[4]['detail_id'],
													'value'	=> $exhibition[4]['detail_id'],
													'checked'	=> set_checkbox('time', $exhibition[4]['detail_id'], FALSE)
												)); ?>
												<?php echo form_label(date('H:i', strtotime($exhibition[4]['start'])) . '～' . date('H:i', strtotime($exhibition[4]['end'])) . '（40人迄）', 'time_' . $exhibition[4]['detail_id'], array('class' => 'for-radio place-label')); ?>
											<?php else: ?>
												<p class="full-capacity"><?= date('H:i', strtotime($exhibition[4]['start'])) ?>～<?= date('H:i', strtotime($exhibition[4]['end'])) ?></p>
												<span class="full-capacity-info">※満員</span>
											<?php endif; ?>
										</div>
									</div> <!-- end of .row -->
								<?php endforeach; ?>
								<?php echo form_error('time'); ?>
							<?php endif; ?>

							<dl class="item-box">
								<dt class="item-title">ご来場人数</dt>
								<dd>
									<?php echo form_dropdown('guest_num', $GLIST, set_value('guest_num', '')); ?>名
									<?php echo form_error('guest_num'); ?>
								</dd>
							</dl>
						</div> <!-- end of .container-fluid -->

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
					</div> <!-- end of #input_area -->
				</div> <!-- end of .form-box -->

				<div id="confirm_area" style="display:none;">
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
				</div> <!-- end of #confirm_area -->
			<?php echo form_close(); ?>

			<div class="anchor-to-back">
				<a href="<?= site_url('summer21/kansai') ?>">トップに戻る</a>
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
	<script src="<?= base_url('js/front/summer21_exhibition_kansai.js') ?>?var=<?= CACHES_CLEAR_VERSION ?>"></script>
</body>
</html>
