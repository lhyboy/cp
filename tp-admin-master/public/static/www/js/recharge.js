$(function(){
    
    $('.loginBtn').click(function(){        
        var Money = $("#Money").val();
        var PayUser = $("#PayUser").val();
        
        
        
        $.post('dosetrecharge',{Money:Money,PayUser:PayUser},function(o){
            if(o.code == 1) {    
                alert('提交成功！');
                window.location.href = o.url;
            } else {
                alert(o.msg);
                
            }
        })
    })
})