<?php session_start();
include('conexao.php');

if((!isset($_SESSION['login'])==true) and (!isset($_SESSION['senha'])==true))
	{
		session_destroy(); # Destruir todas as sessões do navegador
		unset ($_SESSION['login']);
        unset ($_SESSION['senha']);
        unset ($_SESSION['path_avatar']);
		header('location:naoAutenticado.php');
		exit;

     
	}else{

  $categoria = mysqli_query($conn,"select * from categoria ") or die("Erro");
  $movimentacoes = mysqli_query($conn,"

  select * from movimentacoes 
  INNER JOIN usuario ON movimentacoes.COD_Usuario = usuario.COD_Usuario
  INNER JOIN categoria ON categoria.SERVICO = movimentacoes.CATEGORIA
    ORDER BY idFINANCAS DESC ;  ") or die("Erro");
  $forma_pg = mysqli_query($conn,"select FORMA_PAGAMENTO from forma_pagamento ") or die("Erro");
		
?>

<!doctype html>
<html lang="pt=br">
  <?php include('header.php'); ?>
  
          <!-- inicio tabela responsiva -->
          <div class="mytable">
            <table class="table table-striped table-sm">
              <thead>
                <tr>
                  <th>CLIENTE</th>
                  <th>VALOR</th>
                  <th>SERVIÇO</th>
                  <th>DATA </th>
                  <th>HORÁRIO</th>
                  <th>FORMA PG</th>
                  <th>ÚLTIMA ATUALIZAÇÃO</th>
                </tr>
              </thead>
              <tbody>
              <?php
              //pecorrendo os registros da consulta.
              while ($aux = mysqli_fetch_assoc($movimentacoes)){
							  echo "<tr><td><b>".$aux["CLIENTE"]."</b></td>"; 
							  echo "<td>R$".$aux["VALOR"]."</td>"; 
                echo "<td>".$aux["CATEGORIA"]."</td>";
                echo "<td>".date('d-m-Y',  strtotime($aux["DATA"]))."</td>"; 
							  echo "<td>".strftime($aux["HORARIO"])."</td>";
							  echo "<td>".$aux["FORMA_PAGAMENTO"]."</td>";
                echo "<td>".$aux["nome"]."</td></tr>";
							} 
							 //mysqli_close($conn);	
		   				?>
              </tbody>
            </table>
          </div>
        <!-- </main> -->
      </div>
    </div>

    <script src="https://igorescobar.github.io/jQuery-Mask-Plugin/js/jquery.mask.min.js"></script>           
    <script>
      
        $('.dinheiro').mask('#.##0.00', {reverse: true});
        
        
      </script>  


   
  </body>
</html>

<?php } ?>
