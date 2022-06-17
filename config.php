<?php

use Stripe\Stripe;

    require_once "stripe-php-master/init.php";
    date_default_timezone_set('Asia/Kolkata');

    $stripedetails = array(
        "publishableKey" => "pk_test_51LBZGPSAznE31jZNU2wxG0YqsGZhokDP5N9TlCYoFlRdjKTsqr3gC7ZBHlbKXnuqoSpF6oWNsFe4D24lKVu2RzG600ASROcy8M",
        "secretKey" => "sk_test_51LBZGPSAznE31jZNawI3uENnRJ83NG6zb7b5p8ZzLu4rQWjw2K7Gs2X6cdzsDgewbETFnN6RU1miYT1gaHqtdFF5004f5ne7t6"
    );
    \Stripe\Stripe::setApiKey($stripedetails["secretKey"]);

    // $servername = "localhost";
    // $username = "id19096669_client4";
    // $password = "sEtW4*<Uh^v}yNpc";
    // $db_name = "id19096669_ta";
    // $dsn = "mysql: dbname=ta; host=localhost";

    // $hostname = "http://localhost/Industry_Project_1";

    $servername = "localhost";
    $db_name = "ta";
    $dsn = "mysql: dbname=sql6499202; host=sql6.freemysqlhosting.net";
    $username = "root";
    $password = "";
    $conn = new mysqli($servername, $username, $password, $db_name);

    // $servername = "sql6.freemysqlhosting.net";
    // $db_name = "sql6499202";
    // $dsn = "mysql: dbname=sql6499202; host=sql6.freemysqlhosting.net";
    // $username = "sql6499202";
    // $password = "Zd18U1li9H";
    // $conn = new mysqli($servername, $username, $password, $db_name);

    if($conn -> connect_error){
        die("Connection Failed" . $conn -> connect_error);
    }
    
?>