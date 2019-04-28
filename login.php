<?php
include "db.php";
session_start();
if (isset($_POST['login'])) { $login = $_POST['login']; if ($login == '') { unset($login);} }
if (isset($_POST['passw'])) { $password=$_POST['passw']; if ($password =='') { unset($password);} }
if (empty($login) or empty($password))
{
echo "Извините, введённый вами login или пароль неверный." ;}
// header ("location: ../login.php?error=2");

$login = $_POST['login'];
$password=$_POST['passw'];

$login = stripslashes($login);
$login = htmlspecialchars($login);
$login = mysqli_real_escape_string($db,$login);
$password = stripslashes($password);
$password = htmlspecialchars($password);
$password = mysqli_real_escape_string($db,$password);

$login = trim($login);
$password = trim($password);

$result = mysqli_query($db,"SELECT * FROM `regist` WHERE LOGIN='$login'");
$myrow = mysqli_fetch_array($result);
if (empty($myrow['Password']))
{
    echo "Извините, введённый вами login или пароль неверный.";
}
else {
    if ($myrow['Password'] == $password) {
        $_SESSION['login'] = $myrow['LOGIN'];
        $_SESSION['logID'] = $myrow['ID'];
        echo 'success';
    } else {
        echo "Извините, введённый вами login или пароль неверный.";
    }
}
?>