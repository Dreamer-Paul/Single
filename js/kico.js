/* ----

# Kico Style 1.5.4
# By: Dreamer-Paul
# Last Update: 2018.4.27

一个简洁、有趣的开源响应式框架，仅包含基础样式，需按照一定规则进行二次开发。

欢迎你加入缤奇，和我们一起改变世界。
本代码为奇趣保罗原创，并遵守 MIT 开源协议。欢迎访问我的博客：https://paugram.com

---- */

function kico_style () {
    var kico = {};
    var that = this;

    // 新建对象
    this.create = function (tag, cls, prop) {
        var obj = document.createElement(tag);
        if(cls) obj.className = cls;
        if(prop){
            if(prop.text){
                obj.innerText = prop.text;
            }
            else if(prop && prop.html){
                obj.innerText = prop.html;
            }
        }

        return obj;
    };

    // 选择对象
    this.select = function (obj) {
        if(typeof obj === 'object'){
            return obj;
        }
        else if(typeof obj === 'string'){
            return document.querySelectorAll(obj);
        }
    };

    // 弹窗
    kico.notice_list = this.create("div", "bk-notice-list");

    this.notice = function (content, attr) {
        var item = that.create("div", "bk-notice");
        item.innerHTML += "<span class='content'>" + content + "</span>";

        kico.notice_list.appendChild(item);

        if(!document.querySelector("body > .bk-notice-list")) document.body.appendChild(kico.notice_list);

        if(attr && attr.time){
            setTimeout(notice_remove, attr.time);
        }
        else{
            var close = document.createElement("span");
            close.className = "close";

            close.addEventListener("click", function () {
                notice_remove();
            });

            item.classList.add("dismiss");
            item.appendChild(close);
        }

        if(attr && attr.color){item.classList.add(attr.color);}
        if(attr && attr.time && attr.overlay === true){bk_overlay({time: attr.time});}

        function notice_remove() {
            item.classList.add("remove");

            setTimeout(function () {
                try{
                    kico.notice_list.removeChild(item);
                }
                catch(err) {}

                if(document.querySelector("body > .bk-notice-list") && kico.notice_list.childNodes.length === 0){
                    document.body.removeChild(kico.notice_list);
                }
            }, 300);
        }
    };

    // 遮罩
    kico.overlay = this.create("div", "bk-overlay");

    this.overlay = function (attr) {
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
    };

    // 图片缩放
    kico.image_box = this.create("div", "bk-image");
    kico.image_single = this.create("img");
    kico.image_box.appendChild(kico.image_single);

    this.image = function bk_image(selector) {
        var get_images = that.select(selector);

        function item(obj) {
            obj.setAttribute("bk-image", "active");
            obj.onclick = function () {
                kico.image_single.src = obj.src;
                if (!document.querySelector("body > .bk-image")) {
                    document.body.appendChild(kico.image_box);
                }
            };
        }

        for(var i = 0; i < get_images.length; i++){
            item(get_images[i]);
        }

        kico.image_box.onclick = function () {
            kico.image_box.classList.add("remove");
            setTimeout(function () {
                try{
                    document.body.removeChild(kico.image_box);
                    kico.image_box.classList.remove("remove");
                }
                catch (err){}
            }, 300);
        };
    };

    // Show Version
    console.log("%c Kico Style %c https://www.binkic.com ","color: #fff; margin: 1em 0; padding: 5px 0; background: #3498db;","margin: 1em 0; padding: 5px 0; background: #efefef;");
};

var ks = new kico_style();
var $$ = ks.select;