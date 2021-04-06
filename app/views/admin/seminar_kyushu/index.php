<?php $this->load->view('inc/admin/_head', array('TITLE' => '申込状況確認（九州） | ' . SITE_NAME)); ?>

<body>
	<div id="app">
		<div class="main-wrapper main-wrapper-1">
			<?php $this->load->view('inc/admin/header'); ?>
			<?php $this->load->view('inc/admin/sidebar', array('current' => 'kyushu')); ?>

			<div class="main-content">
				<section class="section">
					<div class="section-header">
						<h1>申込状況確認（九州）</h1>
					</div>

					<div class="section-body">
						<div class="row">
							<div class="col-12">
								<div class="card card-primary">
									<div class="card-body">
										<div class="table-responsive">
											<table id="tbl_seminar_kyushu" class="table table-striped table-sm">
												<thead>
													<tr>
														<th data-column-id="col_proc" data-formatter="col_proc" data-sortable="false" data-width="140px">処理</th>
														<th data-column-id="juku_name" data-width="150px">塾名</th>
														<th data-column-id="guest_num" data-width="90px">申込人数</th>
														<th data-column-id="zip" data-width="90px">郵便番号</th>
														<th data-column-id="address" data-width="200px">住所</th>
														<th data-column-id="tel" data-width="100px">電話番号</th>
														<th data-column-id="email" data-width="220px">メールアドレス</th>
														<th data-column-id="regist_time" data-width="160px">申込日時</th>
													</tr>
												</thead>
											</table>
										</div>
									</div>
								</div> <!-- end of .card -->
							</div>
						</div> <!-- end of .row -->

						<div class="row justify-content-center">
							<div class="col-12 text-center">
								<?php echo form_button(array(
									'name'		=> 'btn-back',
									'class'		=> 'btn btn-primary',
									'content'	=> 'ダウンロード',
									'onclick'	=> 'location.href=\'' . site_url('admin/seminar_kyushu/dl') . '\''
								)); ?>
							</div>
						</div> <!-- end of .row -->
					</div> <!-- end of .section-body -->
				</section>
			</div> <!-- end of .main-content -->

			<?php $this->load->view('inc/admin/footer'); ?>
		</div> <!-- end of .main-wrapper -->
	</div> <!-- end of #app -->

	<?php /* ダイアログ */ ?>
	<div class="modal" id="modal_seminar_kyushu" tabindex="-1" role="dialog" aria-labelledby="staticModalLabel" aria-hidden="true" data-show="true" data-keyboard="false">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
				<h4 class="modal-title">キャンセル</h4>
					<button type="button" class="close" data-dismiss="modal">
						<span aria-hidden="true">&#215;</span><span class="sr-only">閉じる</span>
					</button>
				</div><!-- /modal-header -->

				<div class="modal-body">
					<p id="juku_name"></p>
					本当にキャンセルしますか？
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
					<button type="button" class="btn btn-primary" onclick="do_submit();">実行</button>
				</div>
			</div> <!-- /.modal-content -->
		</div> <!-- /.modal-dialog -->
	</div> <!-- /.modal -->

	<?php $this->load->view('inc/admin/_foot'); ?>
	<script src="<?= base_url('js/admin/seminar_kyushu.js')?>?var=<?= CACHES_CLEAR_VERSION ?>"></script>
</body>
</html>
