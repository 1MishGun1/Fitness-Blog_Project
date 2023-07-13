<?php require_once 'inc/ini_users.php' ?>
<!DOCTYPE html>
<html lang="en">
<title>Информационная система - .....</title>
<meta charset="utf-8">
<head>
	<?php echo file_get_contents('inc/header.html') ?>
</head>

<body>
	<div id="colorlib-page">
		<?php echo $menu->createMenu(basename(__FILE__)); ?>
		<div id="colorlib-main">
			<section class="contact-section px-md-4 pt-5">
				<div class="container">
					<div class="row block-9">
						<div class="col-lg-12">
							<div class="row">
								<div class="col-md-12 mb-1">
									<h3 class="h3">Пользователи</h3>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12 mb-1">
									<table class="table table-striped">
										<thead>
											<tr>
												<th scope="col">#</th>
												<th scope="col">Name</th>
												<th scope="col">Surname</th>
												<th scope="col">Login</th>

												<th scope="col">E-mail</th>
												<th scope="col">Temp block</th>
												<th scope="col">Permanent block</th>
											</tr>
										</thead>
										<tbody>
											<?php 
												if ($res = $user->getUserInfo()) {
													$echo = '';
													foreach ($res as $key => $val) {
														$date = isset($res[$key]['block_time']) ? $post->convertDate($res[$key]['block_time']) : "<b>BLOCKED</b>";
														echo "<tr>
															<th scope='row'>" . $res[$key]['user_id'] . "</th>
															<td>" . $res[$key]['name'] . "</td>
															<td>" . $res[$key]['surname'] . "</td>
															<td>" . $res[$key]['login'] . "</td>
															<td>" . $res[$key]['email'] . "</td>
															<td><a href='" . $responce->getLink('temp-block.php', ['user_id' => $res[$key]['user_id']]) .
																	 "' class='btn btn-outline-warning px-4' >⏳ Block</a>
															</td>
															<td>" . ($res[$key]['is_block'] == 0 ? "<a href=" . 
																	$responce->getLink('users.php', ['block' => $res[$key]['user_id']]) .
															 		" class='btn btn-outline-danger px-4'>📌 Block</a>" : "{$date}") .
															"</td>
														</tr>";
													}
												}
											?>

											
											<!-- <tr>
												<th scope="row">2</th>
												<td>Mark</td>
												<td>Otto</td>
												<td>dfg</td>
												<td>@mdo</td>
												<td>
													<a href="temp-block.html" class="btn btn-outline-warning px-4">⏳ Block</a>
												</td>
												<td>
													<a href="#" class="btn btn-outline-danger px-4">📌 Block</a>
												</td>
											</tr>
											<tr>
												<th scope="row">3</th>
												<td>Mark</td>
												<td>Otto</td>
												<td>dfg</td>
												<td>@mdo</td>
												<td>
													<a href="temp-block.html" class="btn btn-outline-warning px-4">⏳ Block</a>
												</td>
												<td>
													<a href="#" class="btn btn-outline-danger px-4">📌 Block</a>
												</td>
											</tr> -->

										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
		</div><!-- END COLORLIB-MAIN -->
	</div><!-- END COLORLIB-PAGE -->

	<!-- loader -->
	<?php echo file_get_contents('inc/loader.html') ?>

	<?php echo file_get_contents('inc/jsScripts.html') ?>
</body>

</html>