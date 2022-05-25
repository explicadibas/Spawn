<?php session_start() ?>

<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Spawn - Início</title>
        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="../Spawn/estilo.css">

        <!--Add link - ícons-->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    </head>
    	
    <body>
        <div class="container">
            <!-- Page Content goes here -->
        

        <!--------------------------------------------------------------------------------------------------------------------->
                                                    <!--MENU-->
        <nav class="white z-depth-0">
            <div class="nav-wrapper">
                <a href="index.php" class="brand-logo"><img id="Logo_menu"width="80"src="img/Logo.svg"></a>
                <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons icon-black">menu</i></a>
        
                <ul class="left hide-on-med-and-down">
                    <li><a id="padding" class="black-text text-black" href="index.php">Início</a></li>

                    <?php
                        if(!isset($_SESSION['usuario'])){	
                            ?> <li><a class="black-text text-black" href="meDeslogado.php">Minha Empresa</a></li> <?php
                        }
            
                        else{
                            ?> <li><a class="black-text text-black" href="me.php">Minha Empresa</a></li> <?php
                        } 
                    ?>
                    
                    <li><a class="black-text text-black" href="#">Serviços</a></li>
                    <li><a class="black-text text-black" href="#">Novidades</a></li>
                    <li><a class="black-text text-black" href="#">Suporte</a></li>
                </ul>

                <ul class="right">
                    <?php
                        if(!isset($_SESSION['usuario'])){
                    ?>
                        <!-- Para o usuário que não está logado -->
                        <li><a class="black-text text-black" href="#"><a href="login.php"><i class="large material-icons icon-black">person_add</i></a></a></li>
                    <?php
                        }
                        else{
                    ?>
                        <!-- Para o usuário que já está logado -->
                        
                        <li>
                            <a class="black-text text-black dropdown-trigger" data-target="dropdown-menu" href="#">
                                <i class="large material-icons right icon-black">person</i>
                            </a>
                        </li>

                        <div >
                            <ul id="dropdown-menu" class="dropdown-content barra perfilCentro">
                                <li>
                                    <div class="perfil">
                                        <div class="row">                       
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
                                                        #$msg = "Arquivo enviado com sucesso!";
                                                        
                                                        #salvar imagem no usuario
                                                        $e = $_SESSION['usuario'];
                                                        $sql = "UPDATE usuarios SET imgperfil = '$novo_nome' WHERE email = '$e'";            
                                                        $resultado = @mysqli_query($conect,$sql);
                                                        /*var_dump($resultado); */
                                                    
                                                    } else {
                                                        $msg = "Falha ao enviar o arquivo.";
                                                    }
                                                }
                                                    
                                                if($msg != false) { 
                                                        echo "<p> $msg </p>"; 
                                                }
                                                    
                                            ?>
                                            
                                               
                                            <form action="index.php" method="POST" enctype="multipart/form-data">
                                                <input class="" type="file" required name="imagem">
                                                <input class="" type="submit" value="Salvar">
                                            </form>
                                            
                                            <table>
                                                <tr class="linhatabela">
                                                    <td rowspan="2">  
                                                        <?php
                                                            #Busca de imagem do usuario

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
                                                </tr>

                                                <tr class="linhatabela">
                                                    <td style="max-width: 360px;">
                                                        <?php
                                                            #exibição de nome e email
                                                            include_once("conexao.inc");

                                                            $sql2 = "SELECT nome FROM usuarios WHERE email = '$e'";
                                                            $resultado = @mysqli_query($conect, $sql2);
                                                            $campo = $resultado->fetch_assoc();

                                                            $nome = $campo['nome'];
                                                        ?>

                                                            <div class=nome-email>
                                                                <b class=maiusculo><?php echo mb_strimwidth("$nome", 0, 25, "..."); ?></b>
                                                            </div>
                                                            
                                                            <div class=nome-email>
                                                                <?php echo mb_strimwidth("$e", 0, 25, "..."); ?>
                                                            </div>
                                                        
                                                            <form method=POST>
                                                                <input type="submit" name="deslogar" value="Sair da Conta" class="btn-small botaoSairConta">
                                                            </form>
                                                            
                                                            <?php
                                                                if($_POST){
                                                                unset($_SESSION['count']);
                                                                $_SESSION['usuario'] = "";
                                                                $logado = false;
                                                                unset($_SESSION['usuario']);
                                                                session_destroy();

                                                                echo '<script type="text/JavaScript"> location.reload(); </script>';
                                                            }
                                                        ?>
                                                    </td>
                                               
                                                </tr>

                                             
                                            </table>
                                        </div>
                                    </div>     
                                </li>
                                    
                                <form method="POST">             
                                    <?php
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
                            </ul>
                        </div>
                    <?php
                        }
                    ?>
                </ul>
            </div>
        </nav>
    </div>
        
        <!--Mobile-->
        <ul class="sidenav grey lighten-2" id="mobile-demo">
            <li><a href="index.php">Início</a></li>
            <li><a href="me.php">Minha Empresa</a></li>
            <li><a href="#">Serviços</a></li>
            <li><a href="#">Novidades</a></li>
            <li><a href="#">Suporte</a></li>
        </ul>

<!---------------------------------------------------------------------------------------------------------------------------->


<!---------------------------------------------------------------------------------------------------------------------------->

                                                    <!--IMAGEM INICIO-->
        <div class="reuniao">
            <img src="img/reuniao2.jpg" class="responsive-img" class="reuniao">
        </div>

        <div class="texto-apresentacao">
            <blockquote>
                <p class="flow-text">Crie ou entre em empresas oficiais</p>
            </blockquote>
        </div>
        
<!---------------------------------------------------------------------------------------------------------------------------->

        
<!---------------------------------------------------------------------------------------------------------------------------->
        
                                                    <!--BACK CINZA SABER MAIS-->
        <div id="logo-saberMais">
           <div>
                <img class="responsive-img" id="logoClara" src="img/Logo_clara.svg">
            </div>
            
            <table>
                <tr>
                    <td>
                        <div>
                            <p>Aqui você pode criar conosco sua empresa oficial de modo seguro e confiável</p>
                        </div>
                    </td>
                </tr>
    
                <tr>
                    <td>
                        <div id="botaomais" class="card-action center">
                            <a class="black-text waves-effect waves-light btn-large white"><i class="material-icons right icon-black">navigate_next</i><b>Clique para saber mais</b></a>
                            <!--
                                <p><a class="container-saberMais" href="suporte.html">Clique para saber mais</a></p>
                            -->
                        </div>
                    </td>
                </tr>
            </table>                  
        </div>

<!---------------------------------------------------------------------------------------------------------------------------->

<!---------------------------------------------------------------------------------------------------------------------------->        
                                                    <!--Card CRIE empresa-->
    
        <div id="containerIcones" style="margin-bottom: 10p">
            <div class="containerIcones">
                <div>
                    <div class="row ">
                        <div class="col s12 m15">
                            <div class="card z-depth-0">
                                <div class="card-image">
                                    <i class="large material-icons">build</i>
                                    <span class="card-title"></span>
                                </div>
                            
                                <div class="card-content">
                                    <p>Crie sua empresa</p>

                                    <div class="card-content center descricoes">
                                        <span>
                                            Funda, desenvolva e divulgue a sua empresa por meio dos serviços Spawn, tendo acesso a sua empresa em qualquer dispositivo e em qualquer lugar
                                        </span> 
                                    </div>
                                </div>
                                
                                <div class="card-action center">
                                    <a class="waves-effect waves-light btn-small blue"><i class="material-icons right">navigate_next</i>Criar agora</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        
        <!--Card ENTRE empresa-->
            <div>
                <div class="containerIcones">
                    <div class="row ">
                        <div class="col s12 m15">
                          <div class="card z-depth-0">
                            <div class="card-image">
                              <i class="large material-icons">people</i>
                              <span class="card-title"></span>
                            </div>
                            
                            <div class="card-content">
                                <p>
                                    Junte-se a uma empresa
                                </p>

                                <div class="card-content center descricoes">
                                     <span>
                                        Selecione a empresa ideal para você
                                     </span>
                                </div>
                            </div>
                            
                            <div class="card-action center">
                                <a class=" waves-effect waves-light btn-small #616161 grey darken-2"><i class="material-icons right">navigate_next</i>EM BREVE</a>
                            </div>
                            
                          </div>
                        </div>
                      </div>
                </div> 
            </div>
        <!--Card Portfólio-->
            <div>
                <div class="containerIcones">
                    <div class="row ">
                        <div class="col s12 m15">
                          <div class="card z-depth-0">
                            <div class="card-image">
                              <i class="large material-icons">business_center</i>
                              <span class="card-title"></span>
                            </div>
                            
                            <div class="card-content">
                              <p>Divulgue seu portifólio</p>
                            
                            <div class="card-content center descricoes">
                                Aqui você pode divulgar seu portifólio para atrair novas pessoas e oportunidades
                            </div>
                           
                            </div>
                                <div class="card-action center">
                                    <a class=" waves-effect waves-light btn-small #616161 grey darken-2"><i class="material-icons right">navigate_next</i>EM BREVE</a>
                                </div>
                          </div>
                        </div>
                      </div>
                </div> 
            </div>        
        </div>
        <!--ìcones_Fim-->
<!---------------------------------------------------------------------------------------------------------------------------->

<!---------------------------------------------------------------------------------------------------------------------------->

                                                    <!--INÍCIO RODAPÉ-->
    <div id="rodape">
        <div class="clear"></div>

        <footer class="page-footer blue">
            <div class="container">
              <div class="row">
                <div class="col l6 s12">
                  <h5 class="white-text">Política</h5>
                  <p class="grey-text text-lighten-4 termos">
                    Este site foi desenvolvido para a feira tecnológica da ETEC Bartolomeu 
                    Bueno da Silva com o intuito de preescrever fins educacionais
                  </p>
                </div>
                <div class="col l4 offset-l2 s12">
                  <h5 class="white-text">Contatos</h5>
                  <ul>
                    <table>
                        <tr>
                            <td>
                                <li><a class="grey-text text-lighten-3" href="#!"><img src="img/instaicon.png"></a></li>
                            </td>

                            <td>
                                <li><a class="grey-text text-lighten-3 icon" href="#!">Instagram oficial</a></li>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <li><a class="grey-text text-lighten-3" href="#!"><img src="img/instaicon.png"></a></li>
                            </td>

                            <td>
                                <li><a class="grey-text text-lighten-3 icon" href="#!">Instagram pessoal</a></li>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <li><a class="grey-text text-lighten-3" href="#!"><img src="img/faceicon.png"></a></li>
                            </td>

                            <td>
                                <li><a class="grey-text text-lighten-3 icon" href="#!">Facebook oficial</a></li>
                            </td>
                        </tr>
                    </table>
                  </ul>
                </div>
              </div>
            </div>
            <div class="footer-copyright">
              <div class="container">
                © 2021 Spawn - Todos os direitos reservados
              <a class="grey-text text-lighten-4 right" href="#!"><!--More Links--></a>
              </div>
            </div>
          </footer>
    </div>
<!---------------------------------------------------------------------------------------------------------------------------->

    </body>
    <!--body_fim-->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="main.js"></script>

    <script>
        $(document).ready(function(){
            $('.sidenav').sidenav();
        });
    </script>
</html>