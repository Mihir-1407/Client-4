<?php 
    include 'header.php'; 

    $temp = $_GET['id'];
    $len = strlen($temp);
    $temp = substr($temp, 3, $len - 3);
    $tu_id = intval($temp);

    $sqlS = $conn -> prepare("SELECT * FROM tutor WHERE tutor_id = ?");
    $sqlS -> bind_param('s', $tu_id);
    $sqlS -> execute();
    $result = $sqlS -> get_result() -> fetch_all(MYSQLI_ASSOC);

    if(count($result) > 0){
        
?>
<div class="form">
    <h2>Edit Tutor Info</h2>
    <form action="<?php $_SERVER['PHP_SELF']?>" class="a_form" method="post">
        <label for="td_id">Tutor ID</label>
        <input type="text" name="tuID" id="tuID" value="<?php echo "TUT" . $result[0]['tutor_id'] ?>" readonly>
        <label for="td_name">Tutor Name</label>
        <input type="text" name="tuName" id="tuName" value="<?php echo $result[0]['tutor_name'] ?>">
        <label for="td_email">Email</label>
        <input type="email" name="tuEmail" id="tuEmail" value="<?php echo $result[0]['email'] ?>">
        <label for="td_contact">Contact No.</label>
        <input type="text" name="tuContact" id="tuContact" value="<?php echo $result[0]['contact_no'] ?>">
        <label for="td_subject">Subject</label>
        <input type="subject" name="tuSubject" id="tuSubject" value="<?php echo $result[0]['subject'] ?>">
        <br>
        <input type="submit" class="button" name="submit">
    </form> 

    <?php

        if(isset($_POST['submit'])){
            $temp = $_POST['tuID'];
            $len = strlen($temp);

            $temp = substr($temp, 3, $len - 3);
            $id = intval($temp);
            $name = $_POST['tuName'];
            $email = $_POST['tuEmail'];
            $contact = $_POST['tuContact'];
            $subject = $_POST['tuSubject'];

            
            $sqlT = $conn -> prepare("UPDATE tutor SET tutor_id = ?, tutor_name = ?, email = ? , contact_no = ?, subject = ? WHERE tutor_id = ? ");
            $sqlT -> bind_param("ssssss", $id, $name, $email, $contact, $subject, $id);
            $sqlT -> execute();

            if($sqlS -> affected_rows > 0){
                echo "<script>alert('Updated TUT{$id}')</script>";
                header("Refresh:1");
            }else{
                echo "<script>alert('Error')</script>";
            }
            

            $sqlS -> close();
        }

    ?>

</div>
<?php
    }
    include '../footer.php';
?>



