/* ----

# Kico Style 2.0.2
# By: Dreamer-Paul
# Last Update: 2018.9.25

一个简洁、有趣的开源响应式框架，仅包含基础样式，需按照一定规则进行二次开发。

欢迎你加入缤奇，和我们一起改变世界。
本代码为奇趣保罗原创，并遵守 MIT 开源协议。欢迎访问我的博客：https://paugram.com

---- */

function Kico_Style () {
    var kico = {};
    var that = this;

    // 对象创建
    this.create = function (tag, prop) {
        var obj = document.createElement(tag);

        if(prop){
            if(prop.class) obj.className = prop.class;
            if(prop.text) obj.innerText = prop.text;
            if(prop.html) obj.innerHTML = prop.html;
        }

        return obj;
    };

    // 对象选择
    this.select = function (obj) {
        if(typeof obj === 'object'){
            return obj;
        }
        else if(typeof obj === 'string'){
            return document.querySelector(obj);
        }
    };

    this.selectAll = function (obj) {
        if(typeof obj === 'object'){
            return obj;
        }
        else if(typeof obj === 'string'){
            return document.querySelectorAll(obj);
        }
    };

    // 弹窗
    kico.notice_list = this.create("div", {class: "ks-notice-list"});

    this.notice = function (content, attr) {
        var item = that.create("div", {class: "ks-notice"});
        item.innerHTML += "<span class='content'>" + content + "</span>";

        kico.notice_list.appendChild(item);

        if(!document.querySelector("body > .ks-notice-list")) document.body.appendChild(kico.notice_list);

        if(attr && attr.time){
            setTimeout(notice_remove, attr.time);
        }
        else{
            var close = this.create("span", {class: "close"});

            close.addEventListener("click", function () {
                notice_remove();
            });

            item.classList.add("dismiss");
            item.appendChild(close);
        }

        if(attr && attr.color){item.classList.add(attr.color);}

        function notice_remove() {
            item.classList.add("remove");

            setTimeout(function () {
                try{
                    kico.notice_list.removeChild(item);
                    item = null;
                }
                catch(err) {}

                if(document.querySelector("body > .ks-notice-list") && kico.notice_list.childNodes.length === 0){
                    document.body.removeChild(kico.notice_list);
                }
            }, 300);
        }
    };

    // 遮罩
    kico.overlay = this.create("div", {class: "ks-overlay"});

    this.overlay = function (attr) {
        document.body.appendChild(kico.overlay);

        if(attr && attr.time){
            setTimeout(overlay_remove, attr.time);
        }
        else{
            kico.overlay.onclick = function (){ overlay_remove() };
        }

        if(attr && attr.code){
            kico.overlay.onclick = function (){ overlay_remove(); attr.code() }
        }

        function overlay_remove() {
            kico.overlay.onclick = null;
            kico.overlay.classList.add("remove");

            setTimeout(function () {
                if(document.querySelector("body > .ks-overlay")){
                    kico.overlay.classList.remove("remove");
                    document.body.removeChild(kico.overlay);
                }
            }, 300);
        }
    };

    // 图片缩放
    kico.image_box = this.create("div", {class: "ks-image"});
    kico.image_single = this.create("img");
    kico.image_box.appendChild(kico.image_single);

    this.image = function (selector) {
        var get_images = that.selectAll(selector);

        function item(obj) {
            obj.setAttribute("ks-image", "active");
            obj.onclick = function () {
                if(obj.getAttribute("ks-original") !== null){
                    kico.image_single.src = obj.getAttribute("ks-original");
                }
                else if(obj.src){
                    kico.image_single.src = obj.src;
                }

                if (!document.querySelector("body > .ks-image")) {
                    document.body.appendChild(kico.image_box);
                }
            };
        }

        for(var i = 0; i < get_images.length; i++){
            if(get_images[i].src || get_images[i].getAttribute("ks-original")){
                item(get_images[i]);
            }
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

    this.ajax = function (prop) {
        if(!prop.url){
            prop.url = document.location.origin + document.location.pathname;
        }

        function test_crossDomain() {
            var a = document.createElement("a");
            a.href = window.location.hostname;
            return a.hostname === prop.url ? true : false;
        }

        if(prop.method === "POST"){
            var data = new FormData();

            for(var pk in prop.data){
                data.append(pk, prop.data[pk]);
            }
        }
        else if(prop.method === "GET"){
            var url = prop.url + "?";

            for(var k in prop.data){
                url += k + "=" + prop.data[k] + "&";
            }

            prop.url = url.substr(0, url.length - 1);
        }

        var request = new XMLHttpRequest();
        request.open(prop.method, prop.url);
        if(prop.crossDomain){ request.setRequestHeader("X-Requested-With", "XMLHttpRequest"); }

        if(prop.header){
            for(var i in prop.header){
                request.setRequestHeader(prop.header[i][0], prop.header[i][1]);
            }
        }

        request.send(data);

        request.onreadystatechange = function () {
            if(request.readyState === 4){
                if(request.status === 200 || request.status === 304){
                    prop.success ? prop.success(request) : console.log(prop.method + " 请求发送成功");
                }
                else{
                    prop.failed ? prop.failed(request) : console.log(prop.method + " 请求发送失败");
                }
            }
        };
    };

    // Show Version
    console.log("%c Kico Style %c https://paugram.com ","color: #fff; margin: 1em 0; padding: 5px 0; background: #3498db;","margin: 1em 0; padding: 5px 0; background: #efefef;");
}

var ks = new Kico_Style();