/* ----

# Kico Style 1.0.1
# By: Dreamer-Paul
# Last Update: 2017.7.23

一个简洁、有趣的开源响应式框架，仅包含基础样式，需按照一定规则进行二次开发。

欢迎你加入缤奇，和我们一起改变世界。
本代码为缤奇保罗原创，并遵守 MIT 开源协议。保罗的个人博客：https://hi-paul.space

---- */

// 弹框
function alert_box(content, count_down, overlay_stat, color){
    var body = document.body;
    var alert_box = document.createElement("div");
    var inner = document.createElement("p");
    alert_box.classList.add("bk-alert");
    inner.classList.add("content");
    inner.innerHTML = content;
    alert_box.appendChild(inner);
    body.appendChild(alert_box);

    if(overlay_stat != false){
        overlay(count_down);
    }
    if(count_down != null){
        setTimeout(alert_remove, count_down);
    }

    // 颜色判断
    switch(color){
        case "red":    alert_color("red"); break;
        case "yellow": alert_color("yellow"); break;
        case "blue":   alert_color("blue"); break;
        case "green":  alert_color("green"); break;
    }

    function alert_color(color) {
        alert_box.classList.add(color);
    }

    // 移除
    function alert_remove() {
        alert_box.classList.add("remove");
        setTimeout(function () {
            body.removeChild(alert_box);
        }, 300);
    }
}

// 遮罩
function overlay(count_down){
    var body = document.body;
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

// 开关按钮
function sw_btn(){
    var sw_btns = document.getElementsByClassName("sw-btn");
    var sw_btns_length = sw_btns.length;
    if(sw_btns[0]){
        for (var i = 0; i < sw_btns_length; i++) {
            sw_btns[i].addEventListener("click", function () {
                if(sw_btns[i].className == "sw-btn"){
                    sw_btns[i].classList.add("active");
                }
                else{
                    sw_btns[i].classList.remove("active");
                }
            });
        }
    }
}
sw_btn();

if (window.console && window.console.log) {
    console.log("\n %c Kico Style %c https://www.binkic.com \n\n","color: #fff; background: #3498db; padding: 5px 0;","background: #efefef; padding: 5px 0;");
}