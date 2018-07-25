<?php
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
header('Content-Type: application/json');

$parametro = $_GET['opcion'];

function conectar_basedatos(){
    $usuario = "usuario";
    $password = "clave";
    $db = new PDO('mysql:host=localhost;dbname=tabla', $usuario, $password);
    return $db;
}

function error($mensaje){
    $respuesta = array(
        "tipo" => "error",
        "msj" => $mensaje
    );
    return $respuesta;
}

function listar_companya(){
    
    $companyas = array();
    try {
        $db = conectar_basedatos();
        foreach($db->query('SELECT * from company') as $fila) {
            $companya = array(
                "id" => $fila['id'],
                "sector" => $fila['sector'],
                "nombre" => $fila['nombre'],
                "fecha" => $fila['fecha']
            );
            array_push($companyas, $companya);
        }
        
    } catch (PDOException $e) {
        return error($e->getMessage());
    }    
    
    return $companyas;
}

function calcular_precio(){
    try{
    $precio = array(
        "precio" => "200",
        "fecha" => "2018-01-01"
    );
    } catch (Exception $e){
        return error($e->getMessage());
    }
    return $precio;
}

if($parametro=='listar_companyas'){
    echo json_encode(listar_companya());    
}elseif ($parametro == 'calcular_precio') {
    echo json_encode(calcular_precio());
}else{
    echo json_encode(error("No se ha especificado parametro"));
}
?>