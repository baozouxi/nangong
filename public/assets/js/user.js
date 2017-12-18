const RECHARGE_URL = '/admin/users/{user}/capital';

const USER_UPDATE_URL = '/admin/users/{user}';

/**
 * 充值函数
 * @param user_id
 * @param money
 */
function recharge(user_id, money, obj)
{

    var url = RECHARGE_URL.replace('{user}', user_id);
    var data = {money:money, _method:'PATCH'};
    $.post(url, data, function(data){

        if (data.status == 0) {
            alert('冲值失败');
            return;
        }

        alert('充值成功');
        obj.text(data.money);
    }, 'json').fail(function(xhr){
        alert(xhr.status);
    });
}


//冻结
function frozen (user_id, obj) {

    var url = USER_UPDATE_URL.replace('{user}', user_id);

    var data = {_method:'PATCH', enable:'0'};

    $.post(url, data, function(data){
        if (data.status == 0) {
            alert('冻结失败');
            return;
        }
        obj.text('冻结');
        alert('冻结成功');
    },'json');


}


//解冻
function reFrozen (user_id, obj) {

    var url = USER_UPDATE_URL.replace('{user}', user_id);

    var data = {_method:'PATCH', enable:'1'};

    $.post(url, data, function(data){
        if (data.status == 0) {
            alert('恢复失败');
            return;
        }
        obj.text('正常');
        alert('恢复成功');
    },'json');


}


$(function() {
    $('.recharge').on('click', function() {

        var username =$(this).parents('td').siblings('.username').text();
        var user_id = $(this).attr('data-id');
        var money_obj = $(this).parents('td').siblings('.money');
        $('#recharge span.username').text(username);
        $('#recharge').modal({
            relatedTarget: this,
            onConfirm: function(e) {
                console.log(this);
                recharge(user_id, e.data,money_obj);
            },
        });
    });


    $('.frozen').on('click',function(){

        var user_id = $(this).attr('data-id');
        var obj =$(this).parents('td').siblings('.enable');
        frozen(user_id, obj);
    });



    $('.reFrezen').on('click',function(){
        var user_id = $(this).attr('data-id');
        var obj =$(this).parents('td').siblings('.enable');
        reFrozen(user_id, obj);
    });



});



