<!doctype html>
<html lang="en">
<head>
    <link rel="stylesheet" href="styler/style.css"
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>OKU.KZ</title>
</head>
<body class="body-bg">
<nav class="navbar navbar-expand-md bg-light navbar-light border-bottom border-pr mb-2">
<a href='index.php'><img class="logo mr-2" src="img/logoB1.png" width="73" height="43"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#testnavbar1" aria-controls="testnavbar1" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="testnavbar1">
        <ul class="nav nav-pills my-lg-0 my-2">
            <li class="nav-item px-2">
                <a class="nav-link active" href="index.php">Главная <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item px-2">
                <a class="nav-link" href="articles.php">Статьи</a>
            </li>
            <li class="nav-item px-2">
                <a class="nav-link" href="news.php">Новости</a>
            </li>
        </ul>
        <?php
        session_start();
        if (isset($_SESSION['login'])){
            echo "<a href='create.php' id='create' class='nav-link btn btn-outline-primary mx-lg-auto mx-sm-0 my-lg-0 my-2'>Написать</a>";
            echo "<div id='logout-block' class='inline mr-3 my-lg-0 my-2'><form action='logout.php'><span class='border border-primary rounded p-2 mr-2'>{$_SESSION['login']}</span><button type='submit' id='logout' class='btn btn-outline-primary py-2'>Выйти</button></form></div>";
        }else{
            echo '<button id="logregbtn" type="button" class="inline ml-auto btn btn-outline-primary mr-2">Вход/Регистрация</button>';
        }?>
        <form class="form-inline" action='search.php' method='get'>
            <input id='srch-input' class="form-control mr-sm-2" type="search" placeholder="Поиск" aria-label="Search" name='search_query'>
            <button id='srch-button' class="btn btn-outline-primary my-2 my-sm-0" type="submit">Найти</button>
        </form>
    </div>
</nav>

<div class="row mx-0">
    <div class="col-12 col-lg-7 bg-light mx-auto rounded py-2 shadow">
        <?php
        $id=$_GET['id'];
        include "db.php";
        $res=mysqli_query($db,"SELECT * FROM `article` WHERE `ID` LIKE $id");
        $myrow=mysqli_fetch_assoc($res);
        $zag=$myrow['Zagolovok'];
        $Text1=$myrow['Tekst'];
        $iskz=$myrow['ISKZ'];
        $zagkz=$myrow['KZZagolovok'];
        $Text2=$myrow['KZ'];
        $Author=$myrow['Avtor'];
        $Date=$myrow['Date'];
        $jpg=$myrow['Kartinka'];
        if ($iskz)
        {
            echo "<button id='RU' class='pr-2 btn btn-primary slb'>RU</button> <button id='KZ' class='btn btn-outline-primary slb'>KZ</button>"
        ;}
        else{echo "<button id='RU' class='pr-2 btn btn-primary slb'>RU</button> <button id='KZ' class='btn btn-outline-primary slb' disabled>KZ</button>";};
        echo"";
        echo"<hr>
        <div id='article-text' class='p-4'>
        <h2 id='ruz' class='mb-3'>$zag</h2>
        <h2 id='kzz' class='mb-3 d-none'>$zagkz</h2>
        <p class='text-muted mb-3'>Автор: $Author - Дата: $Date - Просмотров: </p>
        <img class='home-img rounded mx-auto d-block img-fluid' src='$jpg' alt='Здесь должна была быть картинка'>
        <hr class='my-5'><div id='text1'>$Text1</div>";
        if($iskz){echo"<div id='text2' class='d-none'>$Text2</div>";};

            $i=0;
            $pg=$_GET['id'];
            $res2=mysqli_query($db,"SELECT * FROM `rating` WHERE `post` = $pg");
            while($row2 = mysqli_fetch_array($res2)) {
                if ($row2['action']==='upvote'){$i++;}
                if ($row2['action']==='downvote'){$i--;}
            }
        if (!isset($_SESSION['logID'])){
            echo "</div>
        <div class='likecont ml-auto'>
            <button id='upvote' class=\"btn btn-outline-primary\" disabled></button>
            <div data-id=\"$pg\" id=\"likediv\" class=\"d-inline-block\">$i</div>
            <button id='downvote' class=\"btn btn-outline-primary\" disabled></button>
        </div>";
        }else{
            $logid=$_SESSION['logID'];
            $res=mysqli_query($db,"SELECT * FROM `rating` WHERE `post` LIKE $pg AND `user` LIKE $logid");
            $qr=mysqli_fetch_array($res);
            $b1='btn-outline-primary';
            $b2='btn-outline-primary';
            if ($qr['action']=='upvote') $b1='btn-primary';
            if ($qr['action']=='downvote') $b2='btn-primary';
            echo "</div>
            <div class='likecont ml-auto'>
                <button id='upvote' class=\"btn $b1\"></button>
                <div data-id=\"$pg\" id=\"likediv\" class=\"d-inline-block\">$i</div>
                <button id='downvote' class=\"btn $b2\"></button>
            </div>";
        }
        ?>

    </div>


    <div class="d-none d-lg-block col-2 mx-auto rounded px-0">
        <div class="bg-secondary w-100 sidebar-block rounded pt-3 shadow">
            <p class="text-center font-weight-bold">Новые статьи:</p>
            <hr class="border-primary border w-100z"><?php
            $db=mysqli_connect("localhost","root","","reg");
            mysqli_query($db,"set names 'utf8'");
            $res1=mysqli_query($db,"SELECT * FROM `article` ORDER BY `Date` DESC LIMIT 5");
            $myrow=mysqli_fetch_assoc($res1);
            while($row = mysqli_fetch_array($res1)) {
                $id=$row['ID'];
                $zag=$row['Zagolovok'];
                $Text1=iconv_substr($row['Tekst'],0,40).'...';

                echo "<div class=\"row bg-light border-primary border-bottom mx-0\">
                <div class=\"col-12 align-self-center text-truncate\"><a class=\"h5 text-decoration-none\" href=\"article_blank.php?id=$id\">$zag</a></div>
                <div class=\"col-12 text-truncate\"><p class=\"text-muted\">$Text1</p></div>
        </div>";
            }

            ?>

        </div>
    </div>
</div>
</body>
<script type="text/javascript" src="node_modules/jquery/dist/jquery.min.js"></script>
<script type="text/javascript" src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="main.js"></script>
<script type="text/javascript" src="likes.js"></script>
</html>