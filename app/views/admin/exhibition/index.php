<?php $this->load->view('inc/admin/_head', array('TITLE' => '展示会管理 | ' . SITE_NAME)); ?>

<body>
	<div id="app">
		<div class="main-wrapper main-wrapper-1">
			<?php $this->load->view('inc/admin/header'); ?>
			<?php $this->load->view('inc/admin/sidebar', array('current' => 'exhibition')); ?>

			<div class="main-content">
				<section class="section">
					<div class="section-header">
						<h1>展示会管理</h1>
					</div>

					<div class="section-body">
						<div class="row">
							<div class="col-12 col-md-8">
								<div class="card card-primary">
									<div class="card-header">
										<a href="<?= site_url('admin/exhibition/add') ?>" class="btn btn-primary note-btn">新規追加</a>
									</div>
									<div class="card-body">
										<div class="table-responsive">
											<table id="tbl_exhibition" class="table table-striped table-sm">
												<thead>
													<tr>
														<th data-column-id="col_proc" data-formatter="col_proc" data-sortable="false" data-width="140px">処理</th>
														<th data-column-id="col_proc2" data-formatter="col_proc2" data-sortable="false" data-width="200px">申込状況</th>
														<th data-column-id="office" data-width="150px">主催オフィス</th>
														<th data-column-id="place" data-width="80px" data-sortable="false">会場</th>
														<th data-column-id="event_date" data-width="120px">開催日</th>
													</tr>
												</thead>
											</table>
										</div>
									</div>
								</div> <!-- end of .card -->
							</div>
						</div> <!-- end of .row -->
					</div> <!-- end of .section-body -->
				</section>
			</div> <!-- end of .main-content -->

			<?php $this->load->view('inc/admin/footer'); ?>
		</div> <!-- end of .main-wrapper -->
	</div> <!-- end of #app -->

	<?php /* ダイアログ */ ?>
	<div class="modal" id="modal_exhibition" tabindex="-1" role="dialog" aria-labelledby="staticModalLabel" aria-hidden="true" data-show="true" data-keyboard="false">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">削除</h4>
					<button type="button" class="close" data-dismiss="modal">
						<span aria-hidden="true">&#215;</span><span class="sr-only">閉じる</span>
					</button>
				</div><!-- /modal-header -->

				<div class="modal-body">
					<div class="row">
						<div class="col-sm-4">
							主催オフィス
						</div>
						<div class="col-sm-8">
							<?php echo form_dropdown('office', $CONF['office'], '', 'id="office"'); ?>
						</div>
					</div><br />
					<div class="row">
						<div class="col-sm-4">
							会場
						</div>
						<div class="col-sm-8">
							<?php echo form_dropdown('place', $CONF['place_summer21'], '', 'id="place"'); ?>
						</div>
					</div><br />
					<div class="row">
						<div class="col-sm-4">
							開催日
						</div>
						<div class="col-sm-8">
							<?php echo form_input(array(
								'name'		=> 'event_date',
								'id'		=> 'event_date',
								'value'		=> ''
							)); ?>
						</div>
					</div>
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
					<button type="button" class="btn btn-primary" onclick="do_submit();">削除</button>
				</div>
			</div> <!-- /.modal-content -->
		</div> <!-- /.modal-dialog -->
	</div> <!-- /.modal -->

	<?php $this->load->view('inc/admin/_foot'); ?>

	<script>
		var result = '<?= $RESULT ?>';
	</script>
	<script src="<?= base_url('js/admin/exhibition.js')?>?var=<?= CACHES_CLEAR_VERSION ?>"></script>
</body>
</html>
