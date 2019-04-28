<?php
session_start();
unset($_SESSION['login']);
unset($_SESSION['logID']);
header("Location: index.php");
?>