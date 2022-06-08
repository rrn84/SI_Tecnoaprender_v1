<?php
//www\SI-Tecnoaprender\main_app\server\login\funcs
//servidor, usuario de base de datos, contraseña del usuario, nombre de base de datos
	$mysqli=new mysqli("localhost","tecno_admin","Holatecno123*","tecno_aprender");

	if(mysqli_connect_errno()){
		echo 'Conexion Fallida : ', mysqli_connect_error();
		exit();
	}
?>
