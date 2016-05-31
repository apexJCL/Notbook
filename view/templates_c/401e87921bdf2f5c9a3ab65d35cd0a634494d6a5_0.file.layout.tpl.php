<?php
/* Smarty version 3.1.29, created on 2016-05-31 10:42:00
  from "/var/www/html/Notbook/view/templates/layout.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_574db0c8dfd5b3_81140265',
  'file_dependency' => 
  array (
    '401e87921bdf2f5c9a3ab65d35cd0a634494d6a5' => 
    array (
      0 => '/var/www/html/Notbook/view/templates/layout.tpl',
      1 => 1464582345,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:menu.tpl' => 2,
  ),
),false)) {
function content_574db0c8dfd5b3_81140265 ($_smarty_tpl) {
$_smarty_tpl->ext->_inheritance->init($_smarty_tpl, false);
?>
<!doctype html>
<html lang="es">
<head>
    <!-- JQuery -->
    <?php echo '<script'; ?>
 src="/js/jquery.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="/js/materialize.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="/js/init.js"><?php echo '</script'; ?>
>

    <!-- JQuery Validate -->
    <?php echo '<script'; ?>
 src="/js/jquery.validate.min.js"><?php echo '</script'; ?>
>

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
                <a href="/" class="brand-logo center"><img src="/img/notbook.png" class="logo" alt=""></a>
                <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
                <ul class="right hide-on-med-and-down">
                    <?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:menu.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

                </ul>
                <ul class="side-nav" id="mobile-demo">
                    <?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:menu.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>

                </ul>
            </div>
        </nav>
    </div>
</header>

<main>
    <div class="section no-pad-bot" id="index-banner">
        <div class="container main-container">
            <?php 
$_smarty_tpl->ext->_inheritance->processBlock($_smarty_tpl, 0, "body", array (
  0 => 'block_2018896382574db0c8dfb434_00178861',
  1 => false,
  3 => 0,
  2 => 0,
));
?>

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
            <strong>© 2016 José Carlos López</strong> - Made with <img src="/img/pacman.png" alt="" style="max-width: 28px">
        </div>
    </div>
</footer>

<div class="hiddendiv common"></div>
<div class="drag-target"
     style="left: 0px; touch-action: pan-y; -webkit-user-drag: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></div>
</body>
</html><?php }
/* {block 'body'}  file:layout.tpl */
function block_2018896382574db0c8dfb434_00178861($_smarty_tpl, $_blockParentStack) {
}
/* {/block 'body'} */
}
