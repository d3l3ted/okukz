<?php

$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
if(!file_exists($target_file)){
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;}
        else{
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}}}
else{
    echo "File Exists";
    $uploadOk=0;
}
if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
} else {
    echo "Sorry, there was an error uploading your file.";
}

$db=mysqli_connect("localhost","root","","reg");
mysqli_query($db, "set names 'utf8'");
$author='olex';
date_default_timezone_set('Asia/Almaty');
$date=date('Y-m-d');

    $zag = mysqli_real_escape_string($db, trim($_POST['zag']));
    $type = mysqli_real_escape_string($db, trim($_POST['type']));
    $text = mysqli_real_escape_string($db, trim($_POST['editordata']));
    $kzzag = mysqli_real_escape_string($db,trim($_POST['zagKZ']));
    $iskz = $_POST['iskz'];
    if($iskz == 'on'){
    $kztext = mysqli_real_escape_string($db, trim($_POST['editordata1']));}
    else{
        $kztext='';
    }
    $img=$target_file;

		
        if (!empty($zag) && !empty($type) && !empty($text) && !empty($iskz) && !empty ($kztext)) {
            $sql = "INSERT INTO `article`(`Type`,`Zagolovok`,`Tekst`,`ISKZ`, `KZZagolovok`,`KZ`, `Avtor`, `Date`,`Kartinka`) VALUES ('$type','$zag','$text', '$iskz','$kzzag','$kztext', '$author', '$date', '$img')";
            echo mysqli_error($db);

            $res=mysqli_query($db, $sql);
            if ($res) {
                header("Location: index.php");
            } else {
                echo '<p>\'Упс. Что то пошло не так, статья не добавлена\' ' . mysqli_error($db) . '</p>';
            }
        }
		
    echo mysqli_error($db);