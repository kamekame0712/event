<?php $this->load->view('inc/admin/_head', array('TITLE' => '展示会管理 | ' . SITE_NAME)); ?>

<body>
	<div id="app">
		<div class="main-wrapper main-wrapper-1">
			<?php $this->load->view('inc/admin/header'); ?>
			<?php $this->load->view('inc/admin/sidebar', array('current' => 'exhibition')); ?>

			<div class="main-content">
				<section class="section">
					<div class="section-header">
						<h1>展示会管理 <?= $PDATA['kind'] == 'add' ? '新規追加' : '修正' ?> 確認</h1>
					</div>

					<div class="section-body">
						<div class="row">
							<div class="col-4">
								<div class="card card-primary">
									<div class="card-body">
										<dl class="confirm-list">
											<dt>主催オフィス</dt>
											<dd><?= $CONF['office'][$PDATA['office']] ?></dd>

											<dt>会場</dt>
											<dd><?= $CONF['place_summer21'][$PDATA['place']] ?></dd>

											<dt>開催日</dt>
											<dd><?= $DATE ?></dd>

											<dt>開催時間（入場時間）</dt>
											<dd>
												<?php if( !empty($DETAIL) ): ?>
													<?php foreach( $DETAIL as $val ): ?>
														<?= $val['start'] ?>&nbsp;～&nbsp;<?= $val['end'] ?>&nbsp;⇒&nbsp;<?= $val['capacity'] ?>名<br>
													<?php endforeach; ?>
												<?php endif; ?>
											</dd>
										</dl>
									</div> <!-- end of .card-body -->
								</div> <!-- end of .card -->

								<div class="text-center">
									<?php echo form_open('admin/exhibition', array('id' => 'frm_exhibition')); ?>
										<?php echo form_hidden($PDATA); ?>

										<?php echo form_button(array(
											'name'		=> 'btn-back',
											'content'	=> '戻る',
											'class'		=> 'btn btn-light',
											'onclick'	=> 'do_submit(\'1\',\'' . $PDATA['kind'] . '\',\''. $PDATA['exhibition_id'] .'\');'
										)); ?>

										<?php echo form_button(array(
											'name'		=> 'btn-submit',
											'content'	=> '登録',
											'class'		=> 'btn btn-primary ml-3',
											'onclick'	=> 'do_submit(\'2\', \'\', \'\');'
										)); ?>
									<?php echo form_close(); ?>
								</div>
							</div>
						</div> <!-- end of .row -->
					</div> <!-- end of .section-body -->
				</section>
			</div> <!-- end of .main-content -->

			<?php $this->load->view('inc/admin/footer'); ?>
		</div> <!-- end of .main-wrapper -->
	</div> <!-- end of #app -->

	<?php $this->load->view('inc/admin/_foot'); ?>
	<script src="<?= base_url('js/admin/exhibition_confirm.js')?>?var=<?= CACHES_CLEAR_VERSION ?>"></script>
</body>
</html>
