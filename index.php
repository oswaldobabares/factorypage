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
      <img src="img/iconos/iconsWp.png" /> </div>
      
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
<div id="info">
	<span id="birds" style="display: none"></span>
	<!-- Header -->
<header class="text-center" name="home">
  <div class="intro-text">
    <h1><?php echo $titulo ?><span class="color"> Web Progress</span></h1>
    <p><?php echo $subTitulo ?></p>
    <div class="clearfix"></div>
    <a href="#about-section" class="btn btn-default btn-lg page-scroll"><?php echo $link ?></a> </div>
</header>
</div>
		<script src="js/three.js"></script>
		<script src="js/Detector.js"></script>
		<script src="js/stats.min.js"></script>
		<script src="js/dat.gui.min.js"></script>
		<script src="js/GPUComputationRenderer.js"></script>

		<!-- shader for bird's position -->
		<script id="fragmentShaderPosition" type="x-shader/x-fragment">
			uniform float time;
			uniform float delta;
			void main()	{
				vec2 uv = gl_FragCoord.xy / resolution.xy;
				vec4 tmpPos = texture2D( texturePosition, uv );
				vec3 position = tmpPos.xyz;
				vec3 velocity = texture2D( textureVelocity, uv ).xyz;
				float phase = tmpPos.w;
				phase = mod( ( phase + delta +
					length( velocity.xz ) * delta * 3. +
					max( velocity.y, 0.0 ) * delta * 6. ), 62.83 );
				gl_FragColor = vec4( position + velocity * delta * 15. , phase );
			}
		</script>

		<!-- shader for bird's velocity -->
		<script id="fragmentShaderVelocity" type="x-shader/x-fragment">
			uniform float time;
			uniform float testing;
			uniform float delta; // about 0.016
			uniform float seperationDistance; // 20
			uniform float alignmentDistance; // 40
			uniform float cohesionDistance; //
			uniform float freedomFactor;
			uniform vec3 predator;
			const float width = resolution.x;
			const float height = resolution.y;
			const float PI = 3.141592653589793;
			const float PI_2 = PI * 2.0;
			// const float VISION = PI * 0.55;
			float zoneRadius = 40.0;
			float zoneRadiusSquared = 1600.0;
			float separationThresh = 0.45;
			float alignmentThresh = 0.65;
			const float UPPER_BOUNDS = BOUNDS;
			const float LOWER_BOUNDS = -UPPER_BOUNDS;
			const float SPEED_LIMIT = 9.0;
			float rand(vec2 co){
				return fract(sin(dot(co.xy ,vec2(12.9898,78.233))) * 43758.5453);
			}
			void main() {
				zoneRadius = seperationDistance + alignmentDistance + cohesionDistance;
				separationThresh = seperationDistance / zoneRadius;
				alignmentThresh = ( seperationDistance + alignmentDistance ) / zoneRadius;
				zoneRadiusSquared = zoneRadius * zoneRadius;
				vec2 uv = gl_FragCoord.xy / resolution.xy;
				vec3 birdPosition, birdVelocity;
				vec3 selfPosition = texture2D( texturePosition, uv ).xyz;
				vec3 selfVelocity = texture2D( textureVelocity, uv ).xyz;
				float dist;
				vec3 dir; // direction
				float distSquared;
				float seperationSquared = seperationDistance * seperationDistance;
				float cohesionSquared = cohesionDistance * cohesionDistance;
				float f;
				float percent;
				vec3 velocity = selfVelocity;
				float limit = SPEED_LIMIT;
				dir = predator * UPPER_BOUNDS - selfPosition;
				dir.z = 0.;
				// dir.z *= 0.6;
				dist = length( dir );
				distSquared = dist * dist;
				float preyRadius = 150.0;
				float preyRadiusSq = preyRadius * preyRadius;
				// move birds away from predator
				if (dist < preyRadius) {
					f = ( distSquared / preyRadiusSq - 1.0 ) * delta * 100.;
					velocity += normalize( dir ) * f;
					limit += 5.0;
				}
				// if (testing == 0.0) {}
				// if ( rand( uv + time ) < freedomFactor ) {}
				// Attract flocks to the center
				vec3 central = vec3( 0., 0., 0. );
				dir = selfPosition - central;
				dist = length( dir );
				dir.y *= 2.5;
				velocity -= normalize( dir ) * delta * 5.;
				for (float y=0.0;y<height;y++) {
					for (float x=0.0;x<width;x++) {
						vec2 ref = vec2( x + 0.5, y + 0.5 ) / resolution.xy;
						birdPosition = texture2D( texturePosition, ref ).xyz;
						dir = birdPosition - selfPosition;
						dist = length(dir);
						if (dist < 0.0001) continue;
						distSquared = dist * dist;
						if (distSquared > zoneRadiusSquared ) continue;
						percent = distSquared / zoneRadiusSquared;
						if ( percent < separationThresh ) { // low
							// Separation - Move apart for comfort
							f = (separationThresh / percent - 1.0) * delta;
							velocity -= normalize(dir) * f;
						} else if ( percent < alignmentThresh ) { // high
							// Alignment - fly the same direction
							float threshDelta = alignmentThresh - separationThresh;
							float adjustedPercent = ( percent - separationThresh ) / threshDelta;
							birdVelocity = texture2D( textureVelocity, ref ).xyz;
							f = ( 0.5 - cos( adjustedPercent * PI_2 ) * 0.5 + 0.5 ) * delta;
							velocity += normalize(birdVelocity) * f;
						} else {
							// Attraction / Cohesion - move closer
							float threshDelta = 1.0 - alignmentThresh;
							float adjustedPercent = ( percent - alignmentThresh ) / threshDelta;
							f = ( 0.5 - ( cos( adjustedPercent * PI_2 ) * -0.5 + 0.5 ) ) * delta;
							velocity += normalize(dir) * f;
						}
					}
				}
				// this make tends to fly around than down or up
				// if (velocity.y > 0.) velocity.y *= (1. - 0.2 * delta);
				// Speed Limits
				if ( length( velocity ) > limit ) {
					velocity = normalize( velocity ) * limit;
				}
				gl_FragColor = vec4( velocity, 1.0 );
			}
		</script>

		<script type="x-shader/x-vertex" id="birdVS">
			attribute vec2 reference;
			attribute float birdVertex;
			attribute vec3 birdColor;
			uniform sampler2D texturePosition;
			uniform sampler2D textureVelocity;
			varying vec4 vColor;
			varying float z;
			uniform float time;
			void main() {
				vec4 tmpPos = texture2D( texturePosition, reference );
				vec3 pos = tmpPos.xyz;
				vec3 velocity = normalize(texture2D( textureVelocity, reference ).xyz);
				vec3 newPosition = position;
				if ( birdVertex == 4.0 || birdVertex == 7.0 ) {
					// flap wings
					newPosition.y = sin( tmpPos.w ) * 5.;
				}
				newPosition = mat3( modelMatrix ) * newPosition;
				velocity.z *= -1.;
				float xz = length( velocity.xz );
				float xyz = 1.;
				float x = sqrt( 1. - velocity.y * velocity.y );
				float cosry = velocity.x / xz;
				float sinry = velocity.z / xz;
				float cosrz = x / xyz;
				float sinrz = velocity.y / xyz;
				mat3 maty =  mat3(
					cosry, 0, -sinry,
					0    , 1, 0     ,
					sinry, 0, cosry
				);
				mat3 matz =  mat3(
					cosrz , sinrz, 0,
					-sinrz, cosrz, 0,
					0     , 0    , 1
				);
				newPosition =  maty * matz * newPosition;
				newPosition += pos;
				z = newPosition.z;
				vColor = vec4( birdColor, 1.0 );
				gl_Position = projectionMatrix *  viewMatrix  * vec4( newPosition, 1.0 );
			}
		</script>

		<!-- bird geometry shader -->
		<script type="x-shader/x-fragment" id="birdFS">
			varying vec4 vColor;
			varying float z;
			uniform vec3 color;
			void main() {
				// Fake colors for now
				float z2 = 0.2 + ( 1000. - z ) / 1000. * vColor.x;
				gl_FragColor = vec4( z2, z2, z2, 1. );
			}
		</script>

		<script>
			if ( ! Detector.webgl ) Detector.addGetWebGLMessage();
			var hash = document.location.hash.substr( 1 );
			if (hash) hash = parseInt(hash, 0);
			/* TEXTURE WIDTH FOR SIMULATION */
			var WIDTH = hash || 32;
			var BIRDS = WIDTH * WIDTH;
			// Custom Geometry - using 3 triangles each. No UVs, no normals currently.
			THREE.BirdGeometry = function () {
				var triangles = BIRDS * 3;
				var points = triangles * 3;
				THREE.BufferGeometry.call( this );
				var vertices = new THREE.BufferAttribute( new Float32Array( points * 3 ), 3 );
				var birdColors = new THREE.BufferAttribute( new Float32Array( points * 3 ), 3 );
				var references = new THREE.BufferAttribute( new Float32Array( points * 2 ), 2 );
				var birdVertex = new THREE.BufferAttribute( new Float32Array( points ), 1 );
				this.addAttribute( 'position', vertices );
				this.addAttribute( 'birdColor', birdColors );
				this.addAttribute( 'reference', references );
				this.addAttribute( 'birdVertex', birdVertex );
				// this.addAttribute( 'normal', new Float32Array( points * 3 ), 3 );
				var v = 0;
				function verts_push() {
					for (var i=0; i < arguments.length; i++) {
						vertices.array[v++] = arguments[i];
					}
				}
				var wingsSpan = 20;
				for (var f = 0; f<BIRDS; f++ ) {
					// Body
					verts_push(
						0, -0, -20,
						0, 4, -20,
						0, 0, 30
					);
					// Left Wing
					verts_push(
						0, 0, -15,
						-wingsSpan, 0, 0,
						0, 0, 15
					);
					// Right Wing
					verts_push(
						0, 0, 15,
						wingsSpan, 0, 0,
						0, 0, -15
					);
				}
				for( var v = 0; v < triangles * 3; v++ ) {
					var i = ~~(v / 3);
					var x = (i % WIDTH) / WIDTH;
					var y = ~~(i / WIDTH) / WIDTH;
					var c = new THREE.Color(
						0x444444 +
						~~(v / 9) / BIRDS * 0x666666
					);
					birdColors.array[ v * 3 + 0 ] = c.r;
					birdColors.array[ v * 3 + 1 ] = c.g;
					birdColors.array[ v * 3 + 2 ] = c.b;
					references.array[ v * 2     ] = x;
					references.array[ v * 2 + 1 ] = y;
					birdVertex.array[ v         ] = v % 9;
				}
				this.scale( 0.2, 0.2, 0.2 );
			};
			THREE.BirdGeometry.prototype = Object.create( THREE.BufferGeometry.prototype );
			var container, stats;
			var camera, scene, renderer, geometry, i, h, color;
			var mouseX = 0, mouseY = 0;
			var windowHalfX = window.innerWidth / 2;
			var windowHalfY = window.innerHeight / 2;
			var BOUNDS = 800, BOUNDS_HALF = BOUNDS / 2;
			document.getElementById('birds').innerText = BIRDS;
			function change(n) {
				location.hash = n;
				location.reload();
				return false;
			}
			
			var last = performance.now();
			var gpuCompute;
			var velocityVariable;
			var positionVariable;
			var positionUniforms;
			var velocityUniforms;
			var birdUniforms;
			init();
			animate();
			function init() {
				container = document.createElement( 'div' );
				document.body.appendChild( container );
				camera = new THREE.PerspectiveCamera( 75, window.innerWidth / window.innerHeight, 1, 3000 );
				camera.position.z = 350;
				scene = new THREE.Scene();
				scene.fog = new THREE.Fog( 0x222222, 100, 1000 );
				renderer = new THREE.WebGLRenderer();
				renderer.setClearColor( scene.fog.color );
				renderer.setPixelRatio( window.devicePixelRatio );
				renderer.setSize( window.innerWidth, window.innerHeight );
				container.appendChild( renderer.domElement );
				initComputeRenderer();
				stats = new Stats();
				container.appendChild( stats.dom );
				document.addEventListener( 'mousemove', onDocumentMouseMove, false );
				document.addEventListener( 'touchstart', onDocumentTouchStart, false );
				document.addEventListener( 'touchmove', onDocumentTouchMove, false );
				//
				window.addEventListener( 'resize', onWindowResize, false );
				var gui = new dat.GUI();
				var effectController = {
					seperation: 20.0,
					alignment: 20.0,
					cohesion: 20.0,
					freedom: 0.75
				};
				var valuesChanger = function() {
					velocityUniforms.seperationDistance.value = effectController.seperation;
					velocityUniforms.alignmentDistance.value = effectController.alignment;
					velocityUniforms.cohesionDistance.value = effectController.cohesion;
					velocityUniforms.freedomFactor.value = effectController.freedom;
				};
				valuesChanger();
				gui.add( effectController, "seperation", 0.0, 100.0, 1.0 ).onChange( valuesChanger );
				gui.add( effectController, "alignment", 0.0, 100, 0.001 ).onChange( valuesChanger );
				gui.add( effectController, "cohesion", 0.0, 100, 0.025 ).onChange( valuesChanger );
				gui.close();
				initBirds();
			}
			function initComputeRenderer() {
    				gpuCompute = new GPUComputationRenderer( WIDTH, WIDTH, renderer );
				var dtPosition = gpuCompute.createTexture();
				var dtVelocity = gpuCompute.createTexture();
				fillPositionTexture( dtPosition );
				fillVelocityTexture( dtVelocity );
				velocityVariable = gpuCompute.addVariable( "textureVelocity", document.getElementById( 'fragmentShaderVelocity' ).textContent, dtVelocity );
				positionVariable = gpuCompute.addVariable( "texturePosition", document.getElementById( 'fragmentShaderPosition' ).textContent, dtPosition );
				gpuCompute.setVariableDependencies( velocityVariable, [ positionVariable, velocityVariable ] );
				gpuCompute.setVariableDependencies( positionVariable, [ positionVariable, velocityVariable ] );
				positionUniforms = positionVariable.material.uniforms;
				velocityUniforms = velocityVariable.material.uniforms;
				positionUniforms.time = { value: 0.0 };
				positionUniforms.delta = { value: 0.0 };
				velocityUniforms.time = { value: 1.0 };
				velocityUniforms.delta = { value: 0.0 };
				velocityUniforms.testing = { value: 1.0 };
				velocityUniforms.seperationDistance = { value: 1.0 };
				velocityUniforms.alignmentDistance = { value: 1.0 };
				velocityUniforms.cohesionDistance = { value: 1.0 };
				velocityUniforms.freedomFactor = { value: 1.0 };
				velocityUniforms.predator = { value: new THREE.Vector3() };
				velocityVariable.material.defines.BOUNDS = BOUNDS.toFixed( 2 );
				velocityVariable.wrapS = THREE.RepeatWrapping;
				velocityVariable.wrapT = THREE.RepeatWrapping;
				positionVariable.wrapS = THREE.RepeatWrapping;
				positionVariable.wrapT = THREE.RepeatWrapping;
				var error = gpuCompute.init();
				if ( error !== null ) {
				    console.error( error );
				}
			}
			function initBirds() {
				var geometry = new THREE.BirdGeometry();
				// For Vertex and Fragment
				birdUniforms = {
					color: { value: new THREE.Color( 0xff2200 ) },
					texturePosition: { value: null },
					textureVelocity: { value: null },
					time: { value: 1.0 },
					delta: { value: 0.0 }
				};
				// ShaderMaterial
				var material = new THREE.ShaderMaterial( {
					uniforms:       birdUniforms,
					vertexShader:   document.getElementById( 'birdVS' ).textContent,
					fragmentShader: document.getElementById( 'birdFS' ).textContent,
					side: THREE.DoubleSide
				});
				birdMesh = new THREE.Mesh( geometry, material );
				birdMesh.rotation.y = Math.PI / 2;
				birdMesh.matrixAutoUpdate = false;
				birdMesh.updateMatrix();
				scene.add(birdMesh);
			}
			function fillPositionTexture( texture ) {
				var theArray = texture.image.data;
				for ( var k = 0, kl = theArray.length; k < kl; k += 4 ) {
					var x = Math.random() * BOUNDS - BOUNDS_HALF;
					var y = Math.random() * BOUNDS - BOUNDS_HALF;
					var z = Math.random() * BOUNDS - BOUNDS_HALF;
					theArray[ k + 0 ] = x;
					theArray[ k + 1 ] = y;
					theArray[ k + 2 ] = z;
					theArray[ k + 3 ] = 1;
				}
			}
			function fillVelocityTexture( texture ) {
				var theArray = texture.image.data;
				for ( var k = 0, kl = theArray.length; k < kl; k += 4 ) {
					var x = Math.random() - 0.5;
					var y = Math.random() - 0.5;
					var z = Math.random() - 0.5;
					theArray[ k + 0 ] = x * 10;
					theArray[ k + 1 ] = y * 10;
					theArray[ k + 2 ] = z * 10;
					theArray[ k + 3 ] = 1;
				}
			}
			function onWindowResize() {
				windowHalfX = window.innerWidth / 2;
				windowHalfY = window.innerHeight / 2;
				camera.aspect = window.innerWidth / window.innerHeight;
				camera.updateProjectionMatrix();
				renderer.setSize( window.innerWidth, window.innerHeight );
			}
			function onDocumentMouseMove( event ) {
				mouseX = event.clientX - windowHalfX;
				mouseY = event.clientY - windowHalfY;
			}
			function onDocumentTouchStart( event ) {
				if ( event.touches.length === 1 ) {
					event.preventDefault();
					mouseX = event.touches[ 0 ].pageX - windowHalfX;
					mouseY = event.touches[ 0 ].pageY - windowHalfY;
				}
			}
			function onDocumentTouchMove( event ) {
				if ( event.touches.length === 1 ) {
					event.preventDefault();
					mouseX = event.touches[ 0 ].pageX - windowHalfX;
					mouseY = event.touches[ 0 ].pageY - windowHalfY;
				}
			}
			//
			function animate() {
				requestAnimationFrame( animate );
				render();
				stats.update();
			}
			function render() {
				var now = performance.now();
				var delta = (now - last) / 1000;
				if (delta > 1) delta = 1; // safety cap on large deltas
				last = now;
				positionUniforms.time.value = now;
				positionUniforms.delta.value = delta;
				velocityUniforms.time.value = now;
				velocityUniforms.delta.value = delta;
				birdUniforms.time.value = now;
				birdUniforms.delta.value = delta;
				velocityUniforms.predator.value.set( 0.5 * mouseX / windowHalfX, - 0.5 * mouseY / windowHalfY, 0 );
				mouseX = 10000;
				mouseY = 10000;
				gpuCompute.compute();
				birdUniforms.texturePosition.value = gpuCompute.getCurrentRenderTarget( positionVariable ).texture;
				birdUniforms.textureVelocity.value = gpuCompute.getCurrentRenderTarget( velocityVariable ).texture;
				renderer.render( scene, camera );
			}
		</script>
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
            <p class="styleTextTeam"><?php echo $desarrollador ?></p>
            <p class="styleTextTeam">+58 0424-5595806</p>
            <p class="styleTextTeam">migmosquera2303@gmail.com</p>
          </div>
        </div>
      </div>
      <div class="col-md-3 col-sm-6 team">
        <div class="thumbnail"> <img src="img/team/oba.jpg" alt="..." class="team-img">
          <div class="caption">
            <h3>Oswaldo Teran</h3>
            <p class="styleTextTeam"><?php echo $desarrollador ?></p>
            <p class="styleTextTeam">+58 0416-5597370</p>
            <p class="styleTextTeam">oswaldobabaresco@gmail.com</p>
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
<script>
	var container = $("div").find('dg ac');
	$(container.context.all[69]).addClass('labelHide');
</script>
</body>
</html>