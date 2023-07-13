<?php require_once 'inc/ini_post-action.php'; ?>
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
			<section class="contact-section px-md-2 pt-5">
				<div class="container">
					<div class="row d-flex contact-info">
						<div class="col-md-12 mb-1">
							<h2 class="h3">Создание поста</h2>
						</div>

					</div>
					<div class="row block-9">
						<div class="col-lg-6 d-flex">

							<form method="POST" action="#" enctype="multipart/form-data" class="bg-light p-5 contact-form">
								<div class="form-group">
									<input type="text" value="<?php echo $post->title ? $post->title : ''?>" class="form-control <?php echo $post->validTitle ? 'is-invalid' : ''?>" placeholder="Post title" name="title">
									<?php echo $post->validTitle ? "<div style='color: red;'>$post->validTitle</div>" : ''?>
								</div>
								<div class="form-group">
									<input type="text" value="<?php echo $post->preview ? $post->preview : ''?>" class="form-control <?php echo $post->validPreview ? 'is-invalid' : ''?>" placeholder="Post preview" name="preview">
									<?php echo $post->validPreview ? "<div style='color: red;'>$post->validPreview</div>" : ''?>
								</div>
								<div class="form-group">
									<input type="file" name="image">
								</div>
								<div class="form-group">
									<textarea name="content" id="" cols="30" rows="10" class="form-control <?php echo $post->validContent ? 'is-invalid' : ''?>" 
									placeholder="Post content"><?php echo $post->content ? $post->changeToRn($post->content) : ''?></textarea> 
									<?php echo $post->validContent ? "<div style='color: red;'>$post->validContent</div>" : ''?>
								</div>
								<div class="form-group">
									<input type="submit" value="Создать пост" class="btn btn-primary py-3 px-5">
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