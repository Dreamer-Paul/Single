<?php

if(!defined('__TYPECHO_ROOT_DIR__')) exit;

/**
 * 标签云
 *
 * @package custom
 */

$this -> need('header.php');

?>
<main>
    <style>
        main .tags-list{
            display: flex;
            flex-wrap: wrap;
        }
        main .tags-list a{
            color: inherit;
            border-radius: 2em;
            padding: .5em .75em;
            margin: 0 .5em .5em 0;
            display: inline-block;
            transition: border .3s;
            border: 1px solid var(--board-border);
        }
    </style>
    <div class="wrap min">
        <section class="page-title">
            <h2><?php $this -> title() ?></h2>
<?php if($this -> authorId == $this -> user -> uid): ?>
            <a class="edit-link" href="<?php $this -> options -> adminUrl(); ?>write-page.php?cid=<?php echo $this -> cid; ?>" target="_blank">编辑</a>
<?php endif; ?>
        </section>
        <section class="page-content">
<?php $this -> widget('Widget_Metas_Tag_Cloud', 'sort=mid&ignoreZeroCount=1&desc=0') -> to($tags); ?>
    <?php if($tags -> have()): ?>
            <div class="tags-list">
                <?php while ($tags -> next()): ?>
                    <a href="<?php $tags->permalink(); ?>" title="<?php $tags -> count(); ?> 个话题"><?php $tags -> name(); ?> (<?php $tags -> count(); ?>)</a>
                <?php endwhile; ?>
    <?php else: ?>
                    <div><?php _e('没有任何标签'); ?></div>
    <?php endif; ?>
            </div>
        </section>
    </div>
</main>

<?php $this -> need('footer.php'); ?>