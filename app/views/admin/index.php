<?php $this->load->view('inc/admin/_head', array('TITLE' => 'TOP | ' . SITE_NAME)); ?>

<body>
	<div id="app">
		<div class="main-wrapper main-wrapper-1">
			<?php $this->load->view('inc/admin/header'); ?>
			<?php $this->load->view('inc/admin/sidebar', array('current' => 'top')); ?>

			<div class="main-content">
				<section class="section">
					<div class="section-header">
						<h1>TOP</h1>
					</div>

					<div class="section-body">
						<div class="row">
							<div class="col-12">
								<div class="card card-primary">
									<div class="card-body">
										<div class="table-responsive">
											<table class="table table-striped table-sm">
												<thead>
													<tr>
														<th>機能</th>
														<th>説明</th>
													</tr>
												</thead>
												<tbody>
<?php /* ?>
													<tr>
														<td><a href="<?= site_url('admin/seminar') ?>"><i class="fas fa-chalkboard-teacher"></i>&nbsp;セミナー管理</a></td>
														<td>
															セミナーの登録、修正、削除が行えます。<br>
															また、セミナーの申し込み状況の確認も行えます。
														</td>
													</tr>

													<tr>
														<td><a href="<?= site_url('admin/exhibition') ?>"><i class="fas fa-book-reader"></i>&nbsp;展示会管理</a></td>
														<td>
															展示会の登録、修正、削除が行えます。<br>
															また、展示会の申し込み状況の確認も行えます。
														</td>
													</tr>

													<tr>
														<td><a href="<?= site_url('admin/seminar_kyushu') ?>"><i class="fas fa-list-ol"></i>&nbsp;申込状況確認（九州）</a></td>
														<td>
															セミナーの申し込み状況の確認が行えます。<br>
															<span class="text-danger">※九州専用</span>
														</td>
													</tr>
<?php */ ?>

													<tr>
														<td><a href="<?= site_url('admin/webinar21004') ?>"><i class="fas fa-list-ol"></i>&nbsp;申込確認（安河内先生）</a></td>
														<td>
															2021年9月・10月に行われる安河内先生のオンラインセミナーへの申し込み状況の確認が行えます。<br>
															また、申し込み状況のダウンロードも行えます。
														</td>
													</tr>

													<tr>
														<td><a href="<?= site_url('admin/winter21') ?>"><i class="fas fa-list-ol"></i>&nbsp;申込確認（21冬期）</a></td>
														<td>
															2021年冬期展示会への申し込み状況の確認が行えます。<br>
															また、申し込み状況のダウンロードも行えます。
														</td>
													</tr>

													<tr>
														<td><a href="<?= site_url('admin/manage') ?>"><i class="fas fa-user-tie"></i>&nbsp;管理者管理</a></td>
														<td>
															管理者の登録、修正、削除が行えます。
														</td>
													</tr>

													<tr>
														<td><a href="<?= site_url('admin/analytics') ?>"><i class="far fa-chart-bar"></i>&nbsp;アクセス状況（21冬期）</a></td>
														<td>
															サイトのアクセス状況の確認が行えます。
														</td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
								</div> <!-- end of .card -->
							</div>
						</div> <!-- end of .row -->
					</div> <!-- end of .section-body -->
				</section>
			</div>

			<?php $this->load->view('inc/admin/footer'); ?>
		</div> <!-- end of .main-wrapper -->
	</div> <!-- end of #app -->

	<?php $this->load->view('inc/admin/_foot'); ?>
</body>
</html>
