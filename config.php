<?php

    try{
        date_default_timezone_set('Asia/Kolkata');
        $servername = "remotemysql.com";
        $db_name = "JzWIM9HHVR";
        $dsn = "mysql: dbname=$db_name; host=$servername";
        $username = "JzWIM9HHVR";
        $password = "zD4p8P8bsa";
        $conn = new mysqli($servername, $username, $password, $db_name);
    }
    catch(Exception $e){
        echo 'Message: ' .$e->getMessage();
    }
?>