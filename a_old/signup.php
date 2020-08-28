<?php

include "config.php";
include "functions.php";
include "DB.php";
include "User.php";

$errorMessage = "";

if(!empty($_POST["name"]) && !empty($_POST["email"]) && !empty($_POST["password"])){
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    try{
        $u = new User();
        $u->create($name, $email, $password);
        $html = ShowDialog("Sucesso", "Cadastro realizado com sucesso", "index.php");

        echo $html;
    }catch(\Exception $e){
        $errorMessage = $e->getMessage();
    }
}

?>

<div data-role="page">
    <div data-role="header">
        <a href="index.php" class="ui-btn" data-rel="back">Voltar</a>
        <h1>Cadastro</h1>
    </div>

    <div data-role="content">
        <i style="color: red;"><?php echo $errorMessage; ?></i>

        <form action="signup.php" method="post">
            <div class="ui-field-contain">
                <label for="name">Nome:</label>
                <input type="text" name="name" id="name" value="<?php echo $_POST['name']; ?>">
            </div>
            <div class="ui-field-contain">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" value="<?php echo $_POST['email']; ?>">
            </div>
            <div class="ui-field-contain">
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" value="<?php echo $_POST['password']; ?>">
            </div>

            <input type="submit" value="Enviar">
        </form>
    </div>
</div>