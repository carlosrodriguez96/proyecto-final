
	
		var acumuladorApp = angular.module( 'acumuladorApp', [] );        
        acumuladorApp.controller( "acumuladorAppCtrl",           
            [ "$scope", "$http",
            function( $scope, $http )
            {
            	$scope.cargar_datos_php=function()
					                      
                    {          
		                    
		            		
		            		
		            		//console.log($scope.lista.length);
		            		
		            		var lista=document.getElementById('sintomas');
		            		//console.log("esta es la seleccion  "+ lista);  		            		
		            		//&console.log("esta es la cantidad de sintomas seleccones  " +lista.length); 
		            		var salida="";
		            		var cadena="";

		            		for (var i = 0; i < lista.length; i++)
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
		            			$http.get('llamado-php.php?cadena=' + cadena)
    							.then(
    								
    								function (response) 
    									{
    										document.getElementById('carga').innerHTML="";
    										$scope.campos = response.data.records;
    									}
									);
		            			 
		                            console.log("valor que deberia llegar al php  "   + cadena);  
		            		}             
                    }	

					
            	}


            

            ]
         );
	
