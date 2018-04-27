/* ----

# Single Theme
# By: Dreamer-Paul
# Last Update: 2018.4.27

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
    var bar = document.getElementsByClassName("head-search")[0];

    btn.addEventListener("click", function () {
        bar.classList.toggle("active");
    })
}
search_btn();

// 关灯切换
function single_night() {
    var neon_btn = document.getElementsByClassName("light-btn")[0];

    if (localStorage.style === "neon") {
        body.classList.add("neon");
    }

    neon_btn.addEventListener("click", function () {
        if(body.classList.contains("neon")){
            body.classList.remove("neon");
            localStorage.style = null;
        }
        else{
            body.classList.add("neon");
            localStorage.style = "neon";
        }
    });
}
single_night();

// 目录树
function single_tree() {
    var wrap = document.getElementsByClassName("wrap")[0];
    var content = document.getElementsByClassName("post-content")[0] || document.getElementsByClassName("page-content")[0];

    if(content){
        var headings = content.querySelectorAll("h1, h2, h3, h4, h5, h6");

        if(headings.length > 0){
            body.classList.add("has-trees");

            var trees = document.createElement("aside");
                trees.className = "article-list";
                trees.innerHTML += "<h3>文章目录：</h3>";

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

            function toggle_tree() {
                var buttons = document.getElementsByTagName("footer")[0].getElementsByClassName("buttons")[0];
                var btn = document.createElement("a");
                btn.className = "toggle-list";
                buttons.appendChild(btn);

                btn.addEventListener("click", function () {
                    trees.classList.toggle("active");
                })
            }
            toggle_tree();
        }
    }
}
single_tree();

// 自动添加外链
function single_links() {
    var content = document.getElementsByClassName("post-content")[0] || document.getElementsByClassName("page-content")[0];
    var comment = document.getElementsByClassName("comment-list")[0];

    function add(selector) {
        if(selector){
            var links = selector.getElementsByTagName("a");

            for(var i = 0; i < links.length; i++){
                links[i].target = "_blank";
            }
        }
    }

    add(content);
    add(comment);
}
single_links();

// 返回页首
function to_top() {
    var btn = document.getElementsByClassName("to-top")[0];
    var scroll = window.pageYOffset || document.documentElement.scrollTop || document.body.scrollTop;

    scroll >= window.innerHeight / 2 ? btn.classList.add("active") : btn.classList.remove("active");
}

window.addEventListener("scroll", function () {
    to_top();
});

// 图片缩放
ks.image(".post-content img, .page-content img");

// 请保留版权说明
if (window.console && window.console.log) {
    console.log("%c Single %c https://paugram.com ","color: #fff; margin: 1em 0; padding: 5px 0; background: #ffa628;","margin: 1em 0; padding: 5px 0; background: #efefef;");
}