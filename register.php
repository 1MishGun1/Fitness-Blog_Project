<?php require_once 'inc/ini_register.php'; ?>
<!DOCTYPE html>
<html lang="en">
<title>Информационная система - .....</title>
<meta charset="utf-8">
<head>
	<?php echo file_get_contents('inc/header.html'); ?>
</head>

<body>
	<div id="colorlib-page">
	<?php echo $menu->createMenu(basename(__FILE__)); ?>
		<div id="colorlib-main">
			<section class="contact-section px-md-2 pt-5">
				<div class="container">
					<div class="row d-flex contact-info">
						<div class="col-md-12 mb-1">
							<h2 class="h3">Регистрация</h2>
						</div>

					</div>
					<div class="row block-9">
						<div class="col-lg-6 d-flex"> 
							<form method="POST" enctype="multipart/form-data" action="#" class="bg-light p-5 contact-form">
								<div class="form-group">
									<input type="text" class="form-control <?php echo $user->validName ? 'is-invalid' : ''?>" placeholder="Your Name" 
									value="<?php echo $user->name ? $user->name : '' ?>" name="name"> 
									<?php 
									echo $user->validName ? "<div style='color: red;'>$user->validName</div>" : '';
									?>
								</div>
								<div class="form-group">
									<input type="text" class="form-control <?php echo $user->validSurname ? 'is-invalid' : ''?>" placeholder="Your Surname"
									value="<?php echo $user->surname ? $user->surname : '' ?>" name="surname">
									<?php 
									echo $user->validSurname ? "<div style='color: red;'>$user->validSurname</div>" : '';
									?>
								</div>
								<div class="form-group">
									<input type="text" class="form-control" placeholder="Your Patronymic"
									value="<?php echo $user->patronymic ? $user->patronymic : '' ?>" name="patronymic">
								</div>
								<div class="form-group">
									<input type="text" class="form-control <?php echo $user->validLogin ? 'is-invalid' : ''?>" placeholder="Your Login"
									value="<?php echo $user->login ? $user->login : '' ?>" name="login">
									<?php 
									echo $user->validLogin ? "<div style='color: red;'>$user->validLogin</div>" : '';
									?>
								</div>
								<div class="form-group">
									<input type="email" class="form-control <?php echo $user->validEmail ? 'is-invalid' : ''?>" placeholder="Your Email"
									value="<?php echo $user->email ? $user->email : '' ?>" name="email">
									<?php 
									echo $user->validEmail ? "<div style='color: red;'>$user->validEmail</div>" : '';
									?>
				
								</div>
								<div class="form-group">
									<input type="password" class="form-control <?php echo $user->validPass ? 'is-invalid' : ''?>" placeholder="Password"
									name="password">  
									<?php 
									echo $user->validPass ? "<div style='color: red;'>$user->validPass</div>" : '';
									?>
								</div>
								<div class="form-group">
									<input type="password" class="form-control <?php echo $user->validPass_rep ? 'is-invalid' : ''?>" placeholder="Password repeat"
									name="password_repeat">
									<?php 
									echo $user->validPass_rep ? "<div style='color: red;'>$user->validPass_rep</div>" : '';
									?>
								</div>
								<div class="form-group">
									<input type="file" name="avatar">
								</div>
								<div class="form-group">
									<div class="form-check">
										<input class="form-check-input <?php echo $user->validRules ? 'is-invalid' : '' ?>" type="checkbox" value="check"
											id="rules" name="rules">
										<label style="<?php echo $user->validRules ? 'color: red;' : '' ?>">
											Rules
										</label>
										<?php 
											echo $user->validRules ? "<div style='color: red;'>$user->validRules</div>" : '';
										?>
									</div>
								</div>
								<div class="form-group">
									<input type="submit" value="Регистрация" class="btn btn-primary py-3 px-5">
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

	<script>
		$(document).ready(function(){
			$('#rules').click(function(e){
				$(this).toggleClass('is-invalid');
				$(this).toggleClass('is-valid');
				$('#rulesFeedback').toggleClass('d-none');				
			})
		})

	</script>

</body>

</html>