
<!--
	Carlos Rodriguez y Jhon Jairo Salazar
	Primer formulario para la instalación de un aplicativo, aunque el aplicativo en sí no existe, solo se mostrará el proceso de instalación.
-->

<html>
	<head>
		<title>Instalador de aplicativo.</title>
		<?php 
		include 'class/BD.php'; //trae las funciones de la pagina BD.php
		$nuevo_obj=new BD();	// llama la clase BD
			echo $nuevo_obj->estilos("bootstrap"); // trae la funcion estilos de la clase
			
	?>
	</head>

	<body>
	<hr>
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-md-12 col-lg-12 well"><h1><center>Bienvenido a la Instalación</center></h1></div>
		</div>
		<div class="row">
	        <div class="col-xs-12 col-md-5 col-lg-5 well">

			

			<form action="instalando.php" method="_get">
			<div class="form-group">
	                <input class="form-control" type="text" name="usuario" placeholder="Usuario" required>
	            </div>
	            <div class="form-group">
	                <input class="form-control" type="text" name="contrasena" placeholder="Contraseña">
	            </div>
	            <div class="form-group">
	                <input class="form-control" type="text" name="servidor" placeholder="Servidor" required>
	            </div>
	            <div class="form-group">
	                <input class="form-control"  type="text" name="bd" placeholder="Base de datos" required> 
	            </div>
	            <button type="submit"  class="btn btn-success btn-lg">Enviar</button>


			</form>
			</div>
			<div class="col-xs-12 col-md-2 col-lg-2"></div>
			<div class="col-xs-12 col-md-5 col-lg-5 "><h3 style="color:red;text-align: justify;">
			A continuaci&oacute;n se proceder&aacute; a instalar un aplicativo, el cual permite observar dicho proceso al detalle.<br><br>
				Sin embargo requiere de que la <strong>base de datos</strong> sea creada con anterioridad. <br><br></h3>
			</div>
		</div>
	</div>
	</body>

</html>
