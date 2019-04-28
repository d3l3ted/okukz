<?php
include "db.php";
    $imya = mysqli_real_escape_string($db, trim($_POST['name']));
    $email = mysqli_real_escape_string($db, trim($_POST['mail']));
    $login = mysqli_real_escape_string($db, trim($_POST['login']));
    $password = mysqli_real_escape_string($db, trim($_POST['parol']));
    if (!empty($imya) && !empty ($email) && !empty ($login) && !empty ($password)) {
        $sql = "INSERT INTO `regist`(`NAME`, `E-mail`, `LOGIN`,`Password`) VALUES ('$imya', '$email', '$login', '$password')";
        echo mysqli_error($db);

        mysqli_query($db, $sql);
        echo 'Регистрация прошла успешно.';

    } else {
         echo 'Вы не зарегистрированы. Попробуйте проверить правильность введенных данных';
    }echo mysqli_error($db);