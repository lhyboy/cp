$(function(){
    
    $('.loginBtn').click(function(){        
        var BankID = $("#BankID option:selected").val();
        var Address_P = $("#Address_P option:selected").val();
        var Address_C = $("#Address_C option:selected").val();        
        var RealName = $('input[name=RealName]').val();
        var BankNum = $('input[name=BankNum]').val();
        var checkBankNum = $('input[name=checkBankNum]').val();       
        if(BankID=='0'){
            alert('请选择银行');
            return false;
        }
        if(Address_P=='0'){
            alert('请选择开户省');
            return false;
        }
        if(Address_C=='0'){
            alert('请选择开户市');
            return false;
        }
        if(RealName==''){
            alert('请填写开户人姓名');
            return false;
        }
        if(BankNum==''){
            alert('银行卡号不能为空');
            return false;
        }
        if(checkBankNum==''){
            alert('请再次确认银行卡号');
            return false;
        }
        $.post('dosetbankcard',{BankID:BankID,Address_P:Address_P,Address_C:Address_C,RealName:RealName,BankNum:BankNum,checkBankNum:checkBankNum},function(o){
            if(o.code == 1) {    
                alert('提交成功！');
                return false;
                window.location.href = o.url;
            } else {
                alert(o.msg);                
            }
        })
    })
})