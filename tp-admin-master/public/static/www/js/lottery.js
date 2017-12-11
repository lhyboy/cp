//滚动筛子
function game(i){
    $('.Sieve').removeClass('rDice0 rDice1 rDice2 rDice3').addClass('rDice'+i);
    i++;
    if(i==4)  i=0;
    t=setTimeout('game('+i+')',100);
}
//停止转动控制
function clearGame(n1,n2,n3){
    clearTimeout(t);
    $('.Sieve').removeClass('rDice0 rDice1 rDice2 rDice3')
    $('.Sieve').eq(0).addClass('Dice'+n1);
    $('.Sieve').eq(1).addClass('Dice'+n2);
    $('.Sieve').eq(2).addClass('Dice'+n3);
}
//滚动筛子控制
function startGame(type){
    $.each($('.Sieve'),function(){
        $(this).removeClass('Dice1 Dice2 Dice3 Dice4 Dice5 Dice6');
    })
    game(0);
    //开奖
    $.post('test.php',{type:type},function(o){ //type 开奖类型
        if(o.code=='1'){
            clearGame(o.arr[0],o.arr[1],o.arr[2]);
            Betting_status=true;
        }else{
            alert(o.msg);
        }
    })    
}
//倒计时
function doTimer(left_second){
    var day=0, hour=0, minute=0, second=0;//时间默认值
    if(left_second > 0){
        day = Math.floor(left_second / (60 * 60 * 24));
        hour = Math.floor(left_second / (60 * 60)) - (day * 24);
        minute = Math.floor(left_second / 60) - (day * 24 * 60) - (hour * 60);
        second = Math.floor(left_second) - (day * 24 * 60 * 60) - (hour * 60 * 60) - (minute * 60);
    }
    return (day>0?('<i>'+day+'</i>天  '):'')+'<i>'+toDou(hour)+'</i>:<i>'+toDou(minute)+'</i>:<i>'+toDou(second)+'</i>';
};
function toDou(n){
    return n>9?n:('0'+n);
};
var lotteryArr=[]; //投注的选项数组
var Odds1 = 1.93;   //大 小 单 双
var Odds2 = 186.84; //3  18
var Odds3 = 62.28;  //4  17
var Odds4 = 31.14;  //5  16
var Odds5 = 18.68;  //6  15
var Odds6 = 12.45;  //7  14
var Odds7 = 8.89;   //8  13
var Odds8 = 7.47;   //9  12
var Odds9 = 6.92;   //10 11
var Betting_status=true; //投注状态，true可投注 false不可投注
$(function(){   
   $('#balance span').html($.cookie("userInfo")); //用户余额

   //即将开售倒计时
    var s = $('.timeP').attr('data-val1');
    if(s){
       //倒计时
       timer = setInterval(function(){
           if(s >= 0){
               $('.timeP').html(doTimer(s));
               s--;
           }else{
               //倒计时结束 开始开奖
               Betting_status=false;
               startGame(1);
               clearInterval(timer);
           }
       },1000);
    }
   //下注
   $('.Method li').click(function(){
       var lotteryText='';
       var msg = $(this).find('span').text();
       if($(this).hasClass('checked')){
            $(this).removeClass('checked');
            lotteryArr.splice($.inArray(msg,lotteryArr),1);
            if(!$('.Method li').hasClass('checked')){
                $('.bottom table').hide();
            }
       }else{
            $(this).addClass('checked');            
            lotteryArr[lotteryArr.length]=msg;            
            $('.bottom table').show();
       }       
       console.log(lotteryArr)
       $.each(lotteryArr,function(i){
          lotteryText+=lotteryArr[i]+' ';
       })
       $('#choice').html(lotteryText);
       lotteryTotal();
   })
   //每注金额
   $('input[name=tel]').change(function(){
        lotteryTotal();
   })
   //确定投注
   $('.fr').click(function(){
        //Betting_status=true;  投注时候可以用，改成true就可以下注  false是开奖进行时
        if(Betting_status){
            var Multiple=$('input[name=tel]').val(); //当前下注金额
            var balance=$('#balance span').html();
            if(lotteryArr.length<1){
                alert('请至少选择一组号码投注!')
                return false;
            } 
            if(Multiple<1){
                alert('请填写您要投注的金额!')
                return false;
            } 
            if(parseInt(Multiple)>parseInt(balance)){
                alert('您的余额是'+balance+'不够本次投注！');
                return false;
            }
           // 备注：
           // 1.userID       用户ID
           // 2.cpType       彩票类型 既是1分钟 5分钟 10分钟
           // 3.lotteryArr   投注的数组  （例如：用户购买了3 4 15 大 单）
           // 4.Multiple     投注倍数
            var userID='111';
            var cpType='1';
            //投注
            $.post('test',{userID:userID,lotteryArr:lotteryArr,Multiple:Multiple,cpType:cpType},function(o){  //lotteryArr  投注的选项数组   Multiple  投注的倍数
                if(o.code==1){
                    alert('投注成功');
                    return false;
                }else{
                    alert(o.msg);
                }
            })
        }else{
            alert('开奖中，稍后投注!');
        }
   })
   //算金额
   function lotteryTotal(){
       var total=0; //总和
       //判断当前投注的是什么
       var num1 = $.inArray("大",lotteryArr);
       var num2 = $.inArray("小",lotteryArr);
       var num3 = $.inArray("单",lotteryArr);
       var num4 = $.inArray("双",lotteryArr);
       var num5 = $.inArray("3",lotteryArr);
       var num6 = $.inArray("4",lotteryArr);
       var num7 = $.inArray("5",lotteryArr);
       var num8 = $.inArray("6",lotteryArr);
       var num9 = $.inArray("7",lotteryArr);
       var num10 = $.inArray("8",lotteryArr);
       var num11 = $.inArray("9",lotteryArr);
       var num12 = $.inArray("10",lotteryArr);
       var num13 = $.inArray("11",lotteryArr);
       var num14 = $.inArray("12",lotteryArr);
       var num15 = $.inArray("13",lotteryArr);
       var num16 = $.inArray("14",lotteryArr);
       var num17 = $.inArray("15",lotteryArr);
       var num18 = $.inArray("16",lotteryArr);
       var num19 = $.inArray("17",lotteryArr);
       var num20 = $.inArray("18",lotteryArr);
       //投注倍数
       var Multiple = $('input[name=tel]').val();
       $.each(lotteryArr,function(j){
           //大 小 单 双
           if(lotteryArr[j]=='大' || lotteryArr[j]=='小' || lotteryArr[j]=='单' || lotteryArr[j]=='双'){
              total+=Multiple*Odds1;
           } 
           //3 18
           if(lotteryArr[j]=='3' || lotteryArr[j]=='18'){
              total+=Multiple*Odds2;
           } 
           //4 17
           if(lotteryArr[j]=='4' || lotteryArr[j]=='17'){
              total+=Multiple*Odds3;
           }
           //5 16
           if(lotteryArr[j]=='5' || lotteryArr[j]=='16'){
              total+=Multiple*Odds4;
           }
           //6 15
           if(lotteryArr[j]=='6' || lotteryArr[j]=='15'){
              total+=Multiple*Odds5;
           }
           //7 14
           if(lotteryArr[j]=='7' || lotteryArr[j]=='14'){
              total+=Multiple*Odds6;
           }
           //8 13
           if(lotteryArr[j]=='8' || lotteryArr[j]=='13'){
              total+=Multiple*Odds7;
           }
           //9 12
           if(lotteryArr[j]=='9' || lotteryArr[j]=='12'){
              total+=Multiple*Odds8;
           }
           //10 11
           if(lotteryArr[j]=='10' || lotteryArr[j]=='11'){
              total+=Multiple*Odds8;
           }
       })       
       $('#totalNumber').html(total.toFixed(2));  
       if(total>0){
           $('.showText').not($('.showText').eq(1).show()).hide();
       }else{
           $('.showText').not($('.showText').eq(0).show()).hide();
       }   
   }
   //清空
   $('.fl').click(function(){
        $('.Method li').removeClass('checked');
        $('input[name=tel]').val('');
        $('.bottom table').hide();
   })
   //查看历史开奖
   $('.xiala').click(function(){
       $(".openPast").is(":hidden")?$('.openPast').show():$('.openPast').hide();
   })
})