<?php $this->load->view('inc/_head', array('TITLE' => SITE_NAME, 'CSS' => 'style.summer21.css')); ?>

<body>
	<div class="wrapper">
		<?php $this->load->view('front/summer21/header_chushikoku'); ?>

		<div class="container">
			<h1 class="title">テキスト展示来場申込フォーム</h1>

			<ul class="breadcrumb-list">
				<li class="current">情報の入力</li>
				<li>入力内容の確認</li>
				<li>受付完了</li>
			</ul>

			夏期テキスト展示の来場申し込みを受け付けております。<br>
			ご希望の会場（日程）をお選びいただき、必要事項をご入力の上、「入力内容の確認画面へ」をクリックしてください。

			<?php echo form_open('summer21/confirm_exhibition', array('id' => 'frm_apply_chushikoku')); ?>
				<?php echo form_hidden('office', $OFFICE); ?>

				<div class="form-box">
					<p class="item-title">ご希望の会場（日程）をお選びください</p>
					<div class="container-fluid">
						<div class="row">
							<div class="col-12 col-md-6">
								<?php if( strtotime(date('Y-m-d')) > strtotime('2021-05-21') ): ?>
									<p class="full-capacity">米子会場［５月２５日（火）］</p>
								<?php else: ?>
									<?php echo form_radio(array(
										'name'	=> 'place',
										'id'	=> 'place6',
										'value'	=> '6',
										'checked'	=> set_checkbox('place', '6', FALSE)
									)); ?>
									<?php echo form_label('米子会場［５月２５日（火）］', 'place6', array('class' => 'for-radio place-label')); ?>
								<?php endif; ?>
							</div>

							<div class="col-12 col-md-6">
								<?php if( strtotime(date('Y-m-d')) > strtotime('2021-05-22') ): ?>
									<p class="full-capacity">広島会場［５月２６日（水）］</p>
								<?php else: ?>
									<?php echo form_radio(array(
										'name'	=> 'place',
										'id'	=> 'place2',
										'value'	=> '2',
										'checked'	=> set_checkbox('place', '2', FALSE)
									)); ?>
									<?php echo form_label('広島会場［５月２６日（水）］', 'place2', array('class' => 'for-radio place-label')); ?>
								<?php endif; ?>
							</div>
						</div> <!-- end of .row -->

						<div class="row">
							<div class="col-12 col-md-6">
								<?php if( strtotime(date('Y-m-d')) > strtotime('2021-05-23') ): ?>
									<p class="full-capacity">松山会場［５月２７日（木）］</p>
								<?php else: ?>
									<?php echo form_radio(array(
										'name'	=> 'place',
										'id'	=> 'place4',
										'value'	=> '4',
										'checked'	=> set_checkbox('place', '4', FALSE)
									)); ?>
									<?php echo form_label('松山会場［５月２７日（木）］', 'place4', array('class' => 'for-radio place-label')); ?>
								<?php endif; ?>
							</div>

							<div class="col-12 col-md-6">
								<?php if( strtotime(date('Y-m-d')) > strtotime('2021-05-24') ): ?>
									<p class="full-capacity">福山会場［５月２８日（金）］</p>
								<?php else: ?>
									<?php echo form_radio(array(
										'name'	=> 'place',
										'id'	=> 'place5',
										'value'	=> '5',
										'checked'	=> set_checkbox('place', '5', FALSE)
									)); ?>
									<?php echo form_label('福山会場［５月２８日（金）］', 'place5', array('class' => 'for-radio place-label')); ?>
								<?php endif; ?>
							</div>
						</div> <!-- end of .row -->

						<div class="row">
							<div class="col-12 col-md-6">
								<?php if( strtotime(date('Y-m-d')) > strtotime('2021-05-27') ): ?>
									<p class="full-capacity">岡山会場［５月３１日（月）］</p>
								<?php else: ?>
									<?php echo form_radio(array(
										'name'	=> 'place',
										'id'	=> 'place3',
										'value'	=> '3',
										'checked'	=> set_checkbox('place', '3', FALSE)
									)); ?>
									<?php echo form_label('岡山会場［５月３１日（月）］', 'place3', array('class' => 'for-radio place-label')); ?>
								<?php endif; ?>
							</div>
						</div> <!-- end of .row -->

						<?php echo form_error('place'); ?>
					</div> <!-- end of .container-fluid -->

					<div id="input_area" style="display:none;">
						<p class="item-title mt-4">ご希望の時間帯をお選びください</p>
						<div class="container-fluid">
							<?php if( !empty($REMAIN_EXHIBITION) ): ?>
								<?php foreach( $REMAIN_EXHIBITION as $place => $exhibition ): ?>
									<div id="select_time_<?= $place ?>" style="display:none;">
										<div class="row">
											<div class="col-12 col-md-6">
												<?php if( $exhibition[1]['remain'] > 0 ): ?>
													<?php echo form_radio(array(
														'name'	=> 'time',
														'id'	=> 'time_' . $exhibition[1]['detail_id'],
														'value'	=> $exhibition[1]['detail_id'],
														'checked'	=> set_checkbox('time', $exhibition[1]['detail_id'], FALSE)
													)); ?>
													<?php echo form_label(date('H:i', strtotime($exhibition[1]['start'])) . '～' . date('H:i', strtotime($exhibition[1]['end'])), 'time_' . $exhibition[1]['detail_id'], array('class' => 'for-radio place-label')); ?>
												<?php else: ?>
													<p class="full-capacity"><?= date('H:i', strtotime($exhibition[1]['start'])) ?>～<?= date('H:i', strtotime($exhibition[1]['end'])) ?></p>
													<span class="full-capacity-info">※満員</span>
												<?php endif; ?>
											</div>

											<div class="col-12 col-md-6">
												<?php if( $exhibition[2]['remain'] > 0 ): ?>
													<?php echo form_radio(array(
														'name'	=> 'time',
														'id'	=> 'time_' . $exhibition[2]['detail_id'],
														'value'	=> $exhibition[2]['detail_id'],
														'checked'	=> set_checkbox('time', $exhibition[2]['detail_id'], FALSE)
													)); ?>
													<?php echo form_label(date('H:i', strtotime($exhibition[2]['start'])) . '～' . date('H:i', strtotime($exhibition[2]['end'])), 'time_' . $exhibition[2]['detail_id'], array('class' => 'for-radio place-label')); ?>
												<?php else: ?>
													<p class="full-capacity"><?= date('H:i', strtotime($exhibition[2]['start'])) ?>～<?= date('H:i', strtotime($exhibition[2]['end'])) ?></p>
													<span class="full-capacity-info">※満員</span>
												<?php endif; ?>
											</div>
										</div> <!-- end of .row -->

										<div class="row">
											<div class="col-12 col-md-6">
												<?php if( $exhibition[3]['remain'] > 0 ): ?>
													<?php echo form_radio(array(
														'name'	=> 'time',
														'id'	=> 'time_' . $exhibition[3]['detail_id'],
														'value'	=> $exhibition[3]['detail_id'],
														'checked'	=> set_checkbox('time', $exhibition[3]['detail_id'], FALSE)
													)); ?>
													<?php echo form_label(date('H:i', strtotime($exhibition[3]['start'])) . '～' . date('H:i', strtotime($exhibition[3]['end'])), 'time_' . $exhibition[3]['detail_id'], array('class' => 'for-radio place-label')); ?>
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
													<?php echo form_label(date('H:i', strtotime($exhibition[4]['start'])) . '～' . date('H:i', strtotime($exhibition[4]['end'])), 'time_' . $exhibition[4]['detail_id'], array('class' => 'for-radio place-label')); ?>
												<?php else: ?>
													<p class="full-capacity"><?= date('H:i', strtotime($exhibition[4]['start'])) ?>～<?= date('H:i', strtotime($exhibition[4]['end'])) ?></p>
													<span class="full-capacity-info">※満員</span>
												<?php endif; ?>
											</div>
										</div> <!-- end of .row -->

										<div class="row">
											<div class="col-12 col-md-6">
												<?php if( $exhibition[5]['remain'] > 0 ): ?>
													<?php echo form_radio(array(
														'name'	=> 'time',
														'id'	=> 'time_' . $exhibition[5]['detail_id'],
														'value'	=> $exhibition[5]['detail_id'],
														'checked'	=> set_checkbox('time', $exhibition[5]['detail_id'], FALSE)
													)); ?>
													<?php echo form_label(date('H:i', strtotime($exhibition[5]['start'])) . '～' . date('H:i', strtotime($exhibition[5]['end'])), 'time_' . $exhibition[5]['detail_id'], array('class' => 'for-radio place-label')); ?>
												<?php else: ?>
													<p class="full-capacity"><?= date('H:i', strtotime($exhibition[5]['start'])) ?>～<?= date('H:i', strtotime($exhibition[5]['end'])) ?></p>
													<span class="full-capacity-info">※満員</span>
												<?php endif; ?>
											</div>
										</div> <!-- end of .row -->
									</div>
								<?php endforeach; ?>
								<?php echo form_error('time'); ?>

								<p class="note-limit">
									※新型コロナウイルス感染予防対策として、展示会場内に密が発生することを避けるために時間帯ごとに人数制限を設けております。
									50分以内を目処に展示商品をご覧ください。
								</p>
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
				<a href="<?= site_url('summer21/chushikoku?referer=apply_exhibition') ?>">トップに戻る</a>
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
	<script src="<?= base_url('js/front/summer21_exhibition_chushikoku.js') ?>?var=<?= CACHES_CLEAR_VERSION ?>"></script>
</body>
</html>
