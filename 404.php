<?php if(!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this -> need('header.php'); ?>

<main>
    <div class="wrap">
        <div class="error-page">
            <h1>404</h1>
            <p>找不到页面啦</p>
            <img src="<?php $this -> options -> themeUrl('img/404.png'); ?>"/>
        </div>
    </div>
</main>

<?php $this -> need('footer.php'); ?>