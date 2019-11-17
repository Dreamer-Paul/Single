<?php

/**
 * 一个简洁大气，含夜间模式的 Typecho 博客模板。
 *
 * @package Single Theme
 * @author Dreamer-Paul
 * @version 2.1
 * @link https://paugram.com
 */

if(!defined('__TYPECHO_ROOT_DIR__')) exit;

$this -> need('header.php');

?>

<main>
    <div class="wrap min">
        <section class="home-title">
            <h1><?php $this -> options -> title() ?></h1>
            <span><?php $this -> options -> description() ?></span>
<?php if($this -> options -> home_social): ?>
            <div class="home-social">
<?php $this -> options -> home_social() ?>
            </div>
<?php endif; ?>
        </section>
        <section class="home-posts">
<?php while($this -> next()): ?>
            <div class="post-item">
                <h2>
                    <a href="<?php $this -> permalink() ?>"><?php $this->title() ?></a>
                    <?php if($this -> authorId == $this -> user -> uid): ?> <a class="edit-link" href="<?php $this -> options -> adminUrl(); ?>write-post.php?cid=<?php echo $this->cid;?>" target="_blank">编辑</a><?php endif; ?>
                </h2>
                <p><?php $this -> excerpt(100); ?></p>
                <div class="post-meta">
                    <time class="date"><?php $this -> date(); ?></time>
<?php if(!empty($this -> options -> archive_meta) && in_array('show_category', $this -> options -> archive_meta)): ?>
                        <span class="category"><?php $this -> category('，'); ?></span>
<?php endif; ?>
<?php if(!empty($this -> options -> archive_meta) && in_array('show_tags', $this -> options -> archive_meta)): ?>
                        <span class="tags"><?php $this -> tags('，', true, '暂无'); ?></span>
<?php endif; ?>
<?php if(!empty($this -> options -> archive_meta) && in_array('show_comments', $this->options -> archive_meta)): ?>
                        <span class="comments"><?php $this -> commentsNum('%d °C'); ?></span>
<?php endif; ?>
                </div>
            </div>
            <?php endwhile; ?>
        </section>
        <?php $this -> pageNav('&laquo;', '&raquo;', 3, "...", array('wrapTag' => 'section', 'itemTag' => 'span')); ?>
    </div>
</main>

<?php $this -> need('footer.php'); ?>