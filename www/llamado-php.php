<?php

    /**
     * Este php me permite usar el poder del php con un ejemplo de la tecnología AngularJS...
     * incluso desde el administrador de este sitio.
     */
    include'class/BD.php';
    $nuevo_obj=new BD();    // llama la clase BD
           
     if( isset( $_GET[ 'cadena' ] ) )
    {     
        $valores=$_GET['cadena'];
        echo  $nuevo_obj->consultar($valores);
        //echo $sql;
    }
    if (isset($_GET['busqueda'])) {
        if ($_GET['busqueda']!="") {
           
            echo  $nuevo_obj->consulta();
        }
         
    }
  ?>
