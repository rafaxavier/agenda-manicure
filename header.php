
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>Agenda Da Dodô +_+.</title>
    <!-- link icones  -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Principal CSS do Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <!-- Estilos customizados para esse template -->
    <link href="_css/dashboard.css" rel="stylesheet">
    <link href="_css/estilo.css" rel="stylesheet">
    <!-- mascara para inputs -->
    <script src="https://igorescobar.github.io/jQuery-Mask-Plugin/js/jquery.mask.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

    <div>

  </head>
  <body>
    <div>
      <nav class="navbar navbar-inverse navbar-static-top" role="navigation">
        <div class="container">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
          </div>
        </div>


        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow  ">
            <a href="agendamentos.php"><img src="_imgs/logo.png" width="70" alt="cash plus"></a>
            <ul class="nav flex ">
              <li class="nav-item">
                <a class="nav-link active" href="agendamentos.php">
                  <i class="material-icons md-25 icon">event_available </i>
                  Agendamentos
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="relatorios.php">
                  <i class="material-icons md-25">assignment</i>
                  Relatórios
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="cadastrarCliente.php">
                  <i class="material-icons md-25">person_add</i>
                  Cadastrar Cliente
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="config.php">
                  <i class="material-icons md-25 icon">settings</i>
                  Configurações
                </a>
              </li>
              <li class="nav-item text-nowrap pl-5  ml-5">
                <a href="perfil.php"> "olá <?php echo $_SESSION['login']; ?> " <img src="<?php echo $_SESSION['path_avatar'];  ?>" alt="avatar" width="45"></a>
              </li>
              <li class="nav-item text-nowrap">
                <a class="nav-link" href="logout.php"> | Sair |</a>
              </li>
            </ul>
          </nav>
        </div>
    </div>