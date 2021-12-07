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
  
  $idlanc = filter_input(INPUT_GET, "idlancamentos"); //  ||  o id do movimento via form e salva  em var
  
  $data=filter_input(INPUT_GET, "data");


  // #####   query genericas    ####
  // deletando movimentaçoes por id
  $deletaridlanc =  mysqli_query($conn, "delete from movimentacoes where  idFINANCAS='$idlanc' ") or die("Erro");
  
 //COD_Usuario=".$_SESSION['id']."  AND

 $movimentacoes = mysqli_query($conn, "select * from movimentacoes ") or die("Erro");
    // $movimentacoes = mysqli_query($conn, "select * from movimentacoes  order by HORARIO ASC ") or die("Erro");
    //WHERE COD_Usuario=".$_SESSION['id']." 
  

  ?>

  <!doctype html>
  <html lang="pt=br">

  <?php include('header.php'); ?>

  
<!-- botão de filtros de exibição -->
      <!-- filtrar por data -->
      <div class="mt-5" >
        <form  method="get" action="<?php echo $_SERVER['PHP_SELF'] ?>">
          <div class="pesquisa"  >
            <input   class="form-control" type="date" min="2021-01-01" name="data"  >
          </div >  
          <div class="pesquisa " >
            <input style="height:35px" class="  btn btn-sm  btn-success" id="botao" type="submit" value="pesquisar">
          </div>
        </form>
      <!--botão para modal de adição de novo lançamento  -->
      <div  class="pesquisa  ">
          <input style="height:35px" class="   btn btn-sm  btn-success ml-2 " id="botao" type="submit" value="agendar" data-toggle="modal" data-target="#myModal">
        </div>
        <div class=""  style="float:left">
          
          <!--botão para cadastrar novo cliente  -->
          <a class="ml-2 " style="height:35px"  href="cadastrarCliente.php"><button  style="height:35px"  type="button" class="btn btn-sm  btn-primary  "><i class="material-icons ">person_add</i></button></a>
      </div>
    </div>
    
    


    
    <!--############################################  Exibi os agendamentos #######################################################  -->
    <!-- inicio tabela responsiva -->
    <div class="mytable">
      <table class="table table-striped table-sm">
        <?php 
        $timestamp = mktime(date("H")-3, date("i"), date("s"), date("m"), date("d"), date("Y"));
        
        
        if($data ==""){
          $data= gmdate("Y-m-d", $timestamp);
          $exibeData=gmdate("d/m/Y", $timestamp)." <b>(hoje)</b>";
          
        }else{
          $exibeData = date("d/m/Y", strtotime($data));
          
        }

       
        
        echo "<br><h3  style='float:left; margin-left:15px'><b>DATA :</b>" .$exibeData."</h3  >";
        //pecorrendo os registros da consulta.
          for($i=9 ; $i<19; $i++){ //horário de atendimento
            // $movimentacoes = mysqli_query($conn, "select * from movimentacoes  WHERE  DATA='$data' order by HORARIO ASC ") or die("Erro");
            $movimentacoes = mysqli_query($conn, "select * FROM movimentacoes INNER JOIN categoria
            ON movimentacoes.CATEGORIA = categoria.SERVICO  WHERE  DATA='$data' order by HORARIO ASC ") or die("Erro");
            ?>
              <tr>
                <td><?php echo "<b>".$i .":00 | </b>"; ?></td>
                <td><?php 
                    while ($aux = mysqli_fetch_assoc($movimentacoes)){
                      if($i != date("H", strtotime($aux["HORARIO"])) ){
                        echo " ";
                      }else{
                        
                        ?>
                        <div style=" border:1px solid aliceblue;border-radius: 5px ;width:250px; margin-bottom:10px; background:#343a40;">
                        <div style=" border:1px solid aliceblue;border-radius: 4px ; background:aliceblue; margin:5px; padding-left:5px" >
                        
                        <?php
                          
                          echo '<em><b>'.$aux["CLIENTE"].'</em><br>'; 
                          echo $aux["CATEGORIA"].'</b> - R$'.$aux["VALOR"].'<br>'; 
                          echo '<b>Horário - </b>'.strftime($aux["HORARIO"]).'<br>';
                          echo '<b>Cod - </b>'.$aux["idFINANCAS"].'<br>';
                        ?>
                        </div>
                        

                        <div style=" display:flex; height:40px; margin:5px">
                          <!-- #### form de deletar ######-->
                          <div style="float:left;width:50%; height:40px; margin-right:2px  ">
                            <form method='get' action='<?php echo $_SERVER['PHP_SELF'] ?>'>
                              <input type='hidden'  name='idlancamentos' value='<?php echo $aux["idFINANCAS"]; ?> '>
                              <input style="height:38px;width:100%;" class='btn btn-danger  material-icons ' type='submit' 	value='DELETAR'>
                            </form>
                          </div>
                          <!-- fim form de deletar -->

                          <!-- botao modal editar -->
                          <div style="float:left;width:50%;height:40px;  margin-left:2px" >
                            <button style="height:38px; width:100%;"  class='btn btn-warning  material-icons' id="botao" type='button' data-toggle='modal' data-target='#myModalEditar<?php echo $aux['idFINANCAS'];  ?>' aria-expanded='false' aria-controls='collapseExample'  >
                              EDITAR 
                            </button>
                          <!-- inicio modal de editar agendamento -->
                          <!-- Modal -->
                          <div class="modal " id="myModalEditar<?php echo $aux['idFINANCAS'];?>" role="dialog">
                            <div class="modal-dialog modal-lg">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h4 class="modal-title">Editar agendamento </h4>
                                  <span> <?php echo $aux["idFINANCAS"] ?></span>
                                </div>
                                <!-- inicio corpo modal editar agendamento -->
                                <?php include('modal.php'); 
                                ?>
                                  <button class="btn btn-lg btn-success btn-block" type="submit">Salvar</button>
                                  </form>
                                </div>
                                <!-- fim corpo modal editar agendamento -->
                              </div>
                            </div>
                          </div>
                          <!-- fim modal editar agendamento -->
                            <span> <?php echo $aux["idFINANCAS"] ?></span>
                          </div>
                          <!-- fim botao modal editar -->
                        <!-- </div> -->

                        
                    <?php }
                    };?>
                    </td>
              </tr>
        <?php };?>
      </table>
    </div>
    <!-- fim da tabela responsiva -->
    <!--####################################################################################################################################  -->
    
    
    

    <!-- inicio modal de lançamento -->
    <!-- Modal -->
    <div class="modal " id="myModal" role="dialog">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Novo Lançamento</h4>
          </div>
          <!-- inicio corpo modal add lançamentos -->
          <?php include('modal.php'); ?>
              <button class="btn btn-lg btn-success btn-block" type="submit">ADICIONAR</button>
              <button type="button" class="btn btn-lg btn-warning btn-block" data-dismiss="modal">Fechar</button>
            </form>
          </div>
          <!-- fim corpo modal add lançamentos -->
        </div>
      </div>
    </div>
    <!-- fim corpo modal-->

    

                

    <!-- </main> -->
    
    <script src="https://igorescobar.github.io/jQuery-Mask-Plugin/js/jquery.mask.min.js"></script>
    <script>
      $('.telefone').mask('(00) 0 0000-0000');
      $('.dinheiro').mask('####0.00', {
        reverse: true
      });

    </script>
  </body>

  </html>

<?php }; ?>