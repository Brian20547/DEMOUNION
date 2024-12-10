
<?php
include("conexion.php");
$con=conectar();
$usuario=$_POST['usuario'];
$pass=$_POST['pass'];
$rol=$_POST['rol'];
$sql="INSERT INTO login (usuario,pass,rol) values ('$usuario','$pass','$rol')";
$result=mysqli_query($con,$sql);
echo "<script>window.location='datosregistrado.html';</script>";
?>
