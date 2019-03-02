/* ----

# Kico Style 2.2
# By: Dreamer-Paul
# Last Update: 2019.2.17

一个简洁、有趣的开源响应式框架，仅包含基础样式，需按照一定规则进行二次开发。

欢迎你加入缤奇，和我们一起改变世界。
本代码为奇趣保罗原创，并遵守 MIT 开源协议。欢迎访问我的博客：https://paugram.com

---- */

Array.prototype.remove = function (value) {
    var index = this.indexOf(value);
    if(index > -1) this.splice(index, 1);
};

function Kico_Style () {
    var kico = {};
    var that = this;

    // 批量执行
    this.forEach = function (data, fn) {
        for(var i = 0; i < data.length; i++){
            fn(data[i], i, data);
        }
    };

    // 对象创建
    this.create = function (tag, prop) {
        var obj = document.createElement(tag);

        if(prop){
            if(prop.id)    obj.id = prop.id;
            if(prop.href)  obj.href = prop.href;
            if(prop.class) obj.className = prop.class;
            if(prop.text)  obj.innerText = prop.text;
            if(prop.html)  obj.innerHTML = prop.html;

            if(prop.child){
                if(prop.child.constructor === Array){
                    that.forEach(prop.child, function (i) {
                        obj.appendChild(i);
                    });
                }
                else{
                    obj.appendChild(prop.child);
                }
            }
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
    kico.image_box = [];
    kico.image_box.img = this.create("img");
    kico.image_box.prev = this.create("div", {class: "ks-prev"});
    kico.image_box.next = this.create("div", {class: "ks-next"});
    kico.image_box.ball = this.create("div", {class: "ks-ball"});

    kico.image_box.wrap = this.create("div", {class: "ks-image", child: [
        kico.image_box.img, kico.image_box.prev, kico.image_box.next, kico.image_box.ball
    ]});

    this.image = function (selector) {
        var current = 0;
        var get_images = this.selectAll(selector);

        // 设置图片
        function set_image(img) {
            if(img.getAttribute("ks-original") !== null){
                kico.image_box.img.src = img.getAttribute("ks-original");
            }
            else if(img.src){
                kico.image_box.img.src = img.src;
            }

            kico.image_box.wrap.classList.add("loading");
        }

        // 设置按钮
        function set_buttons(c) {
            function l(){
                if(current - 1 >= 0) current--;

                set_image(get_images[current]);
            }

            function r(){
                if(current + 1 < get_images.length) current++;

                set_image(get_images[current]);
            }

            kico.image_box.prev.onclick = l;
            kico.image_box.next.onclick = r;
        }

        // 循环内单条设定
        function set_item(obj, num) {
            var scale = 1;
            var locationX, locationY;

            obj.setAttribute("ks-image", "active");

            function single_click(){
                current = num;
                set_image(obj);
                set_buttons(num);

                if(!document.body.contains(kico.image_box.wrap)) {
                    document.body.appendChild(kico.image_box.wrap);
                }
            }

            obj.onclick = single_click;
        }

        this.forEach(get_images, function (i, j) {
            if(i.src || i.getAttribute("ks-original")){
                set_item(i, j);
            }
        });

        kico.image_box.img.onclick = function () {
            kico.image_box.wrap.classList.add("remove");
            setTimeout(function () {
                try{
                    document.body.removeChild(kico.image_box.wrap);
                    kico.image_box.wrap.classList.remove("remove");
                }
                catch (err){}
            }, 300);
        };

        kico.image_box.img.onload = function () {
            kico.image_box.wrap.classList.remove("loading");
        }
    };

    // 图片懒加载
    this.lazy = function (el, bg) {
        var list = [];
        el = ks.selectAll(el);

        ks.forEach(el, function (item) {
            var original = item.getAttribute("ks-original");

            if(original) list.push({el: item, link: original, showed: false});
        });

        function back() {
            ks.forEach(list, function (item) {
                var img = new Image();
                var check = item.el.getBoundingClientRect().top <= window.innerHeight;

                if(check && !item.showed){
                    img.src = item.link;

                    img.onload = function () {
                        list.remove(item);
                        item.el.style.backgroundImage = "url(" + item.link + ")";
                    };
                }
            });
        }

        function front() {
            ks.forEach(list, function (item) {
                var check = item.el.getBoundingClientRect().top <= window.innerHeight;

                if(check && !item.showed){
                    item.el.src = item.link;
                    list.remove(item);
                }
            });
        }

        bg ? back() : front();
        bg ? document.addEventListener("scroll", back) : document.addEventListener("scroll", front);
    };

    // AJAX 组件
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

    // 返回页头
    this.scrollTop = function () {
        function to_top(){
            if(window.scrollY !== 0){
                window.scrollTo(0, window.scrollY * 0.9);
                requestAnimationFrame(to_top);
            }
            else{
                cancelAnimationFrame(this);
            }
        }

        window.requestAnimationFrame(to_top);
    };

    // Show Version
    console.log("%c Kico Style %c https://paugram.com ","color: #fff; margin: 1em 0; padding: 5px 0; background: #3498db;","margin: 1em 0; padding: 5px 0; background: #efefef;");
}

var ks = new Kico_Style();