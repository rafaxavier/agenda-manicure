<?php 
include("conexao.php"); 
session_start();

$cliente=$_POST["cliente"];
$nome_categoria=$_POST["nomeServico"];
$data=$_POST["data"];
$horario=$_POST["horario"];
$forma_pag=$_POST["forma_pagamento"];
$id=$_POST["idlancamentos"];
$idUser=$_SESSION['id'];

//verifica se tem alguma  registro com id passado
$verificaRegistro=mysqli_query($conn, "select HORARIO from movimentacoes where idFINANCAS='$id' ");
$numlinReg= mysqli_num_rows($verificaRegistro);


    
    
    if($numlinReg == 0){
        $verificaHora=mysqli_query($conn, "select * from movimentacoes where DATA='$data' and HORARIO='$horario' ");
        $numHour= mysqli_num_rows($verificaHora);
        if ($numHour ==0){
            $insere=mysqli_query($conn, "insert into movimentacoes (`COD_Usuario`, `CLIENTE`, `CATEGORIA`,`DATA`,`HORARIO`,`FORMA_PAGAMENTO`) 
            VALUES ('$idUser','$cliente','$nome_categoria','$data','$horario','$forma_pag')"); 
        }else {
            echo"<script language='javascript' type='text/javascript'>
                alert('ERRO ao adicionar horário pois o horário escolhido não está disponível!');
                window.location='agendamentos.php';
            </script>";
            exit;
        }
        
        
    }else{
        $verificaHora=mysqli_query($conn, "select * from movimentacoes where DATA='$data' and HORARIO='$horario' and idFINANCAS<>'$id' ");
        $numHour= mysqli_num_rows($verificaHora);

        if ($numHour==0){
            $update=mysqli_query($conn," update movimentacoes  SET COD_Usuario='$idUser', CLIENTE='$cliente', CATEGORIA='$nome_categoria', DATA='$data' ,HORARIO='$horario' ,FORMA_PAGAMENTO='$forma_pag'  where idFINANCAS='$id'");
        }else {
            echo"<script language='javascript' type='text/javascript'>
                alert('ERRO ao atualizar horário pois o horário escolhido não está disponível!');
                window.location='agendamentos.php';
            </script>";
            exit;
        }
            
        
        
        
        
    };


if (mysqli_query($conn, $insere)) {
    header("Location: agendamentos.php");

} elseif(mysqli_query($conn, $update)) {
    header("Location: agendamentos.php");
    
}else {
    header("Location: agendamentos.php");
    echo "Error: " . $insere . "<br>" . mysqli_error($conn);
};

?>
