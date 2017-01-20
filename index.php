<!DOCTYPE html>
<?php
	session_start();
	require_once  'controller/changeLanguage.php';
	require_once  'controller/sendEmail.php';
?>
<html lang="es">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Web Progress</title>
<meta name="description" content="">
<meta name="author" content="">

<!-- Bootstrap -->
<link rel="stylesheet" type="text/css"  href="css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="fonts/font-awesome/css/font-awesome.css">

<!-- Stylesheet
    ================================================== -->
<link rel="stylesheet" type="text/css"  href="css/style.css">
<link rel="stylesheet" type="text/css" href="css/prettyPhoto.css">
<link href='http://fonts.googleapis.com/css?family=Lato:400,700,900,300' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800,600,300' rel='stylesheet' type='text/css'>

</head>
<body>
<!-- Navigation
    ==========================================-->
<nav id="menu" class="navbar navbar-default navbar-fixed-top">
  <div class="container"> 
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
      <a class="navbar-brand" href="#home">Web Progress</a> </div>
      
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#home" class="page-scroll"><?php echo $inicio ?></a></li>
        <li><a href="#about-section" class="page-scroll"><?php echo $conoceme ?></a></li>
        <li><a href="#services-section" class="page-scroll"><?php echo $servicios ?></a></li>
        <li><a href="#works-section" class="page-scroll"><?php echo $portafolio ?></a></li>
        <li><a href="#team-section" class="page-scroll"><?php echo $equipo ?></a></li>
        <li><a href="#contact-section" class="page-scroll"><?php echo $contactanos ?></a></li>
        <li>
        	<form action="" method="post" accept-charset="utf-8">
				<input type="hidden" name="language" value="<?php if($lang=='en')  { ?>es<?php } else { ?>en<?php } ?>" id="language"/>
				<button id="buttonChangeLanguage" class="buttonChangeLanguage" type="submit"><?php if($lang=='en')  { ?> <p class="nameChangeLanguage">En</p><?php } else { ?> <p class="nameChangeLanguage" >Es</p><?php } ?> <i class="fa fa-caret-down caret_down" aria-hidden="true"></i></button>
			</form>
        </li>	
      </ul>
    </div>
  </div>
</nav>

<!-- Header -->
<header class="text-center" name="home">
  <div class="intro-text">
    <h1><?php echo $titulo ?><span class="color"> Web Progress</span></h1>
    <p><?php echo $subTitulo ?></p>
    <div class="clearfix"></div>
    <a href="#about-section" class="btn btn-default btn-lg page-scroll"><?php echo $link ?></a> </div>
</header>
<!-- About Section -->
<div id="about-section">
  <div class="container">
    <div class="section-title">
      <h2><?php echo $conoceme ?></h2>
      <hr>
    </div>
    <div class="space"></div>
    <div class="row">
      <div class="col-md-4">
        <h4><?php echo $quienesSomos ?></h4>
        <p><?php echo $parrafoUno ?></p>
      </div>
      <div class="col-md-4">
        <h4><?php echo $quéHacemos ?></h4>
        <p><?php echo $parrafoDos ?></p>
      </div>
      <div class="col-md-4">
        <h4><?php echo $porqueElegirnos ?></h4>
        <p><?php echo $parrafoTres ?></p>
      </div>
    </div>
  </div>
</div>
<!-- Services Section -->
<div id="services-section">
  <div class="container">
    <div class="section-title">
      <h2><?php echo $nuestrosServicios ?></h2>
      <hr>
    </div>
    <div class="space"></div>
    <div class="row">
      <div class="col-md-3 col-sm-6 service">
      	<img style="display: block" src="img/iconos/website-design-symbol.png" />
        <h4><?php echo $diseñoWeb ?></h4>
        <p class="text_services"><?php echo $bloqueUno ?></p>
      </div>
      <div class="col-md-3 col-sm-6 service">
      	<img style="display: block" src="img/iconos/data.png" />
        <h4><?php echo $desarolloAplicaciones ?></h4>
        <p class="text_services"><?php echo $bloqueDos ?></p>
      </div>
      <div class="col-md-3 col-sm-6 service">
      	<img style="display: block" src="img/iconos/responsive-design-symbol.png" />
        <h4><?php echo $responsive ?></h4>
        <p class="text_services"><?php echo $bloqueTres ?></p>
      </div>
      <div class="col-md-3 col-sm-6 service">
      	<img style="display: block" src="img/iconos/smartphone-call.png" />
        <h4><?php echo $aplicacionMobile ?></h4>
        <p class="text_services"><?php echo $bloqueCuatro ?></p>
      </div>
    </div>
    <div class="space"></div>
    <div class="row">
      <div class="col-md-3 col-sm-6 service">
      	<img style="display: block" src="img/iconos/business-comunication.png" />
        <h4><?php echo $comunityManager ?></h4>
        <p class="text_services"><?php echo $bloqueCinco ?></p>
      </div>
      <div class="col-md-3 col-sm-6 service">
      	<img style="display: block" src="img/iconos/classroom.png" />
        <h4><?php echo $asesorias ?></h4>
        <p class="text_services"><?php echo $bloqueSeis ?></p>
      </div>
      <div class="col-md-3 col-sm-6 service">
      	<img style="display: block" src="img/iconos/test.png" />
        <h4><?php echo $testing ?></h4>
        <p class="text_services"><?php echo $bloqueSiete ?></p>
      </div>
      <div class="col-md-3 col-sm-6 service">
      	<img style="display: block" src="img/iconos/photo-camera.png" />
        <h4><?php echo $fotografia ?></h4>
        <p class="text_services"><?php echo $bloqueOcho ?></p>
      </div>
    </div>
  </div>
</div>
<!-- Portfolio Section -->
<div id="works-section">
  <div class="container">
    <div class="section-title">
      <h2><?php echo $nuestroPortafolio ?></h2>
      <hr>
      <div class="clearfix"></div>
    </div>
    <div class="categories">
      <ul class="cat">
        <li>
          <ol class="type">
            <li><a href="#" data-filter="*" class="active"><?php echo $pestañaUno ?></a></li>
            <li><a href="#" data-filter=".web"><?php echo $pestañaDos ?></a></li>
            <li><a href="#" data-filter=".Applications"><?php echo $pestañaTres ?></a></li>
            <li><a href="#" data-filter=".mobile"><?php echo $pestañaCuatro ?></a></li>
          </ol>
        </li>
      </ul>
      <div class="clearfix"></div>
    </div>
    <div class="row">
      <div class="portfolio-items">
        <div class="col-sm-6 col-md-3 col-lg-3 web">
          <div class="portfolio-item">
            <div class="hover-bg"> <a href="http://alexfernandez.tk" target="_blank" rel="prettyPhoto">
              <div class="hover-text">
                <h4>Alex Fernandez</h4>
                <small><?php echo $pestañaDos ?></small>
                <div class="clearfix"></div>
              </div>
              <img src="img/portfolio/alex.png" class="img-responsive" alt="alexfernandez.tk"> </a> </div>
          </div>
        </div>
        <div class="col-sm-6 col-md-3 col-lg-3 web">
          <div class="portfolio-item">
            <div class="hover-bg"> <a href="http://edgarbalbas.tk/blog/" target="_blank" rel="prettyPhoto">
              <div class="hover-text">
                <h4>Blog Edgar Balbas</h4>
                <small><?php echo $pestañaDos ?></small>
                <div class="clearfix"></div>
              </div>
              <img src="img/portfolio/blogbalbas.png" class="img-responsive" alt="Blog Edgar Balbas"> </a> </div>
          </div>
        </div>
        <div class="col-sm-6 col-md-3 col-lg-3 web">
          <div class="portfolio-item">
            <div class="hover-bg"> <a href="http://poporoink.com.ve" target="_blank" rel="prettyPhoto">
              <div class="hover-text">
                <h4>Poporo Ink</h4>
                <small><?php echo $pestañaDos ?></small>
                <div class="clearfix"></div>
              </div>
              <img src="img/portfolio/poporoink.png" class="img-responsive" alt="Poporo Ink"> </a> </div>
          </div>
        </div>
        <div class="col-sm-6 col-md-3 col-lg-3 mobile">
          <div class="portfolio-item">
            <div class="hover-bg"> <a href="http://biz.totalhbl.com/app" target="_blank" rel="prettyPhoto">
              <div class="hover-text">
                <h4>App Herbalife</h4>
                <small><?php echo $pestañaCuatro ?></small>
                <div class="clearfix"></div>
              </div>
              <img src="img/portfolio/recorteApp.png" class="img-responsive" alt="App Herbalife"> </a> </div>
          </div>
        </div>
        <div class="col-sm-6 col-md-3 col-lg-3 Applications">
          <div class="portfolio-item">
            <div class="hover-bg"> <a  href="http://biz.totalhbl.com" target="_blank" rel="prettyPhoto">
              <div class="hover-text">
                <h4>SYSLIFE</h4>
                <small><?php echo $pestañaTres ?></small>
                <div class="clearfix"></div>
              </div>
              <img src="img/portfolio/SYSLIFE.png" class="img-responsive" alt="SYSLIFE"> </a> </div>
          </div>
        </div>
        <div class="col-sm-6 col-md-3 col-lg-3 mobile">
          <div class="portfolio-item">
            <div class="hover-bg"> <a href="http://alex.totalhbl.com" target="_blank"  rel="prettyPhoto">
              <div class="hover-text">
                <h4>Tarjeta Virtual</h4>
                <small><?php echo $pestañaTres ?></small>
                <div class="clearfix"></div>
              </div>
              <img src="img/portfolio/tarjeta_alex.png" class="img-responsive" alt="Tarjeta Virtual"> </a> </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Team Section -->
<div id="team-section">
  <div class="container">
    <div class="section-title">
      <h2><?php echo $conoceEquipo ?></h2>
      <hr>
    </div>
    <div id="row" style="display: block; text-align: -webkit-center">
      <div class="col-md-3 col-sm-6 team">
        <div class="thumbnail"> <img src="img/team/miguel.png" alt="..." class="team-img">
          <div class="caption">
            <h3>Miguel Mosquera</h3>
            <p><?php echo $desarrollador ?></p>
          </div>
        </div>
      </div>
      <div class="col-md-3 col-sm-6 team">
        <div class="thumbnail"> <img src="img/team/oba.jpg" alt="..." class="team-img">
          <div class="caption">
            <h3>Oswaldo Teran</h3>
            <p><?php echo $desarrollador ?></p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Contact Section -->
<div id="contact-section">
  <div class="container">
    <div class="section-title center">
      <h2><?php echo $contactanos ?></h2>
      <hr>
    </div>
    <div class="col-md-4">
      <h4><?php echo $datosDeContacto ?></h4>
      <div class="space"></div>
      <p><i class="fa fa-map-marker"></i>Venezuela</p>
      <div class="space"></div>
      <p><i class="fa fa-envelope-o"></i>administrator@webprogress.com.ve</p>
      <div class="space"></div>
      <p><i class="fa fa-phone"></i>+58 04245595806</p>
    </div>
    <div class="col-md-8">
      <h4><?php echo $dejanosUnMensaje ?></h4>
      <form action="" method="post" accept-charset="utf-8">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <input type="text" id="name" name="name" class="form-control" placeholder=<?php echo $nombre ?> required="required">
              <p class="help-block text-danger"></p>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <input type="email" id="email" name="email" class="form-control" placeholder="Email" required="required">
              <p class="help-block text-danger"></p>
            </div>
          </div>
        </div>
        <div class="form-group">
          <textarea name="message" id="message" class="form-control" rows="4" placeholder=<?php echo $mensaje ?> required></textarea>
          <p class="help-block text-danger"></p>
        </div>
        <p class="help-block text-danger"><?php echo $msjSendEmail ?></p>
        <div id="success"></div>
        <button type="submit" id="sendEmail" name="sendEmail" class="btn btn-default"><?php echo $enviarMensaje ?></button>
      </form>
    </div>
  </div>
</div>
<!--<div id="social-section">
  <div class="container">
    <div class="social">
      <ul>
        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
        <li><a href="#"><i class="fa fa-github"></i></a></li>
        <li><a href="#"><i class="fa fa-instagram"></i></a></li>
      </ul>
    </div>
  </div>
</div>-->
<div id="footer">
  <div class="container">
    <p>Copyright &copy; WebProgress</p>
  </div>
</div>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> 
<script type="text/javascript" src="js/jquery.1.11.1.js"></script> 
<script type="text/javascript" src="js/bootstrap.js"></script> 
<script type="text/javascript" src="js/SmoothScroll.js"></script> 
<script type="text/javascript" src="js/jquery.prettyPhoto.js"></script> 
<script type="text/javascript" src="js/jquery.isotope.js"></script> 
<script type="text/javascript" src="js/jqBootstrapValidation.js"></script> 

<!-- Javascripts
    ================================================== --> 
<script type="text/javascript" src="js/main.js"></script>
</body>
</html>