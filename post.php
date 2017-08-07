<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>
 
<main class="container">
    <div class="wrap min">
        <section class="post-title">
            <h2><?php $this->title() ?></h2>
            <?php if($this->authorId == $this->user->uid): ?> <a class="edit-link" href="<?php $this->options->adminUrl(); ?>write-post.php?cid=<?php echo $this->cid;?>" target="_blank">编辑</a><?php endif; ?>
            <div class="post-meta">
                <time class="date"><?php $this->date('Y.m.d'); ?></time>
                <span class="category"><?php $this->category('，'); ?></span>
                <span class="comments"><?php $this->commentsNum('%d °C'); ?></span>
            </div>
        </section>
        <article class="post-content">
            <?php $this->content(); ?>
        </article>
        <ul class="post-near">
            <li>上一篇: <?php $this->thePrev('%s','看完啦 (つд⊂)'); ?></li>
            <li>下一篇: <?php $this->theNext('%s','看完啦 (つд⊂)'); ?></li>
        </ul>
        <?php $this->need('comments.php'); ?>
    </div>
</main>

<?php $this->need('footer.php'); ?>