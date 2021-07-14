<?php $this->load->view('inc/admin/_head', array('TITLE' => '申し込み状況確認 | ' . SITE_NAME)); ?>

<body>
	<div id="app">
		<div class="main-wrapper main-wrapper-1">
			<?php $this->load->view('inc/admin/header'); ?>
			<?php $this->load->view('inc/admin/sidebar', array('current' => 'webinar21004')); ?>

			<div class="main-content">
				<section class="section">
					<div class="section-header">
						<h1>申し込み状況確認</h1>
					</div>

					<div class="section-body">
						<div class="row">
							<div class="col-12 col-md-5">
								<div class="card card-info">
									<div class="card-header">申し込み総数</div>
									<div class="card-body">
										<dl class="apply-total">
											<dt>９月１６日（木）【中学生に必要な英語力】</dt>
											<dd><?= $NUM1 ?>名</dd>
											<dt>１０月１日（金）【いまからできる大学入試対策】</dt>
											<dd><?= $NUM2 ?>名</dd>
										</dl>
									</div>
								</div> <!-- end of .card -->
							</div>
						</div> <!-- end of .row -->

						<div class="row">
							<div class="col-12">
								<div class="card card-primary">
									<div class="card-body">
										<div class="table-responsive">
											<table id="tbl_webinar21004" class="table table-striped table-sm">
												<thead>
													<tr>
														<th data-column-id="col_proc" data-formatter="col_proc" data-sortable="false" data-width="110px">処理</th>
														<th data-column-id="regist_time" data-width="180px" data-order="desc">申込日時</th>
														<th data-column-id="juku_name">塾名</th>
														<th data-column-id="classroom" data-width="180px">教室名</th>
														<th data-column-id="participant" data-width="130px">参加者氏名</th>
														<th data-column-id="position" data-width="110px">役職</th>
														<th data-column-id="apply1" data-sortable="false" data-width="70px">9/16</th>
														<th data-column-id="apply2" data-sortable="false" data-width="70px">10/1</th>
														<th data-column-id="pref" data-width="110px">都道府県</th>
														<th data-column-id="tel" data-width="140px">電話番号</th>
														<th data-column-id="email" data-width="290px">メールアドレス</th>
													</tr>
												</thead>
											</table>
										</div>
									</div> <!-- end of .card-body -->
									<div class="card-footer text-right">
										<a href="<?= site_url('admin/webinar21004/dl_apply') ?>" class="btn btn-primary">申し込み状況のダウンロード</a>
									</div> <!-- end of .card-footer -->
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
	<script src="<?= base_url('js/admin/webinar21004.js')?>?var=<?= CACHES_CLEAR_VERSION ?>"></script>
</body>
</html>
