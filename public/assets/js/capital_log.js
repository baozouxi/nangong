const ORDER_CANCEL_URL = '/admin/capital-logs/{capitalLog}';


function orderCancel(order_id, obj) {
    var url = ORDER_CANCEL_URL.replace('{capitalLog}', order_id);

    var data = {_method: 'DELETE'};

    $.post(url, data, function (data) {
        if (data.status == 0) {
            alert('取消失败');
            return;
        }

        alert('取消成功');
        obj.remove();
    }, 'json');

}


$(function () {
    $('.order-cancel').click(function () {
        var order_id = $(this).attr('data-id');
        orderCancel(order_id, $(this).parents('tr'));
    });

});
