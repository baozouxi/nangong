const WITHDRAW_URL = '/admin/withdraws/{withdraw}';


function withdraw(withdraw_id, obj)
{
    var url = WITHDRAW_URL.replace('{withdraw}', withdraw_id);

    $.post(url,null,function(data){
        if (data.status == 0) {
            alert('修改失败');
            return;
        }
        alert('修改成功');
        obj.remove();
    },'json');

}


$(function () {
    $('.update').click(function () {
        var withdraw_id = $(this).attr('data-id');

        withdraw(withdraw_id, $(this));
    });
});