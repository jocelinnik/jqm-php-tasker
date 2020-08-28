<?php

include "config.php";

$html = "";

if(isset($_GET["a"])){
    switch($_GET["a"]){
        case "test":
            $html = "<h1>Testar conexão com banco de dados</h1>";

            try{
                $pdo = new PDO("mysql:host" . DB_HOST, DB_USER, DB_PASSWORD);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $dbs = $pdo->query("SHOW DATABASES");
                $html .= "Conectou! <br />Bancos encontrados: <ul>";
                while(($db = $dbs->fetchColumn(0))!==false){
                    $html .= "<li>$db</li>";
                }
                $html .= "</ul>";
            }catch(Exception $e){
                $html .= "Não conectou: " . $e->getMessage();
            }

            break;
        case "ct":
            $html = "<h1>Criar Tabelas</h1>";

            try{
                $pdo = new PDO("mysql:host" . DB_HOST, DB_USER, DB_PASSWORD);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql_contents = file_get_contents("database/db.sql");
                $pdo->exec("DROP DATABASE IF EXISTS tasker");
                $pdo->exec($sql_contents);
                $html .= "Tabelas criadas";
            }catch(Exception $e){
                $html .= "Não criou: " . $e->getMessage();
            }

            break;

        case "clean":
            $html = "<h1>Limpar dados das tabelas</h1>";

            try{
                $pdo = new PDO("mysql:host" . DB_HOST, DB_USER, DB_PASSWORD);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $pdo->exec("DELETE FROM tasker.tasks");
                $pdo->exec("DELETE FROM tasker.users");
                $html .= "Registros apagados!";
            }catch(Exception $e){
                $html .= "Não apagou: " . $e.getMessage();
            }

            break;

        case "seedata":
            $html = "<h1>Ver Dados</h1>";

            try{
                $pdo = new PDO("mysql:host" . DB_HOST, DB_USER, DB_PASSWORD);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $html .= "
                    <h2>Users</h2>
                    
                    <table class='table table striped'>
                        <thead>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Email</th>
                            <th>Senha</th>
                        </thead>
                ";
                foreach($pdo->query("SELECT * FROM tasker.users") as $row){
                    $html .= "
                        <tr>
                            <td>{$row[0]}</td>
                            <td>{$row[1]}</td>
                            <td>{$row[2]}</td>
                            <td>{$row[3]}</td>
                        </tr>
                    ";
                }
                $html .= "</table>";

                $html .= "
                    <h2>Tasks</h2>
                    
                    <table class='table table striped'>
                        <thead>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Created</th>
                            <th>Status</th>
                            <th>User ID</th>
                        </thead>
                ";
                foreach($pdo->query("SELECT * FROM tasker.tasks") as $row){
                    $html .= "
                        <tr>
                            <td>{$row[0]}</td>
                            <td>{$row[1]}</td>
                            <td>{$row[2]}</td>
                            <td>{$row[3]}</td>
                            <td>{$row[4]}</td>
                        </tr>
                    ";
                }
                $html .= "</table>";

                $html .= "";
            }catch(Exception $e){
                $html .= "Não leu os dados: " . $e->getMessage();
            }
            break;

        default:
            # code...
            break;
    }
}else{
    $html = "<h1>Bem Vindo!</h1>";

    $html .= "
        <hr />
        <a href='install.php?a=test'>Testar conexão com banco de dados</a><br />
        <a href='install.php?a=ct'>Criar Tabelas</a><br />
        <a href='install.php?a=clean'>Limpar dados de tabelas</a><br />
        <a href='install.php?a=seedata'>Ver dados</a><br />
    ";
}

?>

<html>
<head>
    <meta charset="UTF-8">
    <title>Install</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <?php echo $html; ?>
    </div>
</body>
</html>