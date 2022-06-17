<?php 
    include 'config.php';
    
    // echo '<pre>';
    // print_r($_POST);
    // echo '</pre>';

    if(isset($_POST['stripeToken'])){

        // for testing
        \Stripe\Stripe::setVerifySslCerts(false);

        $token = $_POST['stripeToken'];
        $lec_id = $_POST['lec_id'];

        
        $sql = $conn -> prepare("Update lecture_entry SET payment = 1 WHERE lec_id = ?");
        $sql -> bind_param("s", $lec_id);
        $sql -> execute();
        $sql -> close();

        $sqlL = $conn -> prepare("SELECT * FROM lecture_entry WHERE lec_id = ?");
        $sqlL -> bind_param("s", $lec_id);
        $sqlL -> execute();
        $result = $sqlL -> get_result() -> fetch_all(MYSQLI_ASSOC);
        $price = $result[0]['duration'] * 100 * 10;
        

        $data = \Stripe\Charge::create(array(
            'amount'=>$price,
            'currency'=>'usd',
            'description'=>$lec_id,
            'source'=>$token
        ));
        // echo '<pre>';
        // print_r($data);
        // echo '</pre>';
        echo "<script>alert('Payment Successful')</script>";
        
    }else{
        echo "<script>alert('Payment Unsuccessful')</script>";
    }
    
    $sqlL -> close();
?>