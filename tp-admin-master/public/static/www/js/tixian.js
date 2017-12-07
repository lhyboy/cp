$(function(){
    var yu = $.cookie("userInfo");
    $('.loginBtn').click(function(){        
        var Money = $("#Money").val(); 
         
        if(Money==''){
            alert('提现金额不能为空!');
            return false;
        }
        if(Money=='0' || parseInt(Money)>parseInt(yu)){
            alert('提现金额不足!');
            return false;
        }       
        $.post('dotixian',{Money:Money},function(o){
            if(o.code == 1) {    
                alert('提交成功！');
                window.location.href = o.url;
            } else {
                alert(o.msg);                
            }
        })
    })
})