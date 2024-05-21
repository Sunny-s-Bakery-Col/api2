<?php

require_once "models/get.model.php";

class GetController {

    ## GET de datos sin filtro

    static public function getData($table, $select, $orderBy, $orderMode, $startAt, $endAt) {

        $response = GetModel::getData($table, $select, $orderBy, $orderMode, $startAt, $endAt);
        
        $return = new GetController();
        $return -> fncResponse($response);
    }

    ## GET de datos con filtro

    static public function getDataFilter($table, $select, $link, $equal, $orderBy, $orderMode, $startAt, $endAt) {

        $response = GetModel::getDataFilter($table, $select, $link, $equal, $orderBy, $orderMode, $startAt, $endAt);
        
        $return = new GetController();
        $return -> fncResponse($response);
    }

    ## GET de relaciones de datos sin filtro

    static public function getRelData($rel, $type, $select, $orderBy, $orderMode, $startAt, $endAt) {

        $response = GetModel::getRelData($rel, $type, $select, $orderBy, $orderMode, $startAt, $endAt);
        
        $return = new GetController();
        $return -> fncResponse($response);
    }

    ## GET de relaciones de datos con filtro

    static public function getRelDataFilter($rel, $type, $select, $link, $equal, $orderBy, $orderMode, $startAt, $endAt) {

        $response = GetModel::getRelDataFilter($rel, $type, $select, $link, $equal, $orderBy, $orderMode, $startAt, $endAt);
        
        $return = new GetController();
        $return -> fncResponse($response);
    }

    ## GET para el buscador sin relaciones

    static public function getDataSearch($table, $select, $link, $equal, $search, $orderMode, $startAt, $endAt) {

        $response = GetModel::getDataSearch($table, $select, $link, $equal, $search, $orderMode, $startAt, $endAt);
        
        $return = new GetController();
        $return -> fncResponse($response);
    }

    ## GET para el buscador con relaciones

    static public function getRelDataSearch($rel, $type, $select, $link, $search, $orderBy, $orderMode, $startAt, $endAt) {

        $response = GetModel::getRelDataSearch($rel, $type, $select, $link, $search, $orderBy, $orderMode, $startAt, $endAt);
        
        $return = new GetController();
        $return -> fncResponse($response);
    }

    static public function getDataRange($table, $select, $link, $between1, $between2, $orderBy, $orderMode, $startAt, $endAt, $filterTo, $inTo) {

        $response = GetModel::getDataRange($table, $select, $link, $between1, $between2, $orderBy, $orderMode, $startAt, $endAt, $filterTo, $inTo);
        
        $return = new GetController();
        $return -> fncResponse($response);
    }

    static public function getRelDataRange($rel, $type, $select, $link, $between1, $between2, $orderBy, $orderMode, $startAt, $endAt, $filterTo, $inTo) {

        $response = GetModel::getRelDataRange($rel, $type, $select, $link, $between1, $between2, $orderBy, $orderMode, $startAt, $endAt, $filterTo, $inTo);
        
        $return = new GetController();
        $return -> fncResponse($response);
    }

    ## Respuesta del servidor a la petición

    public function fncResponse($response) {
        if(!empty($response)){
            $json = array(

                'status' => 200,
                'total' => count($response),
                'results' => $response

            );
        }

        else {

            $json = array(

                'status' => 404,
                'results' => 'Resource not found'

            );

        }

        echo "<pre>". json_encode($json, http_response_code($json['status'])). "</pre>";
    }
}

?>