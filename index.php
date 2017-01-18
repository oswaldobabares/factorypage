<!DOCTYPE html>
<?php
	session_start();
	require_once  'controller/changeLanguage.php';
	require_once  'controller/sendEmail.php';
?>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Web Progress</title>
<meta name="description" content="">
<meta name="author" content="">

<!-- Favicons
    ================================================== -->
<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
<link rel="apple-touch-icon" href="img/apple-touch-icon.png">
<link rel="apple-touch-icon" href="img/apple-touch-icon-72x72.png">
<link rel="apple-touch-icon"  href="img/apple-touch-icon-114x114.png">

<!-- Bootstrap -->
<link rel="stylesheet" type="text/css"  href="css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="fonts/font-awesome/css/font-awesome.css">

<!-- Stylesheet
    ================================================== -->
<link rel="stylesheet" type="text/css"  href="css/style.css">
<link rel="stylesheet" type="text/css" href="css/prettyPhoto.css">
<link href='http://fonts.googleapis.com/css?family=Lato:400,700,900,300' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800,600,300' rel='stylesheet' type='text/css'>
<script type="text/javascript" src="js/modernizr.custom.js"></script>

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<!-- Navigation
    ==========================================-->
<nav id="menu" class="navbar navbar-default navbar-fixed-top">
  <div class="container"> 
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
      <a class="navbar-brand" href="index.php">Web Progress</a> </div>
    
    <!-- Collect the nav links, forms, and other content for toggling -->
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
    <!-- /.navbar-collapse --> 
  </div>
  <!-- /.container-fluid --> 
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
      <div class="col-md-3 col-sm-6 service"> <i class="fa fa-laptop"></i>
        <h4><?php echo $diseñoWeb ?></h4>
        <p class="text_services"><?php echo $bloqueUno ?></p>
      </div>
      <div class="col-md-3 col-sm-6 service"> <i class="fa fa-gears"></i>
        <h4><?php echo $desarolloAplicaciones ?></h4>
        <p class="text_services"><?php echo $bloqueDos ?></p>
      </div>
      <div class="col-md-3 col-sm-6 service"> <i class="fa fa-google"></i>
        <h4><?php echo $responsive ?></h4>
        <p class="text_services"><?php echo $bloqueTres ?></p>
      </div>
      <div class="col-md-3 col-sm-6 service"> <i class="fa fa-mobile"></i>
        <h4><?php echo $aplicacionMobile ?></h4>
        <p class="text_services"><?php echo $bloqueCuatro ?></p>
      </div>
    </div>
    <div class="space"></div>
    <div class="row">
      <div class="col-md-3 col-sm-6 service"> <i class="fa fa-share-alt"></i>
        <h4><?php echo $comunityManager ?></h4>
        <p class="text_services"><?php echo $bloqueCinco ?></p>
      </div>
      <div class="col-md-3 col-sm-6 service"> <i class="fa fa-file-text-o"></i>
        <h4><?php echo $asesorias ?></h4>
        <p class="text_services"><?php echo $bloqueSeis ?></p>
      </div>
      <div class="col-md-3 col-sm-6 service"> <i class="fa fa-share-alt"></i>
        <h4><?php echo $testing ?></h4>
        <p class="text_services"><?php echo $bloqueSiete ?></p>
      </div>
      <div class="col-md-3 col-sm-6 service"> <i class="fa fa-camera"></i>
        <h4><?php echo $fotografia ?></h4>
        <p class="text_services"><?php echo $bloqueOcho ?></p>
      </div>
    </div>
  </div>
</div>
<!-- Portfolio Section -->
<div id="works-section">
  <div class="container"> <!-- Container -->
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
            <div class="hover-bg"> <a href="img/portfolio/alexfernandez.png" rel="prettyPhoto">
              <div class="hover-text">
                <h4>Alex Fernandez</h4>
                <small><?php echo $pestañaDos ?></small>
                <div class="clearfix"></div>
              </div>
              <img src="img/portfolio/alexfernandez.png" class="img-responsive" alt="Alex Fernandez"> </a> </div>
          </div>
        </div>
        <div class="col-sm-6 col-md-3 col-lg-3 web">
          <div class="portfolio-item">
            <div class="hover-bg"> <a href="img/portfolio/edgarbalbas.png" rel="prettyPhoto">
              <div class="hover-text">
                <h4>Blog Edgar Balbas</h4>
                <small><?php echo $pestañaDos ?></small>
                <div class="clearfix"></div>
              </div>
              <img src="img/portfolio/edgarbalbas.png" class="img-responsive" alt="Blog Edgar Balbas"> </a> </div>
          </div>
        </div>
        <div class="col-sm-6 col-md-3 col-lg-3 web">
          <div class="portfolio-item">
            <div class="hover-bg"> <a href="img/portfolio/alexfernandez.png" rel="prettyPhoto">
              <div class="hover-text">
                <h4>Poporo Ink</h4>
                <small><?php echo $pestañaDos ?></small>
                <div class="clearfix"></div>
              </div>
              <img src="img/portfolio/alexfernandez.png" class="img-responsive" alt="Poporo Ink"> </a> </div>
          </div>
        </div>
        <div class="col-sm-6 col-md-3 col-lg-3 mobile">
          <div class="portfolio-item">
            <div class="hover-bg"> <a href="img/portfolio/apps.png" rel="prettyPhoto">
              <div class="hover-text">
                <h4>App Herbalife</h4>
                <small><?php echo $pestañaCuatro ?></small>
                <div class="clearfix"></div>
              </div>
              <img src="img/portfolio/apps.png" class="img-responsive" alt="App Herbalife"> </a> </div>
          </div>
        </div>
        <div class="col-sm-6 col-md-3 col-lg-3 Applications">
          <div class="portfolio-item">
            <div class="hover-bg"> <a href="img/portfolio/syslife.png" rel="prettyPhoto">
              <div class="hover-text">
                <h4>SYSLIFE</h4>
                <small><?php echo $pestañaTres ?></small>
                <div class="clearfix"></div>
              </div>
              <img src="img/portfolio/syslife.png" class="img-responsive" alt="SYSLIFE"> </a> </div>
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
    <div id="row">
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
      <p><i class="fa fa-map-marker"></i>Urb. del Este Barquisimeto - Venezuela</p>
      <div class="space"></div>
      <p><i class="fa fa-envelope-o"></i>info@company.com</p>
      <div class="space"></div>
      <p><i class="fa fa-phone"></i>+58 04165597370</p>
    </div>
    <div class="col-md-8">
      <h4><?php echo $dejanosUnMensaje ?></h4>
      <form action="" method="post" accept-charset="utf-8">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <input type="text" id="name" class="form-control" placeholder=<?php echo $nombre ?> required="required">
              <p class="help-block text-danger"></p>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <input type="email" id="email" class="form-control" placeholder="Email" required="required">
              <p class="help-block text-danger"></p>
            </div>
          </div>
        </div>
        <div class="form-group">
          <textarea name="message" id="message" class="form-control" rows="4" placeholder=<?php echo $mensaje ?> required></textarea>
          <p class="help-block text-danger"></p>
        </div>
        <div id="success"></div>
        <button type="submit" class="btn btn-default"><?php echo $enviarMensaje ?></button>
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
    <p>Copyright &copy; Optics. Designed by <a href="http://www.templatewire.com" rel="nofollow"></a></p>
  </div>
</div>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> 
<script type="text/javascript" src="js/jquery.1.11.1.js"></script> 
<!-- Include all compiled plugins (below), or include individual files as needed --> 
<script type="text/javascript" src="js/bootstrap.js"></script> 
<script type="text/javascript" src="js/SmoothScroll.js"></script> 
<script type="text/javascript" src="js/jquery.prettyPhoto.js"></script> 
<script type="text/javascript" src="js/jquery.isotope.js"></script> 
<script type="text/javascript" src="js/jqBootstrapValidation.js"></script> 

<!--<script type="text/javascript" src="js/contact_me.js"></script>--> 

<!--<script type="text/javascript" src="js/contact_me.js"></script> -->

<!-- Javascripts
    ================================================== --> 
<script type="text/javascript" src="js/main.js"></script>
</body>
</html>