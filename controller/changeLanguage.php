<?php
    if (empty($_POST["language"])){
    	$lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0,2);
		$_SESSION['language']=$lang;
		if($lang!="es"){
			$_SESSION['language']="en";
		}
		
    } 
	
	if (isset($_POST['language'])){
		$language = $_POST['language'];
		$lang=$language;
		
	}
	
	switch ($lang) {
		case 'es':
				include 'language/es.php';	
			break;
			
		case 'en':
				include 'language/en.php';	
			break;
		default:
				include 'language/en.php';	
			break;
	}
?>