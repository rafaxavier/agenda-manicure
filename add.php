<?php
include('conexao.php');
session_start();
if ((!isset($_SESSION['login']) == true) and (!isset($_SESSION['senha']) == true)) {
  session_destroy(); # Destruir todas as sessões do navegador
  unset($_SESSION['login']);
  unset($_SESSION['senha']);
  unset($_SESSION['path_avatar']);
  header('location:naoAutenticado.php');
  exit;
} else {

    $insertCat=$_POST["insertCat"];
    
    $nomeCat=strtoupper($_POST["nome"]);
  
    $valorCat=$_POST["valor"];

if($insertCat == "nova_categoria" ){
    $verificaCat=mysqli_query($conn, "select * FROM categoria where SERVICO='$nomeCat' ");
    $numlin= mysqli_num_rows($verificaCat);
    if($numlin == 0){
        $insCat=mysqli_query($conn, "insert into `categoria`  (`SERVICO`,`VALOR` ) VALUES 
        ('$nomeCat', '$valorCat' )") or die("Erro");
        header("Location: config.php");
    }else{
        echo "categoria já existe";
    }
}else{
    $parametro=$_POST["parametro"];
    $verificaFPG=mysqli_query($conn, "select  $parametro FROM forma_pagamento ");
    $numlin= mysqli_num_rows($verificaFPG);
    if($numlin == 0){
        $insCat=mysqli_query($conn, "insert into `forma_pagamento`  (`FORMA_PAGAMENTO`) VALUES 
        ('$parametro')") or die("Erro");
    header("Location: config.php");

    }else{
        echo "forma de pagamento já existe";
    }

}

}
?>