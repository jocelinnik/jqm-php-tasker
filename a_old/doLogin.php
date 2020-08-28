<?php

include "config.php";
include "functions.php";
include "DB.php";
include "User.php";

if(!empty($_POST["email"]) && !empty($_POST["password"])){
    $email = $_POST["email"];
    $password = $_POST["password"];

    $u = new User();
    $user = $u->checkLogin($email, $password);
    if($user){
        $_SESSION["user_id"] = $user->id;
        $_SESSION["user_name"] = $user->name;
        $_SESSION["user_email"] = $user->email;

        $html = ShowDialog("Sucesso", "Olá {$user->name}, você logou com sucesso", "tasks.php");

        echo $html;
    }else{
        $html = ShowDialog("Erro", "Email/senha incorretos", "index.php");

        echo $html;
    }
}else{
    $html = ShowDialog("Erro", "Preencha o email/senha", "index.php");

    echo $html;
}

?>