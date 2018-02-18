/* ----

# Kico Style 1.5.3
# By: Dreamer-Paul
# Last Update: 2017.2.5

一个简洁、有趣的开源响应式框架，仅包含基础样式，需按照一定规则进行二次开发。

欢迎你加入缤奇，和我们一起改变世界。
本代码为奇趣保罗原创，并遵守 MIT 开源协议。欢迎访问我的博客：https://paugram.com

---- */

var kico = {};

// 弹框
kico.notice_list = document.createElement("div");
kico.notice_list.classList.add("bk-notice-list");

function bk_notice(content, attr) {
    var notice_item = document.createElement("div");
    notice_item.className = "bk-notice";
    notice_item.innerHTML += "<span class='content'>" + content + "</span>";

    kico.notice_list.appendChild(notice_item);

    if(!document.querySelector("body > .bk-notice-list")){document.body.appendChild(kico.notice_list);}

    if(attr && attr.time){
        setTimeout(notice_remove, attr.time);
    }
    else{
        var close = document.createElement("span");
        close.className = "close";

        close.addEventListener("click", function () {
            notice_remove();
        });

        notice_item.classList.add("dismiss");
        notice_item.appendChild(close);
    }

    if(attr && attr.color){notice_item.classList.add(attr.color);}
    if(attr && attr.time && attr.overlay === true){bk_overlay({time: attr.time});}

    function notice_remove() {
        notice_item.classList.add("remove");

        setTimeout(function () {
            try{
                kico.notice_list.removeChild(notice_item);
                document.querySelector("body > .bk-notice-list").removeChild(notice_item);
            }
            catch(err) {}

            if(document.querySelector("body > .bk-notice-list") && kico.notice_list.childNodes.length === 0){
                document.body.removeChild(kico.notice_list);
            }
        }, 300);
    }
}

// 遮罩
kico.overlay = document.createElement("div");
kico.overlay.classList.add("bk-overlay");

function bk_overlay(attr){
    document.body.appendChild(kico.overlay);

    if(attr && attr.time){
        setTimeout(overlay_remove, attr.time);
    }
    else{
        kico.overlay.addEventListener("click", function () {
            overlay_remove();
        });
    }

    if(attr && attr.code){
        kico.overlay.addEventListener("click", function () {
            attr.code();
        });
    }

    function overlay_remove() {
        kico.overlay.classList.add("remove");

        setTimeout(function () {
            if(document.querySelector("body > .bk-overlay")){
                kico.overlay.classList.remove("remove");
                document.body.removeChild(kico.overlay);
            }
        }, 300);
    }
}

// 图片放大
kico.image_box = document.createElement("div");
kico.image_box.className = "bk-image";
kico.image_single = document.createElement("img");
kico.image_box.appendChild(kico.image_single);

function bk_image(selector) {
    var get_images = document.querySelectorAll(selector);

    function item(obj) {
        obj.setAttribute("bk-image", "active");
        obj.addEventListener("click", function () {
            kico.image_single.src = obj.src;
            if(!document.querySelector("body > .bk-image")){
                document.body.appendChild(kico.image_box);
            }
        });
    }

    for(var i = 0; i < get_images.length; i++){
        item(get_images[i]);
    }

    kico.image_box.addEventListener("click", function () {
        kico.image_box.classList.add("remove");
        setTimeout(function () {
            try{
                document.body.removeChild(kico.image_box);
                kico.image_box.classList.remove("remove");
            }
            catch (err){}
        }, 300);
    });
}

// 请保留版权说明
if (window.console && window.console.log) {
    console.log("\n %c Kico Style %c https://www.binkic.com \n\n","color: #fff; background: #3498db; padding: 5px 0;","background: #efefef; padding: 5px 0; text-decoration: none;");
}