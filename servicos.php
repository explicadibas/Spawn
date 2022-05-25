<?php session_start(); ?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Spawn - Serviços</title>
        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="estilo.css">
    </head>

    <body>
        <?php
			var_dump($_SESSION);

			if(!isset($_SESSION['usuario'])){	
				echo "Você não está logado. Clique <a href='login.php'>aqui</a> para logar.";
			}

            else{
				echo "Você está logado!";
			}
        ?>
    </body>
</html>