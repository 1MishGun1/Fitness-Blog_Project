<?php require_once 'inc/ini_about.php'; ?>
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
      <section class="ftco-about img ftco-section ftco-no-pt ftco-no-pb" id="about-section">
        <div class="container-fluid px-0">
          <div class="row d-flex mt-5">
            <div class="col-md-6 d-flex align-items-center">
              <div class="text px-4 pt-5 pt-md-0 px-md-4 pr-md-5 ftco-animate">
                <!-- <h2 class="mb-4">This <span>Andrea Moore</span> a Scotish Blogger &amp; Explorer</h2>
                <p>A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a
                  paradisematic country, in which roasted parts of sentences fly into your mouth. It is a paradisematic
                  country, in which roasted parts of sentences fly into your mouth.</p> -->
                  <h2 class="mb-4">Блог-сайт<span> FitDzen</span></h2>
                  <p>На нашем сайте люди ведут собственные блоги, делятся опытом и знаниями с начинающими или продвинутыми в спорте людьми.
                    Также пользователи выкладывают посты на тематику фитнеса, пишут то что они думают о других публикациях, задают вопросы и 
                    отвечают на них.
                  </p>
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