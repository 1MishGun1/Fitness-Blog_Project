<?php require_once 'inc/ini_temp-block.php' ?>
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
			<section class="contact-section px-md-2  pt-5">
				<div class="container">
					<div class="row d-flex contact-info">
						<div class="col-md-12 mb-1">
							<h2 class="h3">Временная блокировка пользователя</h2>
							<div>
								Пользователь: <?php echo $user->getLogin($_GET['user_id'])?>
							</div>
						</div>
					</div>
					<div class="row block-9">
						<div class="col-lg-6 d-flex">
							<form method="POST" action="#" class="bg-light p-5 contact-form">
								<div class="form-group">
									<label for="date-block">Дата временной блокировки</label>
									<input type="text" class="form-control" id="date-block" name="date_block" value=""
										required>
								</div>
								<div class="form-group">
									<input type="submit" value="Блокировать" class="btn btn-primary py-3 px-5">
								</div>
							</form>
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