<?php
    include '../company.php';
    include '../config.php';

    session_start();

    $id = $_SESSION['id'];

    if(!isset($_SESSION["id"]) || $_SESSION["id"] != "Admin"){
        header("Location: ../index.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <title>Admin</title>
</head>


<body>
    <header>
        <div class="head_admin">
            <div class="company">
                <?php echo $company_logo?><br>
                <?php echo $company_name?>
            </div>
            <div class="navigation">
                <?php
                $sqlA = $conn -> prepare("SELECT admin_name FROM admin WHERE admin_id = ?");
                $sqlA -> bind_param('s', $id);
                $sqlA -> execute();
                $result = $sqlA -> get_result() -> fetch_all(MYSQLI_ASSOC);
                if(count($result) > 0){
                echo "Hello " . $result[0]['admin_name'] . "<br>";
                $sqlA -> close();
                }
                ?>
                <a href="admin.php?id=<?php echo $id?>">Home</a>&nbsp;&nbsp;&nbsp;
                <div class="dropdown">
                    <a class="dropbtn" href="" onclick="return false">Lecture</a>&nbsp;&nbsp;&nbsp;
                    <div class="dropdown-content">
                        <a href="lectureSchedule.php?id=<?php echo $id?>">Schedule</a>
                        <a href="lectureTakenDisplay.php?id=<?php echo $id?>">Data</a>
                    </div>
                </div>
                <a href="displayStudent.php?id=<?php echo $id?>">Student</a>&nbsp;&nbsp;&nbsp;
                <a href="displayTutor.php?id=<?php echo $id?>">Tutor</a>&nbsp;&nbsp;&nbsp;
                <a href="../logout.php">Logout</a>&nbsp;&nbsp;
            </div>
        </div>
    </header>

</body>

