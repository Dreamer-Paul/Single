<?php

if(!defined('__TYPECHO_ROOT_DIR__')) exit;

require_once("single.php");

// 设置时区functions

date_default_timezone_set('Asia/Shanghai');
/**
 * 秒转时间，格式 年 月 日 时 分 秒
 * 
 * @return html
 */
function getBuildTime(){
    // 在下面按格式输入本站创建的时间
    $site_create_time = strtotime('2019-11-22 00:00:00');
    $time = time() - $site_create_time;
    if(is_numeric($time)){
        $value = array(
            "years" => 0, "days" => 0, "hours" => 0,
            "minutes" => 0, "seconds" => 0,
        );
        if($time >= 31556926){
            $value["years"] = floor($time/31556926);
            $time = ($time%31556926);
        }
        if($time >= 86400){
            $value["days"] = floor($time/86400);
            $time = ($time%86400);
        }
        if($time >= 3600){
            $value["hours"] = floor($time/3600);
            $time = ($time%3600);
        }
        if($time >= 60){
            $value["minutes"] = floor($time/60);
            $time = ($time%60);
        }
        $value["seconds"] = floor($time);

        echo ''.$value['years'].'年'.$value['days'].'天'.$value['hours'].'小时'.$value['minutes'].'分'.$value['seconds'].'秒';
    }else{
        echo '';
    }
}



function themeConfig($form) {
    Single::update();

    // 自定义站点图标
    $favicon = new Typecho_Widget_Helper_Form_Element_Text('favicon', NULL, NULL, _t('站点图标'), _t('在这里填入一张 png 图片地址（<a>192x192px</a>），不填则使用默认图标'));
    $form -> addInput($favicon);

    // 自定义背景图
    $background = new Typecho_Widget_Helper_Form_Element_Text('background', NULL, NULL, _t('站点背景'), _t('在这里填入一张图片地址，不填则显示纯色背景'));
    $form -> addInput($background);

    // 自定义社交链接
    $home_social = new Typecho_Widget_Helper_Form_Element_Textarea('home_social', NULL, NULL, _t('自定义社交链接'), _t('在这里填入你的自定义社交链接，不填则不输出。（格式请看<a href="https://github.com/Dreamer-Paul/Single/releases/tag/1.1" target="_blank">帮助信息</a>）'));
    $form -> addInput($home_social);

    // 自定义样式表
    $custom_css = new Typecho_Widget_Helper_Form_Element_Textarea('custom_css', NULL, NULL, _t('自定义样式表'), _t('在这里填入你的自定义样式表，不填则不输出。'));
    $form -> addInput($custom_css);

    // 统计代码
    $custom_script = new Typecho_Widget_Helper_Form_Element_Textarea('custom_script', NULL, NULL, _t('统计代码'), _t('在这里填入你的统计代码，不填则不输出。需要 <a>&lt;script&gt;</a> 标签'));
    $form -> addInput($custom_script);

    // 自定义作者信息
    $author_text = new Typecho_Widget_Helper_Form_Element_Textarea('author_text', NULL, NULL, _t('作者信息'), _t('显示在文章底部的作者信息，不填则不输出。'));
    $form -> addInput($author_text);
$bei = new Typecho_Widget_Helper_Form_Element_Text('bei', NULL, NULL, _t('工信部备案号'), _t('一般为 苏ICP备9999999号,留空则不显示'));
$form->addInput($bei->addRule('xssCheck', _t('工信部备案号不能使用特殊字符')));
    // 夜间模式
    $night_mode = new Typecho_Widget_Helper_Form_Element_Radio('night_mode',
        array(
            '0' => _t('关闭'),
            '1' => _t('开启'),
            '2' => _t('始终')
        ),
    '1', _t('是否根据时间开启夜间模式'), _t('在 22:00 - 5:00 期间自动开启夜间模式，始终则为始终开启夜间模式'));
    $form -> addInput($night_mode);

    // 复制提示
    $copy_notice = new Typecho_Widget_Helper_Form_Element_Radio('copy_notice',
        array(
            '0' => _t('关闭'),
            '1' => _t('开启'),
        ),
    '1', _t('是否在复制内容的时候提示注意事项'), _t('开启则会在访客复制内容时弹窗'));
    $form -> addInput($copy_notice);

    // 信息栏
    $widget_set = new Typecho_Widget_Helper_Form_Element_Radio('widget_set',
        array(
          '0' => _t('关闭'),
          '1' => _t('开启'),
        ),
        '0', _t('是否显示信息栏'), _t('在页尾显示 “最新文章”、“最近评论” 和 “时光机”'));
    $form -> addInput($widget_set);

    // 首页、存档页属性显示
    $archive_meta = new Typecho_Widget_Helper_Form_Element_Checkbox('archive_meta',
        array(
            'show_category' => _t('文章分类'),
            'show_tags' => _t('文章标签'),
            'show_comments' => _t('评论数')
        ),
        array('show_category', 'show_comments'), _t('首页、存档页属性显示'));
    $form -> addInput($archive_meta -> multiMode());

    // 文章页属性显示
    $post_meta = new Typecho_Widget_Helper_Form_Element_Checkbox('post_meta',
        array(
            'show_category' => _t('文章分类'),
            'show_tags' => _t('文章标签'),
            'show_comments' => _t('评论数')
        ),
        array('show_category', 'show_comments'), _t('文章页属性显示'));
    $form -> addInput($post_meta -> multiMode());
}
