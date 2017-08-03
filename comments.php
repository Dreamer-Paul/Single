<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<section id="comments" class="post-comments">
    <h3><?php $this->commentsNum(_t('没有评论'), _t('只有一条评论 (QwQ)'), _t('已有 %d 条评论')); ?></h3>
    <?php $this->comments()->to($comments); ?>
    <?php if($this->allow('comment')): ?>
    <div id="<?php $this->respondId(); ?>" class="respond">
        <div class="cancel-comment-reply">
        <?php $comments->cancelReply(); ?>
        </div>
        
        <form method="post" action="<?php $this->commentUrl() ?>" id="comment-form" role="form">
            <div class="row">
                <?php if($this->user->hasLogin()): ?>
                <div class="col-m-12">
                    <p><?php _e('已登录：'); ?><a href="<?php $this->options->profileUrl(); ?>"><?php $this->user->screenName(); ?></a>. <a href="<?php $this->options->logoutUrl(); ?>" title="登出"><?php _e('登出'); ?> &raquo;</a></p>
                    <p>
                        <label for="textarea">内容 *：</label>
                        <textarea rows="2" name="text" id="textarea" required=""><?php $this->remember('text'); ?></textarea>
                    </p>
                    <p>
                        <button type="submit" class="btn small">写好了！</button>
                    </p>
                </div>
                <?php else: ?>
                <div class="col-m-6">
                    <p>
                        <label for="author">昵称 *：</label>
                        <input type="text" name="author" id="author" value="<?php $this->remember('author'); ?>" required="">
                    </p>
                    <p>
                        <label for="mail">电邮 *：</label>
                        <input type="email" name="mail" id="mail" value="<?php $this->remember('mail'); ?>"<?php if ($this->options->commentsRequireMail): ?> required<?php endif; ?>>
                    </p>
                    <p>
                        <label for="url">网站：</label>
                        <input type="url" name="url" id="url" placeholder="http://" value="<?php $this->remember('url'); ?>"<?php if ($this->options->commentsRequireURL): ?> required<?php endif; ?>>
                    </p>
                </div>
                <div class="col-m-6">
                    <p>
                        <label for="textarea">内容 *：</label>
                        <textarea rows="5" name="text" id="textarea" required=""><?php $this->remember('text'); ?></textarea>
                    </p>
                    <p>
                        <button type="submit" class="btn small">写好了！</button>
                    </p>
                </div>
                <?php endif; ?>
            </div>
        </form>
    </div>
    <?php endif; ?>
    <?php if ($comments->have()): ?>
        <?php $comments->listComments(); ?>
        <?php $comments->pageNav('&laquo; 前一页', '后一页 &raquo;'); ?>
    <?php endif; ?>
</section>
