

<!DOCTYPE html> <!--aqui é  tipo do documento -->

<html lang="pt">
<head>
	<title>Login</title> <!--aqui é o titulo da pagina -->
	<link rel="stylesheet" type="text/css" href="_css/estilo.css">
	<meta charset="utf-8">
    <!-- meta tag responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">  
    <!-- bootstrap cnd -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    
    <!-- verica a senha se ta correta realmente  -->
    <script>
    function validaSenha (input){ 
    if (input.value != document.getElementById('txtSenha').value) {
    input.setCustomValidity('Repita a senha corretamente');
    } else {
    input.setCustomValidity('');
    }
} 
    </script>
</head>



<body >
    <div id="login-layout">
        <form class="form-login" action="autentica.php" method="POST">
        <div class="text-center mb-4 mt-2">
            <img class="mb-3" src="_imgs/logo.png" alt="" width="200" height="200">
            <h1 class="h3 mb-3 font-weight-normal">Autenticação</h1>
        </div>

        <div class="label-login">
            <input type="text" id="inputlogin" name="login" class="form-control" placeholder="login" required autofocus>
            <label for="inputlogin">Usuario</label>
        </div>

        <div class="label-login">
            <input type="password" id="inputPassword" name="senha" class="form-control" placeholder="senha" required >
            <label for="inputPassword">Senha</label>
        </div>

        <button class="btn btn-lg btn-success btn-block" type="submit">Entrar</button>
        <button type="button" class="btn btn-lg btn-primary btn-block" data-toggle="modal" data-target="#myModal">Cadastre-se</button>

        <p> <em>Version 1.0</em> </p>
        </form>
        </div>
    </div>



    <!-- Modal  cadatro de usuarios -->
    <div class="modal " id="myModal" role="dialog">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">CADASTRO</h4>
          </div>
          <!-- inicio corpo modal CADASTRO -->
          <div class="modal-body">
            <form id="formCadastro" name="formulario" action="cadastraUsuario.php" method="POST" >
              <label for="nome">NOME COMPLETO:</label>
              <input type="text" id="nome" class="form-control" required  name="nome"  placeholder="Nome"><br>
              <label for="cpf">CPF:</label>
              <input type="text" id="cpf" class="cpf form-control" required  name="cpf" placeholder="CPF"><br>
              <label for="email">E-mail:</label>
              <input type="text" id="email" class="form-control" required  name="email" placeholder="E-mail"><br><hr>
              <label for="Login">USUÁRIO:</label>
              <input type="text" id="login" class="form-control" required  name="login" placeholder="Usuário"><br>

              <label for="txtSenha"  >SENHA:</label>
              <input id="txtSenha"  name="senha" type="password" required placeholder="Digite uma Senha" title="Senha" />
              <label for="repetir_senha" >CONFIRMAR SENHA:</label>
              <input id="repetir_senha"  name="repetir_senha" type="password" required  placeholder="Repetir Senha" title="Repetir Senha" oninput="validaSenha(this)" />

              <hr>
              <button class="btn btn-lg btn-success btn-block" type="submit">Cadastrar</button>
            </form>
          </div>
          <!-- fim corpo modal add lançamentos -->


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

<!-- mascara pra formulario -->
<script src="https://igorescobar.github.io/jQuery-Mask-Plugin/js/jquery.mask.min.js"></script>
    <script>
      $('.cpf').mask('000.000.000-00');
      $('.dinheiro').mask('####0.00', {
        reverse: true
      });

    </script>

</body>

</html>
