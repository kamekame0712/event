<?php $this->load->view('inc/admin/_head', array('TITLE' => 'アクセス状況確認 | ' . SITE_NAME)); ?>

<body>
	<div id="app">
		<div class="main-wrapper main-wrapper-1">
			<?php $this->load->view('inc/admin/header'); ?>
			<?php $this->load->view('inc/admin/sidebar', array('current' => 'analytics')); ?>

			<div class="main-content">
				<section class="section">
					<div class="section-header">
						<h1>アクセス状況確認</h1>（2021/04/21 17時以降）
					</div>

					<div class="section-body">
						<div class="row">
							<div class="col-3">
								<div class="card card-primary">
									<div class="card-header">
										<h4>TOPページ表示回数</h4>
									</div> <!-- end of .card-header -->
									<div class="card-body">
										<table class="table table-sm">
											<tbody>
												<tr>
													<th>中四国</th>
													<td><?= number_format($TOP_C) ?>回</td>
												</tr>
												<tr>
													<th>九州</th>
													<td><?= number_format($TOP_Q) ?>回</td>
												</tr>
											</tbody>
										</table>
									</div> <!-- end of .card-body -->
								</div> <!-- end of .card -->
							</div>

							<div class="col-3">
								<div class="card card-primary">
									<div class="card-header">
										<h4>申込ページ表示回数</h4>
									</div> <!-- end of .card-header -->
									<div class="card-body">
										<table class="table table-sm">
											<tbody>
												<tr>
													<th>中四国</th>
													<td><?= number_format($APPLY_C) ?>回</td>
												</tr>
												<tr>
													<th>九州</th>
													<td><?= number_format($APPLY_Q) ?>回</td>
												</tr>
											</tbody>
										</table>
									</div> <!-- end of .card-body -->
								</div> <!-- end of .card -->
							</div>

							<div class="col-4">
								<div class="card card-primary">
									<div class="card-header">
										<h4>リンク元</h4>
									</div> <!-- end of .card-header -->
									<div class="card-body">
										<table class="table table-sm">
											<tbody>
												<tr>
													<th>コーポレートサイトのお知らせ</th>
													<td><?= number_format($COM) ?>回</td>
												</tr>
												<tr>
													<th>co.jpサイトのイベント情報</th>
													<td><?= number_format($COJP) ?>回</td>
												</tr>
												<tr>
													<th>ネットショップのバナー</th>
													<td><?= number_format($SHOP) ?>回</td>
												</tr>
												<tr>
													<th>アドレス直接入力または、QRコード読込み</th>
													<td><?= number_format($DIRECT) ?>回</td>
												</tr>
											</tbody>
										</table>
									</div> <!-- end of .card-body -->
								</div> <!-- end of .card -->
							</div>
						</div> <!-- end of .row -->

						<div class="row">
							<div class="col-10">
								<div class="container-fluid">
									<div class="row justify-content-center">
										<div class="col-12 text-center">
											<?php echo form_button(array(
												'name'		=> 'btn-back',
												'class'		=> 'btn btn-primary',
												'content'	=> '詳細をダウンロード',
												'onclick'	=> 'location.href=\'' . site_url('admin/analytics/dl') . '\''
											)); ?>
										</div>
									</div> <!-- end of .row -->

									<div class="row justify-content-center mt-3">
										<div class="col-10">
											<div class="card card-warning">
												<div class="card-header">
													<h4>ダウンロードデータについて</h4>
												</div> <!-- end of .card-header -->
												<div class="card-body">
													<dl class="aboud-dl-data">
														<dt>参照ページ</dt>
														<dd>
															実際に表示されたページです。
															<ul>
																<li><span class="w-210">chushikoku</span>：中四国TOP</li>
																<li><span class="w-210">kyushu</span>：九州TOP</li>
																<li><span class="w-210">apply_exhibition/chushikoku</span>：展示会申込ページ</li>
																<li><span class="w-210">confirm_exhibition</span>：展示会申込確認ページ</li>
																<li><span class="w-210">complete_exhibition</span>：展示会申込完了ページ</li>
																<li><span class="w-210">exhibition_reception</span>：展示会受付票ページ</li>
																<li><span class="w-210">dl_exhibition</span>：展示会受付票ダウンロード（PDF）</li>
																<li><span class="w-210">apply_seminar/kyushu</span>：セミナー申込ページ</li>
																<li><span class="w-210">confirm_seminar_kyushu</span>：セミナー申込確認ページ</li>
																<li><span class="w-210">complete_seminar_kyushu</span>：セミナー申込完了ページ</li>
																<li><span class="w-210">seminar_reception</span>：セミナー受付票ページ</li>
																<li><span class="w-210">dl_seminar</span>：セミナー受付票ダウンロード（PDF）</li>
															</ul>
														</dd>

														<dt>リンク元</dt>
														<dd>
															『参照ページ』が各オフィスTOPページの時にだけデータが設定されることがあります。<br>
															どのページからアクセスされたかを表しています。<br>
															※『参照ページ』が各オフィスTOPページで『リンク元』にデータが設定されていない場合、<br>
															　アドレスを直接入力されたか、QRコードを読み込んでアクセスされた可能性が高いです。
															<ul>
																<li><span class="w-60">com</span>：コーポレートサイトのお知らせ</li>
																<li><span class="w-60">cojp</span>：co.jpサイトのイベント情報</li>
																<li><span class="w-60">netshop</span>：ネットショップのバナー</li>
																<li><span class="w-145">apply_exhibition</span>：展示会申込ページ</li>
																<li><span class="w-145">exhibition_complete</span>：展示会申込完了ページ</li>
																<li><span class="w-145">exhibition_reception</span>：展示会受付票ページ</li>
																<li><span class="w-145">apply_seminar</span>：セミナー申込ページ</li>
																<li><span class="w-145">seminar_complete</span>：セミナー申込完了ページ</li>
																<li><span class="w-145">seminar_reception</span>：セミナー受付票ページ</li>
															</ul>
														</dd>

														<dt>IPアドレス</dt>
														<dd>アクセスした方のIPアドレスです。</dd>

														<dt>ユーザーエージェント</dt>
														<dd>アクセスしたブラウザのユーザーエージェントです。</dd>

														<dt>アクセス時間</dt>
														<dd>アクセスされた時間です。</dd>
													</dl>
												</div> <!-- end of .card-body -->
											</div> <!-- end of .card -->
										</div>
									</div> <!-- end of .row -->
								</div> <!-- end of .container-fluid -->
							</div>
						</div> <!-- end of .row -->

					</div> <!-- end of .section-body -->
				</section>
			</div> <!-- end of .main-content -->

			<?php $this->load->view('inc/admin/footer'); ?>
		</div> <!-- end of .main-wrapper -->
	</div> <!-- end of #app -->

	<?php $this->load->view('inc/admin/_foot'); ?>
</body>
</html>
