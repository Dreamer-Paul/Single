<style>
.reply2view {
    background: #f8f8f8;
    padding: 3px;
    position: relative;   
}
</style>
<?php if(!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this -> need('header.php'); ?>

<main>
    <div class="wrap min">
        <section class="post-title">
            <h2><?php $this -> title() ?></h2>
<?php if($this -> authorId == $this -> user -> uid): ?>
            <a class="edit-link" href="<?php $this->options -> adminUrl(); ?>write-post.php?cid=<?php echo $this -> cid; ?>" target="_blank">编辑</a>
<?php endif; ?>
            <div class="post-meta">
                <time class="date"><?php $this->date(); ?></time>
<?php if(!empty($this -> options -> post_meta) && in_array('show_category', $this -> options -> post_meta)): ?>
                <span class="category"><?php $this -> category('，'); ?></span>
<?php endif; ?>
<?php if(!empty($this -> options -> post_meta) && in_array('show_tags', $this -> options -> post_meta)): ?>
                <span class="tags"><?php $this -> tags('，', true, '暂无'); ?></span>
<?php endif; ?>
<?php if(!empty($this -> options -> post_meta) && in_array('show_comments', $this -> options -> post_meta)): ?>
                <span class="comments"><?php $this -> commentsNum(); ?></span>
<?php endif; ?>
<?php if(!empty($this -> options -> post_meta) && in_array('show_view', $this -> options -> post_meta)): ?>
                <span class="view"><?php Single::get_post_view($this) ?></span>
<?php endif; ?>
            </div>
        </section>
        <article class="post-content">
<?php if(time() - $this -> modified >= 15552000): ?>
            <blockquote>这篇文章上次修改于 <?php echo ceil((time() - $this -> modified) / 86400) ?> 天前，可能其部分内容已经发生变化，如有疑问可询问作者。</blockquote>
<?php endif ?>
           <?php
$db = Typecho_Db::get();
$sql = $db->select()->from('table.comments')
    ->where('cid = ?',$this->cid)
    ->where('mail = ?', $this->remember('mail',true))
    ->limit(1);
$result = $db->fetchAll($sql);
if($this->user->hasLogin() || $result) {
    $content = preg_replace("/\[hide\](.*?)\[\/hide\]/sm",'<div class="reply2view"><b>本贴隐藏的内容：</b><br><font color="#dc143c">$1</font></div>',$this->content);
}
else{
    $content = preg_replace("/\[hide\](.*?)\[\/hide\]/sm",'<div class="reply2view">此处内容已隐藏，回复可见',$this->content);
}
echo $content 
?>
        </article>
        <section class="post-near">
            <ul>
                <li>上一篇: <?php $this -> thePrev('%s','看完啦 (つд⊂)'); ?></li>
                <li>下一篇: <?php $this -> theNext('%s','看完啦 (つд⊂)'); ?></li>
            </ul>
        </section>
<?php if($this -> options -> author_text): ?>
        <section class="post-author">
            <figure class="author-avatar">
                <?php $this -> author -> gravatar(200); ?>
            </figure>
            <div class="author-info">
                <h4><?php $this -> author(); ?></h4>
                <p><?php $this -> options -> author_text() ?></p>
            </div>
        </section>
<?php endif; ?>
        <?php $this -> need('comments.php'); ?>
    </div>
</main>

<?php $this -> need('footer.php'); ?>
