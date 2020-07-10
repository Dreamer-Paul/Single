<?php

if(!defined('__TYPECHO_ROOT_DIR__')) exit;

/**
 * 二次开发示例
 *
 * @package custom
 */

$this -> need('header.php');

?>
<main>
    <style>
        /* 样式内容 */
    </style>
    <div class="wrap min">
        <!-- 是否输出页眉 -->
        <section class="page-title">
            <h2><?php $this -> title() ?></h2>
<?php if($this -> authorId == $this -> user -> uid): ?>
            <a class="edit-link" href="<?php $this -> options -> adminUrl(); ?>write-page.php?cid=<?php echo $this -> cid; ?>" target="_blank">编辑</a>
<?php endif; ?>
        </section>
        <!-- 正文区 -->
        <section class="page-content">
            <!-- 可以在这里放入你想在页面自定义的功能 -->
        </section>
    </div>
</main>

<?php $this -> need('footer.php'); ?>