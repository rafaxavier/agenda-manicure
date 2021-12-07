<div class="modal-body">
            <form action="addLancamentos.php" method="POST">
            <input type='hidden'  name='idlancamentos' value='<?php echo $aux['idFINANCAS']; ?> '>
            <label for="cliente">CLIENTE:</label><br>
            <select class="form-control" id="cliente" name="cliente" required>
              <?php
                $clientes = mysqli_query($conn, "select * from clientes ") or die("Erro");
              while ($aux = mysqli_fetch_assoc($clientes)) {
                echo "<option value" . $aux['nomeCliente'] .' ' .$aux['sobrenomeCliente'].  ">" .$aux['nomeCliente'].' '.$aux['sobrenomeCliente']. "</option>";
              }
              ?>
            </select><br>
              <hr>
              <label for="sel1">SERVIÇO:</label>
              <select class="form-control" id="sel1" name="nomeServico" required>
                <?php
                 $categoria = mysqli_query($conn, "select SERVICO from categoria ") or die("Erro");
                while ($aux = mysqli_fetch_assoc($categoria)) {
                  echo "<option value" . $aux['SERVICO'] . ">" . $aux['SERVICO'] . "</option>";
                }
                ?>
              </select><br>
              <hr>
              <label>DATA :</label>
              <input type="date" min="2021-01-01" id="data" class="data form-control" name="data" placeholder="data" required><br>
              <label>HORÁRIO:</label>
              <select class="form-control" id="sel2" name="horario" required>
                <option value="09:00:00">09:00</option>
                <option value="09:30:00">09:30</option>
                <option value="10:00:00">10:00</option>
                <option value="10:30:00">10:30</option>
                <option value="11:00:00">11:00</option>
                <option value="11:30:00">11:30</option>
                <option value="13:00:00">13:00</option>
                <option value="13:30:00">13:30</option>
                <option value="14:00:00">14:00</option>
                <option value="14:30:00">14:30</option>
                <option value="15:00:00">15:00</option>
                <option value="15:30:00">15:30</option>
                <option value="16:00:00">16:00</option>
                <option value="16:30:00">16:30</option>
                <option value="17:00:00">17:00</option>
                <option value="17:30:00">17:30</option>
              </select><br><hr>
              <label for="sel3">FORMAS DE PAGAMENTO:</label>
              <select class="form-control" id="sel3" name="forma_pagamento" required>
                <?php
                $forma_pg = mysqli_query($conn, "select FORMA_PAGAMENTO from forma_pagamento ") or die("Erro");
                while ($aux = mysqli_fetch_assoc($forma_pg)) {
                  echo "<option value" . $aux['FORMA_PAGAMENTO'] . ">" . $aux['FORMA_PAGAMENTO'] . "</option>";
                }
                ?>
              </select><br>
              <hr>
              
