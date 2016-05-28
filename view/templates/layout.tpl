<!doctype html>
<html lang="es">
<head>
    <!-- JQuery -->
    <script src="vendor/components/jquery/jquery.js"></script>
    <script type="text/javascript" src="js/materialize.min.js"></script>
    <script src="js/init.js"></script>

    <!--Import Google Icon Font-->
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css" media="screen,projection"/>
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <!-- Custom css -->
    <link rel="stylesheet" href="css/main.css">
    <meta charset="UTF-8">
    <title>NotBook</title>
</head>
<body>

<header>

    <nav class="teal">
        <div class="nav-wrapper">
            <a href="#" class="brand-logo center"><img src="img/notbook.png" class="logo" alt=""></a>
            <ul id="nav-mobile" class="left hide-on-med-and-down">
                <li><a href="#home">Inicio</a></li>
                <li><a href="#demo">Demo</a></li>
                <li><a href="#about">¿Qué es notbook?</a></li>
                <li><a href="#register">Regístrate</a></li>
            </ul>
        </div>
    </nav>

</header>

<main>
    <div class="section no-pad-bot" id="index-banner">
        <div class="container">
            {block name="body"}{/block}
        </div>

        <div class="container" id="register">

        </div>
    </div>
</main>

<footer class="page-footer grey">
    <div class="container">
        <div class="row">
            <div class="col l6 s12">
                <h5 class="white-text">Footer Content</h5>
                <p class="grey-text text-lighten-4">You can use rows and columns here to organize your footer
                    content.</p>
            </div>
            <div class="col l4 offset-l2 s12">
                <h5 class="white-text">Links</h5>
                <ul>
                    <li><a class="grey-text text-lighten-3" href="#!">Link 1</a></li>
                    <li><a class="grey-text text-lighten-3" href="#!">Link 2</a></li>
                    <li><a class="grey-text text-lighten-3" href="#!">Link 3</a></li>
                    <li><a class="grey-text text-lighten-3" href="#!">Link 4</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="footer-copyright">
        <div class="container">
            © 2014 Copyright Text
            <a class="grey-text text-lighten-4 right" href="#!">More Links</a>
        </div>
    </div>
</footer>

<div class="hiddendiv common"></div>
<div class="drag-target"
     style="left: 0px; touch-action: pan-y; -webkit-user-drag: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></div>
</body>
</html>