<?php $this->load->view('inc/admin/_head', array('TITLE' => 'アクセス状況確認 | ' . SITE_NAME)); ?>

<body>
	<div id="app">
		<div class="main-wrapper main-wrapper-1">
			<?php $this->load->view('inc/admin/header'); ?>
			<?php $this->load->view('inc/admin/sidebar', array('current' => 'analytics')); ?>

			<div class="main-content">
				<section class="section">
					<div class="section-header">
						<h1>アクセス状況確認</h1>
					</div>

					<div class="section-body">
						<div class="row">
							<div class="col-3">
								<div class="card card-primary">
									<div class="card-header">
										<h4>ページ表示回数</h4>
									</div> <!-- end of .card-header -->
									<div class="card-body">
										<table class="table table-sm">
											<tbody>
												<tr>
													<th>TOPページ</th>
													<td><?= number_format($TOP) ?>回</td>
												</tr>
												<tr>
													<th>申込ページ</th>
													<td><?= number_format($APPLY) ?>回</td>
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
													<th>DMのQRコード読込み</th>
													<td><?= number_format($DM) ?>回</td>
												</tr>
												<tr>
													<th>アドレス直接入力</th>
													<td><?= number_format($DIRECT) ?>回</td>
												</tr>
											</tbody>
										</table>
									</div> <!-- end of .card-body -->
								</div> <!-- end of .card -->
							</div>
						</div> <!-- end of .row -->

						<div class="row">
							<div class="col-2">
								<?php echo form_button(array(
									'name'		=> 'btn-back',
									'class'		=> 'btn btn-primary',
									'content'	=> '詳細をダウンロード',
									'onclick'	=> 'location.href=\'' . site_url('admin/analytics/dl') . '\''
								)); ?>
							</div>

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
													<li><span class="w-110">（空白）</span>：TOP</li>
													<li><span class="w-110">apply</span>：申込ページ</li>
													<li><span class="w-110">confirm</span>：確認ページ</li>
													<li><span class="w-110">complete</span>：申込完了ページ</li>
													<li><span class="w-110">reception</span>：受付票ページ</li>
													<li><span class="w-110">dl_exhibition</span>：受付票ダウンロード（PDF）</li>
												</ul>
											</dd>

											<dt>リンク元</dt>
											<dd>
												『参照ページ』がTOPページの時にだけデータが設定されることがあります。<br>
												どのページからアクセスされたかを表しています。<br>
												※『参照ページ』がTOPページで『リンク元』にデータが設定されていない場合、アドレスを直接入力された可能性が高いです。
												<ul>
													<li><span class="w-110">com</span>：コーポレートサイトのお知らせ</li>
													<li><span class="w-110">cojp</span>：co.jpサイトのイベント情報</li>
													<li><span class="w-110">netshop</span>：ネットショップのバナー</li>
													<li><span class="w-110">dm</span>：DMのQRコード読込み</li>
													<li><span class="w-110">apply_w21</span>：申込ページTOP</li>
													<li><span class="w-110">complete_w21</span>：申込完了ページ</li>
													<li><span class="w-110">reception_w21</span>：受付票ページ</li>
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
					</div> <!-- end of .section-body -->
				</section>
			</div> <!-- end of .main-content -->

			<?php $this->load->view('inc/admin/footer'); ?>
		</div> <!-- end of .main-wrapper -->
	</div> <!-- end of #app -->

	<?php $this->load->view('inc/admin/_foot'); ?>
</body>
</html>
