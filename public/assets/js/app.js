$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    var $fullText = $('.admin-fullText');
    $('#admin-fullscreen').on('click', function () {
        $.AMUI.fullscreen.toggle();
    });

    $(document).on($.AMUI.fullscreen.raw.fullscreenchange, function () {
        $fullText.text($.AMUI.fullscreen.isFullscreen ? '退出全屏' : '开启全屏');
    });


    $('.tpl-left-nav-link-list').on('click', function () {
        $(this).siblings('.tpl-left-nav-sub-menu').slideToggle(80)
            .end()
            .find('.tpl-left-nav-more-ico').toggleClass('tpl-left-nav-more-ico-rotate');
    })
    // ==========================
    // 头部导航隐藏菜单
    // ==========================

    $('.tpl-header-nav-hover-ico').on('click', function () {
        $('.tpl-left-nav').toggle();
        $('.tpl-content-wrapper').toggleClass('tpl-content-wrapper-hover');
    })


    $('.changePass').click(function () {

        $('#changePass').modal({
            relatedTarget: this,
            onConfirm: function (e) {
                var data ={};
                data.oldpass = e.data[0];
                data.password = e.data[1];
                data.password_confirmation = e.data[2];
                data._method = 'PUT';


                $.post('/admin/password', data, function(data){

                    if (data.status == 'ok') {
                        alert('修改成功');
                        window.location.href = '/admin/logout';
                    }

                    alert(data.info);

                },'json');

            },
        });

    });


});


function _delete(url, obj) {

    $.post(url, {_method: 'DELETE'}, function (data) {

        if (data.status == 'ok') {
            alert('删除成功');
            obj.remove();
        }
    }, 'json');
}