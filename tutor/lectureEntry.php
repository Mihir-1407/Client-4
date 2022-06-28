<?php
    include 'header.php';
    
    $lec_id = $_GET['id'];

    if(isset($_POST['form'])){

        
        // echo $_POST['size'] . "  " . $_POST['reason'] . "  ";

        if($_POST['size'] == "Conducted"){
            $conducted = true;
            $sqlC = $conn -> prepare("UPDATE lecture_entry SET conducted = ? WHERE lec_id = ?");
            $sqlC -> bind_param("ss", $conducted, $lec_id);
            $sqlC -> execute();
            $resultC = $sqlC -> get_result();
        }
        
        if($_POST['size'] == "Not Conducted"){
            $reason = $_POST['reason'];    
        }else{
            $reason = "";
        }

        $submitted = 1;
        $sqlE = $conn -> prepare("UPDATE lecture_entry SET submitted = ?, remark = ? WHERE lec_id = ?");
        $sqlE -> bind_param("sss", $submitted, $reason, $lec_id);
        $sqlE -> execute();
        $resultE = $sqlE -> get_result();

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

        
        $sqlL = $conn -> prepare("SELECT * FROM lecture_entry WHERE lec_id = ?");
        $sqlL -> bind_param("s", $lec_id);
        $sqlL -> execute();
        $resultL = $sqlL -> get_result() -> fetch_all(MYSQLI_ASSOC);
        if(count($resultL) > 0){

            $from = 'mihir.hemnani99@gmail.com';    

            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $headers .= 'From: AnyDay Tutors<'.$from.'>' . "\r\n";
            $headers .= 'Reply-To: '.$from."\r\n";
            $headers .= 'X-Mailer: PHP/' . phpversion();
    
            $subject = 'AnyDay Tutors';
            $message = '<html> 
                            <head> 
                            </head> 
                            <body> 
                                <h1>Lecture Details</h1> 
                                <table cellspacing="0" style="border: 1px solid black; width: 100%;">  
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
                                <button><a href="https://online-teaching-platform.000webhostapp.com/feedback.php?id1=TUT' . $resultL[0]['tutor_id'] . '&id2='. $resultL[0]['lec_id'] .'">FeedBack Link</a></button>
                            </body> 
                        </html>';
            }

        

        if(mysqli_num_rows($resultS) > 0 && $_POST['size'] == "Conducted"){
            if(mail($to, $subject, $message, $headers)){
                echo "<script>alert('Form Submitted')</script>";
            }
            else{
                echo "<script>alert('Form Not Submitted')</script>";
            }
        }else if($_POST['size'] == "Not Conducted"){
            echo "<script>alert('Form Submitted')</script>";
        }else{
            echo "<script>alert('Error')</script>";

        }
        $sqlL -> close();
        header("Location: scheduledLecture.php?id=TUT" . $_SESSION['id']);
    }
    

?>
<div class="page-wrap">
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
            
            

            <div id="group">
            </div>
            <br>

            <script>
                const sizes = ['Conducted', 'Not Conducted'];

                // generate the radio groups        
                const group = document.querySelector("#group");
                group.innerHTML = sizes.map((size) => `<div>
                        <input type="radio" name="size" value="${size}" id="${size} required">
                        <label for="${size}">${size}</label>
                    </div>`).join(' ');
                
                // add an event listener for the change event
                const radioButtons = document.querySelectorAll('input[name="size"]');
                for(const radioButton of radioButtons){
                    radioButton.addEventListener('change', showSelected);
                }        
                
                function showSelected(e) {
                    // console.log(e);
                    let elementL = document.getElementById("why");
                    let element = document.getElementById("reason");
                    let hiddenL = elementL.getAttribute("hidden");
                    let hidden = element.getAttribute("hidden");
                    
                    if (this.checked && this.value == 'Not Conducted') {

                        if (hidden && hiddenL) {
                            elementL.removeAttribute("hidden");
                            element.removeAttribute("hidden");
                        } 
                    }else{
                        elementL.setAttribute("hidden", "hidden");    
                        element.setAttribute("hidden", "hidden");
                    }
                }
            </script>
            <label for="reason" id="why" hidden="hidden">Reason</label>
            <textarea id="reason" name="reason" hidden="hidden"></textarea>
            <input type="submit" class="button" name="form">
        </form>
        <?php 
        }
        $sqlL -> close();
        ?>  
    </div>
</section>
</div>


<?php
    include '../footer.php';
?>