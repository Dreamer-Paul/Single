<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

function themeConfig($form) {
    // 输出主题信息
    $version = "1.7";
    echo("<style>.single-info{text-align:center; margin:1em 0;}.single-info > *{margin:0 0 1rem}.single-info p:last-child a{background:#467B96;color:#fff;border-radius:4px;padding:.5em .75em;display:inline-block}</style>");
    echo("<div class='single-info'>");
    echo("<h2>Single 主题 (".$version.")</h2>");
    echo("<p>By: <a href='https://github.com/Dreamer-Paul'>Dreamer-Paul</a></p>");
    echo("<p><a href='https://github.com/Dreamer-Paul/Single/releases'>版本列表</a>
             <a href='https://github.com/Dreamer-Paul/Single/releases/tag/".$version."'>更新日志</a></p>");
    echo("</div>");

    // 自定义站点图标
    $favicon_small = new Typecho_Widget_Helper_Form_Element_Text('favicon_small', NULL, NULL, _t('站点图标'), _t('在这里填入一张 png 图片地址（<a>32x32px</a>），不填则使用默认图标'));
    $form->addInput($favicon_small);

    $favicon_large = new Typecho_Widget_Helper_Form_Element_Text('favicon_large', NULL, NULL, _t('站点图标（大）'), _t('在这里填入一张 png 图片地址（<a>192x192px</a>），不填则使用默认图标'));
    $form->addInput($favicon_large);

    // 自定义背景图
    $background_img = new Typecho_Widget_Helper_Form_Element_Text('background_img', NULL, NULL, _t('站点背景'), _t('在这里填入一张图片地址，不填则显示纯色背景'));
    $form->addInput($background_img);

    // 自定义社交链接
    $home_social = new Typecho_Widget_Helper_Form_Element_Textarea('home_social', NULL, NULL, _t('自定义社交链接'), _t('在这里填入你的自定义社交链接，不填则不输出。（格式请看<a href="https://github.com/Dreamer-Paul/Single/releases/tag/1.1" target="_blank">帮助信息</a>）'));
    $form->addInput($home_social);

    // 自定义样式表
    $custom_css = new Typecho_Widget_Helper_Form_Element_Textarea('custom_css', NULL, NULL, _t('自定义样式表'), _t('在这里填入你的自定义样式表，不填则不输出。'));
    $form->addInput($custom_css);

    // 自定义作者信息
    $author_text = new Typecho_Widget_Helper_Form_Element_Text('author_text', NULL, NULL, _t('作者信息'), _t('显示在文章底部的作者信息，不填则不输出。'));
    $form->addInput($author_text);

    // 信息栏
    $widget_set = new Typecho_Widget_Helper_Form_Element_Radio('widget_set',
        array(
          '0' => _t('关闭'),
          '1' => _t('开启'),
        ),
        '0', _t('是否显示信息栏'), _t('在页尾显示 “最近评论”、“最新文章” 和 “时光机”'));
    $form->addInput($widget_set);

    // 首页、存档页属性显示
    $archive_meta = new Typecho_Widget_Helper_Form_Element_Checkbox('archive_meta',
        array(
            'show_category' => _t('文章分类'),
            'show_tags' => _t('文章标签'),
            'show_comments' => _t('评论数')),
        array('show_category', 'show_comments'), _t('首页、存档页属性显示'));
    $form->addInput($archive_meta->multiMode());

    // 文章页属性显示
    $post_meta = new Typecho_Widget_Helper_Form_Element_Checkbox('post_meta',
        array(
            'show_category' => _t('文章分类'),
            'show_tags' => _t('文章标签'),
            'show_comments' => _t('评论数')),
        array('show_category', 'show_comments'), _t('文章页属性显示'));
    $form->addInput($post_meta->multiMode());
    // 自定义网站统计代码
    $umeng_cnzz_text = new Typecho_Widget_Helper_Form_Element_Text('umeng_cnzz_text', NULL, NULL, _t('网站统计代码'), _t('在网站底部的站长统计隐藏显示，不填则不输出。'));
    $form->addInput($umeng_cnzz_text);
	//HTML压缩设置
	$Gzip_compress_html = new Typecho_Widget_Helper_Form_Element_Checkbox('Gzip_compress_html',
	array('g_compress_html' => _t('启用HTML压缩，勾上即可'),),array('g_compress_html'), _t('设置开启HTML代码压缩'));
	$form->addInput($Gzip_compress_html->multiMode());
}
//html压缩代码
function compressHtml($html_source) {
    $chunks = preg_split('/(<!--<nocompress>-->.*?<!--<\/nocompress>-->|<nocompress>.*?<\/nocompress>|<pre.*?\/pre>|<textarea.*?\/textarea>|<script.*?\/script>)/msi', $html_source, -1, PREG_SPLIT_DELIM_CAPTURE);
    $compress = '';
    foreach ($chunks as $c) {
        if (strtolower(substr($c, 0, 19)) == '<!--<nocompress>-->') {
            $c = substr($c, 19, strlen($c) - 19 - 20);
            $compress .= $c;
            continue;
        } else if (strtolower(substr($c, 0, 12)) == '<nocompress>') {
            $c = substr($c, 12, strlen($c) - 12 - 13);
            $compress .= $c;
            continue;
        } else if (strtolower(substr($c, 0, 4)) == '<pre' || strtolower(substr($c, 0, 9)) == '<textarea') {
            $compress .= $c;
            continue;
        } else if (strtolower(substr($c, 0, 7)) == '<script' && strpos($c, '//') != false && (strpos($c, "\r") !== false || strpos($c, "\n") !== false)) {
            $tmps = preg_split('/(\r|\n)/ms', $c, -1, PREG_SPLIT_NO_EMPTY);
            $c = '';
            foreach ($tmps as $tmp) {
                if (strpos($tmp, '//') !== false) {
                    if (substr(trim($tmp), 0, 2) == '//') {
                        continue;
                    }
                    $chars = preg_split('//', $tmp, -1, PREG_SPLIT_NO_EMPTY);
                    $is_quot = $is_apos = false;
                    foreach ($chars as $key => $char) {
                        if ($char == '"' && $chars[$key - 1] != '\\' && !$is_apos) {
                            $is_quot = !$is_quot;
                        } else if ($char == '\'' && $chars[$key - 1] != '\\' && !$is_quot) {
                            $is_apos = !$is_apos;
                        } else if ($char == '/' && $chars[$key + 1] == '/' && !$is_quot && !$is_apos) {
                            $tmp = substr($tmp, 0, $key);
                            break;
                        }
                    }
                }
                $c .= $tmp;
            }
        }
        $c = preg_replace('/[\\n\\r\\t]+/', ' ', $c);
        $c = preg_replace('/\\s{2,}/', ' ', $c);
        $c = preg_replace('/>\\s</', '> <', $c);
        $c = preg_replace('/\\/\\*.*?\\*\\//i', '', $c);
        $c = preg_replace('/<!--[^!]*-->/', '', $c);
        $compress .= $c;
    }
    return $compress;
}
