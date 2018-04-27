<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php $this->archiveTitle(array(
            'category'  =>  _t('%s'),
            'search'    =>  _t('含关键词 %s 的文章'),
            'tag'       =>  _t('标签 %s 下的文章'),
            'author'    =>  _t('%s 发布的文章')
        ), '', ' - '); ?><?php $this->options->title(); ?></title>
<?php if ($this->options->favicon_small): ?>
    <link rel="icon" href="<?php $this->options->favicon_small() ?>" sizes="32x32"/>
<?php else: ?>
    <link rel="icon" href="<?php $this->options->themeUrl('img/icon/32.png'); ?>" sizes="32x32"/>
<?php endif; ?>
<?php if ($this->options->favicon_large): ?>
    <link rel="icon" href="<?php $this->options->favicon_small() ?>" sizes="192x192"/>
<?php else: ?>
    <link rel="icon" href="<?php $this->options->themeUrl('img/icon/192.png'); ?>" sizes="192x192"/>
<?php endif; ?>
    <link href="<?php $this->options->themeUrl('css/kico.css'); ?>" rel="stylesheet" type="text/css"/>
    <link href="<?php $this->options->themeUrl('css/single.css'); ?>" rel="stylesheet" type="text/css"/>
    <link href="<?php $this->options->themeUrl('css/font-awesome.min.css'); ?>" rel="stylesheet" type="text/css"/>
    <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1"/>
<?php if ($this->options->background_img): ?>
    <style>body:before{content:''; display:block;  opacity:.06; z-index:-1; position:fixed; top:0; bottom:0; left:0; right:0; background: url(<?php $this->options->background_img() ?>) center/cover no-repeat;}</style>
<?php endif; ?>
<?php if ($this->options->custom_css): ?>
    <style><?php $this->options->custom_css() ?></style>
<?php endif; ?>
    <meta property="og:site_name" content="<?php $this->options->title(); ?>">
    <meta property="og:title" content="<?php $this->archiveTitle(array(
            'category'  =>  _t('%s'),
            'search'    =>  _t('含关键词 %s 的文章'),
            'tag'       =>  _t('标签 %s 下的文章'),
            'author'    =>  _t('%s 发布的文章')
        )); ?>"/>
<!--[if lt IE 9]>
    <script src="https://cdn.bootcss.com/html5shiv/r29/html5.min.js"></script>
<![endif]-->
<?php $this->header('generator=&template=&pingback=&xmlrpc=&wlw='); ?>
</head>
<body>
<header>
    <div class="head-title">
        <h4><?php $this->options->title() ?></h4>
    </div>
    <div class="toggle-btn"></div>
    <div class="light-btn"></div>
    <div class="search-btn"></div>
    <form class="head-search" method="post" action="">
        <input type="text" name="s" placeholder="搜索什么？">
    </form>
    <ul class="head-menu">
        <li><a href="<?php $this->options->siteUrl(); ?>">首页</a></li>
        <li class="has-child">
            <a>分类</a>
            <ul class="sub-menu">
                <?php $this->widget('Widget_Metas_Category_List')->parse('<li><a href="{permalink}">{name}</a></li>'); ?>
            </ul>
        </li>
        <?php $this->widget('Widget_Contents_Page_List')->parse('<li><a href="{permalink}">{title}</a></li>'); ?>
    </ul>
</header>