<?php 
/**
* Desarrollado por:
* Carlos Arturo rodriguez
* Jhon Jairo Salazar 
*/

include 'Graficos.php';
class BD extends Graficos

	{

		public $conexion; //variable publica



		/**
		*esta funcion es el constructor.			
		*/


		function BD ()
		{
			$this->conexion=$this->crear_conexion();
			//echo "nacio la clase BD";


		}

		/**
		*esta funcion se encarga de crear la conexion con el servidor.			
		*@return 		caracteres 		retorna mysqli_connect.
		*/


		 function crear_conexion ()
		 {
		 	include('config.php');
		 	return mysqli_connect($servidor,$usuario,$clave,$bd);


		 }

		 /**
		*esta funcion se encarga realizar la consulta en la tabla.
		*
		*@param 		texto 			Es el nombre de la tabla.
		*@param 		texto 			campo clave.
		*@param 		texto 			campo a buscar.	
		*@return 		caracteres 		retorna la consulta.
		*/

		 function consultar_tablas($campo_a_mostrar,$sql_antes=null)

		 {
		 	
		 	$sql = "SELECT $sql_antes $campo_a_mostrar from tb_enfermedades ,tb_sintomas , tb_informe where tb_informe.id_enfermedad=tb_enfermedades.id_enfermedad and tb_informe.id_sintomas=tb_sintomas.id_sintomas";
		 	//echo $sql;
		 	//if($sn_pruebas=="s") echo "<div>".$sql."</div>";
		 	$resultado = $this->conexion->query( $sql );	
		 	return $resultado;
		 }
		  /**
		*esta funcion se encarga de traer los datos de la tabla.
		*
		*@param 		texto 			resultado de la busqueda.
		*@param 		texto 			Nombre de las columnas.
		*@return 		caracteres 		retorna la tabla.
		*/

		 function leer_campo ($resultado,$th)

		 {
				 	$salida = 
				 "<table class='table-bordered table-striped'>
				<thead>
		      <tr>
		       $th
		      </tr>
		    </thead>";
		    $salida .= "<tr>";
		 	while( $fila = mysqli_fetch_array( $resultado ) )
			{

				for( $i = 0; $i < mysqli_num_fields( $resultado ); $i ++ )
				$salida .="<td>".$fila[ $i ]."</td>";
				$salida .= "</tr>";

			}
			$salida .= "</table>";

			return $salida;	
		 }

		 /**
		 *esta funcion se encarga de traer la informacion en pantalla
		 *
		 *@param 		texto 			nombra la lista.
		 *@param 		texto 			nombre de la lista.
		 *@param 		texto 			llave primaria de un campo.
		 *@param 		texto 			campo a mostrar.
		 *@param 		texto 			metodo.
		 *@param 		texto 			envio de informacion.
		 *@param 		caracteres		retorna la informacion.
		 */
		 function traer_informacion( $nombre_lista, $tabla, $campo_llave_primaria, $campo_a_mostrar,$method,$action )
		{
		

		$salida = "";
			include 'config.php';
		//------------SQL Se traen datos----------------------------------------------------
		$sql = "SELECT * FROM  $tabla ";	
			if($sn_pruebas=="s") echo "<h3><p class='bg-success'>$sql</p></h3>";
		$resultado = $this->conexion->query( $sql );

		$salida = "<SELECT  id='sintomas' ng-model='lista' ng-change='cargar_datos_php()' multiple size='20' class='form-control'>";
								$contador=0;
							while( $fila = mysqli_fetch_assoc( $resultado ) )
							{
									
									
								$salida .=
									 "<tr>
									 	<td>
										 
											<option value='".$fila[ $campo_llave_primaria ]."'>".$fila[ $campo_a_mostrar ]."</option>

										</td>
									 </tr>";
									
							}
							
							
		$salida .=" </tbody>
					</table>
					<input type='hidden'  >
					
				 ";

		return $salida;	


		}
	 	/**
		*esta funcion se encarga realizar la consulta en la tabla.
		*
		*@param 		texto 			Es el nombre de la tabla.
		*@param 		texto 			campo clave.
		*@param 		texto 			campo a buscar.	
		*@return 		caracteres 		retorna la consulta.
		*/

		 function consultar($valores)

		 {
		 	
		 		
		 	include( "config.php" );
        	
		        /*Esta conexión se realiza para la prueba con angularjs*/
		        header("Access-Control-Allow-Origin: *");
		        header("Content-Type: application/json; charset=UTF-8");
		        
		        $conn = new mysqli( $servidor, $usuario, $clave, $bd );
		        
		        //Se busca principalmente por alias.
		     		$sql = "SELECT tb_enfermedades.enfermedad , COUNT(tb_informe.id_enfermedad) as conteo_sintomas , (SELECT COUNT(tb_informe.id_enfermedad) conteo_total FROM tb_informe where tb_enfermedades.id_enfermedad = tb_informe.id_enfermedad GROUP BY id_enfermedad) as conteo_total FROM tb_informe , tb_enfermedades WHERE tb_informe.id_enfermedad = tb_enfermedades.id_enfermedad AND tb_informe.id_sintomas in($valores) GROUP BY tb_informe.id_enfermedad";
				 	//echo $sql;
		        //LA tabla que se cree debe tener la tabla aquí requerida, y los campos requeridos abajo.
		       
		       	//$this->imprimir($sql);
		        $result = $this->conexion->query( $sql );	
		        
		        $outp = "";
		       
		        
		        while($rs = $result->fetch_array( MYSQLI_ASSOC )) 
		        {
		            //Mucho cuidado con esta sintaxis, hay una gran probabilidad de fallo con cualquier elemento que falte.
		            if ($outp != "") {$outp .= ",";}
		            $outp .= '{"Enfermedad":"'.utf8_encode($rs["enfermedad"]).'",';            // <-- La tabla MySQL debe tener este campo.
		            $outp .= '"conteo_sintomas":"'.$rs["conteo_sintomas"].'",';         // <-- La tabla MySQL debe tener este campo.
		           	$outp .= '"abc":"'.$sql.'",';
		            $outp .= '"conteo_total":"'.$rs["conteo_total"].'"}';     // <-- La tabla MySQL debe tener este campo.
		            
		          
		        }
		        
		        $outp ='{"records":['.$outp.']}';
		        $conn->close();
		        
		        return $outp;
		 	//echo $sql;
		 
		 	
		 	//return $sql;

		 }

		 
		
		 	
		 	
		 

		
	}
		 

 ?>
