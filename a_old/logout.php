<?php

include "functions.php";

unset($_SESSION["user_id"]);
unset($_SESSION["user_name"]);
unset($_SESSION["user_email"]);

session_destroy();

$html = ShowDialog("Sucesso", "Logout feito com sucesso", "index.php");

echo $html;

?>