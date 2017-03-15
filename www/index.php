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
	<title></title>
	<script src="js/angular.min.js"></script>
	<meta charset="utf-8">
	<?php 
		include 'class/BD.php'; //trae las funciones de la pagina BD.php
		$nuevo_obj=new BD();	// llama la clase BD
			echo $nuevo_obj->estilos("bootstrap"); // trae la funcion estilos de la clase
	?>
</head>
<body>
	<div class="container-fluid">
	<div ng-controller="acumuladorAppCtrl">		
		<div class="row">
			<?php  echo $nuevo_obj->encabezado("Diagnostico","de enfermedades"); ?> 
		</div>
		<div class="row">
			<div class="col-xs-12 col-md-3 col-lg-3 ">
				
              
				<center>
				
				<?php 	
					echo $nuevo_obj->traer_informacion("sintoma","tb_sintomas","id_sintomas","sintoma","get","ver.php"); // trae la información a mostrar.
				?>
                </center>

				  
			</div>	
			<div class="col-xs-12 col-md-8 col-lg-8 ">
			<center><div id="carga"> </div></center>
			<div ng-repeat="x in campos">
			<?php 	
					echo $nuevo_obj->imprimir("{{x.abc}}"); // trae la información a mostrar.

				?>
		 	 
            <table class="table table-hover table-bordered">
                <thead>
                  <tr>
                    <th>Enfermedad Posible</th>
                    <th>Sintomas en esta Enfermedad</th>
                    <th>Sintomas encontrados</th>
                  </tr>
                </thead>
                 <tbody>
                  <tr>
                    <td>{{ x.Enfermedad }}</td>
                    <td>{{ x.conteo_total }}</td>
                    <td>{{ x.conteo_sintomas }}</td>

                  </tr>
                  </tbody>
            </table>      
                                  
        </div>
				 
			</div>
		</div>
		</div>
	</div>
	<script type="text/javascript" src="js/mi_js.js"></script>
	
	 


</body>
</html>

