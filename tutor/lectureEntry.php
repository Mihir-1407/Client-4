<?php
    include 'header.php';
    
    $lec_id = $_GET['id'];

    $sqlL = $conn -> prepare("SELECT * FROM lecture_entry WHERE lec_id = ?");
    $sqlL -> bind_param("s", $lec_id);
    $sqlL -> execute();
    $resultL = $sqlL -> get_result() -> fetch_all(MYSQLI_ASSOC);

    if($resultL[0]['conducted'] == 1){
        header("Location: scheduledLecture.php?id=TUT" . $_SESSION['id']);
    }

    if(isset($_POST['form'])){

        // $sqlL = $conn -> prepare("SELECT * FROM lecture_entry WHERE lec_id = ?");
        // $sqlL -> bind_param("s", $lec_id);
        // $sqlL -> execute();
        // $resultS = $sqlL -> get_result();

        if(isset($_POST['conducted'])){
            $conducted = 1;
            $sqlC = $conn -> prepare("UPDATE lecture_entry SET conducted = ? WHERE lec_id = ?");
            $sqlC -> bind_param("ss", $conducted, $lec_id);
            $sqlC -> execute();
            $resultC = $sqlC -> get_result();
        }


        $temp = $_POST['Tutor_ID'];
        $len = strlen($temp);
        $temp = substr($temp, 3, $len - 3);
        $tu_id = intval($temp);

        $temp = $_POST['Std_id'];
        $len = strlen($temp);
        $temp = substr($temp, 3, $len - 3);
        $stu_id = intval($temp);

        

        $subjectTeached = $_POST['Subject'];
        $duration = $_POST['Time'];
        $payment = 0;


        $sqlS = $conn -> prepare("SELECT * FROM student WHERE stu_id = ?");
        $sqlS -> bind_param("s", $stu_id);
        $sqlS -> execute();
        $resultS = $sqlS -> get_result();

        while($rowS = $resultS -> fetch_assoc()){
            $to = $rowS['stu_email'];
        }

        $sql = $conn -> prepare("SELECT * FROM tutor WHERE tutor_id = ?");
        $sql -> bind_param("s", $tu_id);
        $sql -> execute();
        $result = $sql -> get_result();
        while($row = $result -> fetch_assoc()){
            $from = $row['email'];
        }


        $subject = "Test Mail";
        $message = "Payment Pathway. Pay the Fees";
        $headers = "From: " . $from;


        if(mysqli_num_rows($result) > 0 && mysqli_num_rows($resultS) > 0){
            if(mail($to, $subject, $message, $headers)){
                echo "<script>alert('Form Submitted / Email Sent')</script>";
            }
            else{
                echo "<script>alert('Error')</script>";
            }
        }else{
            echo "<script>alert('Error')</script>";

        }

        header("Location: scheduledLecture.php?id=TUT" . $_SESSION['id']);
    }

?>

<section>
    <div class="form">
        <form action="<?php $_SERVER['PHP_SELF']?>" class="a_form" method="post" autocomplete="off">
        <?php
            $conducted = false;

            $sqlL = $conn -> prepare("SELECT * FROM lecture_entry WHERE lec_id = ? AND conducted = ?");
            $sqlL -> bind_param("ss", $lec_id , $conducted);
            $sqlL -> execute();
            $result = $sqlL -> get_result();

            while($row = $result -> fetch_assoc()){

        ?>
            <label for="lec_id">Lecture ID</label>
            <input type="text" name="Lecture_ID" id="Lecture_ID" placeholder="" value="<?php echo $row['lec_id']?>" readonly>
            <label for="tutor_ID">Tutor ID</label>
            <input type="text" name="Tutor_ID" id="Tutor_ID" placeholder="" value="<?php echo "TUT" . $row['tutor_id']?>" readonly>
            <label for="Std_id">Student ID</label>
            <input type="text" name="Std_id" id="Std_id" placeholder="" value="<?php echo "STU" . $row['stu_id']?>" readonly>
            <label for="Subject">Subject</label>
            <input type="text" name="Subject" id="Subject" placeholder="" value="<?php echo $row['subject']?>" readonly>
            <label for="Time">Duration</label>
            <input type="number" name="Time" id="Time" placeholder="Time in hours" value="<?php echo $row['duration']?>" readonly>
            <label for="Conducted">Conducted</label>
            <input type="checkbox" name="conducted" id="conducted" placeholder="" >
            <br>
            <?php 
                date_default_timezone_set("Asia/Kolkata");
                $check_time = date("h:i:s");
                if($row['etime'] < $check_time){
                    echo '<input type="submit" class="button" name="form">';
                }
                else{
                    echo '<input type="submit" class="button" name="form" style="opacity:0.5;" disabled>';
                }
            ?>
        </form>
        <?php 
        }
        $sqlL -> close(); 
        ?>  
    </div>
</section>


<?php
    include '../footer.php';
?>