<?php

require_once "connection.php";

class GetModel {

    ## GET de datos sin filtro

    static public function getData($table, $select, $orderBy, $orderMode, $startAt, $endAt) {

        if(empty(Connection::getColumnsData($table))){
            return null;
        }

        $sql = "SELECT $select FROM $table";

        if ($orderBy != NULL && $orderMode != NULL && $startAt == NULL && $endAt == NULL){
            $sql = "SELECT $select FROM $table ORDER BY $orderBy $orderMode";
        }

        if ($orderBy != NULL && $orderMode != NULL && $startAt != NULL && $endAt != NULL){
            $sql = "SELECT $select FROM $table ORDER BY $orderBy $orderMode LIMIT $startAt, $endAt";
        }

        if ($orderBy == NULL && $orderMode == NULL && $startAt != NULL && $endAt != NULL){
            $sql = "SELECT $select FROM $table LIMIT $startAt, $endAt";
        }

        $stmt = Connection::connect()->prepare($sql);
        $stmt -> execute();

        return $stmt -> fetchAll(PDO::FETCH_CLASS);
    }

    ## GET de datos con filtro

    static public function getDataFilter($table, $select, $link, $equal, $orderBy, $orderMode, $startAt, $endAt) {

        if(empty(Connection::getColumnsData($table))){
            return null;
        }

        $linkToArray = explode(',', $link);

        $equalToArray = explode('_', $equal);

        $linkToText = "";

        if(count($linkToArray)>1){

            foreach($linkToArray as $key => $value) {
                
                if($key > 0){
                    $linkToText .= "AND ".$value." = :".$value." ";
                }

            }

        }

        $sql = "SELECT $select FROM $table WHERE $linkToArray[0] = :$linkToArray[0] $linkToText";

        if ($orderBy != NULL && $orderMode != NULL && $startAt == NULL && $endAt == NULL){
            $sql = "SELECT $select FROM $table WHERE $linkToArray[0] = :$linkToArray[0] $linkToText ORDER BY $orderBy $orderMode";
        }

        if ($orderBy != NULL && $orderMode != NULL && $startAt != NULL && $endAt != NULL){
            $sql = "SELECT $select FROM $table WHERE $linkToArray[0] = :$linkToArray[0] $linkToText ORDER BY $orderBy $orderMode LIMIT $startAt, $endAt";
        }

        if ($orderBy == NULL && $orderMode == NULL && $startAt != NULL && $endAt != NULL){
            $sql = "SELECT $select FROM $table WHERE $linkToArray[0] = :$linkToArray[0] $linkToText LIMIT $startAt, $endAt";
        }

        $stmt = Connection::connect()->prepare($sql);

        foreach ($linkToArray as $key => $value) {

            $stmt -> bindParam(":".$value, $equalToArray[$key], PDO::PARAM_STR);

        }

        $stmt -> execute();

        return $stmt -> fetchAll(PDO::FETCH_CLASS);
    }

    ## GET de relaciones de datos sin filtro

    static public function getRelData($rel, $type, $select, $orderBy, $orderMode, $startAt, $endAt) {

        $relArray = explode(",", $rel);
        $typeArray = explode(",", $type);
        $innerJoinText = "";

        if(count($relArray)>1){

            foreach ($relArray as $key => $value) {

                if(empty(Connection::getColumnsData($value))){
                    return null;
                }

                if ($key > 0){
                    
                    $innerJoinText .= "INNER JOIN ".$value." ON ".$relArray[0].".id_".$typeArray[$key]."_".$typeArray[0]." = ".$value.".id_".$typeArray[$key]." ";

                }

            }

        }


        $sql = "SELECT $select FROM $relArray[0] $innerJoinText";

        if ($orderBy != NULL && $orderMode != NULL && $startAt == NULL && $endAt == NULL){
            $sql = "SELECT $select FROM $relArray[0] $innerJoinText ORDER BY $orderBy $orderMode";
        }

        if ($orderBy != NULL && $orderMode != NULL && $startAt != NULL && $endAt != NULL){
            $sql = "SELECT $select FROM $relArray[0] $innerJoinText ORDER BY $orderBy $orderMode LIMIT $startAt, $endAt";
        }

        if ($orderBy == NULL && $orderMode == NULL && $startAt != NULL && $endAt != NULL){
            $sql = "SELECT $select FROM $relArray[0] $innerJoinText LIMIT $startAt, $endAt";
        }

        $stmt = Connection::connect()->prepare($sql);
        $stmt -> execute();

        return $stmt -> fetchAll(PDO::FETCH_CLASS);
    }

    ## GET de relaciones de datos con filtro

    static public function getRelDataFilter($rel, $type, $select, $link, $equal, $orderBy, $orderMode, $startAt, $endAt) {

        $linkToArray = explode(',', $link);

        $equalToArray = explode('_', $equal);

        $linkToText = "";

        if(count($linkToArray)>1){

            foreach($linkToArray as $key => $value) {
                
                if($key > 0){
                    $linkToText .= "AND ".$value." = :".$value." ";
                }

            }

        }


        $relArray = explode(",", $rel);
        $typeArray = explode(",", $type);
        $innerJoinText = "";

        if(count($relArray)>1){

            foreach ($relArray as $key => $value) {

                if(empty(Connection::getColumnsData($value))){
                    return null;
                }

                if ($key > 0){
                    
                    $innerJoinText .= "INNER JOIN ".$value." ON ".$relArray[0].".id_".$typeArray[$key]."_".$typeArray[0]." = ".$value.".id_".$typeArray[$key]." ";

                }

            }

        }


        $sql = "SELECT $select FROM $relArray[0] $innerJoinText WHERE $linkToArray[0] = :$linkToArray[0] $linkToText";

        if ($orderBy != NULL && $orderMode != NULL && $startAt == NULL && $endAt == NULL){
            $sql = "SELECT $select FROM $relArray[0] $innerJoinText WHERE $linkToArray[0] = :$linkToArray[0] $linkToText ORDER BY $orderBy $orderMode";
        }

        if ($orderBy != NULL && $orderMode != NULL && $startAt != NULL && $endAt != NULL){
            $sql = "SELECT $select FROM $relArray[0] $innerJoinText WHERE $linkToArray[0] = :$linkToArray[0] $linkToText ORDER BY $orderBy $orderMode LIMIT $startAt, $endAt";
        }

        if ($orderBy == NULL && $orderMode == NULL && $startAt != NULL && $endAt != NULL){
            $sql = "SELECT $select FROM $relArray[0] $innerJoinText WHERE $linkToArray[0] = :$linkToArray[0] $linkToText LIMIT $startAt, $endAt";
        }

        $stmt = Connection::connect()->prepare($sql);

        foreach ($linkToArray as $key => $value) {

            $stmt -> bindParam(":".$value, $equalToArray[$key], PDO::PARAM_STR);

        }

        $stmt -> execute();

        return $stmt -> fetchAll(PDO::FETCH_CLASS);
    }

    ## GET de busqueda sin relaciones

    static public function getDataSearch($table, $select, $link, $search, $orderBy, $orderMode, $startAt, $endAt) {

        $linkToArray = explode(',', $link);

        $searchToArray = explode('_', $search);

        $linkToText = "";

        if(count($linkToArray)>1){

            foreach($linkToArray as $key => $value) {
                
                if($key > 0){
                    $linkToText .= "AND ".$value." = :".$value." ";
                }

            }

        }


        $sql = "SELECT $select FROM $table WHERE $linkToArray[0] LIKE '%$searchToArray[0]%' $linkToText";

        if ($orderBy != NULL && $orderMode != NULL && $startAt == NULL && $endAt == NULL){
            $sql = "SELECT $select FROM $table WHERE $linkToArray[0] LIKE '%$searchToArray[0]%' $linkToText ORDER BY $orderBy $orderMode";
        }

        if ($orderBy != NULL && $orderMode != NULL && $startAt != NULL && $endAt != NULL){
            $sql = "SELECT $select FROM $table WHERE $linkToArray[0] LIKE '%$searchToArray[0]%' $linkToText ORDER BY $orderBy $orderMode LIMIT $startAt, $endAt";
        }

        if ($orderBy == NULL && $orderMode == NULL && $startAt != NULL && $endAt != NULL){
            $sql = "SELECT $select FROM $table WHERE $linkToArray[0] LIKE '%$searchToArray[0]%' $linkToText LIMIT $startAt, $endAt";
        }

        $stmt = Connection::connect()->prepare($sql);

        foreach ($linkToArray as $key => $value) {

            if($key > 0){

                $stmt -> bindParam(":".$value, $searchToArray[$key], PDO::PARAM_STR);

            }

        }

        $stmt -> execute();

        return $stmt -> fetchAll(PDO::FETCH_CLASS);

    }

    ## GET de busqueda con relaciones

    static public function getRelDataSearch($rel, $type, $select, $link, $search, $orderBy, $orderMode, $startAt, $endAt) {

        $linkToArray = explode(',', $link);

        $searchToArray = explode('_', $search);

        $linkToText = "";

        if(count($linkToArray)>1){

            foreach($linkToArray as $key => $value) {
                
                if($key > 0){
                    $linkToText .= "AND ".$value." = :".$value." ";
                }

            }

        }

        $relArray = explode(",", $rel);
        $typeArray = explode(",", $type);
        $innerJoinText = "";

        if(count($relArray)>1){

            foreach ($relArray as $key => $value) {

                if(empty(Connection::getColumnsData($value))){
                    return null;
                }

                if ($key > 0){
                    
                    $innerJoinText .= "INNER JOIN ".$value." ON ".$relArray[0].".id_".$typeArray[$key]."_".$typeArray[0]." = ".$value.".id_".$typeArray[$key]." ";

                }

            }

        }


        $sql = "SELECT $select FROM $relArray[0] $innerJoinText WHERE $linkToArray[0] LIKE '%$searchToArray[0]%' $linkToText";

        if ($orderBy != NULL && $orderMode != NULL && $startAt == NULL && $endAt == NULL){
            $sql = "SELECT $select FROM $relArray[0] $innerJoinText WHERE $linkToArray[0] LIKE '%$searchToArray[0]%' $linkToText ORDER BY $orderBy $orderMode";
        }

        if ($orderBy != NULL && $orderMode != NULL && $startAt != NULL && $endAt != NULL){
            $sql = "SELECT $select FROM $relArray[0] $innerJoinText WHERE $linkToArray[0] LIKE '%$searchToArray[0]%' $linkToText ORDER BY $orderBy $orderMode LIMIT $startAt, $endAt";
        }

        if ($orderBy == NULL && $orderMode == NULL && $startAt != NULL && $endAt != NULL){
            $sql = "SELECT $select FROM $relArray[0] $innerJoinText WHERE $linkToArray[0] LIKE '%$searchToArray[0]%' $linkToText LIMIT $startAt, $endAt";
        }

        $stmt = Connection::connect()->prepare($sql);

        foreach ($linkToArray as $key => $value) {

            if($key > 0){

                $stmt -> bindParam(":".$value, $searchToArray[$key], PDO::PARAM_STR);

            }

        }

        $stmt -> execute();

        return $stmt -> fetchAll(PDO::FETCH_CLASS);

    }

    static public function getDataRange($table, $select, $link, $between1, $between2, $orderBy, $orderMode, $startAt, $endAt, $filterTo, $inTo) {

        $filter = "";

        if($filterTo != NULL && $inTo != NULL){

            $filter = 'AND '.$filterTo.' IN ('.$inTo.')';

        }

        $sql = "SELECT $select FROM $table WHERE $link BETWEEN '$between1' AND '$between2'";

        if ($orderBy != NULL && $orderMode != NULL && $startAt == NULL && $endAt == NULL){
            $sql = "SELECT $select FROM $table WHERE $link BETWEEN '$between1' AND '$between2' $filter ORDER BY $orderBy $orderMode";
        }

        if ($orderBy != NULL && $orderMode != NULL && $startAt != NULL && $endAt != NULL){
            $sql = "SELECT $select FROM $table WHERE $link BETWEEN '$between1' AND '$between2' $filter ORDER BY $orderBy $orderMode LIMIT $startAt, $endAt";
        }

        if ($orderBy == NULL && $orderMode == NULL && $startAt != NULL && $endAt != NULL){
            $sql = "SELECT $select FROM $table WHERE $link BETWEEN '$between1' AND '$between2' $filter LIMIT $startAt, $endAt";
        }

        $stmt = Connection::connect()->prepare($sql);
        $stmt -> execute();

        return $stmt -> fetchAll(PDO::FETCH_CLASS);

    }

    static public function getRelDataRange($rel, $type, $select, $link, $between1, $between2, $orderBy, $orderMode, $startAt, $endAt, $filterTo, $inTo) {

        $filter = "";

        if($filterTo != NULL && $inTo != NULL){

            $filter = 'AND '.$filterTo.' IN ('.$inTo.')';

        }

        $relArray = explode(",", $rel);
        $typeArray = explode(",", $type);
        $innerJoinText = "";

        if(count($relArray)>1){

            foreach ($relArray as $key => $value) {

                if(empty(Connection::getColumnsData($value))){
                    return null;
                }

                if ($key > 0){
                    
                    $innerJoinText .= "INNER JOIN ".$value." ON ".$relArray[0].".id_".$typeArray[$key]."_".$typeArray[0]." = ".$value.".id_".$typeArray[$key]." ";

                }

            }

        

            $sql = "SELECT $select FROM $relArray[0] $innerJoinText WHERE $link BETWEEN '$between1' AND '$between2'";

            if ($orderBy != NULL && $orderMode != NULL && $startAt == NULL && $endAt == NULL){
                $sql = "SELECT $select FROM $relArray[0] $innerJoinText WHERE $link BETWEEN '$between1' AND '$between2' $filter ORDER BY $orderBy $orderMode";
            }

            if ($orderBy != NULL && $orderMode != NULL && $startAt != NULL && $endAt != NULL){
                $sql = "SELECT $select FROM $relArray[0] $innerJoinText WHERE $link BETWEEN '$between1' AND '$between2' $filter ORDER BY $orderBy $orderMode LIMIT $startAt, $endAt";
            }

            if ($orderBy == NULL && $orderMode == NULL && $startAt != NULL && $endAt != NULL){
                $sql = "SELECT $select FROM $relArray[0] $innerJoinText WHERE $link BETWEEN '$between1' AND '$between2' $filter LIMIT $startAt, $endAt";
            }

            $stmt = Connection::connect()->prepare($sql);
            $stmt -> execute();

            return $stmt -> fetchAll(PDO::FETCH_CLASS);
        }

        else {
            return null;
        }

    }
}

?>