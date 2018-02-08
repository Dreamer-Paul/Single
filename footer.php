<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
 
<footer>
    <a class="turn-up" href="#"></a>
    <div class="wrap min">
<?php if ($this->options->widget_set == '1'): ?>
        <section class="widget">
            <div class="row">
                <div class="col-m-4">
                    <h3 class="title-recent">最新文章：</h3>
                    <ul>
                        <?php $this->widget('Widget_Contents_Post_Recent', 'pageSize=6')
                                   ->parse('<li><a href="{permalink}" target="_blank">{title}</a></li>'); ?>
                    </ul>
                </div>
                <div class="col-m-4">
                    <h3 class="title-date">时光机：</h3>
                    <ul>
                        <?php $this->widget('Widget_Contents_Post_Date', 'type=month&format=Y 年 m 月&limit=6')
                                   ->parse('<li><a href="{permalink}" rel="nofollow" target="_blank">{date}</a></li>'); ?>
                    </ul>
                </div>
                <div class="col-m-4">
                    <h3 class="title-comments">最近评论：</h3>
                    <ul>
                        <?php $this->widget('Widget_Comments_Recent')->to($comments); ?>
                        <?php while($comments->next()): ?>
                            <li><?php $comments->author(false); ?>: <a href="<?php $comments->permalink(); ?>" rel="nofollow" target="_blank"><?php $comments->excerpt(10, '...'); ?></a></li>
                        <?php endwhile; ?>
                    </ul>
                </div>
            </div>
        </section>
<?php endif; ?>
        <section class="sub-footer">
            <p>© <?php echo date('Y'); ?> <a href="<?php $this->options->siteUrl(); ?>"><?php $this->options->title(); ?></a>. All Rights Reserved. Theme By <a href="https://github.com/Dreamer-Paul/Single" target="_blank" rel="nofollow">Single</a>.</p>
        </section>
    </div>
</footer>

<script src="<?php $this->options->themeUrl('js/kico.js'); ?>"></script>
<script src="<?php $this->options->themeUrl('js/single.js'); ?>"></script>
<script src="https://cdn.bootcss.com/smooth-scroll/12.1.3/js/smooth-scroll.min.js"></script>
<script>var scroll = new SmoothScroll('a.turn-up, .article-list a', {offset: 100});</script>
<?php if ($this->is('single')) : ?>
<script src="//cdn.bootcss.com/highlight.js/9.12.0/highlight.min.js"></script>
<script>hljs.initHighlightingOnLoad();</script>
<script>
    var str = document.getElementsByClassName("page-content")[0];
    var isKaTex = str.innerHTML.match('$$');
    if(isKaTex) {
        join_js("//cdn.bootcss.com/KaTeX/0.8.3/contrib/auto-render.min.js");
        join_js("//cdn.bootcss.com/KaTeX/0.8.3/katex.min.js");
    }
    window.onload = function() {
        if(isKaTex) renderMathInElement(document.body);
    }
</script>
<?php endif; ?>

<?php $this->footer(); ?>
</body>
</html>
