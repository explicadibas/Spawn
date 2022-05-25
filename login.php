<?php session_start(); ?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset='utf-8'>
        <meta http-equiv='X-UA-Compatible' content='IE=edge'>
        <title>Spawn - Login</title>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
        <script src='main.js'></script>

        <style>
            *{
                margin: 0;
                padding: 0;
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            }

            #containerPrincipal{

            }
            
            body {
                background-image: linear-gradient(0deg, rgba(213,220,255,1) 0%, rgba(242,242,242,1) 100%);
                background-attachment: fixed;
            }

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

            .btn_entrar{
                width: 100%;
				padding: 10px 0;
                background: #0092ff; 
                color: white;
                cursor: pointer;
                margin: 22px auto 0 auto;
                border: none;
            }

            .btn_entrar:hover{
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

            .animacaoCampoVazio::placeholder {
                color: #FF0000;
            }
            
			.Red::placeholder
			{
				color: blue; 
			}


        </style>
    </head>

    <body>
	  <script type="text/javascript">
            function js_animacaoCampoVazio(){
                var email = document.getElementById("email");
                var senha = document.getElementById("senha");
                var formulario = document.getElementById("formulario");

				if (email.value == "") {
                    email.className += "Red";
                }

                if(senha.value == ""){
                    senha.className += "Red";
                }

                if(email.value != "" && senha.value != ""){
                    formulario.submit();
                    alert('O formulário foi enviado');
                }
			};
        </script>

        <?php
            include_once("conexao.inc");
			
			if(!isset($_POST['email'])){
				echo 
                '
                    <div id="containerPrincipal">
                        <div id="containerLogin">
                            <div>
                                <a href="index.php"><img class="center" src="img/Logo.svg" alt="" width="20%"></a>
                            </div>
                        
                            <h2>Entrar</h2>

                            <form method="POST" id="formulario">
                                <div>
                                    <label for="email">E-mail:</label>
                                    <input type="email" name="email" id="email" placeholder="Digite seu e-mail">
                                </div>

                                <div>
                                    <label for="senha">Senha:</label>
                                    <input type="password" name="senha" id="senha" placeholder="Digite sua senha">
                                </div>

                                <p class="cinza"><a class="links" href="#" >Esqueceu a senha?</a></p>
                                
                                <div>
                                    <button type="button" class="btn_entrar btn_entrar" onclick="js_animacaoCampoVazio();">Entrar</button>
                                </div>

                                <p class="cinza" style="margin-top: 5px;">Não possui uma conta?<a href="cadastro.php" class="links"> Criar uma conta</a></p>
                            </form>

                            <script src="script.js"></script>
                        </div>
                    </div>
                ';
			}
           
			if(isset($_POST['email'])){
                $e = $_POST['email'];
                $s = $_POST['senha'];
			
                $sql2 = "SELECT * FROM usuarios WHERE email = '$e' AND senha = '$s'";
             
                $nResultados = mysqli_query($conect,$sql2); 
                $campo = $nResultados->fetch_assoc();
                
                if($campo){
                    $_SESSION['usuario'] = $e;
                } else {
                    unset( $_SESSION['usuario']);
                }
                
                header('location: index.php');
            }
		?>
    </body>
</html>