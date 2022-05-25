<?php session_start(); ?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset='utf-8'>
        <meta http-equiv='X-UA-Compatible' content='IE=edge'>
        <title>Spawn - Cadastre-se!</title>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
        <script src='main.js'></script>

        <style>
            *{
                margin: 0;
                padding: 0;
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            }
            
            body {
                background-image: linear-gradient(0deg, rgba(213,220,255,1) 0%, rgba(242,242,242,1) 100%);
                background-attachment: fixed;
            }

            p{
                font-size: 0.7em;
                text-indent: 10px;
            }

            .links {
                text-decoration: none;
                color:#0271c7;
            }

            .links:hover {
                color:#4DACFF;
            }

            .cinza {
                color: #707070;
            }

            .menorIdadeNaoPodeCriarConta{
                top: 0; bottom: 0; left: 0; right: 0;

                position: fixed;
                margin: auto;
                width: 340px;
                height: 150px;
                border: 1px solid gray;
                background: #FFF;
                color: #FFF;
                display: block;
                box-shadow: 5px 10px 15px #BBB;
                opacity: 0;
                transform: translateY(1rem);
                animation: slideup 0.5s forwards;
            }

            .botaoPopup {
                margin: 30px auto 0 auto;
                display: block;
                text-decoration: none;
                color: #FFF;
                text-align: center;
                width: 300px;
                height: 30px;
                padding-top: 5px;
                background: #0092ff;
            }

            .botaoPopup:hover {
                background: #4DACFF;
            }
            
            .textopopup {
                color: black;
                width: 88%;
                margin: 0 auto 0 auto;
                text-align: center;
                font-size: 20px;
                display: block;
            }

            .textopopup2 {
                color: black;
                width: 88%;
                margin: 0 auto 0 auto;
                text-align: center;
                font-size: 20px;
                display: block;
                padding-top: 10px;
            }

            @keyframes slideup {
                to {
                    transform: initial;
                    opacity: initial;
                }
            }
        </style>
    </head>

    <body>
        <div class="menorIdadeNaoPodeCriarConta">
            <p class=textopopup2>Para acessar esta página, é necessário estar cadastrado</p>
            <a class=botaoPopup href=cadastro.php>Cadastrar-se</a>
        </div>

        
    </body>
</html>