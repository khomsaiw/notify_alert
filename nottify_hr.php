<?php
error_reporting(0);
date_default_timezone_set("Asia/Bangkok");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS' || $_SERVER['REQUEST_METHOD'] == 'options' || $_SERVER['REQUEST_METHOD'] == 'OPTION') {
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH');
    header('Access-Control-Max-Age: 0');
    header('Content-Length: 0');
    header('Content-Type: text/plain');
    exit;
}

$token_notify = $_REQUEST['token_notify'];

$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://notify-api.line.me/api/notify',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => array('message' => 'ชื่อ: ' . $_REQUEST['firstname'] . 'วันที่: ' . $_REQUEST['date'] . 'เวลา: ' . $_REQUEST['time'] . 'สถานะ: ' . $_REQUEST['checkwork'] . 'บริษัท: ' . $_REQUEST['company']),
    CURLOPT_HTTPHEADER => array(
        'Context-Type: application/x-www-form-urlencoded',
        'Authorization: Bearer ' . $token_notify
    ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;
