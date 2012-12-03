<?php
/*El parametro de $extension determina q tipo de imagen NO se borrara. Por ejemplo si es jpg significa q la imagen
con extension jpg se queda en el servidor y si existen imagenes con el mismo nombre peor con extension png o gif se eliminaran,
con esta funcion evito tener imaganes duplicadas con distintas extensiones para cada perfil*/
function borrar_imagenes($ruta,$extension)
{
	switch($extension)
	{
		case".jpg":
			//Eliminar los posibles duplicados con extension diferente a la buscada
			if(file_exists($ruta.".png"))
				unlink($ruta.".png");
			if(file_exists($ruta.".gif"))
				unlink($ruta.".gif");
			break;

		case".gif":
			//Eliminar los posibles duplicados con extension diferente a la buscada
			if(file_exists($ruta.".png"))
				unlink($ruta.".png");
			if(file_exists($ruta.".jpg"))
				unlink($ruta.".jpg");
			break;

		case".png":
			//Eliminar los posibles duplicados con extension diferente a la buscada
			if(file_exists($ruta.".gif"))
				unlink($ruta.".gif");
			if(file_exists($ruta.".jpg"))
				unlink($ruta.".jpg");
			break;






	}
}

//Funcion para subir la imagen del perfil del usuario
function subir_imagen($tipo,$imagen,$email)
{
	//strstr($cadena1,$cadena2) sirve para evaluar si en la primer cadena de texto existe la segunda cadena
	//Si dentro del tipo del archivo se encuentra la palabra image significa que el archivo es una imagen
	if(strstr($tipo, "image"))
	{
		//Para saber q tipo de extension es la imagen
		if(strstr($tipo,"jpeg"))
			$extension=".jpg";
		else if(strstr($tipo,"gif"))
			$extension=".gif";
		else if(strstr($tipo,"png"))
			$extension=".png";

		//Para saber si la imagen tiene el ancho correcto que es de 420px
		$tam_img=getimagesize($imagen);
		$ancho_img=$tam_img[0];
		$alto_img=$tam_img[1];
		$ancho_img_deseado=420;

		//Si la imagen es mayor a su ancho predefinido en la maquetacion de 420px, reajusto su tamaño
		if($ancho_img > $ancho_img_deseado)
		{
			//Por medio de una regla de 3, obtengo el alto de la imagen de manera proporcional al ancho nuevo q será de 420px
			$nuevo_ancho_img=$ancho_img_deseado;
			$nuevo_alto_img=($alto_img/$ancho_img)* $nuevo_ancho_img;
			
			//Creo una imagen con el color real con las nuevas funciones
			$img_reajustada=imagecreatetruecolor($nuevo_ancho_img, $nuevo_alto_img);

			//Creo una imagen basada en la original, dependiendo de su extension es la que creare
			switch($extension)
			{

				case ".jpg":
					$img_original=imagecreatefromjpeg($imagen);
					//Reajusto la imagen nueva, respecto a la original
					imagecopyresampled($img_reajustada, $img_original, 0, 0, 0, 0, $nuevo_ancho_img, $nuevo_alto_img, $ancho_img, $alto_img);
					//Guardo la imagen reescalada en el servidor, pasandole como parametro la imagen,ruta y la calidad de jpeg
					$nombre_img_ext="../img/fotos/".$email.$extension;
					$nombre_img="../img/fotos/".$email;
					imagejpeg($img_reajustada,$nombre_img_ext,100);
					//Ejectuto la funcion para borrar posibles imagenes dobles para el perfil
					borrar_imagenes($nombre_img,".jpg");
					break;

				case ".gif":
					$img_original=imagecreatefromgif($imagen);
					//Reajusto la imagen nueva, respecto a la original
					imagecopyresampled($img_reajustada, $img_original, 0, 0, 0, 0, $nuevo_ancho_img, $nuevo_alto_img, $ancho_img, $alto_img);
					//Guardo la imagen reescalada en el servidor, pasandole como parametro la imagen,ruta y la calidad de jpeg
					$nombre_img_ext="../img/fotos/".$email.$extension;
					$nombre_img="../img/fotos/".$email;
					imagegif($img_reajustada,$nombre_img_ext,100);
					//Ejectuto la funcion para borrar posibles imagenes dobles para el perfil
					borrar_imagenes($nombre_img,".gif");
					break;

				case ".png":
					$img_original=imagecreatefrompng($imagen);
					//Reajusto la imagen nueva, respecto a la original
					imagecopyresampled($img_reajustada, $img_original, 0, 0, 0, 0, $nuevo_ancho_img, $nuevo_alto_img, $ancho_img, $alto_img);
					//Guardo la imagen reescalada en el servidor, pasandole como parametro la imagen,ruta y la calidad de jpeg
					$nombre_img_ext="../img/fotos/".$email.$extension;
					$nombre_img="../img/fotos/".$email;
					imagepng($img_reajustada,$nombre_img_ext,9);
					//Ejectuto la funcion para borrar posibles imagenes dobles para el perfil
					borrar_imagenes($nombre_img,".png");
					break;
			}
		

		}
		else
		{
			//No se reajusta y se sube la imagen al servidor. Guardo la ruta q tendra en el servidor
			$destino="../img/fotos/".$email.$extension;
			//Se sube la foto
			move_uploaded_file($imagen,$destino)or die("No se pudo subir la imagen al servidor :(");

			//Ejecuto la funcion para borrar posibles imagenes dobles para el perfil
			$nombre_img="../img/fotos".$email;
			borrar_imagenes($nombre_img,$extension);
		}

		//Asigno el nombre de la foto q se guardara en la BD como cadena de texto
		$imagen=$email.$extension;
		//Retorno el valor del nombre de la imagen
		return $imagen;

	}
	else
	{
		return false;
	}
}

?>