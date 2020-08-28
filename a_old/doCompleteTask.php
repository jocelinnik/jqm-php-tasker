<?php

include "config.php";
include "functions.php";
include "DB.php";
include "Task.php";

$id = $_GET["taskId"];

header("Content-Type: application/json");

try{
    $t = new Task();
    $t->completeTask($id);

    header("HTTP/1.0 200 Ok");

    echo "{result: 'ok'}";
}catch(\Exception $e){
    header("HTTP/1.0 500 Error");

    echo "{error: '{$e->getMessage()}'}";
}

?>