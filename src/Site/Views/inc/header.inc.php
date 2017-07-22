<!DOCTYPE html>
<html lang="ru">
<head>
    <title>Main</title>
    <link href="/resources/css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="/resources/css/mystyle.css" rel="stylesheet" type="text/css">
    <script type="text/javascript"  src="/resources/js/jquery-3.1.1.min.js"></script>
    <script type="text/javascript" src="/resources/js/jquery.simplePagination.js"></script>
    <link type="text/css" rel="stylesheet" href="/resources/css/simplePagination.css"/>
    <?php
    if ($_SERVER['REQUEST_URI'] == '/post/new') {
        echo '    <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>';
        echo '
               <script>
                    tinymce.init({
                    selector: "#post",
                    });
                </script>
              ';
        echo '<script src="/resources/js/ru.js"></script>\'';
    }
    ?>
</head>
<body>
<div class="container header">
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <?php
                if (isset($_SESSION['user_session'])) {
                    echo '<a class="navbar-brand" href="/user/show/'.$_SESSION['user_session']->getId().'">' . $_SESSION['user_session']->getName() .'</a>';
                }
                ?>
            </div>
            <ul class="nav navbar-nav">
                <?php
                if (!isset($_SESSION['user_session'])) {
                    echo '<li><a href="/login">Login</a></li>';
                    echo '<li><a href="/registration">Registration</a></li>';
                } else {
                    echo '<li><a href="/post">Post\'s</a></li>';
                    echo '<li><a href="/post/new">New post</a></li>';
                    echo '<li><a href="/logout">Logout</a></li>';
                } ?>
            </ul>
        </div>
    </nav>
</div>