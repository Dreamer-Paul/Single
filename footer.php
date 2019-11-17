<?php if(!defined('__TYPECHO_ROOT_DIR__')) exit; ?>

<footer>
    <div class="buttons">
        <a class="to-top" href="#"></a>
    </div>
    <div class="wrap min">
<?php if($this -> options -> widget_set == '1'): ?>
        <section class="widget">
            <div class="row">
                <div class="col-m-4">
                    <h3 class="title-recent">最新文章：</h3>
                    <ul>
                        <?php $this -> widget('Widget_Contents_Post_Recent', 'pageSize=6') -> parse('<li><a href="{permalink}" target="_blank">{title}</a></li>'); ?>
                    </ul>
                </div>
                <div class="col-m-4">
                    <h3 class="title-date">时光机：</h3>
                    <ul>
                        <?php $this -> widget('Widget_Contents_Post_Date', 'type=month&format=Y 年 m 月&limit=6') -> parse('<li><a href="{permalink}" rel="nofollow" target="_blank">{date}</a></li>'); ?>
                    </ul>
                </div>
                <div class="col-m-4">
                    <h3 class="title-comments">最近评论：</h3>
                    <ul>
                        <?php $this -> widget('Widget_Comments_Recent', 'pageSize=6') -> to($comments); ?>
                        <?php while($comments -> next()): ?>
                            <li><?php $comments -> author(false); ?>: <a href="<?php $comments -> permalink(); ?>" rel="nofollow" target="_blank"><?php $comments -> excerpt(10, '...'); ?></a></li>
                        <?php endwhile; ?>
                    </ul>
                </div>
            </div>
        </section>
<?php endif; ?>
        <section class="sub-footer">
            <p>© <?php echo date('Y'); ?> <a href="<?php $this -> options -> siteUrl(); ?>"><?php $this -> options -> title(); ?></a>. All Rights Reserved. Theme By <a href="https://github.com/Dreamer-Paul/Single" target="_blank" rel="nofollow">Single</a>.</p>
        </section>
    </div>
</footer>

<script src="<?php $this -> options -> themeUrl('static/kico.js'); ?>"></script>
<script src="<?php $this -> options -> themeUrl('static/single.js'); ?>"></script>
<script src="<?php $this -> options -> themeUrl('static/prism.js'); ?>"></script>
<script>var single = new Paul_Single({copyright: <?php if($this -> options -> copy_notice == 1): ?>true<?php else: ?>false<?php endif; ?>, night: <?php if($this -> options -> night_mode == 1): ?>true<?php else: ?>false<?php endif; ?>});</script>
<?php $this -> options -> custom_script(); ?>
<?php $this -> footer(); ?>

</body>
</html>