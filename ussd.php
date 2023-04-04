<?php
// include "dbConnect.php";


// Reads the variables sent via POST from our gateway

$sessionId = $_POST["sessionId"];
$serviceCode = $_POST["serviceCode"];
$phoneNumber = '' . substr($_POST["phoneNumber"], 4);
$text = $_POST["text"];

if (strpos($text, '*') !== false)
    $level = explode('*', $text);
else $level[0] = $text;

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

    if ($text == '')
    {

        $response = "CON Welcome to ODM Membership Portal \n\n";
        $response .= "1. Become a member \n";
        $response .= "2. Cancel Menu \n";
    }
}