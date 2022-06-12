<?php
    include 'header.php';
        
    $temp = $_POST['Tutor_ID'];
    $len = strlen($temp);
    $temp = substr($temp, 3, $len - 3);
    $tu_id = intval($temp);

    $temp = $_POST['Std_id'];
    $len = strlen($temp);
    $temp = substr($temp, 3, $len - 3);
    $stu_id = intval($temp);

    // echo $stu_id;
    // echo $tu_id;

    $subjectTeached = $_POST['Subject'];
    $duration = $_POST['Time'];
    $payment = 0;


    $sqlS = $conn -> prepare("SELECT * FROM student WHERE stu_id = ?");
    $sqlS -> bind_param("s", $stu_id);
    $sqlS -> execute();
    $resultS = $sqlS -> get_result();


    if(mysqli_num_rows($resultS) < 1){
        
        echo "<h1>Enter valid Student ID<h1>";

    }else{

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
    }
?>

<?php
    include '../footer.php';
?>
