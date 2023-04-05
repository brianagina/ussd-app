<?php
// Read the variables sent via POST from our API
$sessionId   = $_POST["sessionId"];
$serviceCode = $_POST["serviceCode"];
$phoneNumber = $_POST["phoneNumber"];
$text        = $_POST["text"];

if ($text == "") {
    // This is the first request. Note how we start the response with CON
    $response  = "CON CON Dear FARMER, please review the Payment Voucher with code 7383 of KSH 2000.00. Please reply back with 1 to accept and 2 to reject. \n";
    $response .= "1. Accept \n";
    $response .= "2. Reject";

} else if ($text == "1") {
    // Business logic for first level response
    $response = "END Thanks for choosing Rex Mercury. \n";

} else if ($text == "2") {
    // Business logic for first level response
    // This is a terminal request. Note how we start the response with END
    $response = "END Thanks for choosing Rex Mercury. \n";

} 

// Echo the response back to the API
// header('Content-type: text/plain');
echo $response;
?>