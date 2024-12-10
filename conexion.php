<?php
$conn = new mysqli("localhost","root","","nombre_de_la_base_de_datos");
	
	if($conn->connect_errno)
	{
		echo "No hay conexión: (" . $conn->connect_errno . ") " . $conn->connect_error;
	}
?>