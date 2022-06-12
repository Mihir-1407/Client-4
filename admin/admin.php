<?php

    include_once 'header.php';
    if(isset($_POST['student'])){
            
        $temp = $_POST['stuID'];
        $len = strlen($temp);
        $temp = substr($temp, 3, $len - 3);
        $stu_id = intval($temp);

        $stu_name = $_POST['stuName'];
        $stu_email = $_POST['stuEmail'];

        $sqlA = $conn -> prepare("INSERT INTO student VALUES (?,?,?)");
        $sqlA -> bind_param('sss', $stu_id, $stu_name, $stu_email);
        $sqlA -> execute();

        if($sqlA -> affected_rows > 0){
            echo "<script>alert('New Student Added')</script>";
        }else{
            echo "<script>alert('Error')</script>";
        }

        $sqlA -> close();


    }

    else if(isset($_POST['tutor'])){

        $temp = $_POST['Tutor_ID'];
        $len = strlen($temp);

        $temp = substr($temp, 3, $len - 3);
        $tutor_id = intval($temp);

        $tutor_name = $_POST['Tutor_Name'];
        $tutor_email = $_POST['Tutor_Email'];
        $contact_no = $_POST['contact'];
        $subject = $_POST['subject'];

        $passwordT = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890!@#$%^&*()_+abcdefghijklmnopqrstuvwxyz";
        $len = strlen($passwordT);
        $passwordT = str_shuffle($passwordT);
        $number = rand(0,  $len - 9);
        $passwordT = substr($passwordT, $number, 8);
            
        $sqlA = $conn -> prepare("INSERT INTO tutor VALUES(?,?,?,?,?,?)");
        $sqlA -> bind_param('ssssss', $tutor_id, $tutor_name, $tutor_email, $contact_no, $subject, $passwordT);
        $sqlA -> execute();


        if($sqlA -> affected_rows > 0){
            echo "<script>alert('New Tutor Added')</script>";
        }else{
            echo "<script>alert('Error')</script>";
        }

        $sqlA -> close();
}



?>

<section class="adminhome">
    <div class="addnew">
        <div class="new_student">
            <h2>New Student</h2><br>
            <form action="<?php $_SERVER['PHP_SELF']?>" class="a_form" method="post" autocomplete="off">
            <?php
                $sqlS = $conn -> prepare("SELECT stu_id FROM student ORDER BY stu_id DESC LIMIT 1");
                $sqlS -> execute();
                $result = $sqlS -> get_result() -> fetch_all(MYSQLI_ASSOC);
                if(count($result) == 0){
                    $number = 0;
                }else{
                $number = $result[0]['stu_id'];
                }
                $number = $number + 1;
                $stu_id = "STU" . "$number";
            ?>
                <label for="Std_id">Student ID</label>
                <input type="text" name="stuID" id="stuID" placeholder="" value="<?php echo $stu_id?>" readonly>
                <label for="Std_Name">Student Name</label>
                <input type="text" name="stuName" id="stuName" placeholder="" required>
                <label for="Std_Email">Email</label>
                <input type="email" name="stuEmail" id="stuEmail" placeholder="" required>
                <br>
                <input type="submit" class="button" name="student">
            <?php
            $sqlS -> close();
            ?>
            </form>
        </div>
        <div class="new_tutor">
            <h2>New Tutor</h2><br>
            <form action="<?php $_SERVER['PHP_SELF']?>" class="a_form" method="post" autocomplete="off">
            <?php
                $sqlT = $conn -> prepare("SELECT tutor_id FROM tutor ORDER BY tutor_id DESC LIMIT 1");
                $sqlT -> execute();
                $result = $sqlT -> get_result() -> fetch_all(MYSQLI_ASSOC);
                if(count($result) == 0){
                    $number = 0;
                }else{
                $number = $result[0]['tutor_id'];
                }
                $number = $number + 1;
                $tutor_id = "TUT" . "$number";
            ?>
                <label for="Tutor_ID">Tutor ID</label>
                <input type="text" name="Tutor_ID" id="Tutor_ID" placeholder="" value="<?php echo $tutor_id?>" readonly>
                <label for="Tutor_Name">Tutor Name</label>
                <input type="text" name="Tutor_Name" id="Tutor_Name" placeholder="" required>
                <label for="Tutor_Email">Email</label>
                <input type="email" name="Tutor_Email" id="Tutor_Email" placeholder="" required>
                <label for="contact">Contact No.</label>
                <input type="tel" name="contact" id="contact" placeholder="" required>
                <label for="subject">Subject</label>
                <input type="text" name="subject" id="subject" placeholder="" required>
                <br>
                <input type="submit" class="button" name="tutor">
            <?php
                $sqlT -> close();
            ?>
            </form>
        </div>
    </div>    
</section>


<?php include '../footer.php';?>

