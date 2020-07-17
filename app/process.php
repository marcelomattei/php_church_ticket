<?php 
    include 'class/reservation.php';
    include 'class/worship.php';
    $reservation_obj = new Reservation();
    $worship_obj = new Worship();

    session_start();

    if (isset($_POST['create_reservation'])) {
        $reservation_obj->create_reservation($_POST);
        header("location: public/new_reservation.php");
    }

    if (isset($_POST['create_worship'])) {
        $worship_obj->create_worship($_POST);
        header("location: private/worship.php");
    }

    if (isset($_GET['delete_worship'])) {
        $worship_obj->delete_worship($_GET);
        header("location: private/worship.php");
    }
?>