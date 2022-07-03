<?php
session_start();
include '../company.php';
include '../config.php';
   
    $id = $_SESSION["id"];
    if(!isset($_SESSION["id"]) OR $_SESSION["id"] == "Admin"){
        header("Location: index.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <title>AnyDay Tutors</title>
</head>


<body>
    <header>
        <div class="head_admin">
            <div class="company">
                <h1><?php echo $company_logo?>
                <?php echo $company_name?></h1>
            </div>
            <div class="navigation">
                <?php
                    echo "ID : TUT" . $id . "<br>";
                ?><br>
                <a href="scheduledLecture.php?id=<?php echo 'TUT' . $id?>">Lectures</a>&nbsp;&nbsp;&nbsp;
                <a href="../logout.php">Logout</a>&nbsp;&nbsp;
            </div>
        </div>
    </header>