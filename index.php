<?php
	session_start();
	include("phpIncludes/konekcija.php");

    include("phpIncludes/header.php");



if(isset($_GET['stranica'])){
	$stranica = $_GET['stranica'];
	if($stranica=='index'){
		include "phpIncludes/index.php";
    } 
    else if ($stranica == 'smestaj') {
		include "phpIncludes/smestaj.php";
	}
	else if ($stranica == 'registracija') {
		include "phpIncludes/registracija.php";
	}
	else if ($stranica == 'recenzije') {
		include "phpIncludes/recenzije.php";
	}
	else if ($stranica == 'autor') {
	 	include "phpIncludes/autor.php";
	 }
}
else {
	include "phpIncludes/index.php";
}

	include("phpIncludes/footer.php");
?>