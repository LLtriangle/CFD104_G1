<?php
session_start();

if(isset($_SESSION["EMAIL"]) == true){
    echo $_SESSION["CUS_NAME"];
    echo $_SESSION["EMAIL"];
}

?>