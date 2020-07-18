<?php require_once '../process.php'; ?>
<?php include_once '../header.php'; ?>
<?php include_once 'menu.php'; ?>

  <main role="main" class="container">
    <div class="menu-template">
    <?php 
            $result_header = '';
            $reservations = '';

            if (isset($_GET['detail_reservation_summary'])) {
                $id = $_GET['detail_reservation_summary'];
                $result_header = $worship_obj->find_by_id($id);
                $reservations = $reservation_obj->find_by_registration_by_worship_id($id);
            }
        ?>

        <div class="container">
            <div class="row justify-content-center">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Horário</th>
                            <th>Limite</th>
                        </tr>
                    </thead>
                    <?php 
                        while($row = $result_header->fetch_assoc()):
                    ?>
                    <tr>
                        <td>
                            <?php echo $row['description']; ?> - 
                                <?php echo date_format(date_create($row['date']),'d/m/Y'); ?> - 
                                <?php echo $row['hour']; ?>
                        </td>
                        <td><?php echo $row['places']; ?></td>
                    </tr>
                    <?php endwhile; ?>
                </table>
            </div>
        <br>
        <div class="row justify-content-center">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Membro</th>
                        <th>RG</th>
                        <th>Quantidade</th>
                    </tr>
                </thead>
                <?php 
                    while($row = $reservations->fetch_assoc()):
                ?>
                <tbody>
                    <tr>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['tax_id']; ?></td>
                        <td><?php echo $row['quantity']; ?></td>
                    </tr>
                </tbody>
                <?php endwhile; ?>
            </table>
            <a href="registration.php" class="btn btn-primary">Voltar</a>
        </div>
    </div>
</main>
<?php include_once '../footer.php'; ?>