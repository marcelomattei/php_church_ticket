<?php require_once '../process.php'; ?>
<?php include_once '../header.php'; ?>
<?php include_once 'menu.php'; ?>
  <main role="main" class="container">
    <div class="menu-template">
    <?php
        $worships_list = $worship_obj->list_all_worships();
    ?>

        <?php 
            if (isset($_SESSION['message'])): ?>
                <div class="alert alert-<?=$_SESSION['msg_type']?>">
                <?php 
                    echo $_SESSION['message'];
                    unset($_SESSION['message']);
                ?>
                </div>
        <?php endif ?>

        <div class="container">
            <div class="row justify-content-center">
                <form action="../process.php" method="POST">
                    <div class="row">
                        <div class="form-group col-md-6 mb-3">
                            <label for="inputDescription">Descrição:</label>
                            <input type="text" autocomplete="off" size="75" name="description" class="form-control" 
                                id="inputDescription" aria-describedby="descriptionHelp" placeholder="Descrição" required>
                            <small id="descriptionHelp" class="form-text text-muted">Informe a descrição do culto.</small>
                        </div>
                        <div class="form-group col-md-6 mb-3">
                            <label for="inputHour">Horário:</label>
                            <input type="text" autocomplete="off" name="worshipHour" class="form-control" 
                                id="inputHour" aria-describedby="hourHelp" placeholder="00:00" required>
                            <small id="hourHelp" class="form-text text-muted">Informe o horário do culto.</small>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6 mb-3">
                            <label for="inputWorshipDate">Data:</label>
                            <input type="date" class="form-control" name="worshipDate" 
                                id="inputWorshipDate" aria-describedby="worshipDateHelp" placeholder="Data" required>
                            <small id="worshipDateHelp" class="form-text text-muted">Informe a data do culto.</small>
                        </div>
                        <div class="form-group col-md-6 mb-3">
                            <label for="inputPlaces">Lugares:</label>
                            <input type="number" autocomplete="off" size="2" class="form-control" name="places"
                                min="1" max="99"
                                id="inputPlaces" aria-describedby="placesHelp" placeholder="Lugares" required>
                            <small id="placesHelp" class="form-text text-muted">Informe o número de lugares disponíveis.</small>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary" name="create_worship">Salvar</button>
                </form>
            </div>
            <br>
            <div class="row">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Descrição</th>
                            <th>Horário</th>
                            <th>Data</th>
                            <th>Lugares (max)</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <?php 
                        while($row = $worships_list->fetch_assoc()):
                    ?>
                        <tbody>
                            <tr>
                                <td><?php echo $row['description']; ?></td>
                                <td><?php echo $row['hour']; ?></td>
                                <td><?php echo date_format(date_create($row['date']),'d/m/Y'); ?></td>
                                <td><?php echo $row['places']; ?></td>
                                <td>
                                    <a href="../process.php?delete_worship=<?php echo $row['id']; ?>"
                                        class="btn btn-danger">Remover</a>
                                </td>
                            </tr>
                        </tbody>
                    <?php endwhile; ?>
                </table>
            </div>
        </div>
    </div>
<?php include_once '../footer.php'; ?>