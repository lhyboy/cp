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
            if(o.code == 1) {
                $.cookie("userInfo",o.data,{path:"/"});
                window.location.href = o.url;
            } else {
                alert(o.msg);
            }
        },'json')        
        return false;
    })
})


