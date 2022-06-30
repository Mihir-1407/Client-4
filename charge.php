<?php 
include 'config.php';

    try{
        $lec_id = $_GET['id'];
        $sqlL = $conn -> prepare("SELECT * FROM lecture_entry WHERE lec_id = ?");
        $sqlL -> bind_param("s", $lec_id);
        $sqlL -> execute();
        $result = $sqlL -> get_result() -> fetch_all(MYSQLI_ASSOC);
        $price = $result[0]['duration'] * 10;
        $response = $gateway->purchase(array(
            'amount' => $price,
            'currency' => PAYPAL_CURRENCY,
            'returnUrl' => PAYPAL_RETURN_URL,
            'cancelUrl' => PAYPAL_CANCEL_URL,
            'items' => array(array(
                    'name' => "AnyDay Tutors",
                    'price' => $price,
                    'description' => "Lecture ID : ". $lec_id,
                    'quantity' => 1
                )
            )
        ))->send();
        if($response -> isRedirect()){
            $response->redirect();
        }else{
            echo $response -> getMessage();
        }


    }catch(Exception $e){
        echo $e -> getMessage();
    }


?>
