<?php $this->load->view('inc/admin/_head', array('TITLE' => '申込確認（21冬期） | ' . SITE_NAME)); ?>

<body>
	<div id="app">
		<div class="main-wrapper main-wrapper-1">
			<?php $this->load->view('inc/admin/header'); ?>
			<?php $this->load->view('inc/admin/sidebar', array('current' => 'winter21')); ?>

			<div class="main-content">
				<section class="section">
					<div class="section-header">
						<h1>申込確認（21冬期）</h1>
					</div>

					<div class="section-body">
						<div class="row">
							<div class="col-12 col-md-7">
								<div class="card card-primary">
									<div class="card-body">
										<div class="table-responsive">
											<table id="tbl_winter21" class="table table-striped table-sm">
												<thead>
													<tr>
														<th data-column-id="col_proc" data-formatter="col_proc" data-sortable="false" data-width="200px">申込状況</th>
														<th data-column-id="place" data-sortable="false">会場</th>
														<th data-column-id="event_date" data-width="130px" data-order="asc">開催日</th>
														<th data-column-id="guest_num1" data-sortable="false" data-width="75px" data-align="right">10:00</th>
														<th data-column-id="guest_num2" data-sortable="false" data-width="75px" data-align="right">10:50</th>
														<th data-column-id="guest_num3" data-sortable="false" data-width="75px" data-align="right">11:40</th>
														<th data-column-id="guest_num4" data-sortable="false" data-width="75px" data-align="right">12:30</th>
														<th data-column-id="guest_num5" data-sortable="false" data-width="75px" data-align="right">13:20</th>
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

	<?php $this->load->view('inc/admin/_foot'); ?>

	<script>
		var result = '<?= $RESULT ?>';
	</script>
	<script src="<?= base_url('js/admin/winter21.js')?>?var=<?= CACHES_CLEAR_VERSION ?>"></script>
</body>
</html>
