$(function(){    
    $('.va131').change(function(){        
        var nickname=$('input[name=NickName]').val();
        var mobile=$('input[name=NickPhone]').val();
        var email=$('input[name=NickEmail]').val();
        var Gender=$('#sex option:selected').val();
        var BirthDay=$('input[name=BirthDay]').val(); 
        $.post('savepersonalinfo',{nickname:nickname,mobile:mobile,email:email,Gender:Gender,BirthDay:BirthDay},function(o){
            if(o.code == 1) {    
                alert('修改成功！');                
            } else {
                alert(o.msg);                
            }
        })
    })
})