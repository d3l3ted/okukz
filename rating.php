<?php
session_start();
if (isset($_SESSION['logID'])){
include "db.php";
$logid=$_SESSION['logID'];
$query=mysqli_real_escape_string($db,$_POST['query']);
$pg=mysqli_real_escape_string($db,$_POST['id']);
$res=mysqli_query($db,"SELECT * FROM `rating` WHERE `post` LIKE $pg AND `user` LIKE $logid");
if(mysqli_num_rows($res)){
    if ($query=='upvote'){
        $row=mysqli_fetch_array($res);
        if (($row['user']==$logid) && ($row['action']=="$query") && ($row['post']==$pg)) {$qr=mysqli_query($db,"UPDATE `rating` SET `action` = 'nothing' WHERE `post`=$pg AND `user` = $logid");$return='off';}
        else{
        if (($row['user']==$logid) && ($row['post']==$pg)) {$qr=mysqli_query($db,"UPDATE `rating` SET `action` = 'upvote' WHERE `post`=$pg AND `user` = $logid");$return='on';}}
    }
    if ($query=='downvote'){
        $row=mysqli_fetch_array($res);
        if (($row['user']==$logid) && ($row['action']=="$query") && ($row['post']==$pg)) {$qr=mysqli_query($db,"UPDATE `rating` SET `action` = 'nothing' WHERE `post`=$pg AND `user` = $logid");$return='off';}
        else{
        if (($row['user']==$logid) && ($row['post']==$pg)) {$qr=mysqli_query($db,"UPDATE `rating` SET `action` = 'downvote' WHERE `post`=$pg AND `user` = $logid");$return='on';}}
    }
}
else
    {
        mysqli_query($db,"INSERT INTO `rating`(`user`,`post`,`action`) VALUE ($logid,$pg,'$query')");
        if ($query=='upvote' || $query=='downvote') {$return='on';}
        else{$return='off';}
    }
$i=0;
$res2=mysqli_query($db,"SELECT * FROM `rating` WHERE `post` = $pg");
while($row2 = mysqli_fetch_array($res2)) {
    if ($row2['action']==='upvote'){$i++;}
    if ($row2['action']==='downvote'){$i--;}
}
echo "$return;$i";
}
else{
    echo "error-no-login";
}

?>