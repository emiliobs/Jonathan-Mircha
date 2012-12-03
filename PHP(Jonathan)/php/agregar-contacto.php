<?php
//Asigno a variables de php los valores que vienen del formulario
$email=$_POST["email_txt"];
$nombre=$_POST["nombre_txt"];
$sexo=$_POST["sexo_rdo"];
$nacimiento=$_POST["nacimiento_txt"];
$telefono=$_POST["telefono_txt"];
$pais=$_POST["pais_slc"];

/*Dependiendo el sexo ponemos una imagen predeterminada
	Utilizando el operador ternario
 		variable = (condición) ? valor-cuando-es-verdadera : valor-cuando-es-falsa;  */
$imagen_generica=($sexo=="M")?"img/fotos/amigo.png":"img/fotos/amiga.png";

	//Verificamos que no exista previamente el email del usuario en la B.D
	include("conexion.php");
		$consulta="SELECT * FROM contactos WHERE email='$email'";
		$ejecutar_consulta= $conexion->query($consulta);
		$num_regs=$ejecutar_consulta->num_rows;
		//Si $num_regs es igual a 0, insertamos los datos en la tabla. Si no mandamos un mensaje q el usuario existe
		if($num_regs==0)
		{
			//Se ejecuta la funcion para subir la imagen
			include("funciones.php");
			$tipo= $_FILES["foto_fls"]["type"];
			$archivo= $_FILES["foto_fls"]["tmp_name"];
			$se_subio_imagen= subir_imagen($tipo,$archivo,$email);

			//Si la foto en el Formulario esta vacia, entonces le asigno el valor de la imagen predeterminada. Si no guardar el nombre de la imagen
			$imagen= empty($archivo)?$imagen_generica:$se_subio_imagen;

			$consulta="INSERT INTO contactos(email,nombre,sexo,nacimiento,telefono,pais,imagen)
				VALUES('$email','$nombre','$sexo','$nacimiento','$telefono','$pais','$imagen')";

			$ejecutar_consulta=$conexion->query(utf8_encode($consulta));
			//Validar si se ejecuta la consulta
			if($ejecutar_consulta){
				$mensaje ="Se ha dado de alta el contaco con email <b>$email</b>";
			}else{
				$mensaje="No se ha podido dar de alta el contaco con email <b>$email</b>";
			}




		}
		else
		{
			$mensaje="El registro $email <b>ya extiste en la BD :( </b>";
		}
		//Cierro la conexion
		$conexion->close();
		//Redirecciono al usuario
		header("Location: ../index.php?op=alta&mensaje=$mensaje");
?>