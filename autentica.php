<?php session_start();

include('conexao.php');
# Validar os dados do usuário

$usuario = $_POST['login'];
$senha = $_POST['senha'];

$sql = mysqli_query($conn,"select * from usuario where login='$usuario' and senha='$senha'") or die("Erro");

if(mysqli_num_rows ($sql) > 0 )
{ 
  $dados= mysqli_fetch_assoc($sql);
  $_SESSION['id'] = $dados['COD_Usuario'];
  $_SESSION['login'] = $dados['login'];
  $_SESSION['path_avatar'] = $dados['path_avatar'];

 

header('location:agendamentos.php');
exit;
}
else{
  unset ($_SESSION['login']);
  unset ($_SESSION['senha']);
  echo"<script language='javascript' type='text/javascript'>
  alert('Usuário ou senha inválidos!');
  window.location='index.php';
</script>";

  exit;
   
 }




?>


