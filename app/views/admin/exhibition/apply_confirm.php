<?php $this->load->view('inc/admin/_head', array('TITLE' => '展示会管理 | ' . SITE_NAME)); ?>

<body>
	<div id="app">
		<div class="main-wrapper main-wrapper-1">
			<?php $this->load->view('inc/admin/header'); ?>
			<?php $this->load->view('inc/admin/sidebar', array('current' => 'exhibition')); ?>

			<div class="main-content">
				<section class="section">
					<div class="section-header">
						<h1>展示会管理 申し込み状況確認</h1>
					</div>

					<div class="section-body">
						<div class="row">
							<div class="col-12">
								<h4 class="d-inline-block mr-3"><?= $CONF['place_summer21'][$EDATA['place_summer21']] ?>会場</h4>
								<?= $EDATA['show_event_date'] ?>

								<?php foreach( $ADATA as $id => $detail_val ): ?>
									<?php
										$period = date('H:i', strtotime($detail_val['exhibition_time_start'])) . '&nbsp;～&nbsp;' . date('H:i', strtotime($detail_val['exhibition_time_end']));
									?>

									<div class="card card-primary" id="period_box_<?= $id ?>">
										<div class="card-header">
											<h4>
												<?= $period ?>
											</h4>

											<div class="card-header-action">
												<a data-collapse="#period_content_<?= $id ?>" class="btn btn-icon btn-info" href="#"><i class="fas fa-minus"></i></a>
												<a data-dismiss="#period_box_<?= $id ?>" class="btn btn-icon btn-danger" href="#"><i class="fas fa-times"></i></a>
											</div>
										</div>
										<div class="collapse show" id="period_content_<?= $id ?>">
											<div class="card-body">
												<div class="table-responsive">
													<?php if( empty($detail_val['apply']) ): ?>
														申込なし
													<?php else: ?>
														<table class="table table-striped table-sm">
															<thead>
																<tr>
																	<th>処理</th>
																	<th>塾名</th>
																	<th>来場人数</th>
																	<th>郵便番号</th>
																	<th>住所</th>
																	<th>電話番号</th>
																	<th>メールアドレス</th>
																	<th>申込日時</th>
																</tr>
															</thead>
															<tbody>
																<?php foreach( $detail_val['apply'] as $apply_id => $apply ): ?>
																	<tr>
																		<td>
																			<a href="javascript:void(0);" onclick="cancel_apply('<?= $apply_id ?>', '<?= $CONF['place_summer21'][$EDATA['place_summer21']] ?>会場', '<?= $period ?>', '<?= $apply['juku_name'] ?>');">
																				<i class="fas fa-ban"></i>&nbsp;キャンセル
																			</a>
																		</td>
																		<td><?= $apply['juku_name'] ?></td>
																		<td><?= $apply['guest_num'] ?>名</td>
																		<td><?= $apply['zip'] ?></td>
																		<td><?= $apply['address'] ?></td>
																		<td><?= $apply['tel'] ?></td>
																		<td><?= $apply['email'] ?></td>
																		<td><?= $apply['regist_time'] ?></td>
																	</tr>
																<?php endforeach; ?>
															</tbody>
														</table>
														申込者数合計：<?= $detail_val['reserved'] ?>名
													<?php endif; ?>
												</div>
											</div>
										</div> <!-- end of .collapse -->
									</div> <!-- end of .card -->
								<?php endforeach; ?>
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
									'onclick'	=> 'location.href=\'' . site_url('admin/exhibition/dl/' . $EID) . '\''
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
							時間帯
						</div>
						<div class="col-sm-8">
							<p id="period"></p>
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
	<script src="<?= base_url('js/admin/exhibition_ac.js')?>?var=<?= CACHES_CLEAR_VERSION ?>"></script>
</body>
</html>
