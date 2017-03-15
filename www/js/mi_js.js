/**
* Desarrollado por:
* Carlos Arturo rodriguez
* Jhon Jairo Salazar 
*/
	
		var acumuladorApp = angular.module( 'acumuladorApp', [] );        
        acumuladorApp.controller( "acumuladorAppCtrl",           
            [ "$scope", "$http",
            function( $scope, $http )//inicio de la funcion
            {
            	$scope.cargar_datos_php=function()//inicio de la funcion cargar_datos_php.
					                      
                    {          
		                    
		            		
		            		
		            		//console.log($scope.lista.length);
		            		
		            		var lista=document.getElementById('sintomas');//captura el valor de la lista.
		            		//console.log("esta es la seleccion  "+ lista);  		            		
		            		//&console.log("esta es la cantidad de sintomas seleccones  " +lista.length); 
		            		var salida="";
		            		var cadena="";

		            		for (var i = 0; i < lista.length; i++)//esto se encarga de concatenar la cadena
		            		 {	
			            		   if (lista.item(i).selected) 
			            		   {
				            		   	if (salida!="") 
				            		   	{
				            		   		salida+=","+lista.item(i).value;
				            		   		

				            		   	}else{
				            		   		
				            		   		salida+=lista.item(i).value;
				            		   	}
				            		  

			            		   }                 	
		            		 } 
		            		 console.log(salida);
		            		cadena=salida;
		            		if(cadena.length>0)
		            		{
		            			document.getElementById('carga').innerHTML="<img src='img/carga.gif'>";
		            			$http.get('llamado-php.php?cadena=' + cadena)//aqui se envia el calor de la cadena al php.
    							.then(
    								
    								function (response) 
    									{
    										document.getElementById('carga').innerHTML="";
    										$scope.campos = response.data.records;//aqui se recive la respuesta del php.
    									}
									);
		            			 
		                            console.log("valor que deberia llegar al php  "   + cadena);  
		            		}             
                    }	

					
            	}


            

            ]
         );
	
