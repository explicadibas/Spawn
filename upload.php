<?php

include_once("conexao.inc");

$msg = false;

if(isset($_FILES['imagem'])){

    $extensao = strtolower(substr($_FILES['imagem']['name'], -4));
    $novo_nome = md5(time()) . $extensao;
    $diretorio = "upload";

    move_uploaded_file($_FILES['imagem']['tmp_name'], $diretorio.$novo_nome);

    $sql_code = "INSERT INTO imagens (id,imagem, data) VALUES(null, '$novo_nome', NOW())";
     
    $resultado = @mysqli_query($conect, $sql_code);
    
    if ($resultado){
        $msg = "Arquivo enviado com sucesso!";
    } else {
        $msg = "Falha ao enviar o arquivo.";
    }
}
    
?>

<h6>Upload de Arquivos</h6>
<?php 
    if($msg != false)  { 
        echo "<p> $msg </p>"; 
    }
?>


<form action="upload.php" method="POST" enctype="multipart/form-data">
Imagem: <input type="file" required name="imagem">
<input type="submit" value="Salvar">
</form>
