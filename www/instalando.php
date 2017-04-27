<?php

	/**
	* Autor (s): carlos rodriguez, jhon jairo salazar
	* Este programa creará una base de datos con todos sus componentes. La prueba sería usar este script y después mirar 
	* que efectivamente exportándola y creando el gráfico del modelo entidad relación, todos sus componentes estén ahí.
	*
	* En este programa se usan tanto la programación estructurada, como las funciones y la POO.
	*/

	include( "class/BD.php" ); //Se incluye la clase verificador, la idea es no hacer este código más grande.
	$objeto_verificador = new BD(); //Se crea la instancia de la clase verificador.

	define( "NUMERO_DE_TABLAS", 2 ); //Se define el número de tablas que se va a crear. 

	$contador_variables_llegada = 0; 
	$cadena_informe_instalacion = ""; 
	$interrupcion_proceso = 0;
	$imprimir_mensajes_prueba = 0;  //Usar valores 0 o 1, solo para el programador.
	$tmp_nombre_objeto_o_tabla = "";

	$mensaje1 = "Es posible que la tabla o el objeto ya esté creada(o), por favor reinicie la instalación con una base de datos vacía.";

	if( isset( $_GET[ 'servidor' ] ) ) 		$contador_variables_llegada ++;
	if( isset( $_GET[ 'usuario' ] ) ) 		$contador_variables_llegada ++;
	if( isset( $_GET[ 'contrasena' ] ) ) 	$contador_variables_llegada ++;
	if( isset( $_GET[ 'bd' ] ) ) 			$contador_variables_llegada ++;

	if( $imprimir_mensajes_prueba == 1 ) echo "<br>Llegaron ".$contador_variables_llegada." variables.";
	
	//Tienen que llegar cuatro variables para poder dar continuación al proceso de instalación.
	if( $contador_variables_llegada >= 3 && $contador_variables_llegada <= 4 ) // Super if - inicio
	{
		if( $imprimir_mensajes_prueba == 1 ) echo "<br>Entrando al bloque de instalaci&oacute;n.";

		//Se realiza una sola conexión para la ejecución de todas las consultas SQL.-------------------------------
		//$conexion = @mysqli_connect( $_GET[ 'servidor' ], $_GET[ 'usuario' ], $_GET[ 'contrasena' ], $_GET[ 'bd' ] ); //Linea anterior, salía error de conexión.
		$conexion = @mysqli_connect( $_GET[ 'servidor' ], $_GET[ 'usuario' ], $_GET[ 'contrasena' ], $_GET[ 'bd' ] ); //Ojo, con el arroba no sale el mensaje de error.

		if( !$conexion ) //Verificamos que la conexion esté establecida preguntando si hay error o conexión no existe.
		{
			$interrupcion_proceso = 1; //Si pasa a este bloque, la conexión no se ha establecido, quiere decir que activaremos la variable de interrupción.
			$cadena_informe_instalacion .= "<br>Error: no se ha podido establecer una conexión con la base de datos. ";

		}else{

				//echo "1 fds<br>".$objeto_verificador->mostrar_tablas( $conexion, 2 );

				if( $objeto_verificador->mostrar_tablas( $conexion, 2 ) != 0 ) //Aquí se verifica que no hayan tablas existentes.
				{
					//echo "2 fds<br>";

					echo "Ya hay tablas creadas, por favor cree una base de datos nueva.<br>"; 
					$interrupcion_proceso = 1;
				}
			}

		
		if( $interrupcion_proceso == 0 ) //Si esta variable cambia, la instalación será interrumpida para cada bloque sql.
		{
			$tmp_nombre_objeto_o_tabla = "tb_palabras_claves";

				  $sql="CREATE TABLE IF NOT EXISTS $tmp_nombre_objeto_o_tabla ("
			      	  ."id_palabra int(11) NOT NULL AUTO_INCREMENT,"
				  ."palabras varchar(100) NOT NULL,"
				  ."PRIMARY KEY (id_palabra)"
				  .") ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1";

			      
			
			
				

			
			//echo $sql;
			$resultado = $conexion->query( $sql );

			//Si se creó la tabla, el sistema cargará los datos pertienentes del informe.
			if( $objeto_verificador-> verificar_existencia_tabla( $tmp_nombre_objeto_o_tabla, $_GET[ 'servidor' ], $_GET[ 'usuario' ], $_GET[ 'contrasena' ], $_GET[ 'bd' ], $imprimir_mensajes_prueba ) == 1 )
			{
				$cadena_informe_instalacion .= "<br>La tabla $tmp_nombre_objeto_o_tabla se ha creado con éxito.";	

			}else{
					$cadena_informe_instalacion .= "<br>Error: La tabla $tmp_nombre_objeto_o_tabla no se ha creado. ".$mensaje1;	
					$interrupcion_proceso = 1;
				}
		}
		if( $interrupcion_proceso == 0 ) //Si esta variable cambia, la instalación será interrumpida para cada bloque sql.
		{
			$tmp_nombre_objeto_o_tabla = "tb_consultas";

	                  $sql="CREATE TABLE IF NOT EXISTS $tmp_nombre_objeto_o_tabla ("
			      ."id_consulta int(11) NOT NULL,consulta varchar(500) NOT NULL,"
			      ."respuesta varchar(5000) NOT NULL,"
			      ."url varchar(100) NOT NULL,"
			      ."id_palabra int(11) NOT NULL,"
			      ."PRIMARY KEY (id_consulta),"
			      ."KEY index_palabra (id_palabra),"
			      ."CONSTRAINT tb_consultas_ibfk_1 FOREIGN KEY (id_palabra) REFERENCES tb_palabras_claves (id_palabra) ON DELETE CASCADE ON UPDATE CASCADE"
			      .") ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1";
			      
			
			
				

			
			//echo $sql;
			$resultado = $conexion->query( $sql );

			//Si se creó la tabla, el sistema cargará los datos pertienentes del informe.
			if( $objeto_verificador-> verificar_existencia_tabla( $tmp_nombre_objeto_o_tabla, $_GET[ 'servidor' ], $_GET[ 'usuario' ], $_GET[ 'contrasena' ], $_GET[ 'bd' ], $imprimir_mensajes_prueba ) == 1 )
			{
				$cadena_informe_instalacion .= "<br>La tabla $tmp_nombre_objeto_o_tabla se ha creado con éxito.";	

			}else{
					$cadena_informe_instalacion .= "<br>Error: La tabla $tmp_nombre_objeto_o_tabla no se ha creado. ".$mensaje1;	
					$interrupcion_proceso = 1;
				}
		}

		if( $interrupcion_proceso == 0 ) //Si esta variable cambia, la instalación será interrumpida para cada bloque sql.
		{
			$tmp_nombre_objeto_o_tabla = "tb_enfermedades";

			//El sistema procederá a crear la primera tabla si no existe.
			$sql=" CREATE TABLE IF NOT EXISTS $tmp_nombre_objeto_o_tabla ( "
				 ."id_enfermedad int(10) NOT NULL AUTO_INCREMENT,"
				 ."enfermedad varchar(100) NOT NULL,"
				 ."recomendaciones varchar(100) NOT NULL,"
				 ."PRIMARY KEY (id_enfermedad)"
				.") ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1";
		
			

			$resultado = $conexion->query( $sql );

			//Si se creó la tabla, el sistema cargará los datos pertienentes del informe.
			if($objeto_verificador-> verificar_existencia_tabla( $tmp_nombre_objeto_o_tabla, $_GET[ 'servidor' ], $_GET[ 'usuario' ], $_GET[ 'contrasena' ], $_GET[ 'bd' ], $imprimir_mensajes_prueba ) == 1 )
			{
				$cadena_informe_instalacion .= "<br>La tabla $tmp_nombre_objeto_o_tabla se ha creado con éxito.";	

			}else{
					$cadena_informe_instalacion .= "<br>Error: La tabla $tmp_nombre_objeto_o_tabla no se ha creado. ".$mensaje1;	
					$interrupcion_proceso = 1;
				}
		}
		if( $interrupcion_proceso == 0 ) //Si esta variable cambia, la instalación será interrumpida para cada bloque sql.
		{
			$tmp_nombre_objeto_o_tabla = "tb_sintomas";

			//El sistema procederá a crear la primera tabla si no existe.
				$sql=" CREATE TABLE IF NOT EXISTS $tmp_nombre_objeto_o_tabla ( "
				 ."id_sintomas int(10) NOT NULL AUTO_INCREMENT,"
				 ."sintoma varchar(30) NOT NULL,"
				 ."PRIMARY KEY (id_sintomas)"
				.") ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1";

		
			

			$resultado = $conexion->query( $sql );

			//Si se creó la tabla, el sistema cargará los datos pertienentes del informe.
			if($objeto_verificador-> verificar_existencia_tabla( $tmp_nombre_objeto_o_tabla, $_GET[ 'servidor' ], $_GET[ 'usuario' ], $_GET[ 'contrasena' ], $_GET[ 'bd' ], $imprimir_mensajes_prueba ) == 1 )
			{
				$cadena_informe_instalacion .= "<br>La tabla $tmp_nombre_objeto_o_tabla se ha creado con éxito.";	

			}else{
					$cadena_informe_instalacion .= "<br>Error: La tabla $tmp_nombre_objeto_o_tabla no se ha creado. ".$mensaje1;	
					$interrupcion_proceso = 1;
				}
		}

		if( $interrupcion_proceso == 0 ) //Si esta variable cambia, la instalación será interrumpida para cada bloque sql.
		{
			$tmp_nombre_objeto_o_tabla = "tb_informe";

			//El sistema procederá a crear la primera tabla si no existe.
				
				/* ."id_sintomas int(10) NOT NULL AUTO_INCREMENT,"
				 ."sintoma varchar(30) NOT NULL,"
				 ."PRIMARY KEY (id_sintomas)"
				.") ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1";*/
				$sql=" CREATE TABLE IF NOT EXISTS $tmp_nombre_objeto_o_tabla ( "
					 ." id_informe int(10) NOT NULL,"
					  ."id_enfermedad int(10) NOT NULL,"
					  ."id_sintomas int(11) NOT NULL,"
					  ."PRIMARY KEY (id_informe),"
					."KEY index_enfermdad (id_enfermedad),"
					 ."KEY index_sintoma (id_sintomas),"
					 ."CONSTRAINT tb_informe_ibfk_1 FOREIGN KEY (id_enfermedad) REFERENCES tb_enfermedades (id_enfermedad) ON DELETE CASCADE ON   UPDATE CASCADE,"
					 ."CONSTRAINT tb_informe_ibfk_2 FOREIGN KEY (id_sintomas) REFERENCES tb_sintomas (id_sintomas) ON DELETE CASCADE ON UPDATE CASCADE"
					.") ENGINE=InnoDB DEFAULT CHARSET=latin1";

		
			

			$resultado = $conexion->query( $sql );

			//Si se creó la tabla, el sistema cargará los datos pertienentes del informe.
			if($objeto_verificador-> verificar_existencia_tabla( $tmp_nombre_objeto_o_tabla, $_GET[ 'servidor' ], $_GET[ 'usuario' ], $_GET[ 'contrasena' ], $_GET[ 'bd' ], $imprimir_mensajes_prueba ) == 1 )
			{
				$cadena_informe_instalacion .= "<br>La tabla $tmp_nombre_objeto_o_tabla se ha creado con éxito.";	

			}else{
					$cadena_informe_instalacion .= "<br>Error: La tabla $tmp_nombre_objeto_o_tabla no se ha creado. ".$mensaje1;	
					$interrupcion_proceso = 1;
				}
		}

		
		if( $interrupcion_proceso == 0 )
		{
			unlink('config.php');//Elimina el archivo config.php
			$archivo = fopen('config.php', "a");//Abrimos un nuevo config.
			fwrite($archivo , '<?php
			//Este es el archivo que contiene la configuración de mi bd.
							
				$servidor = "'.$_GET[ 'servidor' ].'";
				$usuario = "'.$_GET[ 'usuario' ].'";
				$clave = "'.$_GET[ 'contrasena' ].'";
				$bd = "'.$_GET[ 'bd' ].'";
				$sn_pruebas="n";//ver sql
				$sn_pruebas_log="n";//ver sql

			?> '); // agregamos un texto al config.
			fclose($archivo); //Cerramos archivo config.php
			
			//ojo aquí se usa la clase verificadora para imprimir lo que se ha creado.
			echo $objeto_verificador->mostrar_tablas( $conexion ); //Hay que recordar que la conexión ya se creó arriba.

			echo "Se han creado ".$objeto_verificador->mostrar_tablas( $conexion, 2 )." tablas de ".NUMERO_DE_TABLAS." que se deb&iacute;an crear.  ";
			
			echo "<br><br>";
			echo "<a href='borrando_archivos.php' target='_self'>Proceder a borrar archivos de intalaci&oacute;n</a>";
			echo "<br><br>";
		}
		
		echo $cadena_informe_instalacion; //Se imprime un sencillo informe de la instalación.

		}else{ 									// Super if - else 
			echo "<br>Por favor ingresa el valor de los campos solicitados: Servidor, usuario, base de datos.<br>";
		} 									// Super if - final

	
	

?>
