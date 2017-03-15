<?php
    /**
    * Desarrollado por:
    * Carlos Arturo rodriguez
    * Jhon Jairo Salazar 
    */
    /**
     * Este php me permite usar el poder del php con un ejemplo de la tecnología AngularJS...
     * incluso desde el administrador de este sitio.
     */
    include'BD.php';
    $nuevo_obj=new BD();    // llama la clase BD
           
     if( isset( $_GET[ 'cadena' ] ) )//se pregunta si llegan valores 
    {     
        $valores=$_GET['cadena'];
        echo  $nuevo_obj->consultar($valores);//funcion que consulta la base de datos
        //echo $sql;
    }
  ?>
