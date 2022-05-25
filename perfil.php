<?php session_start() ?>

<!DOCTYPE html>

    <!-- 
        DUVIDAS

            PERFIL DE USUARIO - Busca de imagem da tabela usuário, para seu perfil salvo anteriormente ser exibido automaticamente
                                a variavel $campo está em array, logo não está reconhecendo.

            PopUp na index.php
    -->

<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Perfil de Usuário</title>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="../Spawn/estilo.css ">
    </head>

    <body style="background-color: gray;">
        <div class="perfil">
            <div class="row">
                <div class="col s25 m7">
                    <div class="card white darken-1">
                        <div class="card-content black-text">
                            <span class="card-title center">
                                <h3>Meu perfil</h3>
                                
                                <a href="#"><i class="material-icons right icon-black">close</i></a>
                                
                                <?php
                                /* Receber imagem padrão de perfil */
                                $novo_nome = "./upload/teste2.jpg";
                                /* Conexão com Banco + Receber email */
                                include_once("conexao.inc");
                                $e = $_SESSION['usuario'];
                                

                                /* Variavel de mensagem de aviso */
                                $msg = false;
                               
                               
                                /* Enviar imagem */ 
                                if(isset($_FILES['imagem'])){
                                    $extensao = strtolower(substr($_FILES['imagem']['name'], -4));
                                    $novo_nome = md5(time()) . $extensao;
                                    $diretorio = "upload/";
                                
                                    move_uploaded_file($_FILES['imagem']['tmp_name'], $diretorio.$novo_nome);
                                    /* Adicionar a imagem no banco */
                                    $sql_code = "INSERT INTO imagens (id,imagem, data) VALUES(null, '$novo_nome', NOW())";
                                    $resultado = @mysqli_query($conect, $sql_code);
                                    
                                    /*Enviar mensagem*/
                                    if ($resultado){
                                        $msg = "Arquivo enviado com sucesso!";
                                        
                                        #salvar imagem no usuario
                                        $e = $_SESSION['usuario'];
                                        $sql = "UPDATE usuarios SET imgperfil = '$novo_nome' WHERE email = '$e'";            
                                        $resultado = @mysqli_query($conect,$sql);
                                        /*var_dump($resultado); */
                                    
                                    } else {
                                        $msg = "Falha ao enviar o arquivo.";
                                    }
                                }
                                    if($msg != false)  { 
                                        echo "<p> $msg </p>"; 
                                }
                                    
                                ?>
                                
                                <!-- Botões de escolher arquivo e enviar -->
                                <form action="perfil.php" method="POST" enctype="multipart/form-data">

                                    <input type="file" required name="imagem">
                                    <input type="submit" value="Salvar">
                                </form>
                                
                                
                                <!--
                                    Recado para ♥ Ricardão ♥
                                    Não consigo remover as bordas dessa tabela 
                                -->
                                <table>
                                    <tr>
                                        <td rowspan="3">  
                                            <?php
                                                
                                             
                                                
                                                #Busca de imagem do usuario ****INCOMPLETO****

                                                $sql_busca = "SELECT imgperfil FROM usuarios WHERE email='$e'";
                                                $result = mysqli_query($conect, $sql_busca);
                                                $campo = $result->fetch_assoc();
                                                
                                                $imgperfil = $campo['imgperfil'];                                              

                                                #exibir imagem
                                                
                                                if($imgperfil == ""){
                                                    echo "<img class=imgperfil src=../Spawn/upload/teste2.jpg>";
                                                } else {
                                                    echo "<img class=imgperfil src=../Spawn/upload/$imgperfil>";

                                                    
                                                }          
                                            ?>
                                        </td>
                                            
                                        <td>
                                            <?php
                                                #Puxar email para exibir o nome
                                                include_once("conexao.inc");

                                                $sql2 = "SELECT nome FROM usuarios WHERE email = '$e'";
                                                $resultado = @mysqli_query($conect, $sql2);
                                                $campo = $resultado->fetch_assoc();

                                                $nome = $campo['nome'];

                                                echo 
                                                "
                                                    <div class=nome-email>
                                                        Nome: $nome
                                                    </div>
                                                ";
                                            ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <?php
                                                #exibição do email
                                                include_once("conexao.inc");

                                                echo 
                                                "
                                                    <div class=nome-email>
                                                        E-mail: $e
                                                    </div>
                                                ";
                                            ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <form method="POST">
                                                <input type="submit" name="deslogar" value="Sair da Conta" class="btn-small botaoSairConta blue">
                                                <!--<a class="waves-effect waves-light btn-small botaoSairConta blue">Sair da Conta</a>-->

                                                <?php
                                                    #destruição da sessão por meio do botão "Sair da Conta"
                                                    if($_POST){
                                                        unset($_SESSION['count']);
                                                        $_SESSION['usuario'] = "";
                                                        $logado = false;
                                                        unset($_SESSION['usuario']);
                                                        session_destroy();

                                                        echo "Você encerrou a sessão";

                                                        header('location: index.php');
                                                    }
                                                ?>
                                            </form>   
                                        </td>
                                    </tr>
                                </table>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</html>