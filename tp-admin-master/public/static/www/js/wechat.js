$(function(){
    //微信充值提交
    $('.loginBtn').click(function(){    
        var playtype = $("input[name=playtype]").val();
        var Money = $("input[name=Money]").val();
        var PayUser = $("input[name=PayUser]").val();     
        if(Money==''){
            alert('请输入充值金额！');
            return false;
        }
        if(PayUser==''){
            alert('请输入微信昵称');
            return false;
        }
        $.post('dosetrecharge',{playtype:playtype,Money:Money,PayUser:PayUser},function(o){
            if(o.code == 1) {    
                alert('提交成功！');
                window.location.href = o.url;
            } else {
                alert(o.msg);                
            }
        })
    })
})