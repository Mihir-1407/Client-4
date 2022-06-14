<?php 
    session_start();
    include 'config.php';

    $lec_id = $_GET['id'];
    
    echo "<script>alert('Lecture ID : $lec_id')</script>";

    // session_unset();
    // session_destroy();

    //payment link 
    header("Location: ");
?>