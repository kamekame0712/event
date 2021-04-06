<?php $this->load->view('inc/admin/_head', array('TITLE' => 'セミナー管理 | ' . SITE_NAME)); ?>

<body>
	<div id="app">
		<div class="main-wrapper main-wrapper-1">
			<?php $this->load->view('inc/admin/header'); ?>
			<?php $this->load->view('inc/admin/sidebar', array('current' => 'seminar')); ?>

			<div class="main-content">
				<section class="section">
					<div class="section-header">
						<h1>セミナー管理 申し込み状況確認</h1>
					</div>

					<div class="section-body">
						<div class="row">
							<div class="col-12">
								<h4 class="d-inline-block mr-3"><?= $CONF['place_summer21'][$SDATA['place_summer21']] ?>会場</h4>
								<?= $SDATA['show_event_date'] ?>

								<div class="card card-primary">
									<div class="card-body">
										<div class="table-responsive">
											<?php if( empty($ADATA) ): ?>
												申込なし
											<?php else: ?>
												<table class="table table-striped table-sm">
													<thead>
														<tr>
															<th>処理</th>
															<th>塾名</th>
															<th>参加者名１</th>
															<th>参加者名２</th>
															<th>郵便番号</th>
															<th>住所</th>
															<th>電話番号</th>
															<th>メールアドレス</th>
															<th>展示会</th>
															<th>申込日時</th>
														</tr>
													</thead>
													<tbody>
														<?php foreach( $ADATA as $apply ): ?>
															<tr>
																<td>
																	<a href="javascript:void(0);" onclick="cancel_apply('<?= $apply['apply_seminar_summer21_id'] ?>', '<?= $CONF['place_summer21'][$SDATA['place_summer21']] ?>会場', '<?= $apply['juku_name'] ?>');">
																		<i class="fas fa-ban"></i>&nbsp;キャンセル
																	</a>
																</td>
																<td><?= $apply['juku_name'] ?></td>
																<td><?= $apply['guest_name1'] ?></td>
																<td><?= $apply['guest_name2'] ?></td>
																<td><?= $apply['zip'] ?></td>
																<td><?= $apply['address'] ?></td>
																<td><?= $apply['tel'] ?></td>
																<td><?= $apply['email'] ?></td>
																<td><?= $apply['attend_exhibition'] == '1' ? '参加' : '不参加' ?></td>
																<td><?= $apply['regist_time'] ?></td>
															</tr>
														<?php endforeach; ?>
													</tbody>
												</table>
												申込者数合計：<?= $SDATA['reserved'] ?>名
											<?php endif; ?>
										</div>
									</div>
								</div> <!-- end of .card -->
							</div>
						</div> <!-- end of .row -->

						<div class="row justify-content-center">
							<div class="col-6 text-right">
								<?php echo form_button(array(
									'name'		=> 'btn-back',
									'class'		=> 'btn btn-secondary',
									'content'	=> '戻る',
									'onclick'	=> 'history.back();'
								)); ?>
							</div>

							<div class="col-6">
								<?php echo form_button(array(
									'name'		=> 'btn-back',
									'class'		=> 'btn btn-primary',
									'content'	=> 'ダウンロード',
									'onclick'	=> 'location.href=\'' . site_url('admin/seminar/dl/' . $SID) . '\''
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
	<div class="modal" id="modal_apply" tabindex="-1" role="dialog" aria-labelledby="staticModalLabel" aria-hidden="true" data-show="true" data-keyboard="false">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">キャンセル</h4>
					<button type="button" class="close" data-dismiss="modal">
						<span aria-hidden="true">&#215;</span><span class="sr-only">閉じる</span>
					</button>
				</div><!-- /modal-header -->

				<div class="modal-body">
					<div class="row">
						<div class="col-sm-4">
							会場
						</div>
						<div class="col-sm-8">
							<p id="place"></p>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-4">
							塾名
						</div>
						<div class="col-sm-8">
							<?php echo form_input(array(
								'name'		=> 'juku_name',
								'id'		=> 'juku_name',
								'value'		=> ''
							)); ?>
						</div>
					</div>
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
					<button type="button" class="btn btn-primary" onclick="do_submit();">実行</button>
				</div>
			</div> <!-- /.modal-content -->
		</div> <!-- /.modal-dialog -->
	</div> <!-- /.modal -->

	<?php $this->load->view('inc/admin/_foot'); ?>
	<script src="<?= base_url('js/admin/seminar_ac.js')?>?var=<?= CACHES_CLEAR_VERSION ?>"></script>
</body>
</html>
