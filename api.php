<?php

session_start();

require("src/utility.php");

header('Content-Type: application/json');

$res = array();

if(
    isset($_GET) &&
    isset($_GET["func"])
){
    $func = $_GET["func"];

    if( $func == "check_number" ){
        
        $res["status"] = true;
        $res["check"] = false;

        if( isset($_GET["number"]) ){

            $number = $_GET["number"];

            $res["check"] = checkNumber($number);

            if( $res["check"]["hit"] == 4 ){
                $_SESSION["result"] = "success";
            }
        }
    }

    else{
        $res["status"] = false;
        $res["message"] = "Unknown Function";
    }
}
else{
    $res["status"] = false;
}

echo json_encode($res);
exit();