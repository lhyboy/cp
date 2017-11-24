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
        doLogin();
    })
})

 function doLogin() {
    	$(function(){
    		$.post('{:url("/www/login/doLogin")}', $('#login-form-hooks').serialize(), function(o){
    			if(o.code == 1) {
    				window.location.href = o.url;
    			} else {
    				$(".msgerr").html(o.msg);
    			}
                $('.refcaptcha').click();
    		}, 'json');
    	})
        return false;
    }