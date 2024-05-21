<?php

ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', "D:/xampp/htdocs/MVC API/API1/php_error_log");

require_once "models/connection.php";

require_once "controllers/routes.controller.php";

$index = new RoutesController;
$index->index();

?>