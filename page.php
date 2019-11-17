<?php if(!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this -> need('header.php'); ?>

<main>
    <div class="wrap min">
        <section class="page-title">
            <h2><?php $this -> title() ?></h2>
<?php if($this -> authorId == $this -> user -> uid): ?>
            <a class="edit-link" href="<?php $this -> options -> adminUrl(); ?>write-page.php?cid=<?php echo $this -> cid; ?>" target="_blank">编辑</a>
<?php endif; ?>
        </section>
        <article class="page-content">
            <?php $this -> content(); ?>
        </article>
        <?php $this -> need('comments.php'); ?>
    </div>
</main>

<?php $this -> need('footer.php'); ?>