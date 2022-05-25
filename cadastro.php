<?php session_start() ?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset='utf-8'>
        <meta http-equiv='X-UA-Compatible' content='IE=edge'>
        <title>Spawn - Cadastro</title>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
        <script src='main.js'></script>

        <script type="text/javascript">
            function fecharPopUp(){
                document.getElementById('menorIdadeNaoPodeCriarConta').style.display = 'none';
            }
        </script>

        <style>
            *{
                margin: 0;
                padding: 0;
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            }

            #containerPrincipal{

            }
            
            body{
                background-image: linear-gradient(0deg, rgba(213,220,255,1) 0%, rgba(242,242,242,1) 100%);
                background-attachment: fixed;
            }

            /*COMEÇO TESTE*/
            .s-hidden{
                visibility:hidden;
                padding-right:10px;
            }

            .select{
                cursor:pointer;
                display:inline-block;
                position:relative;
                font:normal 11px/22px Arial, Sans-Serif;
                color:black;
                border:1px solid #ccc;
            }

            .styledSelect{
                position:absolute;
                top:0;
                right:0;
                bottom:0;
                left:0;
                background-color:white;
                padding:0 10px;
                font-weight:bold;
            }

            .styledSelect:after{
                content:"";
                width:0;
                height:0;
                border:5px solid transparent;
                border-color:black transparent transparent transparent;
                position:absolute;
                top:9px;
                right:6px;
            }

            .styledSelect:active, .styledSelect.active{
                background-color:#eee;
            }

            .option{
                display:none;
                position:absolute;
                top:100%;
                right:0;
                left:0;
                z-index:999;
                margin:0 0;
                padding:0 0;
                list-style:none;
                border:1px solid #ccc;
                background-color:white;
                -webkit-box-shadow:0 1px 2px rgba(0, 0, 0, 0.2);
                -moz-box-shadow:0 1px 2px rgba(0, 0, 0, 0.2);
                box-shadow:0 1px 2px rgba(0, 0, 0, 0.2);
            }
            /*FIM TESTE*/

            #containerLogin{
                background: #FFF;
                width: 70%/*414*/;
                max-width: 414px;
                margin: 120px auto 0 auto;
                padding: 25px;     
            }

            h2{
                text-align: center;
            }

            label{
                display: block;
                font-weight: 600;
            }

            input{
                width: 100%;
                padding: 10px 0;
                background-color: #E9E9E9;
                border: 0px solid;
                margin: 4px auto 5px auto;
                text-indent: 10px;
            }

            input.submit{
                width: 100%;
                background: #0092ff; 
                color: white;
                cursor: pointer;
                margin: 22px auto 0 auto;
            }

            .submit:hover{
                background: #4DACFF;
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

            select{
                width: 100%;
                padding: 10px 0;
                background-color: #E9E9E9;
                border: none;
                margin: 4px auto 5px auto;
                text-indent: 10px;
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

            input.popUp{
                cursor: pointer;
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
        <div id="containerPrincipal">
            <div id="containerLogin">
                <div>
                    <a href="index.php"><img class="center" src="img/Logo.svg" alt="" width="20%"></a>
                </div>
                
                <h2>Entrar</h2>

                <form method="POST">
                    <div>
                        <label for="nome">Nome:</label>
                        <input type="text" name="nome" id="nome" placeholder="Digite seu nome">
                    </div>

                    <div>
                        <label for="idade">Idade:</label>
                        <select name="idade">

                            <?php
                                $idade = -18;

                                while($idade <= 120)
                                {
                                    if($idade == -18){
                                        echo "<option value=".$idade.">$idade</option>";
                                        $idade = 18;
                                    }

                                    echo "<option value=".$idade.">$idade</option>";
                                    $idade++;
                                }
                            ?>
			            </select>

                        <!--<input type="text" name="idade" id="idade" placeholder="Digite sua idade">-->
                    </div>

                   <div>
                        <label for="email">E-mail:</label>
                        <input type="email" name="email" id="email" placeholder="Digite seu e-mail">
                    </div>

                    <div>
                        <label for="senha">Senha:</label>
                        <input type="password" name="senha" id="senha" placeholder="Digite sua senha">
                    </div>

                    <p class="cinza"><a class="links" href="#">Esqueceu a senha?</a></p>
                    
                    <div>
                        <input class="submit" type="submit" value="Criar">
                    </div>

                    <p class="cinza" style="margin-top: 5px;">Já possui uma conta?<a href="login.php" class="links"> Entrar em sua conta</a></p>
               </form>
            </div>

            <?php
                if(!empty($_POST)){
                    include_once("conexao.inc");

                    $nome = $_POST["nome"];
                    $idade = $_POST["idade"];

                    if($idade == -18)
                    {                    
                        echo
                        "
                            <div id=menorIdadeNaoPodeCriarConta class=menorIdadeNaoPodeCriarConta>
                    
                                Menores de idade não podem criar uma conta   
                        ";        
                        
                        ?>
                        <!--FECHA O PHP-->
                        <p class="textopopup">Menores de idade não podem
                                                        criar uma conta</p>
                        <a class="botaoPopup" href="javascript: fecharPopUp();">Fechar</a>
                       
                        <!--ABRE O PHP-->
                        <?php        
                            
                        echo
                        "
                            </div>
                        ";
                        exit;
                    }

                    $email = $_POST["email"];
                    $senha = $_POST["senha"];

                    $sql = "INSERT INTO $table (nome, idade, email, senha) VALUES ('$nome', '$idade', '$email', '$senha')";

                    $resultado = @mysqli_query($conect, $sql);
                    
                    if(!$resultado){
                        die('Query inválida: '. @mysqli_error($conect));
                    }
                    else{
                        $_SESSION['usuario'] = $email;

                        echo
                        "
                            <div class=menorIdadeNaoPodeCriarConta>
                                <p class=textopopup2>Sua conta foi registrada com sucesso!</p>
                                <a class=botaoPopup href=index.php>Fechar</a>
                            </div>
                        ";

                        mysqli_close($conect);
                        exit;
                    }
                }
            ?>
        </div>
    </body>
</html>