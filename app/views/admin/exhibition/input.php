<?php $this->load->view('inc/admin/_head', array('TITLE' => '展示会管理 | ' . SITE_NAME)); ?>

<body>
	<div id="app">
		<div class="main-wrapper main-wrapper-1">
			<?php $this->load->view('inc/admin/header'); ?>
			<?php $this->load->view('inc/admin/sidebar', array('current' => 'exhibition')); ?>

			<div class="main-content">
				<section class="section">
					<div class="section-header">
						<h1>展示会管理 <?= $KIND == 'add' ? '新規追加' : '修正' ?></h1>
					</div>

					<div class="section-body">
						<?php echo form_open('admin/exhibition/confirm'); ?>
							<?php echo form_hidden('kind', $KIND) ?>
							<?php echo form_hidden('exhibition_id', $EID) ?>

							<div class="row">
								<div class="col-4">
									<div class="card card-primary">
										<div class="card-body">
											<div class="form-group">
												<?php echo form_label('主催オフィス', '', array('class' => 'required-label')); ?>
												<?php echo form_dropdown('office', $CONF['office'], set_value('office', ( !empty($EDATA['office']) ? $EDATA['office'] : '' )), 'class="form-control"'); ?>
												<?php echo form_error('office'); ?>
											</div>

											<div class="form-group">
												<?php echo form_label('会場', '', array('class' => 'required-label')); ?>
												<?php echo form_dropdown('place', $CONF['place_summer21'], set_value('place', ( !empty($EDATA['place_summer21']) ? $EDATA['place_summer21'] : '' )), 'class="form-control"'); ?>
												<?php echo form_error('place'); ?>
											</div>

											<div class="form-group">
												<?php echo form_label('開催日', '', array('class' => 'required-label')); ?>
												<?php echo form_input(array(
													'name'	=> 'event_date',
													'id'	=> 'event_date',
													'value'	=> set_value('event_date', ( !empty($EDATA['event_date']) ? $EDATA['event_date'] : '' )),
													'class'	=> 'form-control'
												)); ?>
												<?php echo form_error('event_date'); ?>
											</div>

											<div class="form-group">
												<?php echo form_label('開催時間（入場時間）', '', array('class' => 'required-label')); ?>
												<table class="table table-secondary table-sm table-bordered table-striped">
													<thead>
														<tr>
															<th class="text-center">開始時間</th>
															<th class="text-center">終了時間</th>
															<th class="text-center">入場者数制限</th>
														</tr>
													</thead>

													<tbody>
														<?php for( $i = 0; $i < EXHIBITION_PERIOD_NUM; $i++ ): ?>
															<tr>
																<td>
																	<?php echo form_input(array(
																		'name'	=> 'exhibition_time_start[' . $i . ']',
																		'value'	=> set_value('exhibition_time_start[' . $i . ']', ( !empty($DDATA[$i]['exhibition_time_start']) ? $DDATA[$i]['exhibition_time_start'] : '' )),
																		'class'	=> 'form-control'
																	)); ?>
																</td>
																<td>
																	<?php echo form_input(array(
																		'name'	=> 'exhibition_time_end[' . $i . ']',
																		'value'	=> set_value('exhibition_time_end[' . $i . ']', ( !empty($DDATA[$i]['exhibition_time_end']) ? $DDATA[$i]['exhibition_time_end'] : '' )),
																		'class'	=> 'form-control'
																	)); ?>
																</td>
																<td>
																	<?php echo form_input(array(
																		'name'	=> 'capacity[' . $i . ']',
																		'value'	=> set_value('capacity[' . $i . ']', ( !empty($DDATA[$i]['capacity']) ? $DDATA[$i]['capacity'] : '' )),
																		'class'	=> 'form-control'
																	)); ?>
																</td>
															</tr>
														<?php endfor; ?>
													</tbody>
												</table>
												<?php echo form_error('exhibition_time_start[]'); ?>
											</div>
										</div> <!-- end of .card-body -->
									</div> <!-- end of .card -->

									<div class="text-center">
										<a href="<?= site_url('admin/exhibition') ?>" class="btn btn-light">戻る</a>

										<?php echo form_submit(array(
											'name'	=> 'btn-submit',
											'value'	=> '確認',
											'class'	=> 'btn btn-primary ml-3'
										)); ?>
									</div>
								</div>
							</div> <!-- end of .row -->
						<?php echo form_close(); ?>
					</div> <!-- end of .section-body -->
				</section>
			</div> <!-- end of .main-content -->

			<?php $this->load->view('inc/admin/footer'); ?>
		</div> <!-- end of .main-wrapper -->
	</div> <!-- end of #app -->

	<?php $this->load->view('inc/admin/_foot'); ?>
	<script src="<?= base_url('js/admin/exhibition_input.js')?>?var=<?= CACHES_CLEAR_VERSION ?>"></script>
</body>
</html>
