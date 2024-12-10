<?php
session_start(); // Iniciar la sesión

include('conexion.php');

$usu 	= $_POST["txtusuario"];
$pass 	= $_POST["txtpassword"];
$rol 	= $_POST["rol"];

$queryusuario = mysqli_query($conn,"SELECT * FROM login WHERE usuario ='$usu' AND pass = '$pass' AND rol = '$rol'");
$nr 		= mysqli_num_rows($queryusuario);  

if ($nr == 1 )  
{ 
    // Guardar el nombre de usuario en la sesión
    $_SESSION['usuario'] = $usu;

	if ($rol == "Usuario")
	{	
		header("Location:pag_user.php"); // Redirigir a pag_user.php en la carpeta USUARIO
	}
	else if ($rol == "Admin")
	{
		header("Location: USADMIN/pag_admin.php"); // Redirigir a pag_admin.php en la carpeta USUARIO/ADMIN
	}
}
else
{
	echo "<script> alert('Usuario, contraseña o rol incorrecto.'); window.location= 'index.html' </script>";
}

?>
<link href="assets/css/index.css" rel="stylesheet" type="text/css">
