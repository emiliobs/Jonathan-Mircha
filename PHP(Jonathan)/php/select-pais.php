<?php
//Incluir la variable de conexion
include("conexion.php")	;
	
	//Consulta para desplegar los paises
	$consulta="SELECT * FROM pais ORDER BY pais";
	//Ejecutar la consulta
	$ejecutar_consulta= $conexion ->query($consulta);

	//Ciclo para recorrer los registros, fetch_assoc asocia los nombre tal cual a la B.D
	while($filas=$ejecutar_consulta->fetch_assoc())
	{

		$pais=utf8_encode($filas['pais']);
		//echo"<option value='".$filas["pais"]."'>".$filas["pais"]." </option>";
		echo"<option value='$pais'>$pais </option>";
	}

?>