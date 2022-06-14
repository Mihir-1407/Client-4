<?php
    session_start();
    include 'config.php';
    // id1 for tutor and id2 for lecure
    $_SESSION['id1'] = $_GET['id1'];
    $_SESSION['id2'] = $_GET['id2'];

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

        <title>AnyDay Tutors</title>
        <style>    
            * {    
                box-sizing: border-box;    
            }    
                
            input[type=text], select, textarea {    
                width: 25%;    
                padding: 12px; 
                border: 1px solid rgb(70, 68, 68);    
                border-radius: 4px;    
                resize: vertical;    
            }   

            input[type=number], select, textarea {    
                width: 25%;    
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
        <h2 style="text-align: center;">Thank You for choosing AnyDay Tutors for online learning. Please click the link below for payment.</h2>    
        <form action="payment.php?id=<?php echo $_GET['id2']?>" method="post">    
            <div class="row">    
            <div class="col-25">    
                <label for="LectureID">Lecture ID</label>    
            </div>    
            <div class="col-75">    
                <input type="text" id="tutor_id" name="tutor_id" placeholder="" value="<?php echo $_SESSION['id2']?>" required readonly>    
            </div>    
            </div>
                
            <div class="row">  
            <div class="col-25">    
                <label for="payment"></label>  
            </div> 
            <div class="col-75">    
                <input type="submit" value="Payment" name="payment">    
            </div>   
            </div>    
        </form>   
    </div>

    <br><br><br>
    <div class="container">    
        <h2 style="text-align: center; color:darkgreen">FEEDBACK FORM</h2>    
        <form action="<?php $_SERVER['PHP_SELF']?>" method="post">    
            <div class="row">    
            <div class="col-25">    
                <label for="tutorID">TUTOR ID</label>    
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
                <label for="feedback">Feed Back</label>    
            </div>    
            <div class="col-75">    
                <textarea id="comment" name="comment" placeholder="Write something.." style="height:200px" required></textarea>    
            </div>    
            </div>    
            <div class="col-25">    
            <label for=""></label>    
            </div>
            <div class="col-75">    
            <input type="submit" value="Submit" name="submit">    
            </div>    
        </form>    
    </div>    
</body>    
</html>    