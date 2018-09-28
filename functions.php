<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

function themeConfig($form) {
    $theme = "Single";
    $version = "1.9";

    // 插件信息与更新检测
    function paul_update($name, $version){
        echo "<style>.paul-info{text-align:center; margin:1em 0;} .paul-info > *{margin:0 0 1rem} .buttons a{background:#467b96; color:#fff; border-radius:4px; padding:.5em .75em; display:inline-block}</style>";
        echo "<div class='paul-info'>";
        echo "<h2>Single 主题 (".$version.")</h2>";
        echo "<p>By: <a href='https://github.com/Dreamer-Paul'>Dreamer-Paul</a></p>";
        echo "<p class='buttons'><a href='https://paugram.com/essay/single-theme-and-single-dog.html'>项目介绍</a>
              <a href='https://github.com/Dreamer-Paul/Single/releases'>更新日志</a></p>";

        $update = file_get_contents("https://api.paugram.com/update/?name=".$name."&current=".$version."&site=".$_SERVER['HTTP_HOST']);
        $update = json_decode($update, true);

        if(isset($update['text'])){echo "<p>".$update['text']."</p>"; };
        if(isset($update['message'])){echo "<p>".$update['message']."</p>"; };

        echo "</div>";
    }
    paul_update($theme, $version);

    // 自定义站点图标
    $favicon = new Typecho_Widget_Helper_Form_Element_Text('favicon', NULL, NULL, _t('站点图标'), _t('在这里填入一张 png 图片地址（<a>192x192px</a>），不填则使用默认图标'));
    $form->addInput($favicon);

    // 自定义背景图
    $background = new Typecho_Widget_Helper_Form_Element_Text('background', NULL, NULL, _t('站点背景'), _t('在这里填入一张图片地址，不填则显示纯色背景'));
    $form->addInput($background);

    // 自定义社交链接
    $home_social = new Typecho_Widget_Helper_Form_Element_Textarea('home_social', NULL, NULL, _t('自定义社交链接'), _t('在这里填入你的自定义社交链接，不填则不输出。（格式请看<a href="https://github.com/Dreamer-Paul/Single/releases/tag/1.1" target="_blank">帮助信息</a>）'));
    $form->addInput($home_social);

    // 自定义样式表
    $custom_css = new Typecho_Widget_Helper_Form_Element_Textarea('custom_css', NULL, NULL, _t('自定义样式表'), _t('在这里填入你的自定义样式表，不填则不输出。'));
    $form->addInput($custom_css);

    // 自定义统计代码
    $custom_script = new Typecho_Widget_Helper_Form_Element_Textarea('custom_script', NULL, NULL, _t('统计代码'), _t('在这里填入你的统计代码，不填则不输出。需要 <a>&lt;script&gt;</a> 标签'));
    $form->addInput($custom_script);

    // 自定义作者信息
    $author_text = new Typecho_Widget_Helper_Form_Element_Textarea('author_text', NULL, NULL, _t('作者信息'), _t('显示在文章底部的作者信息，不填则不输出。'));
    $form->addInput($author_text);

    // 夜间模式
    $night_mode = new Typecho_Widget_Helper_Form_Element_Radio('night_mode',
        array(
            '0' => _t('关闭'),
            '1' => _t('开启'),
        ),
    '1', _t('是否根据时间开启夜间模式'), _t('在 22:00 - 5:00 期间自动开启夜间模式'));
    $form->addInput($night_mode);

    // 复制提示
    $copy_notice = new Typecho_Widget_Helper_Form_Element_Radio('copy_notice',
        array(
            '0' => _t('关闭'),
            '1' => _t('开启'),
        ),
    '1', _t('是否在复制内容的时候提示注意事项'), _t('开启则会在访客复制内容时弹窗'));
    $form->addInput($copy_notice);

    // 开启公共 CDN
    $cdn_set = new Typecho_Widget_Helper_Form_Element_Radio('cdn_set',
        array(
            '0' => _t('关闭'),
            '1' => _t('开启'),
        ),
    '0', _t('是否使用公共 CDN'), _t('使用 JSDelivr 的公共 CDN 服务，确保你的主题版本为最新'));
    $form->addInput($cdn_set);

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
}