<?php require_once 'inc/ini_index.php'; ?>
<!DOCTYPE html>
<html lang="en">
<title>Информационная система - .....</title>
<meta charset="utf-8">
<head>
	<?php echo file_get_contents('inc/header.html'); ?>
</head>

<body>
	<div id="colorlib-page">
		<?php echo $menu->createMenu(basename(__FILE__)) ?>
		<div id="colorlib-main">
			<section class="ftco-no-pt ftco-no-pb">
				<div class="container">
					<div class="row d-flex">
						<div class="col-xl-8 py-5 px-md-2">
							<div class="row pt-md-4">
										<?php 
										if ($posts = $post->get10LastPosts()) {
											foreach ($posts as $key => $value) {
												$show = "<div class='col-md-12'>
													<div class='blog-entry ftco-animate d-md-flex'>
														<div class='text text-2 pl-md-4'>
															<h3 class='mb-2'><a>" .
															$posts[$key]['title']  . "</a></h3>
															<div class='meta-wrap'>
																<p class='meta'>
																	<span class='text text-3'>" . $post->getLogin($posts[$key]['users_id_user']) . "</span>
																	<span><i class='icon-calendar mr-2'></i>" . $posts[$key]['create_at'] . "</span>
																	<span><i class='icon-comment2 mr-2'></i>" . $posts[$key]['countPost'] . " Comment</span>
																</p>
															</div>
															<p class='mb-4'>" . $posts[$key]['preview'] . "</p>
															<p><a href='" . $responce->getLink('post.php?',['post' => $posts[$key]['post_id']]) .
															 "' class='btn-custom'>Подробнее... 
															<span class='ion-ios-arrow-forward'></span></a></p>
														</div>
													</div>
												</div>";
												echo $show;
											}
										}
										?>
							</div><!-- END-->

							<!-- 
								pagination
								<div class="row">
								<div class="col">
									<div class="block-27">
										<ul>
											<li><a href="#">&lt;</a></li>
											<li class="active"><span>1</span></li>
											<li><a href="#">2</a></li>
											<li><a href="#">3</a></li>
											<li><a href="#">4</a></li>
											<li><a href="#">5</a></li>
											<li><a href="#">&gt;</a></li>
										</ul>
									</div>
								</div>
							</div> -->

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