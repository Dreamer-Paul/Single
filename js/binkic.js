/* ----

# Kico Style 1.5
# By: Dreamer-Paul
# Last Update: 2017.8.25

一个简洁、有趣的开源响应式框架，仅包含基础样式，需按照一定规则进行二次开发。

欢迎你加入缤奇，和我们一起改变世界。
本代码为缤奇保罗原创，并遵守 MIT 开源协议。保罗的个人博客：https://hi-paul.space

---- */

var body = document.body;

// 弹框
function bk_notice(content, attr) {
    var check_list = document.getElementsByClassName("bk-notice-list")[0];


    if(check_list == undefined){
        var notice_list = document.createElement("div");
        notice_list.classList.add("bk-notice-list");
    }

    var notice_item = document.createElement("div");
    notice_item.classList.add("bk-notice");

    var inner = document.createElement("p");
    inner.classList.add("content");
    inner.innerHTML = content;

    notice_item.appendChild(inner);

    if(check_list){
        check_list.appendChild(notice_item);
        body.appendChild(check_list);
    }
    else{
        notice_list.appendChild(notice_item);
        body.appendChild(notice_list);
    }

    if(attr && attr.overlay == true){
        overlay(attr.dtime);
    }
    if(attr && attr.dtime != null){
        setTimeout(notice_remove, attr.dtime);
    }

    // 颜色
    if(attr && attr.color){
        notice_item.classList.add(attr.color);
    }

    // 移除
    function notice_remove() {
        notice_item.classList.add("remove");
        setTimeout(function () {
            if(check_list){
                check_list.removeChild(notice_item);
            }
            else{
                notice_list.removeChild(notice_item);
            }
        }, 300);
    }
}

// 遮罩
function overlay(count_down){
    var overlay = document.createElement("div");
    overlay.classList.add("overlay");
    body.appendChild(overlay);

    if(count_down != null){
        setTimeout(overlay_remove, count_down);
    }

    function overlay_remove() {
        overlay.classList.add("remove");
        setTimeout(function () {
            body.removeChild(overlay);
        }, 300);
    }
}

// 图片放大
function bk_imgs(selector) {
    var img_list = document.querySelectorAll(selector);
    var img_box = document.createElement("div");
    img_box.className = "bk-imgs";

    var image = document.createElement("img");

    if(selector){
        //var img_list = document.body.getElementsByTagName("img");
        console.log(img_list);
        img_list.forEach(function (t) {
            t.setAttribute("bk-imgs", "active");
            t.addEventListener("click", function () {
                image.src = t.src;
                img_box.appendChild(image);
                body.appendChild(img_box);
            });
        });

        img_box.addEventListener("click", function () {
            img_box.classList.add("remove");
            setTimeout(function () {
                body.removeChild(img_box);
                img_box.classList.remove("remove");
            }, 300);
        });
    }

    function remove() {
        img_box.classList.add("remove");
        setTimeout(function () {
            body.removeChild(img_box);
        }, 300);
    }
}

if (window.console && window.console.log) {
    console.log("\n %c Kico Style %c https://www.binkic.com \n\n","color: #fff; background: #3498db; padding: 5px 0;","background: #efefef; padding: 5px 0;");
}