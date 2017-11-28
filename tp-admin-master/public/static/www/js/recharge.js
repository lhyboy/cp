$(function(){
    
    $('.loginBtn').click(function(){ 
        var playtype = $("input[name=playtype]").val();
        var Money = $("#Money").val();
        var PayUser = $("#PayUser").val();     
        if(Money==''){
            alert('请输入充值金额！');
            return false;
        }
        if(PayUser==''){
            alert('请输入转账户名');
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