<?php 
    include 'header.php'; 
    
    $temp = $_GET['id'];
    $len = strlen($temp);
    $temp = substr($temp, 3, $len - 3);
    $stu_id = intval($temp);

    $sqlS = $conn -> prepare("SELECT * FROM student WHERE stu_id = ?");
    $sqlS -> bind_param('s', $stu_id);
    $sqlS -> execute();
    $result = $sqlS -> get_result() -> fetch_all(MYSQLI_ASSOC);

    if(count($result) > 0){
        
?>
<div class="form">
    <h2>Edit Student Info</h2>
    <form action="<?php $_SERVER['PHP_SELF']?>" class="a_form" method="post">
        <label for="Std_id">Student ID</label>
        <input type="text" name="stuID" id="stuID" value="<?php echo "STU" . $result[0]['stu_id'] ?>" readonly>
        <label for="Std_Name">Student Name</label>
        <input type="text" name="stuName" id="stuName" value="<?php echo $result[0]['stu_name'] ?>">
        <label for="Std_Email">Email</label>
        <input type="email" name="stuEmail" id="stuEmail" value="<?php echo $result[0]['stu_email'] ?>">
        <br>
        <input type="submit" class="button" name="submit">
    </form> 

    <?php

        if(isset($_POST['submit'])){
            $temp = $_POST['stuID'];
            $len = strlen($temp);
            $temp = substr($temp, 3, $len - 3);
            $id = intval($temp);
            $email = $_POST['stuEmail'];
            $name = $_POST['stuName'];


            $sqlS = $conn -> prepare("UPDATE student SET stu_id = ?, stu_name = ?, stu_email = ? WHERE stu_id = ? ");
            $sqlS -> bind_param("ssss", $id, $name, $email, $id);
            $sqlS -> execute();

            if($sqlS -> affected_rows > 0){
                echo "<script>alert('Updated STU$id')</script>";
                header("Refresh:1");
            }else{
                echo "<script>alert('No Change')</script>";
            }
            

            $sqlS -> close();
        }

    ?>
</div>

<?php
    }
    include '../footer.php';
?>



