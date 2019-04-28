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
        <div class="container">
            <div class="row bg-dark rounded d-none d-lg-flex">
        <?php
        include "db.php";
        $res=mysqli_query($db,"SELECT * FROM `article` ORDER BY `Date` DESC LIMIT 6");
        $row = mysqli_fetch_array($res);
        $id=$row['ID'];
        $zag=$row['Zagolovok'];
        $jpg=$row['Kartinka'];
        $i=1;
        echo"<div class=\"col-10 s-show overflow-hidden\">
                    <img class=\"s-show-img-main\" src=\"$jpg\" alt=\"\"><a href='article_blank.php?id=$id' class=\"h2 bg-dark rounded-right text-decoration-none\">$zag</a>
                </div>
                <div class=\"col-2 s-show px-0\"><div data-zag='$zag' data-id='$id' class=\"col-12 overflow-hidden bg-primary s-show-thumbs\" id='$i'><img class=\"s-show-img img-fluid border-bottom border-top border-dark\" src=\"$jpg\"></div>";
        while($row = mysqli_fetch_array($res)) {
        $i++;
        $id=$row['ID'];
        $zag=$row['Zagolovok'];
        $jpg=$row['Kartinka'];
        echo "
        <div data-zag='$zag' data-id='$id' class=\"col-12 overflow-hidden s-show-thumbs\" id='$i'><img class=\"s-show-img img-fluid border-bottom border-top border-dark\" src=\"$jpg\" alt=\"\"></div>
        ";
        }
        ?>
                </div>
            </div>
        </div>


    <?php
    if(isset($_GET['page'])){
$pg=$_GET['page'];}else{
    $pg=1;
}
$prevpg=$pg-1;
$nextpg=$pg+1;
$pgstart=$pg*5-5;
$pgend=$pg*5;
include "db.php";
$res=mysqli_query($db,"SELECT * FROM `article` ORDER BY `Date` DESC LIMIT $pgstart,$pgend");
$res2=mysqli_query($db,"SELECT `id` FROM `article` ORDER BY `Date` DESC");
$i=1;
while($myrow2=mysqli_fetch_array($res2)){
    $i++;
};
while($row = mysqli_fetch_array($res)) {
    $id=$row['ID'];
    $type=$row['Type'];
    $zag=$row['Zagolovok'];
    $parpos=iconv_strpos($row['Tekst'],"</p>",0);
    $Text1=iconv_substr($row['Tekst'],0,$parpos).'...';
    $Author=$row['Avtor'];
    $Date=$row['Date'];
    $jpg=$row['Kartinka'];

    echo"<div class=\"row w-lg-75 w-100 my-lg-3 m-0\">
    <div class=\"col-lg-4 col-12 article-block px-0 px-lg-1\">
        <img class=\"img-thumbnail mw-100 w-auto h-100 home-img\" src=\"$jpg\">
    </div>
        <div class=\"col-lg-8 col-12\">
            <div class=\"row\">
                <div class=\"col-12\"><a class=\"h4 text-justify text-decoration-none\" href=\"article_blank.php?id=$id\">$zag</a></div>
                <div class=\"col-12\"><p class=\"\">$Text1</p></div>
            </div>
        </div>
    </div>
    <hr class=\"border-primary border w-100\">";
}

echo "<nav aria-label=\"Page navigation\">
<ul class=\"pagination justify-content-center\">";
if ($pg==1) {echo "<li class=\"page-item disabled\"><a class=\"page-link\" href=\"#\">Предыдущая</a></li>";}
else {echo "<li class=\"page-item\"><a class=\"page-link\" href=\"?page=$prevpg\">Предыдущая</a></li>";};
for($j=1;$j<=($i/5);$j++){
if ($j==$pg) {
    echo "<li class=\"page-item disabled\"><a class=\"page-link\" href=\"?page=$j\">$j</a></li>";
    }
    else{
    echo "<li class=\"page-item\"><a class=\"page-link\" href=\"?page=$j\">$j</a></li>";
    }
}
if ($pg==($j-1)){echo "<li class=\"page-item disabled\"><a class=\"page-link\" href=\"?page=$nextpg\">Следующая</a></li>";}
else
{echo "<li class=\"page-item\"><a class=\"page-link\" href=\"?page=$nextpg\">Следующая</a></li>";}
echo "</ul></nav>";
?>
    </div>

    
    <div class="d-none d-lg-block col-2 mx-auto rounded px-0">
        <div class="stickypos bg-secondary w-100 sidebar-block rounded pt-3 shadow">
            <p class="text-center font-weight-bold">Новые статьи:</p>
            <hr class="border-primary border w-100z"><?php
            include "db.php";
            $res1=mysqli_query($db,"SELECT * FROM `article` ORDER BY `Date` DESC LIMIT 4");
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
</html>