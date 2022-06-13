<?php

use LDAP\Result;
use PHPMailer\PHPMailer\PHPMailer;

    include "header.php";
    include '../config.php';


    if(isset($_POST["schedule"])){

        $lec_id = $_POST['lec_id'];

        $sqlR = $conn -> prepare("SELECT lec_id FROM lecture_entry WHERE lec_id = ?");
        $sqlR -> bind_param('s', $lec_id);
        $sqlR -> execute();
        $resultR = $sqlR -> get_result();
        if(mysqli_num_rows($resultR) > 0){
            header("Location: lectureSchedule.php?id=" . $_SESSION['id']);
        }


        $temp = $_POST['tut_ID'];
        $len = strlen($temp);
        $temp = substr($temp, 3, $len - 3);
        $tutor_id = intval($temp);

        $temp = $_POST['stu_id'];
        $len = strlen($temp);
        $temp = substr($temp, 3, $len - 3);
        $stu_id = intval($temp);

        $subject = $_POST['subject'];
        $sdate = $_POST['sdate'];
        $stime = $_POST['stime'];
        $duration = $_POST['duration'];

        $hour = floor($duration);
        $minute = ($duration - $hour) * 60;
        $addTime = "+" . $hour . " hour +" . $minute . " minutes";
        $etime = date('H:i',strtotime($addTime,strtotime($stime)));

        $conducted = 0;
        $payment = 0;

    
        $sqlL = $conn -> prepare("INSERT INTO lecture_entry VALUES(?,?,?,?,?,?,?,?,?,?)");
        $sqlL -> bind_param('ssssssssss', $lec_id, $tutor_id, $stu_id, $subject, $sdate, $stime, $etime, $duration, $conducted, $payment);
        $sqlL -> execute();
        
        if($sqlL -> affected_rows > 0){
            echo '<script>alert("Lecture Scheduled")</script>';
        }else{
            echo '<script>alert("Scheduling Failed")</script>';
        }
    
        $sqlL -> close();




        // email to Tutor for Lecture Scheduled
        $sql = $conn -> prepare("SELECT * FROM tutor WHERE tutor_id = ?");
        $sql -> bind_param("s", $tutor_id);
        $sql -> execute();
        $result = $sql -> get_result();
        while($row = $result -> fetch_assoc()){
            $to = $row['email'];
        }


        // admin email address
        // $from = "mihir.hemnani99@gmail.com";
        // $subject = "Test Mail";
        // $message = "Payment Pathway. Pay the Fees";
        // $header = "From: mihir.hemnani99@gmail.com\r\n";
        // $header.= "MIME-Version: 1.0\r\n";
        // $header.= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        // $header.= "X-Priority: 1\r\n";
        
        // if(mail($to, $subject, $message, $headers)){
        //     echo "<script>alert('Email Sent to TUT{tutor_id}')</script>";
        // }
        // else{
        //     echo "<script>alert('Failed')</script>";
        // }

        // echo "<script>alert('{$from} : {$to}')</script>";
        






        $to= 'gandhimihir0909@gmail.com';
        $subject = 'the subject';
        $message = 'hello';
        $headers = 'From: mjg2762@gmail@gmail.com' . "\r\n" .
            'Reply-To: webmaster@example.com' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();

        $result = mail($to, $subject, $message, $headers);
            echo "<script>alert('Email Sent to TUT{tutor_id}')</script>";
        if(!$result){
            echo "<script>alert('Failed')</script>";
        }

    }

    

?>

<section>
    <h2>Schedule Lecture</h2>
    <div class="form">  
        <form action="<?php $_SERVER["PHP_SELF"]?>" class="a_form" method="post" autocomplete="off">
            <?php
                $sqlL = $conn -> prepare("SELECT lec_id FROM lecture_entry ORDER BY lec_id DESC LIMIT 1");
                $sqlL -> execute();
                $result = $sqlL -> get_result() -> fetch_all(MYSQLI_ASSOC);
                if(count($result) == 0){
                    $number = 0;
                }else{
                $number = $result[0]['lec_id'];
                }
                $number = $number + 1;
                $lec_id = "$number";
            ?>
            <label for="tutor_ID">Lecture ID</label>
            <input type="text" name="lec_id" id="lec_id" placeholder="" value="<?php echo $lec_id?>" readonly>
            <label for="tutor_ID">Tutor ID</label>
            <input type="text" name="tut_ID" id="tut_ID" placeholder="TUT..." value="" required>
            <label for="Std_id">Student ID</label>
            <input type="text" name="stu_id" id="stu_id" placeholder="STU..." required>
            <label for="Subject">Subject</label>
            <input type="text" name="subject" id="subject" placeholder="eg.Maths" required>
            <label for="Time">Scheduled Date</label>
            <input type="date" name="sdate" id="sdate" placeholder="" required>
            <label for="Time">Scheduled Time</label>
            <input type="time" name="stime" id="stime" placeholder="" required>
            <label for="Time">Duration</label>
            <input type="number" step="0.5" name="duration" id="duration" placeholder="Time in hours" min="0" required>
            <br>
            <input type="submit" class="button" name="schedule">
            <?php
            $sqlL -> close();
            ?>
        </form>
    </div>
</section>

