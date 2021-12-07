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
    
    $parametro=filter_input(INPUT_GET, "parametro");
    $idCliente=filter_input(INPUT_GET, "idCliente");
    $nomeCliente=filter_input(INPUT_GET, "nomeCliente");
    $nomeCliente = strtoupper($nomeCliente);
    $sobrenomeCliente=filter_input(INPUT_GET, "sobrenomeCliente");
    $sobrenomeCliente = strtoupper($sobrenomeCliente);
    $telefoneCliente=filter_input(INPUT_GET, "telefoneCliente");
    
if ($parametro == "inserir") {
    $insertCliente = mysqli_query($conn,"insert into `clientes`  (`nomeCliente`,`sobrenomeCliente`,`telefone` ) VALUES 
  ('$nomeCliente','$sobrenomeCliente', '$telefoneCliente' )") or die("Erro");
  header('Location:cadastrarCliente.php');
}else{
    $deleteCliente = mysqli_query($conn,"DELETE FROM `clientes` WHERE COD_cliente='$idCliente'  ") or die("Erro");
//   header('Location:cadastrarCliente.php');
}
  

//   $b = mysqli_query($conn,"select * from movimentacoes 
//   INNER JOIN usuario ON movimentacoes.COD_Usuario = usuario.COD_Usuario
//   INNER JOIN categoria ON categoria.SERVICO = movimentacoes.CATEGORIA
    // ORDER BY idFINANCAS DESC ;  ") or die("Erro");
//   $c = mysqli_query($conn,"select FORMA_PAGAMENTO from forma_pagamento ") or die("Erro");
		
?>

<!doctype html>
<html lang="pt=br">
  <?php include('header.php'); ?>

  <button style="height:45px; width:100%;"  class='btn btn-primary mb-4 pb-3 material-icons ' id="botao" type='button' data-toggle='modal' data-target='#myModalCadastrar' aria-expanded='false' aria-controls='collapseExample'  >
    CADASTRAR CLIENTE  <i class="material-icons mb-5 pb-3 "> person_add</i> 
  </button>

  <div class="modal card card-body pt-5" id="myModalCadastrar" role="dialog">
  <!-- <div class="card card-body pt-5" > -->
    <form  method="get" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
    <legend><i class="material-icons">person_add</i> Cadastro de Cliente</legend>
    <div class="form-group form-row ">
        <label >Nome :</label>
        <input type="text"  class=" form-control" required name="nomeCliente"><br>
        <label >Sobrenome :</label>
        <input type="text"  class=" form-control" required name="sobrenomeCliente"><br>
        <label >Telefone :</label>
        <input type="text"   class="telefone form-control" required name="telefoneCliente"><br>
        <input type="hidden"   name="parametro" value="inserir"><br>
        <input class="btn btn-success mt-3  "   type="submit" value="Confirmar" >
    </div>
    </form>
    </div>
    
    <div class="mytable mt-5">
    <h3 class="ml-3"><b>Lista de Clientes</b></h3>
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <!-- <th>Cod</th> -->
                    <!-- <th>Nome</th> -->
                    <!-- <th>Sobrenome</th> -->
                </tr>
            </thead>
            <tbody>
            <?php 
            $movimentacoes= mysqli_query($conn,"select * from clientes");
            while ($aux = mysqli_fetch_assoc($movimentacoes)){ ?>
                <tr>
                    <!-- <td><?php //echo $aux['COD_cliente'];?></td> -->
                    <td><b><?php echo $aux['nomeCliente']." ".$aux['sobrenomeCliente'];?></b></td>
                    <td><?php echo $aux['telefone'];?></td>
                    <td>
                        <!-- #### form de deletar ######-->
                        <div style="float:left;width:auto; height:40px; margin-right:2px  ">
                            <form method='get' action='<?php echo $_SERVER['PHP_SELF'] ;?>'>
                              <input type='hidden'  name='idCliente' value='<?php echo $aux["COD_cliente"]; ?>'>
                              <input type='hidden'  name='parametro' value='excluir'>
                              
                              <input style="height:38px;width:100%;" class='btn btn-danger  material-icons ' type='submit' 	value='clear'>
                            </form>
                          </div>
                          <!-- fim form de deletar -->
                    </td>
                </tr>
            <?php  }; ?>
            </tbody>
        </table>
    </div>
  
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
