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

  // query para exibição das categorias e formas de pagamento
  $categoria = mysqli_query($conn, "select * from categoria ") or die("Erro");
  $forma_pg = mysqli_query($conn, "select FORMA_PAGAMENTO from forma_pagamento ") or die("Erro");

  //recebe os valores para as alterações dos categorias ou formas de pagamentos
  $parametro = filter_input(INPUT_GET, "parametro");
  //recebe o nome da categoria ser alterada ou excluida
  $del_cat= filter_input(INPUT_GET, "nomeCatDel"); 

  // ################ Aqui altera nome e valor de serviço ###########################
  //recebe o nome do serviço a ser alterado
  $nomeCatAlt= filter_input(INPUT_GET, "nomeCatAlt");
  //novo nome de serviço
  $nomeServico= filter_input(INPUT_GET, "nome_Serv");
  $nomeServ = strtoupper($nomeServico);
  //novo valor de serviço
  $valorServ= filter_input(INPUT_GET, "valor_Serv");
  // ###############################################################################
  
  //recebe o nome da forma de pagamento a ser alterada ou excluida  
  $nomeFormaPGalt=filter_input(INPUT_GET, "nomeFormaPGalt");
  $nomeFormaPGdel=filter_input(INPUT_GET, "nomeFormaPGdel");

// deletando categoria por nome
$Del_categoria =  mysqli_query($conn, "delete from categoria where  SERVICO='$del_cat' ") or die("Erro");
 // deletando forma de pagamnto por nome
$Del_FormaPG =  mysqli_query($conn, "delete from forma_pagamento where  FORMA_PAGAMENTO='$nomeFormaPGdel' ") or die("Erro");

//ALTERANDO O NOME DE UMA CATEGORIA
$Alt_categoria =  mysqli_query($conn, "update categoria set SERVICO='$nomeServ', VALOR='$valorServ'  where  SERVICO='$nomeCatAlt' ") or die("Erro");
//ALTERANDO O NOME DA FORMA DE PAGAMENTO
$Alt_formaPG =  mysqli_query($conn, "update forma_pagamento set FORMA_PAGAMENTO='$parametro'  where  FORMA_PAGAMENTO='$nomeFormaPGalt' ") or die("Erro");



  ?>

  <!doctype html>
  <html lang="pt=br">
    <?php include('header.php'); ?>
    <div align="center"><h1>CONFIGURAÇÕES </h1>
      <a href="config.php"><b>Após alterar clique no botão para atualizar os dados</b></a>
    </div>


    <div class="mytable box">
      <table class="table table-striped table-sm">
        <thead>
          <tr>
            <th>SERVIÇOS 
              <!-- botão chama modal pra add nova categoria -->
              <button class="btn btn-primary  material-icons md-20 pl-0 pr-0 pt-0 pb-0 mr-0" type="button" data-toggle="collapse" data-target="#a" aria-expanded="false" aria-controls="collapseExample" >
                <i class="material-icons">add</i>
              </button></th>
              <!----------------- corpo modal para add categorias -->
              <div class="collapse" id="a">
                <div class="card card-body boxtest" >
                  <form method="post" action="add.php">
                    <fieldset>
                      <legend><i class="material-icons">arrow_downward</i>INSIRA A NOVA CATEGORIA</legend>
                        <div class="form-group form-row ">
                        <input type="text"  class=" form-control" required name="nome" placeholder="Nome "><br>
                        <input type="text"  class="dinheiro form-control" required name="valor" placeholder="Preço "><br>
                        <input type="hidden"  name="insertCat" value="nova_categoria">
                          <input class="btn btn-success  mt-3 "   type="submit" value="INSERIR">
                        </div>  
                  </form>
                </div>
              </div> 
              <!-- final corpo -->
          </tr>
        </thead>
        <tbody>
          <?php
          
         
          // abaixo o form de exclusão da categoria
          while ($aux = mysqli_fetch_assoc($categoria)) {
            $serv= $aux['SERVICO']; ?>
            <tr><td><?php echo $serv."</br><b> VALOR:</b> R$"; 
                    echo $aux["VALOR"];
            ?></td>
            <td><button class="btn btn-danger  material-icons md-20 pl-0 pr-0 pt-0 pb-0 mr-4" type="button" data-toggle="modal" data-target="#a<?php echo $serv; ?>" aria-expanded="false" aria-controls="collapseExample" >
                  <i class="material-icons">delete_forever</i>
                 </button></td>

            <td><div class="modal box boxtest" id="a<?php echo $serv; ?>">
              <div class="card card-body " >
                <form method="get" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                    <fieldset>
                    <legend><i class="material-icons">arrow_downward</i> Quer realmente excluir a categoria  "<?php echo $aux["SERVICO"] ?>"</legend>
                    <div class="form-group form-row ">
            <input type="hidden"  name="nomeCatDel" value="<?php echo $serv ?>">
            <input class="btn btn-danger  mt-3 "   type="submit" value="Excluir">
            
            
          </div>  
          </form></td>
            <!-- // abaixo o form de alteração da categoria-->
            <td><button class="btn btn-warning  material-icons md-20 pl-0 pr-0 pt-0 pb-0 mr-4" type="button" data-toggle="modal" data-target="#<?php echo $aux["SERVICO"] ?>" aria-expanded="false" aria-controls="collapseExample" >
                      <i class="material-icons">edit</i>
                  </button></td>

          <td><div class="modal box boxtest" id="<?php echo $serv; ?>">
            <div class="card card-body" >
            <form  method="get" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
            <fieldset>
            <legend><i class="material-icons">arrow_downward</i> ALTERAÇÃO no item <?php echo $serv; ?></legend>
              <div class="form-group form-row ">
                <label >Novo Nome :</label>
                <input type="hidden"  name="nomeCatAlt" value="<?php echo $serv; ?>">
                <input type="text"  class=" form-control" required name="nome_Serv"><br>
                <!-- alterar valor dos serviços -->
                <label for="dinheiro">Novo Valor:</label>
                <input type="text" id="dinheiro" class="dinheiro form-control" name="valor_Serv" placeholder="R$0,00" required>
                <br>
                <input class="btn btn-success mt-3  "   type="submit" value="Confirmar" >
              </div>
            </div>
            </div>  
            </form>

           <?php }
            ?>
        </tbody>
      </table>
    </div>
    <!-- CIMA E BAIXO 33333333333333333333333333333333333333333333333333333333333333333333333 -->
    
     <!-- inicio tabela responsiva -->
   <div class="mytable box">
      <table class="table table-striped table-sm">
        <thead>
          <tr>
            <th>Formas de Pagamento 
            <!-- botão chama modal para inserir nova forma de pagamento -->
            <button class="btn btn-primary  material-icons md-20 pl-0 pr-0 pt-0 pb-0 mr-0" type="button" data-toggle="collapse" data-target="#b" aria-expanded="false" aria-controls="collapseExample" >
        <i class="material-icons">add</i>
      </button></th>
      <!-- corpo do modal de inserir nova forma de pagamento -->
      <div class="collapse" id="b">
        <div class="card card-body boxtest" >
          <form method="post" action="add.php">
            <fieldset>
              <legend><i class="material-icons">arrow_downward</i> INSIRA A NOVA FORMA DE PAGAMENTO </legend>
                <div class="form-group form-row ">
                <input type="text"  class=" form-control" required name="parametro"><br>
                  <input type="hidden"  name="insertFormPG" value="forma_pagamento">
                  <input class="btn btn-success  mt-3 "   type="submit" value="INSERIR">
                </div>  
          </form>
        </div>
      </div>
      <!-- fim fo corpo de inserir  -->
            
          </tr>
        </thead>
        <tbody>
          <?php
          
          //pecorrendo os registros da consulta.
          while ($aux = mysqli_fetch_assoc($forma_pg)) { ?>
            <tr><td><?php echo $aux["FORMA_PAGAMENTO"] ?></td>
            <td><button class="btn btn-danger  material-icons md-20 pl-0 pr-0 pt-0 pb-0 mr-4" type="button" data-toggle="modal" data-target="#a<?php echo $aux["FORMA_PAGAMENTO"] ?>" aria-expanded="false" aria-controls="collapseExample" >
                  <i class="material-icons">delete_forever</i>
                 </button></td>

            <td><div class="modal box boxtest" id="a<?php echo $aux["FORMA_PAGAMENTO"] ?>">
              <div class="card card-body " >
                <form method="get" action="<?php echo $_SERVER["PHP_SELF"] ?>">
                    <fieldset>
                    <legend><i class="material-icons">arrow_downward</i> Quer realmente excluir a categoria  "<?php echo $aux["FORMA_PAGAMENTO"] ?>"</legend>
                    <div class="form-group form-row ">
            <input type="hidden"  name="nomeFormaPGdel" value="<?php echo $aux["FORMA_PAGAMENTO"] ?>">
            <input class="btn btn-danger  mt-3 "   type="submit" value="Excluir">
          </div>  
          </form></td>
            <!-- // abaixo o forme de alteração -->
            <td><button class="btn btn-warning  material-icons md-20 pl-0 pr-0 pt-0 pb-0 mr-4" type="button" data-toggle="modal" data-target="#<?php echo $aux["FORMA_PAGAMENTO"] ?>" aria-expanded="false" aria-controls="collapseExample" >
                      <i class="material-icons">edit</i>
                  </button></td>
          <td><div class="modal box boxtest" id="<?php echo $aux["FORMA_PAGAMENTO"] ?>">
            <div class="card card-body " >
            <form  method="get" action="<?php echo $_SERVER["PHP_SELF"] ?>">
            <fieldset>
            <legend><i class="material-icons">arrow_downward</i> ALTERAÇÃO no item <?php echo $aux["FORMA_PAGAMENTO"] ?></legend>
              <div class="form-group form-row ">
                <label for="nomecat">Novo Nome :</label>
                <input type="hidden"  name="nomeFormaPGalt" value="<?php echo $aux["FORMA_PAGAMENTO"] ?>">
                <input type="text" id="nomecat" class=" form-control" required name="parametro"><br>
                <input class="btn btn-success mt-3  "   type="submit" value="Confirmar">
              </div>
            </div>
          </div>  
          
              </form>
           <?php }
            ?>
        </tbody>
      </table>
    </div> 
    
    
    
      <!-- fim de conteudo  -->

   

    <script src="https://igorescobar.github.io/jQuery-Mask-Plugin/js/jquery.mask.min.js"></script>
    <script>
      $('.telefone').mask('(00) 0 0000-0000');
      $('.dinheiro').mask('####0.00', {
        reverse: true
      });

    </script>
  </body>

  </html>

<?php } ?>