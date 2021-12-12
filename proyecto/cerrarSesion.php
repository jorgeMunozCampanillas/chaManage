<?php
session_start();
unset($_SESSION["usuario"]);
$_SESSION=[];
header("Location: index.php");
die();