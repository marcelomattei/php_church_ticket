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
              <h5 style="color:red;" class="card-title">Importante</h5>
              <p style="color:red;" class="card-text">Para segurança de todos, os membros devem ter entre 12 e 65 anos.</p>
            </div>
          </div>
        </div>
        <br>
        <div class="row justify-content-center">
          <form action="../process.php" method="POST">
              <div class="row">
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
              <div class="row">
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
              <button type="submit" class="btn btn-primary" name="create_reservation">Salvar</button>
              <hr>
                <?php 
                  if (isset($_SESSION['message'])): ?>
                    <div class="alert alert-<?=$_SESSION['msg_type']?>">
                      <?php 
                        echo $_SESSION['message'];
                        unset($_SESSION['message']);
                      ?>
                    </div>
                  <?php endif ?>
          </form>
        </div>
      </div>
    </div>
  </main>
  <?php include_once '../footer.php'; ?>
