<?php
/* Smarty version 3.1.29, created on 2016-05-28 13:01:43
  from "/var/www/html/Notbook/view/templates/index/index.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_5749dd07624377_69459947',
  'file_dependency' => 
  array (
    '3eb7f461fd912793817e91044838e219ff0d8e4f' => 
    array (
      0 => '/var/www/html/Notbook/view/templates/index/index.tpl',
      1 => 1464458502,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:layout.tpl' => 1,
    'file:register_layout.tpl' => 1,
  ),
),false)) {
function content_5749dd07624377_69459947 ($_smarty_tpl) {
$_smarty_tpl->ext->_inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->ext->_inheritance->processBlock($_smarty_tpl, 0, "body", array (
  0 => 'block_17073277535749dd076069e8_94766577',
  1 => false,
  3 => 0,
  2 => 0,
));
$_smarty_tpl->ext->_inheritance->endChild($_smarty_tpl);
$_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:layout.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 2, false);
}
/* {block 'body'}  file:index/index.tpl */
function block_17073277535749dd076069e8_94766577($_smarty_tpl, $_blockParentStack) {
?>

    <link rel="stylesheet" href="css/github.css">
    <?php echo '<script'; ?>
 src="js/highlight.pack.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
>hljs.initHighlightingOnLoad();<?php echo '</script'; ?>
>
    <div id="home" class="section">
        <h1 class="">
            ¬book
        </h1>
        <p class="flow-text">
            Porque hacer tus apuntes, nunca había sido tan fácil y con tanto estilo.
        </p>
        <div id="demo" class="section">
            <div class="row">
                <div class="col s10 m6">
                    <div class="card custom-card darken-1">
                        <div>
                            <pre style="word-wrap: break-word;"><code class="<?php echo $_smarty_tpl->tpl_vars['class']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['pre']->value;?>
</code></pre>
                        </div>
                    </div>
                </div>
                <div class="col s10 m6">
                    <div class="card custom-card">
                        <div>
                            <?php echo $_smarty_tpl->tpl_vars['post']->value;?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="section" id="about">
        <div class="row">
            <div class="col m12">
                <h3 class="roboto-light">¿Qué es notbook?</h3>
                <p class="flow-text" style="text-align: justify">
                    No es una libreta, sino una nueva forma de redactar tus documentos.
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col m6">
                <div class="card custom-card">
                    <pre><code class="markdown"><?php echo $_smarty_tpl->tpl_vars['about_unparsed']->value;?>
</code></pre>
                </div>
            </div>
            <div class="col m6">
                <div class="card custom-card ulist">
                    <?php echo $_smarty_tpl->tpl_vars['about']->value;?>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col m6">
                <div class="card custom-card">
                    <pre><?php echo $_smarty_tpl->tpl_vars['code_unparsed']->value;?>
</pre>
                </div>
            </div>
            <div class="col m6">
                <div class="card custom-card">
                    <?php echo $_smarty_tpl->tpl_vars['code']->value;?>

                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="row" id="register">
        <h3 class="roboto-light">
            Regístrate
        </h3>
        <?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:register_layout.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

    </div>
<?php
}
/* {/block 'body'} */
}
