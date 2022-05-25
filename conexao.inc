<?php
    $host = "localhost";
    $username = "root";
    $password = "";
    $dbName = "spawn";
    $table = "usuarios";

    $conect = @mysqli_connect($host, $username, $password, $dbName)
    or die("Problemas com a conexão com o banco de dados");
?>