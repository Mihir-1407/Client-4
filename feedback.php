<?php
  session_start();
  $_SESSION['id'] = $_GET['id'];

?>

<html>    
<head>    
<meta name="viewport" content="width=device-width, initial-scale=1">    
<style>    
* {    
  box-sizing: border-box;    
}    
    
input[type=text], select, textarea {    
  width: 100%;    
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

input[type=email], select, textarea {    
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
  float: right;    
}    
    
input[type=submit]:hover {    
  background-color: #45a049;    
}    
    
.container {    
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
    
/* Clear floats after the columns */    
.row:after {    
  content: "";    
  display: table;    
  clear: both;    
}    
    
/* Responsive layout - when the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other */    
</style>    
</head>    
<body>    
<h2 style="text-align: center; color:darkgreen">FEEDBACK FORM</h2>    
<div class="container">    
  <form action="payment.php?id=<?php echo $_GET['id']?>" method="post">    
    <div class="row">    
      <div class="col-25">    
        <label for="tutorID">TUTOR ID</label>    
      </div>    
      <div class="col-75">    
        <input type="text" id="tutor_id" name="tutor_id" placeholder="TUT1" required>    
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
    <div class="row">    
      <input type="submit" value="Submit" name="submit">    
    </div>    
  </form>    
</div>    
    
</body>    
</html>    