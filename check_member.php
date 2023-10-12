<?php
session_start();
//check if user has login
if(!isset($_SESSION['custUsername'])){
die( Header("Location: login.php"));
}
?>