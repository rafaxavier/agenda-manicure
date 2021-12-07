<?php include('conexao.php');

$nome = $_POST['nome'];
$cpf = $_POST['cpf'];
$email = $_POST['email'];
$login = $_POST['login'];
$senha = $_POST['senha'];




// verifica se o nome de usuario ja existe no banco (login)
$query =mysqli_query($conn ,"select * from usuario");
$array = mysqli_fetch_array($query);
$logarray = $array['login'];
$cpfarray = $array['cpf'];
 
  
      if($logarray == $login || $cpfarray == $cpf ){
        echo"<script language='javascript' type='text/javascript'>
                alert('Esse login ou Cpf já existe');
                window.location='index.php';
            </script>";
        
      }else{
        $query =mysqli_query($conn ,"select * from usuario");
        $insert = mysqli_query($conn ,"insert into usuario (`cpf`,`nome`,`login`,`senha`,`email`) VALUES ('$cpf','$nome','$login','$senha','$email')") or die("Erro") ;
         
        if($insert){
        echo"<script language='javascript' type='text/javascript'>
                alert('Cadastro efetuado com sucesso!!');
                window.location='index.php';
            </script>";
        }else{
        echo"<script language='javascript' type='text/javascript'>
                alert('Não foi possível cadastrar esse usuário');
                window.location='index.php';
            </script>";
          
        }
      }
    
?>