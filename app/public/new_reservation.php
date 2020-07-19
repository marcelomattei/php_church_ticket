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
              <p style="color:red;" class="card-text">Para a segurança de todos, inscreva-se, somente, se sua idade estiver entre <b>12</b> e <b>60</b> anos.</p>
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
                <div class="form-group col-md-6 mb-3">
                    <label for="inputQuantity">Quantas pessoas você quer inscrever? (Limite de 5 pessoas):</label>
                    <select name="quantity" class="form-control" id="inputQuantity" required>
                        <option selected="selected" value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                    <small id="quantityHelp" class="form-text text-muted">
                    Quantidade de pessoas que deseja inscrever (conte você e alguns outros familiares, por exemplo)</small>
                </div>
                <div class="form-group col-md-6 mb-3">
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
              <div id="second_step_reservation">
              </div>
              <button type="submit" class="btn btn-primary" id="btn_finish_reservation" name="create_reservation">Finalizar</button>
          </form>
        </div>
      </div>
    </div>
  </main>
  <?php include_once '../footer.php'; ?>
  <?php include_once '../assets/js/dynamic_reservation.js'; ?>
