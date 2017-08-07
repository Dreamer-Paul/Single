<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
 
<footer>
    <a class="turn-up" href="#"></a>
    <div class="wrap min">
        <p>© <?php echo date('Y'); ?> <a href="<?php $this->options->siteUrl(); ?>"><?php $this->options->title(); ?></a>. All Rights Reserved. Theme <a href="https://github.com/Dreamer-Paul/Single" target="_blank" rel="nofollow">Single</a>.</p>
    </div>
</footer>

<script src="<?php $this->options->themeUrl('js/binkic.js'); ?>"></script>
<script src="<?php $this->options->themeUrl('js/single.js'); ?>"></script>

<?php $this->footer(); ?>
</body>
</html>