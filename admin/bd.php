<?php

$servidor="localhost";
$puerto="3307";
$baseDatos="comedor_universitario";
$usuario="root";
$contrasenia="";

try{

    $conexion = new PDO("mysql:host=$servidor;port=$puerto;dbname=$baseDatos",$usuario,$contrasenia);
}catch(Exception $error){
    echo $error->getMessage();
}

?>