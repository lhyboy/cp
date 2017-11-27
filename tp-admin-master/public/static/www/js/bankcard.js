$(function(){    
    $('.loginBtn').click(function(){        
        var BankID = $("#BankID").val();
        var Address_P = $("#Address_P").val();
        var Address_C = $("#Address_C").val();        
        var RealName = $('input[name=RealName]').val();
        var BankNum = $('input[name=BankNum]').val();
        var checkBankNum = $('input[name=checkBankNum]').val();
        if(RealName==''){
            alert('开户人姓名还没填写！');
            return false;
        }
        if(BankNum==''){
            alert('银行卡号还没填写！');
            return false;
        }
        if(checkBankNum==''){
            alert('确认银行卡号还没填写！');
            return false;
        }
        if(BankNum!=checkBankNum){
            alert('您二次输入的卡号跟第一次不一致，请重新输入！');
            return false;
        }
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