/* ----

# Single Theme
# By: Dreamer-Paul
# Last Update: 2018.1.25

一个简洁大气，含夜间模式的 Typecho 博客模板。

欢迎你加入缤奇，和我们一起改变世界。
本代码为奇趣保罗原创，并遵守 MIT 开源协议。欢迎访问我的博客：https://paugram.com

---- */

var body = document.body;

// 菜单按钮
function head_menu() {
    var btn = document.getElementsByClassName("toggle-btn")[0];
    var menu = document.getElementsByClassName("head-menu")[0];
    btn.addEventListener("click", function () {
        menu.classList.toggle("active");
    })
}
head_menu();

// 搜索按钮
function search_btn() {
    var btn = document.getElementsByClassName("search-btn")[0];
    var bar = document.getElementsByClassName("search-form")[0];
    btn.addEventListener("click", function () {
        bar.classList.toggle("active");
    })
}
search_btn();

// 关灯切换
function style_select() {
    var neon_btn = document.getElementsByClassName("light-btn")[0];

    function style_load() {
        if(localStorage.style === "neon"){
            body.classList.add("neon");
        }
    }
    style_load();

    neon_btn.addEventListener("click", function () {
        switch (body.classList.contains("neon")){
            case true: body.classList.remove("neon"); style_save(null); break;
            case false: body.classList.add("neon"); style_save("neon"); break;
        }
        function style_save(style) {
            localStorage.style = style;
        }
    });
}
style_select();

(function () {
    var wrap = document.getElementsByClassName("wrap")[0];
    var content = document.getElementsByClassName("post-content")[0] || document.getElementsByClassName("page-content")[0];
    if(content){
        var headings = content.querySelectorAll("h1, h2, h3, h4, h5, h6");

        if(headings.length > 0){
            body.classList.add("has-trees");

            var trees = document.createElement("aside");
            trees.className = "article-list";

            var title = document.createElement("h3");
            title.innerHTML = "文章目录：";

            trees.appendChild(title);

            for(var i = 0; i < headings.length; i++){
                headings[i].id = headings[i].innerText;
                var item = document.createElement("a");
                item.innerText = headings[i].innerText;
                item.href = "#" + headings[i].innerText;

                switch (headings[i].tagName){
                    case "H2": item.className = "item-2"; break;
                    case "H3": item.className = "item-3"; break;
                    case "H4": item.className = "item-4"; break;
                    case "H5": item.className = "item-5"; break;
                    case "H6": item.className = "item-6"; break;
                }
                trees.appendChild(item);
            }
            wrap.appendChild(trees);
        }
    }
})();

// 自动添加外链
(function () {
    var content = document.getElementsByClassName("post-content")[0] || document.getElementsByClassName("page-content")[0];
    if(content){
        var links = content.getElementsByTagName("a");

        if(links[0]){
            for(var i = 0; i < links.length; i++){
                links[i].target = "_blank";
            }
        }
    }
})();

// 返回页首
function turn_up() {
    var btn = document.getElementsByClassName("turn-up")[0];
    var scroll = window.pageYOffset || document.documentElement.scrollTop || document.body.scrollTop;

    if(scroll >= window.innerHeight / 2) {
        btn.classList.add("active");
    }
    else {
        btn.classList.remove("active");
    }
}

window.onscroll = function () {
    turn_up();
};

// 图片缩放
bk_image(".post-content img, .page-content img");

if (window.console && window.console.log) {
    console.log("\n %c Single %c https://paugram.com \n\n","color: #fff; background: #ffa628; padding:5px 0;","background: #efefef; padding:5px 0;");
}