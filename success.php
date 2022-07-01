<?php
    include 'config.php';

    if(isset($_GET['token'])){
        $transaction = $gateway->completePurchase(array(
            'payer_id' => $_GET['PayerID'],
            'transactionReference' => $_GET['paymentId'],
        ));
        $response = $transaction->send();
        if($response->isSuccessful()){
            $details = $response->getData();
            $lec_id = $details['transactions'][0]['item_list']['items'][0]['description'];
            $token_id = $_GET['token'];
            $status = $details['payer']['status'];
            if($status == "VERIFIED"){
                $status = 1;
            }else{
                $status = 0;
            }
            $amount = $details['transactions'][0]['amount']['total'];
            $lec_id = substr($lec_id, 12);
            // echo $status . " " . $amount . "<br>";
            // echo $lec_id . " " . $token_id . " " . $status . " " . $amount;
            // echo "<pre>";
            // print_r($details);
            // echo "</pre>";
            // die();

            $sql = $conn -> prepare("Update lecture_entry SET payment = 1 WHERE lec_id = ?");
            $sql -> bind_param("s", $lec_id);
            $sql -> execute();
            $sql -> close();
            

            $sqlP = $conn -> prepare("SELECT * FROM payment WHERE lec_id = ?");
            $sqlP -> bind_param('s', $lec_id);
            $sqlP -> execute();
            $result = $sqlP -> get_result();

            if(mysqli_num_rows($result) == 0){
                $sqlA = $conn -> prepare("INSERT INTO payment VALUES (?,?,?,?)");
                $sqlA -> bind_param('ssss', $lec_id, $token_id, $amount, $status);
                $sqlA -> execute();
            }
            
            echo '<script>alert("Transaction Succesfull")</script>';
            echo '<form action="feedback.php">
                <button type="submit" formaction="feedback.php">Back to Feedback Page</button>
            </form>';
        }else{
            echo "<script>alert('Payment Unsuccessful')</script>";
            echo $response -> getMessage();
        }
    }else{
        echo '<script>alert("Transaction Declined")</script>';
    }
    
?>