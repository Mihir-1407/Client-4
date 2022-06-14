<?php
session_start();
if(isset($_SESSION["id"])){
    if($_SESSION["id"] == "Admin"){
        header("Location: admin/admin.php?id=" . $_SESSION["id"]);
    }else{
        header("Location: tutor/lectureEntry.php?id=TUT" . $_SESSION["id"]);
    }
}

include 'config.php';
if(isset($_POST['submit'])){
    
    $id = $_POST['id'];
    $pass = $_POST['pass'];
    $adminpass = md5($pass);

    // for admin
    $sqlA = $conn -> prepare("SELECT * FROM admin WHERE admin_id = ? AND passwordA = ?");
    $sqlA -> bind_param("ss", $id, $adminpass);
    $sqlA -> execute();
    $resultA = $sqlA -> get_result();

    // for Tutor   
    $len = strlen($id) ;
    $tid = substr($id, 3, $len - 3);
    $tid = intval($tid);

    $sqlT = $conn -> prepare("SELECT tutor_id, passwordT FROM tutor WHERE tutor_id =  ? AND passwordT = ?");
    $sqlT -> bind_param("ss", $tid, $pass);
    $sqlT -> execute();
    $resultT = $sqlT -> get_result();

    if(mysqli_num_rows($resultA) > 0){
        while($row = $resultA -> fetch_assoc()){
            $_SESSION["id"] = $row['admin_id'];
        }
        header("Location: ./admin/admin.php?id=" . $id);
    
    }else if(mysqli_num_rows($resultT) > 0){
        while($row = $resultT -> fetch_assoc()){
            $_SESSION["id"] = $row['tutor_id'];
        }
        header("Location: ./tutor/scheduledLecture.php?id=TUT" . $tid);
    
    }else{
        echo "<h1 class=''>Invalid ID / Password </h1>";
    }

    $sqlT -> close();
    $sqlA -> close();
}
?>

<?php
include 'header.php';

?>
<div class="login">
    <div class="header">
        <h1><?php echo $company_logo?><?php echo $company_name?><br>
        </h1>
    </div>
    
    <div class="form">
    <h2>Login</h2>
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" autocomplete="off">
            <label for="id">ID</label>
            <input type="text" id="id" name="id" placeholder="ID" required>
            <label for="pass">Password</label>
            <input type="password" id="pass" name="pass" placeholder="Password" required>
            <br>
            <input type="submit" class="button" name="submit">
        </form>
    </div>  
</div>

<?php include 'footer.php'?>