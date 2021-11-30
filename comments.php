<?php if(!defined('__TYPECHO_ROOT_DIR__')) exit; ?>

<?php

function threadedComments($comments) {
    $commentLevelClass = $comments -> levels > 0 ? " comment-child" : "";

    Single::$author = Single::$authorCache;
    Single::$authorCache = $comments -> author;

    $comments -> created = Single::tran_time($comments -> created);
?>

<div class="comment-single<?php echo $commentLevelClass; ?>" id="<?php $comments -> theId() ?>">
    <?php
        if(preg_match('/\d{4,13}(@qq.com)/', strtolower($comments -> mail))){
            preg_match('/\d+/', strtolower($comments -> mail), $mail_check);
            echo '<img class="avatar" src="https://q.qlogo.cn/g?b=qq&nk=' . $mail_check[0] . '&s=100" alt=""/>';
        }
        else{
            $comments -> gravatar('150', 'robohash');
        }
    ?>
    <div class="comment-meta">
        <span class="comment-author"><?php if($comments -> url): ?><a href="<?php $comments -> url() ?>" rel="external nofollow" target="_blank"><?php $comments->author(false) ?></a><?php else: $comments->author(); endif; ?></span>
        <time class="comment-time"><?php $comments -> created(); ?></time>
        <span class="comment-reply"><?php $comments -> reply('<i class="fa fa-reply" title="回复"></i>'); ?></span>
    </div>
    <div class="comment-content">
        <p>
<?php

if($comments -> parent){
    echo '<a href="#comment-' . $comments -> parent . '">@' . Single::$author . '</a> ';
}

$comments -> content = preg_replace('#</?[p][^>]*>#','', $comments -> content);
$comments -> content();

?>
        </p>
    </div>
</div>

<?php if($comments -> children) $comments -> threadedComments(); ?>

<?php } ?>

<section class="post-comments" id="comments">
    <h3><?php $this -> commentsNum(_t('没有评论'), _t('只有一条评论 (QwQ)'), _t('已有 %d 条评论')); ?></h3>
<?php $this -> comments() -> to($comments); ?>
<?php if($this -> allow('comment')): ?>
    <div class="comment-form" id="<?php $this -> respondId(); ?>">
        <span class="cancel-comment-reply">
            <?php $comments -> cancelReply(); ?>
        </span>
        <form method="post" action="<?php $this -> commentUrl() ?>" role="form">
<?php if($this -> user -> hasLogin()): ?>
            <fieldset>
                <p>欢迎回来，<a href="<?php $this -> options -> profileUrl() ?>"><?php $this -> user -> screenName(); ?></a>！不是你？<a href="<?php $this -> options -> logoutUrl() ?>">登出</a></p>
                <textarea rows="2" name="text" id="textarea" placeholder="快来评论支持吧 (*≧ω≦)ﾉ" title="如发布虚假信息或广告，将无法通过审核" required><?php $this -> remember('text'); ?></textarea>
                <button type="submit" class="btn">写好了~</button>
            </fieldset>
<?php else: ?>
            <div class="row">
                <fieldset class="col-m-6">
                    <input type="text" name="author" placeholder="昵称 *：" value="<?php $this -> remember('author'); ?>" required>
                    <input type="email" name="mail" placeholder="电邮 *：" value="<?php $this -> remember('mail'); ?>"<?php if($this -> options -> commentsRequireMail): ?> required<?php endif; ?>>
                    <input type="url" name="url" placeholder="http://" value="<?php $this -> remember('url'); ?>"<?php if($this -> options -> commentsRequireURL): ?> required<?php endif; ?>>
                </fieldset>
                <fieldset class="col-m-6">
                    <textarea rows="3" name="text" id="textarea" placeholder="快来评论吧 (*≧ω≦)ﾉ" required><?php $this -> remember('text'); ?></textarea>
                    <button type="submit" class="btn">写好了~</button>
                </fieldset>
            </div>
<?php endif; ?>
        </form>
    </div>
<?php else: ?>
        <p>博主关闭了评论...</p>
<?php endif; ?>

<?php if($comments -> have()): ?>
        <div class="comment-list"><?php $comments -> listComments(array('before' => '', 'after' => '', 'replyWord' => '<i class="fa fa-reply"></i>')); ?></div>
        <?php $comments -> pageNav('&laquo;', '&raquo;', 3, "...", array('wrapTag' => 'section', 'itemTag' => 'span')); ?>
<?php endif; ?>

</section>