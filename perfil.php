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
  $valor = filter_input(INPUT_GET, "valor"); //recebe valor via form e salva em var para  usar em query
  $parametro = filter_input(INPUT_GET, "parametro"); // recebe o parametro a ser alterado(obs : usua, email, senha... )


 $sql= mysqli_query($conn, "select * from usuario where COD_Usuario=".$_SESSION['id']."") or die("Erro");
$dadosUser =mysqli_fetch_assoc($sql);
    // editando os campos selecionados
  if ($parametro == 'newemail') {
    $alteracao = mysqli_query($conn, "update usuario set email='$valor' WHERE COD_Usuario=".$_SESSION['id']." ") or die("Erro");
  } elseif ($parametro == 'newusuario') {
      $verifica=mysqli_query($conn, "select login from usuario WHERE login='$valor' ") or die("Erro");
      $numRow=mysqli_num_rows($verifica);
      if($numRow==0){
        $alteracao = mysqli_query($conn, "update usuario set login='$valor' WHERE COD_Usuario=".$_SESSION['id']." ") or die("Erro");
      }else{
          echo"<script language='javascript' type='text/javascript'>
          alert('Usuário ".$valor." já existe, tente outro nome!');</script>";
      }
  } elseif ($parametro == 'newsenha') {
    $alteracao = mysqli_query($conn, "update usuario set senha='$valor' WHERE COD_Usuario=".$_SESSION['id']." ") or die("Erro");
  } elseif ($parametro == 'newinfo')  {
    $alteracao = mysqli_query($conn, "update usuario set informacoes='$valor' WHERE COD_Usuario=".$_SESSION['id']." ") or die("Erro");
  }

  ?>

  <!doctype html>
  <html lang="pt=br">

  <?php include('header.php'); ?>
  
    <!-- inicio conteudo -->
    <div class="container ">
        <div class="row">
            <div class="media mt-2 col box1 ">
                <div class="media-body">
                    <h2>PERFIL</h2>
                <img class="align-self-center  " src="<?php echo $dadosUser['path_avatar'] ?>" alt="avatar" width="250">
                    <h3 class="mt-2 "><?php echo $dadosUser['nome'] ?> </h3>
                    <p>CPF : <?php echo $dadosUser['cpf'] ?></p>
                    <p>E-MAIL : <?php echo $dadosUser['email'] ?></p>
                    <p>COD DE USUÁRIO : <?php echo $dadosUser['COD_Usuario'] ?></p>
                    <p>USUÁRIO : <?php echo $dadosUser['login'] ?></p>
                    <p>SENHA : <?php echo $dadosUser['senha'] ?></p>
                    <p>INFORMAÇÕES : <?php echo $dadosUser['informacoes'] ?></p>
                </div>
            </div>

            <!-- form pra editar  o perfil de usuario ###########    -->
            <div class="col ml-5 mt-5 ">
                <h2>Edite seu perfil:</h2>
                <form method="get" action="<?php echo $_SERVER["PHP_SELF"] ?>">
                    <div class="input-group mb-3">
                        <input type="hidden" name="parametro" value="newemail">
                        <input type="text" class="form-control"  required name="valor" placeholder="Insira o novo e-mail" aria-describedby="button-addon1">
                        <div class="input-group-append">
                            <button class="btn btn-warning" type="submit" id="button-addon1">Aterar</button>
                        </div>
                    </div>
                </form>
                <form method="get" action="<?php echo $_SERVER["PHP_SELF"] ?>">
                    <div class="input-group mb-3">
                        <input type="hidden" name="parametro" value="newusuario">
                        <input type="text" class="form-control" required name="valor" placeholder="Insira o novo usuários" aria-describedby="button-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-warning" type="submit" id="button-addon2">Aterar</button>
                        </div>
                    </div>
                </form>
                <form method="get" action="<?php echo $_SERVER["PHP_SELF"] ?>">
                    <div class="input-group mb-3">
                        <input type="hidden" name="parametro" value="newsenha">
                        <input type="text" class="form-control" required name="valor" placeholder="Insira a nova senha" aria-describedby="button-addon3">
                        <div class="input-group-append">
                            <button class="btn btn-warning" type="submit" id="button-addon3">Aterar</button>
                        </div>
                    </div>
                </form>
                <form method="get" action="<?php echo $_SERVER["PHP_SELF"] ?>">
                    <div class="input-group mb-3">
                        <input type="hidden" name="parametro" value="newinfo">
                        <textarea type="text" class="form-control" aria-label="With textarea" required name="valor" placeholder="Insira a novas informações..." aria-describedby="button-addon4"></textarea>
                        <div class="input-group-append">
                            <button class="btn btn-warning" type="submit" id="button-addon4">Aterar</button>
                        </div>
                    </div>
                </form>
                <form> 
                    <h5>Após alterar clique no botão para atualizar os dados</h5>
                    <input class="btn btn-success" type="button " value="Atualizar" onClick="history.go(0)"> 
                </form>
            </div>
            <!-- fim do form de edição de perfil ################ -->
        </div>
    </div>

   


  </body>

  </html>

<?php } ?>