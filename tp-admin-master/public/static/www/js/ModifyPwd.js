$(function(){
    $('.loginBtn').click(function(){
        var newPassword = $('input[name=newPassword1]').val();
//        var UserName = $('input[name=UserName]').val();
//        if(name==''){
//            alert('请输入账号');
//            return false;
//        }
        $.post('doModifyPwd',{password:newPassword},function(o){            
            if(o.code == 1) {                
                window.location.href = o.url;
            } else {
                alert(o.msg);
            }
        },'json')        
        return false;
    })
})


