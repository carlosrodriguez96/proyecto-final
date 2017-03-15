<?php 
	class Graficos
	{

		function estilos($carpeta=null)
			{
				$salida="";

				$salida=" <link rel='stylesheet'  type='text/css' href='$carpeta/css/bootstrap.css'>
						 <script src='$carpeta/js/jquerymin.js'></script>
						 <script src='$carpeta/js/bootstrap.min.js'></script>";
				return $salida;		 
			}
				/**
			* Esta función se encarga de retornar el encabezado  para que sean impresos desde afuera.
			* El emcabezado debe estar presente en todos los archivos que muestren resultados al usuario. Es decir, en todas las secciones.
			*/
		function encabezado($text,$texp)
			{
				$salida="";
				$salida="<div class='page-header'><h1>$text <small>$texp</small></h1></div>";
				return $salida;

			}
		 function imprimir($texto){

			 	include 'config.php';

			 	 if ($sn_pruebas=="s") {
			 	 	echo "<p class='bg-success' >".$texto."</p>";
			 	 	
			 	 	
			 	 	
			 	 }
			 	 

			 	
			 	
			 }
		
		
	}




 ?>
