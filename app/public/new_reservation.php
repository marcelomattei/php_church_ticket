<?php require_once '../process.php'; ?>
<?php include_once '../header.php'; ?>

  <?php
    $worships_list = $worship_obj->list_available_worships();
  ?>

  <main role="main" class="container">
    <div class="menu-template">
      <div class="container">
        <div class="row justify-content-center">
          <div class="card">
            <div class="card-body">
              <h5 style="color:red;" class="card-title"><b>Importante</b></h5>
              <p style="color:red;" class="card-text">Para segurança de todos, os membros devem ter entre <b>12</b> e <b>60</b> anos.</p>
            </div>
          </div>
        </div>
        <br>
        <div class="row justify-content-center">
          <form action="../process.php" method="POST">
              <?php if (isset($_SESSION['message'])): ?>
              <div class="alert alert-<?=$_SESSION['msg_type']?>">
                <?php 
                  echo $_SESSION['message'];
                  unset($_SESSION['message']);
                ?>
              </div>
            <?php endif ?>
            <br>
            <div id="first_step_reservation" class="row">
                <div class="form-group col-md-4 mb-3">
                    <label for="inputQuantity">Quantidade:</label>
                    <input type="number" autocomplete="off" class="form-control" name="quantity" id="inputQuantity" 
                      min="1" max="99"
                      aria-describedby="quantityHelp" placeholder="Quantidade" required>
                    <small id="quantityHelp" class="form-text text-muted">Informe a quantidade de membros no culto.</small>
                </div>
                <div class="form-group col-md-8 mb-3">
                    <label for="selectReservationDate">Horário:</label>
                    <select name="worship_id" class="form-control" id="selectReservationDate" required>
                        <option selected="selected"></option>
                        <?php 
                          while($row = $worships_list->fetch_assoc()):
                        ?>
                        <option value="<?php echo $row['id']; ?>">
                          <?php echo $row['description']; ?> - 
                            <?php echo date_format(date_create($row['date']),'d/m/Y'); ?> - 
                            <?php echo $row['hour']; ?>
                        </option>
                        <?php endwhile; ?>
                    </select>
                </div>
              </div>
              <button type="button" class="btn btn-primary" id="btn_proceed_reservation" name="proceed_reservation">Prosseguir</button>
              <div id="second_step_reservation" class="row">
                <div class="form-group col-md-8 mb-3">
                    <label for="inputName">Nome:</label>
                    <input type="text" autocomplete="off" size="75" class="form-control" name="name" id="inputName" aria-describedby="nameHelp" placeholder="Nome" required>
                    <small id="nameHelp" class="form-text text-muted">Informe seu nome completo.</small>
                </div>
                <div class="form-group col-md-4 mb-3">
                    <label for="inputTaxId">RG:</label>
                    <input type="text" autocomplete="off" size="15" class="form-control" name="taxId" id="inputTaxId" aria-describedby="taxIdHelp" placeholder="RG" required>
                    <small id="taxIdHelp" class="form-text text-muted">Informe seu número de RG.</small>
                </div>
              </div>
              <button type="submit" class="btn btn-primary" id="btn_finish_reservation" name="create_reservation">Finalizar</button>
          </form>
        </div>
      </div>
    </div>
  </main>
  <?php include_once '../footer.php'; ?>
  <script>
    $( document ).ready(function() {
      $("#second_step_reservation").hide();
      $("#btn_finish_reservation").hide();
    });

    $("#btn_proceed_reservation").click(function(){
       $("#btn_proceed_reservation").hide();
       $("#second_step_reservation").show();
       $("#btn_finish_reservation").show();
    })
  </script>
