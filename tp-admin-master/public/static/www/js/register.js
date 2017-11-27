$(function(){
    $('.yzm').on('click', function(){
            $('#captchaimg').get(0).src=($('#captchaimg').get(0).src+'?=r'+Math.random(1, 10000));
        });
    $('.loginBtn').click(function(){
        var name = $('input[name=UserName]').val();
        var password = $('input[name=Password]').val();
        var ImgCode = $('input[name=ImgCode]').val();
        if(name==''){
            alert('请输入账号');
            return false;
        }
        if(password==''){
            alert('请输入密码');
            return false;
        }
        if(ImgCode==''){
            alert('请输入验证码');
            return false;
        }
        
        $.post('doRegister',{username:name,password:password,captcha:ImgCode},function(o){
            if(o.code == 1) {    
                alert('注册成功，请登陆！');
                window.location.href = o.url;
            } else {
                alert(o.msg);
            }
        })
    })
})