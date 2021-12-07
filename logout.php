<?php session_start();

unset ($_SESSION['usuario']);
unset ($_SESSION['senha']);
session_destroy(); # Destruir todas as sessões do navegador
    
?>
<div>Logout efetuado com sucesso!<br><br>Redirecionando para a página inicial...</div>
<script type="text/javascript">
setTimeout("window.location='index.php';",2000);
</script>