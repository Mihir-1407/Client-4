<?php
    session_start();
    $_SESSION['id'] = $_GET['id']; 
    include 'config.php';

    $temp = $_POST['tutor_id'];
    $len = strlen($temp);
    $temp = substr($temp, 3, $len - 3);
    $tutor_id = intval($temp);

  
    $sqlF = $conn -> prepare("INSERT INTO feedback VALUES(?, ?, ?)");
    $sqlF -> bind_param("sss", $tutor_id, $_POST['rating'], $_POST['comment']);
    $sqlF -> execute();

    if($sqlF -> affected_rows > 0){
        echo "<script>alert('Proceed toward payment')</script>";
    }else{
        echo "<script>alert('Please try again')</script>";
    }
    
    session_unset();
    session_destroy();

    //payment link 
    header("Location: ");
?>