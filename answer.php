<?php require_once 'inc/ini_answer.php'; ?>
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
								<div class='comment-form-wrap pt-5'>
								<h3 class='mb-5'>Напишите ответ</h3>
									<form method='POST' action='#' class='p-3 p-md-5 bg-light'>
										<div class='form-group'>
											<label for='message'>Сообщение</label>
											<textarea name='message' id='message' cols='30' rows='10'
												class='form-control'></textarea>
											<?php 
                                            echo $comment->validateComment ? "<div style='color: red;'>$comment->validateComment</div>" : '';
                                            ?>
                                        </div>
										<div class='form-group'>
										    <input type='submit' value='Отправить' name='send_comment' class='btn py-3 px-4 btn-primary'>
										</div>
									</form>
								</div>
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