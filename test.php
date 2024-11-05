<?php


session_start();

require("src/utility.php");

if( isset($_SESSION["number"]) ){
    echo "授業発表用チートシート : ";
    echo $_SESSION["number"];
}