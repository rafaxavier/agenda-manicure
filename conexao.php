<?php 

$host="localhost"; //host tem q vir primeiro , caso contrario conexão falha
$user="root";
$pass=" "; //essa senha talvez esteja diferente no servidor
$db="agenda";

//Cria conexao
$conn=mysqli_connect($host, $user, $pass, $db);

// Checa conexao
/*if (!$conn) {
    die("Falha na conexão ao servidor " . mysqli_connect_error());
}
echo "Conexão bem sucedida";
*/

 ?>
