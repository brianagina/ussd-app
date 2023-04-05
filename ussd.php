<?php
// include "dbConnect.php";
// Reads the variables sent via POST from the gateway

$sessionId = $_POST["sessionId"];
$serviceCode = $_POST["serviceCode"];
$phoneNumber = '' . substr($_POST["phoneNumber"], 4); //Elimiminate +254
$text = $_POST["text"];

if (strpos($text, '*') !== false) 
    $level = explode('*', $text);  //Eliminate asterisk from the user input
else $level[0] = $text;

//Get the inputs from user into an array
if (isset($text))
{
    $arrCount = count($level);
    $arrCount -= 1;

    if (isset($level[0]) && $level[0] != '' && $level[$arrCount] == 98 && strlen($text) > 1)
    {
        //$lastAsteric = strrpos($text,"*");
        $lastAsteric = strpos($text, "*98");
        $text = substr($text, 0, $lastAsteric);
        $lastAsteric = strrpos($text, "*");
        $text = substr($text, 0, $lastAsteric);

        $level = explode('*', $text);
    }


    if (strpos($text, '*0') !== false)
    {
        // check any occurence of 0 (back)

        $lastAsteric = $firstOccurence = strpos($text, "*0"); //GET THE FIRST OCCURRENCE *99 AND REPLACE THE PRECCEDING CHARACTER before *
        $firstPart = substr($text, 0, $lastAsteric);
        $lastAsteric = strrpos($firstPart, "*");//get value following the *99 and remove it
        $firstPart = substr($text, 0, $lastAsteric);
        $text = $firstPart . substr($text, $firstOccurence);
        $text = str_replace("*0", "", $text);

        if (substr($text, 0, 1) == '*')
        {
            // if it starts with * remove it
            $text = substr($text, 1);
        }

        $level = explode('*', $text);
        $response = "END Code Error $text";
    }

    /*** Level 0 **/

    /* The PV, Farmer name and total amount to be passed as variables */
    if ($text == '')
    {
        $response = "CON Dear FARMER, please review the Payment Voucher with code 7383 of KSH 2000.00. Please reply back with 1 to accept and 2 to reject. \n\n";
        $response .= "1. Accept \n";
        $response .= "2. Reject \n";
    }

    /*** Level 1 **/

    if (isset($level[0]) && $level[0] == 1 && !isset($level[1]))
    {
        $response = "END Thanks for choosing Rex Mercury. \n";
    }

    if (isset($level[0]) && $level[0] == 2 && !isset($level[1]))
    {
        $response = "END Thanks for choosing Rex Mercury. \n";
    }

    // Level 2 
    /*if (isset($level[0]) && isset($level[1]) && $level[1] == 2 && !isset($level[2]))
    {
        $response = "END Thanks for choosing Rex Mercury. \n";
    } */
}
