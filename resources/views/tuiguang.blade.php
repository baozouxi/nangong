<html lang="zh-cn">

<head>
    <meta charset="utf-8" />
    <meta HTTP-EQUIV="pragma" CONTENT="no-cache">
    <meta HTTP-EQUIV="Cache-Control" CONTENT="no-cache, must-revalidate">
    <meta HTTP-EQUIV="expires" CONTENT="0">
    <meta name="apple-touch-fullscreen" content="yes" />
    <meta name="format-detection" content="telephone=no" />
    <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0 user-scalable=no" media="screen" />
    <script type="text/javascript" src="/public/js/jquery.js"></script>
    <script src="/public/js/clipboard.min.js"></script>
    <script src="/public/js/layer.js"></script>
    <title></title>
</head>
<style>
    * {
        margin: 0;
        padding: 0;
    }

    .copydata {
        position: absolute;
        left: 5%;
        width: 90%;
    }

    .background img {
        width: 100%;
        height: auto;
    }

    {
        -webkit-user-select: text;
    }

    #alertwin {
        position: fixed;
        z-index: 999;
        width: 80%;
        left: 10%;
        top: 32%;
        background: white;
        border-radius: 5px;
        padding-bottom: .8rem;
    }

    #alertwin h3 {
        height: 3rem;
        line-height: 3rem;
        text-align: center;
        background: #6959CD;
        color: white;
        border-radius: 5px 5px 0 0;
    }

    #alertwin .content {
        margin: 2rem auto 1rem auto;
        padding: .5rem 1rem;
        width: 60%;
        border: 2px dashed #eee;
        text-align: center;
        font-size: 1.2rem;
    }

    #alertwin p {
        text-align: center;
        font-size: .8rem;
        color: #999;
    }

    #alertwinbg {
        position: fixed;
        z-index: 998;
        width: 100%;
        top: 0;
        left: 0;
        height: 100%;
        background: #000;
        filter: alpha(opacity=50);
        -moz-opacity: 0.5;
        -khtml-opacity: 0.5;
        opacity: 0.5;
    }
</style>

<body></body>

</html>
<script>
    var data = { "n": ["NG\u5ba2\u670d", "NG2.0\u7fa4\u53f7", "NG2.8\u7fa4\u53f7", "NG\u6295\u6ce8\u4ee3\u7406\u7f51"], "v": ["7006201", "200600724", "200600498", "www.ng077.com"] },
        _w = $(window).width();
    if (data.n) {
        var name = data.n,
            value = data.v,
            str = '<div class="background"><img src="/public/images/background.png?1514099490"></div>',
            y = 0,
            add = 115,
            s = 100 / 412,
            _x = 250 / 412,
            _add = 115 / 412;
        for (var i = 0; i < value.length; i++) {
            str += "<div class=\"copydata\" id=\"copydata" + i + "\" style=\"height:" + (s * _w) + "px;top:" + (_x * _w + i * _add * _w) + "\"></div>";
        }
    }
    $('body').append(str);

    function copycover(index) {
        if ($('#alertwin').length > 0)
            $('#alertwin,#alertwinbg').remove();
        $('body').append('<div id="alertwin"><h3>复制' + data['n'][index] + '</h3><div class="content">' + data['v'][index] + '</div><p>* 长按复制区域 -> 全选 ->复制</p></div><div id="alertwinbg"></div>');
        $('#alertwin').unbind('click').click(function(event) {
            event.stopPropagation();
        });
        $('#alertwinbg').unbind('click').click(function() {
            $('#alertwin,#alertwinbg').remove();
        });
    }
    $(function() {
        var clipboard = [];
        var u = navigator.userAgent;
        var isiOS = !!u.match(/\(i[^;]+;( U;)? CPU.+Mac OS X/);
        if (isiOS) {
            $('.copydata').each(function(i) {
                $('.copydata').eq(i).click(function(event) {
                    event.stopPropagation();
                    copycover(i);
                })
            });

        } else {
            $('.copydata').each(function(index) {
                clipboard[index] = new Clipboard('#copydata' + index, {
                    text: function() {
                        return value[index];
                    }
                });
                clipboard[index].on('success', function(e) {
                    layer.open({ content: "复制成功", skin: "msg", time: 2 });
                });
                clipboard[index].on('error', function(e) {
                    layer.open({ content: "请常按复制区域复制", skin: "msg", time: 2 });
                });
            });
        }
    });
</script>