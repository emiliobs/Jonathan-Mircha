<?php
	
	//Crear funcion para conectarse a la B.D
	
	function conectarse()
	{
		$servidor="localhost";
		$usuario="root";
		$password="";
		$bd="mis_contactos";

		//Parametro mysqli, se le pasa servidor, usuario, pass, bd
		$conectar= new mysqli ($servidor,$usuario,$password,$bd)or die("No se pudo conectar al servidor de BD MySQL");
		//Retornar la variable $conectar
		return $conectar;
	}
	//Asignamos a la variable $conexion=$conectar (El retorno de la variable, en este caso el query de conexion)
	$conexion= conectarse();

?>