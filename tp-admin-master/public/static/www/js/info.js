$(function(){    
    $('.va131').change(function(){        
        var NickName=$('input[name=NickName]').val();
        var NickPhone=$('input[name=NickPhone]').val();
        var NickEmail=$('input[name=NickEmail]').val();
        var Gender=$('#sex option:selected').val();
        var BirthDay=$('input[name=BirthDay]').val(); 
        $.post('savepersonalinfo',{nickname:NickName,mobile:NickPhone,email:NickEmail,Gender:Gender,BirthDay:BirthDay},function(o){
            if(o.code == 1) {    
                alert('修改成功！');                
            } else {
                alert(o.msg);                
            }
        })
    })
})