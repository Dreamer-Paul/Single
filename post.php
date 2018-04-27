<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>

<main>
    <div class="wrap min">
        <section class="post-title">
            <h2><?php $this->title() ?></h2>
<?php if($this->authorId == $this->user->uid): ?>
            <a class="edit-link" href="<?php $this->options->adminUrl(); ?>write-post.php?cid=<?php echo $this->cid;?>" target="_blank">编辑</a>
<?php endif; ?>
            <div class="post-meta">
                <time class="date"><?php $this->date(); ?></time>
<?php if (!empty($this->options->post_meta) && in_array('show_category', $this->options->post_meta)): ?>
                <span class="category"><?php $this->category('，'); ?></span>
<?php endif; ?>
<?php if (!empty($this->options->post_meta) && in_array('show_tags', $this->options->post_meta)): ?>
                <span class="tags"><?php $this->tags('，', true, '暂无'); ?></span>
<?php endif; ?>
<?php if (!empty($this->options->post_meta) && in_array('show_comments', $this->options->post_meta)): ?>
                <span class="comments"><?php $this->commentsNum('%d °C'); ?></span>
<?php endif; ?>
            </div>
        </section>
        <article class="post-content">
            <?php $this->content(); ?>
        </article>
        <ul class="post-near">
            <li>上一篇: <?php $this->thePrev('%s','看完啦 (つд⊂)'); ?></li>
            <li>下一篇: <?php $this->theNext('%s','看完啦 (つд⊂)'); ?></li>
        </ul>
<?php if($this->options->author_text): ?>
        <section class="post-author">
            <figure>
                <?php $this->author->gravatar(200); ?>
            </figure>
            <div>
                <h4><?php $this->author(); ?></h4>
                <p><?php $this->options->author_text() ?></p>
            </div>
        </section>
<?php endif; ?>
        <?php $this->need('comments.php'); ?>
    </div>
</main>

<?php $this->need('footer.php'); ?>