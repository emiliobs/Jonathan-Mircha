<?php
//Para que no mande mensajes NOTICE: xxx
error_reporting(E_ALL ^ E_NOTICE);
	//Recibo el valor de la variable
	$op=$_GET["op"];

	//Control de flujo para realizar la accion que desea el usuario
	switch($op)
	{
		case "alta":
			$contenido= "php/alta-contacto.php";
			$titulo="Alta de contactos";
			break;
		case "baja":
			$contenido="php/baja-contacto.php";
			$titulo="Baja de conctactos";
			break;
		case "cambios":
			$contenido="php/cambios-contacto.php";
			$titulo="Cambio de contactos";
			break;
		case "consultas":
			$contenido="php/consultas-contacto.php";
			$titulo="Consulta de contactos";
			break;
		default:
			$contenido="php/home.php";
			$titulo="Mis contactos v1";
			break;

	}
		
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8"/>
	<title>Aplicacion ABC</title>
	<!--[if lt IE 9]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<link rel="stylesheet" href="css/mis-contactos.css" />
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
	
	<!--Si no encuentra la libreria en el servidor externo ir al archivo jquery.min.js local
		escapar la etiqueta de cierre </script>-->
	<script>
		!window.jQuery && document.write("<script src='js/jquery.min.js'> <\/script> ")
	</script>

	<script src="js/mis-contactos.js"> </script>

</head>
<body>
	<section id="contenido">
		<nav>
			<ul>
				<li><a class="cambio" href="index.php">Home</a></li>
				<li><a class="cambio" href="?op=alta">Alta de contactos</a></li>
				<li><a class="cambio" href="?op=baja">Baja de contactos</a></li>
				<li><a class="cambio" href="?op=cambios">Cambios de contactos</a></li>
				<li><a class="cambio" href="?op=consultas">Consultas de contactos</a></li>
			</ul>
		</nav>	
		
		<section id="principal">
			<!--Incluir los archivos, según las acciones que desea realizar el usuario-->
			<?php
				include($contenido);
			?>
		</section>

	</section>
</body>
</html>