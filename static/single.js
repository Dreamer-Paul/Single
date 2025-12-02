/* ----

# Single Theme
# By: Dreamer-Paul
# Last Update: 2025.11.25

一个简洁大气，含夜间模式的 Typecho 博客模板。

本代码为奇趣保罗原创，并遵守 MIT 开源协议。欢迎访问我的博客：https://paugram.com

---- */

var Paul_Single = function (config) {
    var body = document.body;
    var content = ks.select(".post-content:not(.is-special), .page-content:not(.is-special)");

    // 菜单按钮
    this.header = function () {
        var menu = document.getElementsByClassName("head-menu")[0];

        ks.select(".toggle-btn").onclick = function () {
            menu.classList.toggle("active");
        };

        ks.select(".light-btn").onclick = this.night;

        var search = document.getElementsByClassName("search-btn")[0];
        var bar = document.getElementsByClassName("head-search")[0];

        search.addEventListener("click", function () {
            bar.classList.toggle("active");
        })
    };

    // 关灯切换
    this.night = function () {
        if (body.classList.contains("dark-theme")) {
            body.classList.remove("dark-theme");
            document.cookie = "night=false;" + "path=/;" + "max-age=21600";
        }
        else {
            body.classList.add("dark-theme");
            document.cookie = "night=true;" + "path=/;" + "max-age=21600";
        }
    };

    // 目录树
    this.tree = function () {
        const wrap = ks.select(".wrap");
        const headings = content.querySelectorAll("h1, h2, h3, h4, h5, h6");

        if (headings.length === 0) {
            return;
        }

        body.classList.add("has-trees");

        // 计算数量，得出最高层级
        const levelCount = { h1: 0, h2: 0, h3: 0, h4: 0, h5: 0, h6: 0 };

        headings.forEach((el) => {
            const tagName = el.tagName.toLowerCase();
            levelCount[tagName]++;
        });

        let firstLevel = 1;
        if (levelCount.h1 === 0 && levelCount.h2 > 0) {
            firstLevel = 2;
        }
        else if (levelCount.h1 === 0 && levelCount.h2 === 0 && levelCount.h3 > 0) {
            firstLevel = 3;
        }

        // 目录树节点
        const trees = ks.create("section", {
            class: "article-list",
            html: `<h4><span class="title">目录</span></h4>`
        });

        ks.each(headings, (t, index) => {
            const text = t.innerText;

            t.id = "title-" + index;

            const level = Number(t.tagName.substring(1)) - firstLevel + 1;
            const className = `item-${level}`;

            trees.appendChild(ks.create("a", { class: className, text, href: `#title-${index}` }));
        });

        wrap.appendChild(trees);

        // 绑定元素
        const buttons = ks.select("footer .buttons");
        const btn = ks.create("button", {
            class: "toggle-list",
            attr: [
                { name: "title", value: "切换文章目录" },
            ],
        });
        buttons.appendChild(btn);

        btn.addEventListener("click", () => {
            trees.classList.toggle("active");
        });
    };

    // 自动添加外链
    this.links = function () {
        var linksEl = content.getElementsByTagName("a");

        if (linksEl) {
            ks.each(linksEl, function (t) {
                if (t.host !== location.host) {
                    t.target = "_blank";
                }
            });
        }
    };

    this.comment_list = function () {
        ks(".comment-content [href^='#comment']").each(function (t) {
            var item = ks.select(t.getAttribute("href"));

            t.onmouseover = function () {
                item.classList.add("active");
            };

            t.onmouseout = function () {
                item.classList.remove("active");
            };
        });
    };

    // 返回页首
    this.to_top = function () {
        var btn = document.getElementsByClassName("to-top")[0];
        var scroll = document.documentElement.scrollTop || document.body.scrollTop;

        scroll >= window.innerHeight / 2 ? btn.classList.add("active") : btn.classList.remove("active");

        btn.onclick = () => {
            window.scrollTo({ top: 0 }, { behavior: "smooth" });
        }
    };

    this.header();

    if (content) {
        this.tree();
        this.links();
        this.comment_list();
    }

    // 返回页首
    window.addEventListener("scroll", this.to_top);

    // 如果开启自动夜间模式
    if (config.night) {
        var hour = new Date().getHours();

        if (!document.cookie.includes("night") && (hour <= 5 || hour >= 22)) {
            document.body.classList.add("dark-theme");
            document.cookie = "night=true;" + "path=/;" + "max-age=21600";
        }
    }
    else if (document.cookie.includes("night")) {
        if (document.cookie.includes("night=true")) {
            document.body.classList.add("dark-theme");
        }
        else {
            document.body.classList.remove("dark-theme");
        }
    }

    // 如果开启复制内容提示
    if (config.copyright) {
        document.oncopy = function () {
            ks.notice("复制内容请注明来源并保留版权信息！", { color: "yellow", overlay: true });
        };
    }
};

// 图片缩放
ks.image(".post-content:not(.is-special) img, .page-content:not(.is-special) img");

// 请保留版权说明
if (window.console && window.console.log) {
    console.log("%c Single %c https://paugram.com ", "color: #fff; margin: 1em 0; padding: 5px 0; background: #ffa628;", "margin: 1em 0; padding: 5px 0; background: #efefef;");
}
