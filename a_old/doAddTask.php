<?php

include "config.php";
include "functions.php";
include "DB.php";
include "Task.php";

if(empty($_SESSION["user_id"])){
    echo ShowDialog("Erro", "Necessário Login", "index.php");
}else{
    if(!empty($_POST["title"])){
        $t = new Task();
        $t->create($_POST["title"]);
        $html = ShowDialog("Sucesso", "Tarefa criada com sucesso", "tasks.php");

        echo $html;
    }
}

?>