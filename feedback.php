<?php
    include 'config.php';
    include 'company.php';

    if(isset($_POST['submit'])){
        $temp = $_POST['tutor_id'];
        $len = strlen($temp);
        $temp = substr($temp, 3, $len - 3);
        $tutor_id = intval($temp);


        $sqlF = $conn -> prepare("INSERT INTO feedback VALUES(?, ?, ?)");
        $sqlF -> bind_param("sss", $tutor_id, $_POST['rating'], $_POST['comment']);
        $sqlF -> execute();

        if($sqlF -> affected_rows > 0){
        echo "<script>alert('Feedback Submitted')</script>";
        }else{
        echo "<script>alert('Please try again later')</script>";
        }
    }
?>

<html>    
    <head>    
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>AnyDay Tutors - Payment</title>
        <style>    
            * {    
                box-sizing: border-box;    
            }
            
            h1{
                margin: 2rem;
                text-align:center;
            }

                
            input[type=text], select, textarea {    
                width: 100%;    
                padding: 12px; 
                border: 1px solid rgb(70, 68, 68);    
                border-radius: 4px;    
                resize: vertical;    
            }   

            input[type=number], select, textarea {    
                width: 100%;    
                padding: 12px;    
                border: 1px solid rgb(70, 68, 68);    
                border-radius: 4px;    
                resize: vertical;    
            }   
   
                
            label {    
                padding: 12px 12px 12px 0;    
                display: inline-block;    
            }    
                
            input[type=submit] {    
                background-color: rgb(37, 116, 161);    
                color: white;    
                padding: 12px 20px;    
                border: none;    
                border-radius: 4px;    
                cursor: pointer;    
                float:left;    
            }    
                
            input[type=submit]:hover {    
                background-color: #45a049;    
            }    
                
            .container { 
                margin: auto;   
                width: 75%;
                border-radius: 5px;    
                background-color: #f2f2f2;    
                padding: 20px;    
            }    

            .col-25 {    
                float: left;    
                width: 25%;    
                margin-top: 6px;   
                text-align: center; 
            }    
                
            .col-75 {    
                float: left;    
                width: 75%;    
                margin-top: 6px;    
            }    
                
            .row:after {    
                content: "";    
                display: table;    
                clear: both;    
            }    
            
            .disclaimer {
                display: none !important;
            }
        </style>    
    </head>    
<body>   
    <div>
        <h1>Thank You for choosing AnyDay Tutors!</h1><h3>Please click the Payment link below for the payment. Also, you can fill up the Feedback form below to help us get better.</h3>    
        <form>    
            <div class="row">    
                <div class="col-25">    
                    <label for="LectureID">Lecture ID</label>    
                </div>    
                <div class="col-75">    
                    <input type="text" id="lec_id" name="lec_id" placeholder="" value="<?php echo $_GET['id2']?>" required readonly>    
                </div>    
            </div>
                
            <div class="row">  
                <div class="col-25">    
                    <label for="payment"></label>  
                </div> 
                <!-- define lecture cost hour wise -->
                <?php
                    $sqlL = $conn -> prepare("SELECT * FROM lecture_entry WHERE lec_id = ?");
                    $sqlL -> bind_param("s", $_GET['id2']);
                    $sqlL -> execute();
                    $result = $sqlL -> get_result() -> fetch_all(MYSQLI_ASSOC);
                    // per hour class price set to $10 for testing
                    $price = $result[0]['duration'] ;
                    $Lecture = $result[0]['lec_id'];
                    $Duration = $result[0]['duration'];
                    if($result[0]['payment'] == 1){
                        echo "Payment Done";
                    }else{
                    ?>
                        <script src="https://www.paypal.com/sdk/js?client-id=test&currency=USD"></script>
    <!-- Set up a container element for the button -->
                        <div id="paypal-button-container"></div>
                        <script>
                        paypal.Buttons({
                            // Sets up the transaction when a payment button is clicked
                            createOrder: (data, actions) => {
                            return actions.order.create({
                                purchase_units: [{
                                amount: {
                                    value: '<?php echo $price; ?>' // Can also reference a variable or function
                                }
                                }]
                            });
                            },
                            // Finalize the transaction after payer approval
                            onApprove: (data, actions) => {
                            return actions.order.capture().then(function(orderData) {
                                // Successful capture! For dev/demo purposes:
                                console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
                                const transaction = orderData.purchase_units[0].payments.captures[0];
                                alert(`Transaction ${transaction.status}: ${transaction.id}\n\nSee console for all available details`);
                                // When ready to go live, remove the alert and show a success message within this page. For example:
                                // const element = document.getElementById('paypal-button-container');
                                // element.innerHTML = '<h3>Thank you for your payment!</h3>';
                                // Or go to another URL:  actions.redirect('thank_you.html');
                            });
                            }
                        }).render('#paypal-button-container');
                        </script>
                    <?php
                    }
                ?>  
            </div>
        </form>   
    </div>

    <br><br><br>
    <div class="container">    
        <h2 style="text-align: center; color:darkgreen">FEEDBACK FORM (Optional)</h2>    
        <form action="<?php $_SERVER['PHP_SELF']?>" method="post">    
            <div class="row">    
            <div class="col-25">    
                <label for="lectureID">Lecture Id</label>    
            </div>    
            <div class="col-75">    
                <input type="text" id="lecture_id" name="lecture_id" placeholder="" value="<?php echo $_SESSION['id2']?>" required readonly>    
            </div>    
            </div>
        
            <div class="row">    
            <div class="col-25">    
                <label for="tutorID">Tutor Id</label>    
            </div>    
            <div class="col-75">    
                <input type="text" id="tutor_id" name="tutor_id" placeholder="" value="<?php echo $_SESSION['id1']?>" required readonly>    
            </div>    
            </div>
            
            <div class="row">    
            <div class="col-25">    
                <label for="rating">Rating</label>    
            </div>    
            <div class="col-75">    
                <input type="number" id="rating" name="rating" placeholder="Out of 5" step="1" min="0" max="5" required>    
            </div>    
            </div>
            
            <div class="row">    
            <div class="col-25">    
                <label for="feedback">Feedback</label>    
            </div>    
            <div class="col-75">    
                <textarea id="comment" name="comment" placeholder="Please give your valuable feedback..." style="height:200px" required></textarea>    
            </div>    
            </div> 
            <div class="row">  
            <div class="col-25">    
            <label for=""></label>    
            </div>
            <div class="col-75">    
            <input type="submit" value="Submit" name="submit">    
            </div>
            </div>     
        </form>    
    </div>    
</body>    
</html>    