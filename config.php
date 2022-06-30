<?php
require_once "vendor/autoload.php";
use Omnipay\Omnipay;
define('CLIENT_ID', 'AUfd5be-9fODSbhkRTLP2zbRliAt69UEZ27lDBpLGluXnyWjuUUcS4VBDR4lkelXixhoi_Ege312mIXW');
define('CLIENT_SECRET', 'EEgh697RVsVwXNglx2IEt42pcZSr5gBksId9oAP6IIMt85C2qyh-efIfrbru_YFtUpDAWAy13aaPqDJZ');
define('PAYPAL_CURRENCY', 'USD');
define('PAYPAL_RETURN_URL', 'anydaytutors.com/success.php');
define('PAYPAL_CANCEL_URL', 'anydaytutors.com/cancel.php');
    try{
        $gateway = Omnipay::create('PayPal_Rest');
        $gateway->setClientId(CLIENT_ID);
        $gateway->setSecret(CLIENT_SECRET);
        $gateway->setTestMode(true);
        date_default_timezone_set('Asia/Kolkata');
        // $servername = "remotemysql.com";
        // $db_name = "JzWIM9HHVR";
        // $dsn = "mysql: dbname=$db_name; host=$servername";
        // $username = "JzWIM9HHVR";
        // $password = "zD4p8P8bsa";

        $servername = "localhost";
        $db_name = "u285368853_client4";
        $dsn = "mysql: dbname=$db_name; host=$servername";
        $username = "u285368853_anydaytutors";
        $password = "Anydaytutors@client4";
        $conn = new mysqli($servername, $username, $password, $db_name);
    }
    catch(Exception $e){
        echo 'Message: ' .$e->getMessage();
    }

?>