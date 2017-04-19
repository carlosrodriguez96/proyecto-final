<?php

    /**
    * 
    * Este código borra los archivos de la instalación y redirige al sitio. 
    */

    include( "class/BD.php" );
    $objeto_verificador = new BD();

    $objeto_verificador->borrar_archivo( "instalador.php" );
    $objeto_verificador->borrar_archivo( "instalando.php" );
    header( "location: index.php" );