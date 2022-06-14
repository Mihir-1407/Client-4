<?php
    include 'header.php';
    
    $lec_id = $_GET['id'];

    // $sqlL = $conn -> prepare("SELECT lec_id FROM lecture_entry WHERE lec_id = ?");
    // $sqlL -> bind_param("s", $lec_id);
    // $sqlL -> execute();
    // $resultL = $sqlL -> get_result() -> fetch_all(MYSQLI_ASSOC);

    // if($resultL[0]['conducted'] == 1){
    //     header("Location: scheduledLecture.php?id=TUT" . $_SESSION['id']);
    // }

    if(isset($_POST['form'])){


        $submitted = 1;
        $sqlE = $conn -> prepare("UPDATE lecture_entry SET submitted = ? WHERE lec_id = ?");
        $sqlE -> bind_param("ss", $submitted, $lec_id);
        $sqlE -> execute();
        $resultE = $sqlE -> get_result();


        if(isset($_POST['conducted'])){
            $conducted = true;
            $sqlC = $conn -> prepare("UPDATE lecture_entry SET conducted = ? WHERE lec_id = ?");
            $sqlC -> bind_param("ss", $conducted, $lec_id);
            $sqlC -> execute();
            $resultC = $sqlC -> get_result();
        

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

            
            $sqlL = $conn -> prepare("SELECT * FROM lecture_entry WHERE lec_id = ?");
            $sqlL -> bind_param("s", $lec_id);
            $sqlL -> execute();
            $resultL = $sqlL -> get_result() -> fetch_all(MYSQLI_ASSOC);
            if(count($resultL) > 0){

            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $headers .= 'From: '.$from.'<'.$from.'>' . "\r\n".'Reply-To: '.$from."\r\n" . 'X-Mailer: PHP/' . phpversion();

            $subjectEmail = 'AnyDay Tutors';
            $message = '<html> 
                            <head> 
                            </head> 
                            <body> 
                                <h1>Lecture Details</h1> 
                                <table cellspacing="0" style="border: 2px dashed #FB4314; width: 100%;"> 
                                    <tr> 
                                    <th>Lecture ID : </th><td>' . $resultL[0]['lec_id'] . '</td> 
                                    </tr>
                                    <tr> 
                                        <th>Tutor ID : </th><td>TUT' . $resultL[0]['tutor_id'] . '</td> 
                                    </tr> 
                                    <tr> 
                                        <th>Student ID : </th><td>STU' . $resultL[0]['stu_id'] . '</td> 
                                    </tr> 
                                    <tr> 
                                        <th>Subject : </th><td>' . $resultL[0]['subject'] . '</td> 
                                    </tr>
                                    <tr> 
                                        <th>Date : </th><td>' . date("d-m-Y", strtotime($resultL[0]['sdate'])) . '</td> 
                                    </tr>
                                    <tr> 
                                        <th>Time : </th><td>' . date('h:i A', strtotime($resultL[0]['stime'])) . ' to ' . date('h:i A', strtotime($resultL[0]['etime'])) .  '</td> 
                                    </tr>
                                    <tr> 
                                        <th>Duration : </th><td>' . $resultL[0]['duration'] . ' Hour</td> 
                                    </tr>
                                </table> 
                                <button><a href="https://online-teaching-platform.000webhostapp.com/feedback.php?id=STU' . $resultL[0]['stu_id'] . '">FeedBack Link</a></button>
                            </body> 
                        </html>';
            }

            

            if(mysqli_num_rows($result) > 0 && mysqli_num_rows($resultS) > 0){
                if(mail($to, $subjectEmail, $message, $headers)){
                    echo "<script>alert('Form Submitted')</script>";
                }
                else{
                    echo "<script>alert('Form Not Submitted')</script>";
                }
            }else{
                echo "<script>alert('Error')</script>";

            }
            $sqlL -> close();
            // header("Location: scheduledLecture.php?id=TUT" . $_SESSION['id']);
        }

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
            <input type="submit" class="button" name="form">
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