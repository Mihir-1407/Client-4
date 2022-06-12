<?php

    date_default_timezone_set('Asia/Kolkata');

    // $servername = "localhost";
    // $username = "root";
    // $password = "";
    // $db_name = "ta";
    // $dsn = "mysql: dbname=ta; host=localhost";

    // $hostname = "http://localhost/Industry_Project_1";
    // $hostname = "Industry_Project_1";

    $servername = "sql6.freemysqlhosting.net";
    $db_name = "sql6499202";
    $dsn = "mysql: dbname=sql6499202; host=sql6.freemysqlhosting.net";
    $username = "sql6499202";
    $password = "Zd18U1li9H";
    $conn = new mysqli($servername, $username, $password, $db_name);


    if($conn -> connect_error){
        die("Connection Failed" . $conn -> connect_error);
    }
    
?>