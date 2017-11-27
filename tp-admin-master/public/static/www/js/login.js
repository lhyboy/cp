$(function(){
    $('.loginBtn').click(function(){
        var name = $('input[name=UserName]').val();
        var password = $('input[name=Password]').val();
        if(name==''){
            alert('请输入账号');
            return false;
        }
        if(password==''){
            alert('请输入密码');
            return false;
        }
        $.post('doLogin',{username:name,password:password},function(o){
            //console.log(o);
            //return false;
            if(o.code == 1) {
                window.location.href = o.url;
            } else {
                $(".msgerr").html(o.msg);
            }
        },'json')        
    	
        return false;
    })
})


