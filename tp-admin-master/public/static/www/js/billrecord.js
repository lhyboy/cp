$(function(){
    $('.hd li').click(function(){
        var index=$(this).index();
        $(this).siblings().not($(this).addClass('on')).removeClass('on');
        $('.scrollBox2').not($('.scrollBox2').eq(index).show()).hide();
    })
})


