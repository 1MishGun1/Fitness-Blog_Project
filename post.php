<?php require_once 'inc/ini_post.php'; ?>
<!DOCTYPE html>
<html lang="en">
<title>Информационная система - .....</title>
<meta charset="utf-8">
<head>
	<?php echo file_get_contents('inc/header.html'); ?>
</head>

<body>
	<div id="colorlib-page">
		<a href="#" class="js-colorlib-nav-toggle colorlib-nav-toggle"><i></i></a>
		<?php echo $menu->createMenu(basename(__FILE__)) ?> 
		<div id="colorlib-main">
			<section class="ftco-no-pt ftco-no-pb">
				<div class="container">
					<div class="row">
						<div class="col-lg-12 px-md-3 py-5">
							<div class="post">
								<h1 class="mb-3"><?php echo $post->title ?></h1>
								<div class="meta-wrap">
									<p class="meta">
										<!-- <img src='avatar.jpg' /> -->
										<span class="text text-3"><?php echo $post->getLogin($post->users_id_user) ?></span>
										<span><i class="icon-calendar mr-2"></i><?php echo $post->convertDate($post->create_at) . (" (обновлен: " . $post->convertDate($post->update_at) . ")")?></span>
										<span><i class="icon-comment2 mr-2"></i><?php echo $post->commentCount ?></span>
									</p>
								</div>
								<p>
									<?php echo $post->content;?>
								</p>
								<?php echo isset($post->image) ? "<p><img src='$post->image' width='1000px' class='img-fluid'></p>" : '' ?>
								<div>
								<?php 
									if ($user->user_id == $post->users_id_user) {
										echo "<a href=" . $responce->getLink('post-action.php', ['post' => $post->post_id]) . 
										"class='text-warning' style='font-size: 1.8em;' title='Редактировать'>🖍</a>";
									} 
									if ($user->isAdmin || ($user->user_id == $post->users_id_user && $post->commentCount == 0)) {
										echo "<a href='" . $responce->getLink('post.php', ['post' => $post->post_id, 'delete' => 'true']) . "' class='text-danger' style='font-size: 1.8em;' title='Удалить'>🗑</a>";
									}
								?>
								</div>

							</div>
							<div class="comments pt-5 mt-5">
								<h3 class="mb-5 font-weight-bold"><?php echo "Комментариев: " . $post->commentCount ?></h3>
								<ul class="comment-list">
								
									<?php 
										echo createCommentsList($comment);
									?>


								</ul>
								<!-- END comment-list -->
								<?php
								if ($user->user_id !== $post->users_id_user && !$user->isAdmin && !$user->isGuest) {
									$text = "<div class='comment-form-wrap pt-5'>
									<h3 class='mb-5'>Оставьте комментарий</h3>
										<form method='POST' action='#' class='p-3 p-md-5 bg-light'>
											<div class='form-group'>
												<label for='message'>Сообщение</label>
												<textarea name='message' id='message' cols='30' rows='10'
													class='form-control'></textarea>" .
												($comment->validateComment ? "<div style='color: red;'>$comment->validateComment</div>" : '') .
											"</div>
											<div class='form-group'>
												<input type='submit' value='Отправить' name='send_comment'
												class='btn py-3 px-4 btn-primary'>
											</div>
										</form>
									</div>";
									echo $text;
								}
								?>
							</div>
						</div>
					</div><!-- END-->
				</div>
			</section>
		</div><!-- END COLORLIB-MAIN -->
	</div><!-- END COLORLIB-PAGE -->

	<!-- loader -->
	<?php echo file_get_contents('inc/loader.html') ?>

	<?php echo file_get_contents('inc/jsScripts.html') ?>
</body>

</html>