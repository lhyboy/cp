$(function(){
    
    $('.loginBtn BTN').click(function(){        
        var Money = $("#Money").val();
        
        
        
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