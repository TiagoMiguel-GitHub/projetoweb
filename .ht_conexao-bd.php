<?php

$conexao = mysqli_connect("localhost", "root", "", "planoaluga");

if (!$conexao) {
    echo "Não foi possivel ligar à base de dados";

    //echo "</br>" . mysqli_connect_error() . "</br>" .
    //	mysqli_connect_errno();

    exit();
}

mysqli_set_charset($conexao, "utf8");

?>