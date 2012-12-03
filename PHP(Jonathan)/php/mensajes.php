<?php
	//Verifico si la variable esta vacia
	if(isset($_GET["mensaje"]))
	{
		$mensaje=$_GET["mensaje"];	
		echo"<br />  <span class='mensajes'> $mensaje </span> <br />";
	}

?>