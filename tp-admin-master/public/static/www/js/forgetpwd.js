$(function(){
    $('.loginBtn').click(function(){
        var name = $('input[name=UserName]').val();
        var code = $('input[name=ImgCode]').val();
        if(name==''){
            alert('请输入账号');
            return false;
        }
        if(code==''){
            alert('请输入验证码');
            return false;
        }
        $.post('checkusername',{UserName:name,captcha:code},function(o){            
            if(o.code == 1) { 
                //alert(o.url);
                window.location.href = o.url;
                
            } else {
                alert(o.msg);
            }
        },'json')        
        return false;
    })
})


