<?php
/**
 * 一个简洁大气，含夜间模式的 Typecho 博客模板。
 * 
 * @package Single Theme
 * @author Dreamer-Paul
 * @version 1.0
 * @link https://hi-paul.space
 */

if (!defined('__TYPECHO_ROOT_DIR__')) exit;
 $this->need('header.php');
 ?>
 
<main class="container">
    <div class="wrap min">
        <section class="home-title">
            <h1><?php $this->options->title() ?></h1>
            <span><?php $this->options->description() ?></span>
            <div class="home-social">
                <a rel="nofollow" title="新浪微博" href="http://weibo.com/234891753" target="_blank">
                    <i class="fa fa-weibo"></i>
                </a>
                <a rel="nofollow" title="QQ" href="http://shang.qq.com/wpa/qunwpa?idkey=8a11cea032c2362cf21573e774864329d29550f2bb0780adea5e9e0de39a19f7" target="_blank">
                    <i class="fa fa-qq"></i>
                </a>
                <a rel="nofollow" title="GitHub" href="https://github.com/Dreamer-Paul" target="_blank">
                    <i class="fa fa-github"></i>
                </a>
                <a rel="nofollow" title="Facebook" href="https://www.facebook.com/dreamer.paul.china" target="_blank">
                    <i class="fa fa-facebook"></i>
                </a>
                <a rel="nofollow" title="Steam" href="http://steamcommunity.com/id/dreamer-paul" target="_blank">
                    <i class="fa fa-steam"></i>
                </a>
            </div>
        </section>
        <section class="home-posts">
            <?php while($this->next()): ?>
            <div class="post-item">
                <h2>
                    <a href="<?php $this->permalink() ?>"><?php $this->title() ?></a>
                    <?php if($this->authorId == $this->user->uid): ?> <a class="edit-link" href="<?php $this->options->adminUrl(); ?>write-post.php?cid=<?php echo $this->cid;?>" target="_blank">编辑</a><?php endif; ?>
                </h2>
                <p><?php $this->excerpt(100); ?></p>
                <div class="post-meta">
                    <time class="date"><?php $this->date('Y.m.d'); ?></time>
                    <span class="category"><?php $this->category('、'); ?></span>
                    <span class="comments"><?php $this->commentsNum('%d °C'); ?></span>
                </div>
            </div>
            <?php endwhile; ?>
        </section>
        <?php $this->pageNav('&laquo;', '&raquo;'); ?>
    </div>
</main>

<?php $this->need('footer.php'); ?>