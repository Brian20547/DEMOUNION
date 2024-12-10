<?php
	$server="localhost";
	$username="root";
	$password="";
	$db='nombre_de_la_base_de_datos';
	
	$con=mysqli_connect($server,$username,$password,$db);
	
	if (mysqli_connect_errno()) {
       printf("Falló la conexión: %s\n", mysqli_connect_error());
       exit();
    }

	
    if (!mysqli_set_charset($con,"utf8")) {
        printf("Error cargando el conjunto de caracteres utf8: %s\n", mysqli_error($con));
        exit();
    } else {
        mysqli_character_set_name($con);
    }

    //mysqli_close($con);
?>