<!doctype html>
<html lang="es">
<head>
    <!-- JQuery -->
    <script src="/js/jquery.min.js"></script>
    <script type="text/javascript" src="/js/materialize.min.js"></script>
    <script src="/js/init.js"></script>

    <!--Import Google Icon Font-->
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="/css/materialize.min.css" media="screen,projection"/>
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <!-- Custom css -->
    <link rel="stylesheet" href="/css/main.css">
    <meta charset="UTF-8">
    <title>¬book</title>
</head>
<body>

<header>
    <div class="navbar-fixed">
        <nav class="teal">
            <div class="nav-wrapper">
                <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
                <ul class="right hide-on-med-and-down">
                    {if isset($smarty.session.user_logged_in) && $smarty.session.user_logged_in == "1"}
                        {include file="{$baseurl}menu.tpl"}
                    {else}
                        {include file="menu.tpl"}
                    {/if}
                </ul>
                <ul class="side-nav" id="mobile-demo">
                    {if isset($smarty.session.user_logged_in) && $smarty.session.user_logged_in == "1"}
                        {include file="{$baseurl}menu.tpl"}
                    {else}
                        {include file="menu.tpl"}
                    {/if}
                </ul>
            </div>
        </nav>
    </div>
</header>

<main>
    <div class="section no-pad" id="index-banner">
        <div class="container main-container">
            {block name="body"}{/block}
        </div>
    </div>
</main>

<footer class="page-footer grey">
    <div class="container">
        <div class="row">
            <div class="col l6 s12">
                <h5 class="white-text">¬book</h5>
                <p class="grey-text text-lighten-4">No es una libreta.</p>
            </div>
            <div class="col l4 offset-l2 s12">
                <ul>
                    <li>
                        <a class="" href="https://github.com/apexJCL/Notbook">
                            <img src="/img/GitHub-Mark-Light-64px.png" alt="Github">
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="footer-copyright">
        <div class="container">
            <strong>© 2016 José Carlos López</strong> - Made with <img src="/img/pacman.png" alt="" style="max-width: 28px"> | Icons by <a href="https://design.google.com/icons/">Google</a>
        </div>
    </div>
</footer>

<div class="hiddendiv common"></div>
<div class="drag-target"
     style="left: 0px; touch-action: pan-y; -webkit-user-drag: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></div>
</body>
</html>