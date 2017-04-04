<!--  
* /**
* Desarrollado por:
* Carlos Arturo rodriguez
* Jhon Jairo Salazar 
*/
 -->

<html lang="ES" ng-app="acumuladorApp">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<head>
	<title>PetVet</title>


	<script type="text/javascript" src="js/angular.min.js"></script>
	<meta charset="utf-8">
	<?php 
		include 'class/BD.php'; //trae las funciones de la pagina BD.php
		$nuevo_obj=new BD();	// llama la clase BD
			echo $nuevo_obj->estilos("bootstrap"); // trae la funcion estilos de la clase
	?>
</head>
<body>
	<div class="container">
	<div ng-controller="acumuladorAppCtrl">		
		<div class="row">
			<?php  echo $nuevo_obj->encabezado("Diagnóstico","de enfermedades"); ?> 
		</div>
		
		
		<div class="row" id="cont-preg" >
			<div class="col-xs-12 col-md-3 col-lg-4">
				<input type='text' class='form-control' id='usrname' placeholder='Ingrese Búsqueda' ng-model='busqueda' ng-change='consulta()'>
			</div>
			<div class="col-xs-12 col-md-3 col-lg-4"></div>
			<div class="col-xs-12 col-md-3 col-lg-7"></div>
			<div class="col-xs-12 col-md-1 col-lg-1">
				<a href="index.php"><button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-home"></span> Volver</button></a>
			</div>
		</div>
		<div class="row" ng-repeat="x in campos" >
		
		<br>
			<div class="col-xs-12 col-md-3 col-lg-2">
				<h3>{{x.consulta}}</h3>
			</div>
			<div class="col-xs-12 col-md-3 col-lg-2" style="text-align: justify;">
				{{x.Descripcion}}
			</div>
			<div class="col-xs-12 col-md-3 col-lg-8">
				<img src="{{x.Imagen}}" class="img-responsive">
			</div>

		</div>
		

		</div>
	</div>
	<script type="text/javascript" src="js/mi_js.js"></script>
	<script type="text/javascript"></script>
	
	



</body>
</html>

