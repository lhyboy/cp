$(function(){
    //支付宝充值提交
    $('.loginBtn').click(function(){        
        var Money = $("input[name=Money]").val();
        var PayUser = $("input[name=PayUser]").val();     
        if(Money==''){
            alert('请输入充值金额！');
            return false;
        }
        if(PayUser==''){
            alert('请输入支付宝姓名');
            return false;
        }
        $.post('dosetrecharge',{Money:Money,PayUser:PayUser},function(o){
            if(o.code == 1) {    
                alert('提交成功！');
                window.location.href = o.url;
            } else {
                alert(o.msg);
                
            }
        })
    })
})