<?php

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
        $submitted = 0;
    
        $sqlL = $conn -> prepare("INSERT INTO lecture_entry VALUES(?,?,?,?,?,?,?,?,?,?,?)");
        $sqlL -> bind_param('sssssssssss', $lec_id, $tutor_id, $stu_id, $subject, $sdate, $stime, $etime, $duration, $conducted, $payment, $submitted);
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
        $fromEmail = "mihir.hemnani99@gmail.com";
        

        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: '.$fromEmail.'<'.$fromEmail.'>' . "\r\n".'Reply-To: '.$fromEmail."\r\n" . 'X-Mailer: PHP/' . phpversion();

        $subject = 'AnyDay Tutors';
        $message = '<html> 
                        <head> 
                        </head> 
                        <body> 
                            <h1>Lecture Schedule</h1> 
                            <table cellspacing="0" style="border: 1px solid black; width: 100%;"> 
                                <tr> 
                                <th>Lecture ID: </th><td>' . $lec_id . '</td> 
                                </tr>
                                <tr> 
                                    <th>Tutor ID: </th><td>TUT' . $tutor_id . '</td> 
                                </tr> 
                                <tr> 
                                    <th>Student ID: </th><td>STU' . $stu_id . '</td> 
                                </tr> 
                                <tr> 
                                    <th>Date : </th><td>' . date("d-m-Y", strtotime($sdate)) . '</td> 
                                </tr>
                                <tr> 
                                    <th>Time : </th><td>' . date('h:i A', strtotime($stime)) . '</td> 
                                </tr>
                                <tr> 
                                    <th>Duration : </th><td>' . $duration . ' hours</td> 
                                </tr>
                                <tr> 
                                    <th>Duration : </th><td>' . $subject . '</td> 
                                </tr>
                            </table> 
                        </body> 
                    </html>';
        
        $result = mail($to, $subject, $message, $headers);
            echo "<script>alert('Email Sent to TUT$tutor_id')</script>";
        if(!$result){
            echo "<script>alert('Failed to send Email.')</script>";
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
            <input type="number" step="0.5" name="duration" id="duration" placeholder="Time in hours" min="0.5" required>
            <br>
            <input type="submit" class="button" name="schedule">
            <?php
            $sqlL -> close();
            ?>
        </form>
    </div>
</section>

<?php
    include "../footer.php";
?>