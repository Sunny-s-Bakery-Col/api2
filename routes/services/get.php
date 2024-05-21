<?php

require_once "controllers/get.controller.php";

$table = explode("?", $routesArray[1])[0];

$select = $_GET["select"] ?? "*";
$orderBy = $_GET["OrderBy"] ?? NULL;
$orderMode = $_GET["OrderMode"] ?? NULL;
$startAt = $_GET["StartAt"] ?? NULL;
$endAt = $_GET["EndAt"] ?? NULL;
$filterTo = $_GET["FilterTo"] ?? NULL;
$inTo = $_GET["InTo"] ?? NULL;

$response = new GetController();


## Selección de datos con filtro

if(isset($_GET["linkTo"]) && isset($_GET["equalTo"]) && !isset($_GET["Rel"]) && !isset($_GET["Type"])){

    $response -> getDatafilter($table, $select, $_GET["linkTo"], $_GET["equalTo"], $orderBy, $orderMode, $startAt, $endAt);

}

## Relaciones sin filtro

else if(isset($_GET["Rel"]) && isset($_GET["Type"]) && $table == 'relations' && !isset($_GET["linkTo"]) && !isset($_GET["equalTo"])){

    $response -> getRelData($_GET["Rel"], $_GET["Type"], $select, $orderBy, $orderMode, $startAt, $endAt);
}

## Relaciones con filtro

else if(isset($_GET["Rel"]) && isset($_GET["Type"]) && $table == 'relations' && isset($_GET["linkTo"]) && isset($_GET["equalTo"])){

    $response -> getRelDataFilter($_GET["Rel"], $_GET["Type"], $select, $_GET["linkTo"], $_GET["equalTo"], $orderBy, $orderMode, $startAt, $endAt);
}

## Buscador sin relaciones

else if(isset($_GET["linkTo"]) && isset($_GET["Search"]) && !isset($_GET["Rel"]) && !isset($_GET["Type"])){

    $response -> getDataSearch($table, $select, $_GET["linkTo"], $_GET["Search"], $orderBy, $orderMode, $startAt, $endAt);

}

## Buscador con relaciones

else if(isset($_GET["Rel"]) && isset($_GET["Type"]) && $table == 'relations' && isset($_GET["linkTo"]) && isset($_GET["Search"])){

    $response -> getRelDataSearch($_GET["Rel"], $_GET["Type"], $select, $_GET["linkTo"], $_GET["Search"], $orderBy, $orderMode, $startAt, $endAt);

}

## Selección de rangos

else if(isset($_GET["linkTo"]) && isset($_GET["Between1"]) && isset($_GET["Between2"]) && !isset($_GET["Rel"]) && !isset($_GET["Type"])){

    $response -> getDataRange($table, $select, $_GET["linkTo"], $_GET["Between1"], $_GET["Between2"], $orderBy, $orderMode, $startAt, $endAt, $filterTo, $inTo);

}

## Selección de rangos con relaciones

else if(isset($_GET["linkTo"]) && isset($_GET["Between1"]) && isset($_GET["Between2"]) && isset($_GET["Rel"]) && isset($_GET["Type"]) && $table == 'relations'){

    $response -> getRelDataRange($_GET["Rel"], $_GET["Type"], $select, $_GET["linkTo"], $_GET["Between1"], $_GET["Between2"], $orderBy, $orderMode, $startAt, $endAt, $filterTo, $inTo);

}

## Seleccion de datos sin filtro

else{

    $response -> getData($table, $select, $orderBy, $orderMode, $startAt, $endAt);

}


?>