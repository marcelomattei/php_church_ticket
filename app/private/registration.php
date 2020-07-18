<?php require_once '../process.php'; ?>
<?php include_once '../header.php'; ?>

<?php include_once 'menu.php'; ?>
  <main role="main" class="container">
    <div class="menu-template">
    <?php
        $reservation_summary_list = $reservation_obj->list_summary_active_reservations();
    ?>
        <a href="registration.php" class="btn btn-primary">Atualizar</a>
        <br>
        <div class="container">
            <div class="row justify-content-center">
                <p><b>Relatório de reservas: </b>
                    <?php echo date('d/m/Y') ?>
                </p>
            <div>
        </div>
        <?php if ($reservation_summary_list->num_rows): ?>
        <div class="container">
            <div class="row justify-content-center">
                <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Horário</th>
                        <th>Atual</th>
                        <th>Limite</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <?php 
                    while($row = $reservation_summary_list->fetch_assoc()):
                ?>
                <tbody>
                    <tr>
                        <td>
                            <?php echo $row['description']; ?> - 
                                <?php echo date_format(date_create($row['date']),'d/m/Y'); ?> - 
                                <?php echo $row['hour']; ?>
                        </td>
                        <td><?php echo $row['current_qty']; ?></td>
                        <td><?php echo $row['places']; ?></td>
                        <td>
                            <a href="registration_detail.php?detail_reservation_summary=<?php echo $row['id']; ?>"
                                class="btn btn-success">Detalhar</a>
                        </td>
                    </tr>
                </tbody>
                <?php endwhile; ?>
            </table>
        </div>
    </div>
    <?php endif; ?>
    </div>
    <?php if (!$reservation_summary_list->num_rows): ?>
        <div class="container">
            <div class="row justify-content-center">
                <p>Não foram encontrados registros.</p>
            </div>
        </div>
    <?php endif; ?>
</main>
<?php include_once '../footer.php'; ?>