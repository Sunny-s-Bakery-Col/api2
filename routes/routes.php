<?php

$routesArray = explode("/", $_SERVER['REQUEST_URI']);
$routesArray = array_filter($routesArray);

##Ruta inicial

if(count($routesArray) == 0){

    $json = array(
        'status' => 404,
        'result' => "Not found"
    );
    
    echo json_encode($json,  http_response_code($json['status']));
    echo "<pre>"; print_r($_SERVER['REQUEST_METHOD']); echo "</pre>";  
    return;
}

##Rutas y metodos hallados

if(count($routesArray) == 1 && isset($_SERVER['REQUEST_METHOD'])){

    if($_SERVER['REQUEST_METHOD'] == 'GET'){
        
        include "services/get.php";

    }

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $json = array(
            'status' => 200,
            'result' => "Solicitud POST"
        );

        echo json_encode($json,  http_response_code($json['status']));
        echo "<pre>"; print_r($_SERVER['REQUEST_METHOD']); echo "</pre>";  
    }

    if($_SERVER['REQUEST_METHOD'] == 'PUT'){
        $json = array(
            'status' => 200,
            'result' => "Solicitud PUT"
        );

        echo json_encode($json,  http_response_code($json['status']));
        echo "<pre>"; print_r($_SERVER['REQUEST_METHOD']); echo "</pre>";  
    }

    if($_SERVER['REQUEST_METHOD'] == 'PATCH'){
        $json = array(
            'status' => 200,
            'result' => "Solicitud PATCH"
        );

        echo json_encode($json,  http_response_code($json['status']));
        echo "<pre>"; print_r($_SERVER['REQUEST_METHOD']); echo "</pre>";  
    }

    if($_SERVER['REQUEST_METHOD'] == 'DELETE'){
        $json = array(
            'status' => 200,
            'result' => "Solicitud DELETE"
        );

        echo json_encode($json,  http_response_code($json['status']));
        echo "<pre>"; print_r($_SERVER['REQUEST_METHOD']); echo "</pre>";  
    }

    if($_SERVER['REQUEST_METHOD'] == 'HOLA'){
        $json = array(
            'status' => 200,
            'result' => "Solicitud HOLA"
        );

        echo json_encode($json,  http_response_code($json['status']));
        echo "<pre>"; print_r($_SERVER['REQUEST_METHOD']); echo "</pre>";  
    }
}
?>