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

        // email to New Student
       
        $to = $stu_email;
        
        // admin email id
        $fromEmail = "mihir.hemnani99@gmail.com";
        

        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: '.$fromEmail.'<'.$fromEmail.'>' . "\r\n".'Reply-To: '.$fromEmail."\r\n" . 'X-Mailer: PHP/' . phpversion();

        $subject = 'AnyDay Tutors';
        $message = '<html> 
                        <head> 
                        </head> 
                        <body> 
                            <h1>Login Credentials</h1> 
                            <table cellspacing="0" style="border: 2px dashed #FB4314; width: 100%;"> 
                                
                                <tr> 
                                    <th>Student ID : </th><td>STU' . $stu_id . '</td> 
                                </tr> 
                
                                <tr> 
                                    <th>Email ID : </th><td>' . $stu_email . '</td> 
                                </tr>


                            </table> 
                        </body> 
                    </html>';

        $result = mail($to, $subject, $message, $headers);
        if(!$result){
            echo "<script>alert('Failed')</script>";
        }else{
            echo "<script>alert('Email Sent to STU$stu_id')</script>";
        }


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
        $tutor_password = md5($passwordT);
            
        $sqlA = $conn -> prepare("INSERT INTO tutor VALUES(?,?,?,?,?,?)");
        $sqlA -> bind_param('ssssss', $tutor_id, $tutor_name, $tutor_email, $contact_no, $subject, $tutor_password);
        $sqlA -> execute();

        if($sqlA -> affected_rows > 0){
            echo "<script>alert('New Tutor Added')</script>";
        }else{
            echo "<script>alert('Error')</script>";
        }

        $sqlA -> close();

        // email to New Tutor
       
        $to = $tutor_email;
        
        // admin email id
        $fromEmail = "mihir.hemnani99@gmail.com";
        

        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: '.$fromEmail.'<'.$fromEmail.'>' . "\r\n".'Reply-To: '.$fromEmail."\r\n" . 'X-Mailer: PHP/' . phpversion();

        $subjectEmail = 'AnyDay Tutors';
        $message = '<html> 
                        <head> 
                        </head> 
                        <body> 
                            <h1>Login Credentials</h1> 
                            <table cellspacing="0" style="border: 2px dashed #FB4314; width: 100%;"> 
                                
                                <tr> 
                                    <th>Tutor ID : </th><td>TUT' . $tutor_id . '</td> 
                                </tr> 
                
                                <tr> 
                                    <th>Email ID : </th><td>' . $tutor_email . '</td> 
                                </tr>

                                <tr> 
                                    <th>Password : </th><td>' . $passwordT . '</td> 
                                </tr>


                            </table> 
                        </body> 
                    </html>';

        $result = mail($to, $subjectEmail, $message, $headers);
        if(!$result){
            echo "<script>alert('Failed')</script>";
        }else{
            echo "<script>alert('Email Sent to TUT$tutor_id')</script>";
        }

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

