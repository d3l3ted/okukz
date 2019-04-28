<!doctype html>
<html lang="en">
<head>
    <link rel="stylesheet" href="styler/style.css"
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script type="text/javascript" src="node_modules/jquery/dist/jquery.min.js"></script>
    <script type="text/javascript" src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <link href="node_modules/summernote/dist/summernote-bs4.css" rel="stylesheet">
    <script src="node_modules/summernote/dist/summernote-bs4.min.js"></script>
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
                <a class="nav-link active" href="#">Главная <span class="sr-only">(current)</span></a>
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
            header("Location: index.php");
        }?>
        <form class="form-inline" action='search.php' method='get'>
            <input id='srch-input' class="form-control mr-sm-2" type="search" placeholder="Поиск" aria-label="Search" name='search_query'>
            <button id='srch-button' class="btn btn-outline-primary my-2 my-sm-0" type="submit">Найти</button>
        </form>
    </div>
</nav>


<div class="container w-50 bg-light rounded p-5 shadow">
    <label for="article-header">Заголовок: </label>
    <input name='zag' form='form-article' id="article-header" class="my-3 form-control" type="text" placeholder="Введите заголовок поста">
    <label for="article-header">Казахский заголовок: </label>
    <input name='zagKZ' form='form-article' id="article-header2" class="my-3 form-control" type="text" placeholder="Введите заголовок поста на казахском(необязательно)">
    <div class="row">
        <div class="col-8">
            <select name='type' form='form-article' class="custom-select my-3">
                <option value='Статья' selected>Статья</option>
                <option value="Новость">Новость</option>
            </select>
        </div>
            <div class="col-4 align-self-center"><button id='changebutton' class='btn btn-primary'>Перейти на казахский язык >></button></div>
        <div class="col-12 mx-auto my-3" id='summernote-div-1'>
            <textarea form='form-article'  id="summernote1" name="editordata"></textarea>
        </div>
        <div class="col-12 mx-auto my-3 d-none" id='summernote-div-2'>
            <textarea form='form-article'  id="summernote2" name="editordata1"></textarea>
        </div>
        <br>
        <form class='w-100' method='post' enctype='multipart/form-data' id='form-article' name='form-article' action="create_article.php">
        <div class="custom-file">
            <input type="file" class="custom-file-input" id="fileToUpload" name='fileToUpload' aria-describedby="inputGroupFileAddon01">
            <label form='form-article' class="custom-file-label" for="inputGroupFile01">Выберите картинку для превью</label>
        </div>
        <input type='hidden' value='' name='iskz'>
        <div class="col-3 ml-auto my-3"><button type='submit' id='write-article' class="btn btn-outline-success">Написать</button></form></div>

    </div>
</div>


</body>
            <script type="text/javascript" src="crt.js"></script>
</html>