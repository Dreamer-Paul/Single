<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

function themeConfig($form) {
    // 输出主题信息
    $version = "1.3";
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

    // 自定义社交链接
    $home_social = new Typecho_Widget_Helper_Form_Element_Textarea('home_social', NULL, NULL, _t('自定义社交链接'), _t('在这里填入你的自定义社交链接，不填则不输出。（格式请看<a href="https://github.com/Dreamer-Paul/Single/releases/tag/1.1" target="_blank">帮助信息</a>）'));
    $form->addInput($home_social);

    // 自定义样式表
    $custom_css = new Typecho_Widget_Helper_Form_Element_Textarea('custom_css', NULL, NULL, _t('自定义样式表'), _t('在这里填入你的自定义样式表，不填则不输出。'));
    $form->addInput($custom_css);

    // 显示作者信息
    $show_author = new Typecho_Widget_Helper_Form_Element_Select('show_author',
        array(
            '0' => _t('关闭'),
            '1' => _t('开启')
        ), '1', _t('显示作者信息'),  _t('在文章底部显示作者信息'));

    $form->addInput($show_author->multiMode());

    // 自定义作者信息
    $author_text = new Typecho_Widget_Helper_Form_Element_Text('author_text', NULL, NULL, _t('作者信息'), _t('显示在文章底部的作者信息，可以是版权声明等'));
    $form->addInput($author_text);

    // Pjax
    $pjax_set = new Typecho_Widget_Helper_Form_Element_Radio('pjax_set',
        array(
            '0' => _t('关闭'),
            '1' => _t('开启'),
        ),
        '0', _t('是否开启 PJAX'), _t('给网站开启 PJAX，提升浏览体验。使用 “instantclick” 实现'));
    $form->addInput($pjax_set);

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
}