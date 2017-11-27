$(function(){
    
    $('.loginBtn').click(function(){        
        var BankID = $("#BankID").val();
        var Address_P = $("#Address_P").val();
        var Address_C = $("#Address_C").val();        
        var NickName = $('input[name=NickName]').val();
        var BankNum = $('input[name=BankNum]').val();
        var checkBankNum = $('input[name=checkBankNum]').val();
        
        
        $.post('dosetbankcard',{BankID:BankID,Address_P:Address_P,Address_C:Address_C,RealName:RealName,BankNum:BankNum,checkBankNum:checkBankNum},function(o){
            if(o.code == 1) {    
                alert('提交成功！');
                window.location.href = o.url;
            } else {
                alert(o.msg);
                
            }
        })
    })
})