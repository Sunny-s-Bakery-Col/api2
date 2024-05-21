<?php 

class Connection {

    static public function InfoDB() {
        $InfoDB = array(
            
            'host' => "api.com",
            'Database' => "api",
            'User' => "root",
            'Pass' => ""

        );

        return $InfoDB;
    }

    static public function connect(){
        try{

            $link = new PDO("mysql:host=".Connection::InfoDB()["host"].";dbname=".Connection::InfoDB()["Database"],
            Connection::InfoDB()["User"],
            Connection::InfoDB()["Pass"]
        );

        $link->exec("set names utf8");

        }
        catch(PDOException $e){
            die("Error: ".$e->getMessage());
        }

        return $link;
    }

    static public function getColumnsData($table) {

        $database = Connection::InfoDB()["Database"];

        return Connection::connect()
        ->query("SELECT COLUMN_NAME AS item FROM information_schema.columns WHERE table_schema = '$database' AND table_name = '$table'")
        ->fetchAll(PDO::FETCH_OBJ);

    }
}

?>