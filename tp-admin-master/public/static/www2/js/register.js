$(function(){
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
        $.post('test.php',{name:name,password:password,ImgCode:ImgCode},function(data){
            if(data==1){
                window.location.href = 'index.html';
            }
        })
    })
})