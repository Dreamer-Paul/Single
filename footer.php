<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
 
<footer>
    <a class="turn-up" href="#"></a>
    <div class="wrap min">
        <p>© <?php echo date('Y'); ?> <a href="<?php $this->options->siteUrl(); ?>"><?php $this->options->title(); ?></a>. All Rights Reserved. Theme By <a href="https://github.com/Dreamer-Paul/Single" target="_blank" rel="nofollow">Single</a>.</p>
    </div>
</footer>

<script src="<?php $this->options->themeUrl('js/binkic.js'); ?>"></script>
<script>bk_imgs(".post-content img, .page-content img");</script>
<script src="<?php $this->options->themeUrl('js/single.js'); ?>"></script>
<?php if ($this->options->pjax_set == '1'): ?>
<script src="<?php $this->options->themeUrl('js/instantclick.min.js'); ?>"></script>
<script data-no-instant>InstantClick.init('mousedown');</script>
<script>(function(){window.TypechoComment={dom:function(id){return document.getElementById(id)},create:function(tag,attr){var el=document.createElement(tag);for(var key in attr){el.setAttribute(key,attr[key])}return el},reply:function(cid,coid){var comment=this.dom(cid),parent=comment.parentNode,response=this.dom("respond-post-60"),input=this.dom("comment-parent"),form="form"==response.tagName?response:response.getElementsByTagName("form")[0],textarea=response.getElementsByTagName("textarea")[0];if(null==input){input=this.create("input",{"type":"hidden","name":"parent","id":"comment-parent"});form.appendChild(input)}input.setAttribute("value",coid);if(null==this.dom("comment-form-place-holder")){var holder=this.create("div",{"id":"comment-form-place-holder"});response.parentNode.insertBefore(holder,response)}comment.appendChild(response);this.dom("cancel-comment-reply-link").style.display="";if(null!=textarea&&"text"==textarea.name){textarea.focus()}return false},cancelReply:function(){var response=this.dom("respond-post-60"),holder=this.dom("comment-form-place-holder"),input=this.dom("comment-parent");if(null!=input){input.parentNode.removeChild(input)}if(null==holder){return true}this.dom("cancel-comment-reply-link").style.display="none";holder.parentNode.insertBefore(response,holder);return false}}})();</script>
<?php endif; ?>
<script src="https://cdn.bootcss.com/smooth-scroll/12.1.3/js/smooth-scroll.min.js"></script>
<script>var scroll = new SmoothScroll('a[href*="#"]', {offset: 100});</script>

<?php $this->footer(); ?>
</body>
</html>