$(function(){
    $('.hd li').click(function(){
        var index=$(this).index();
        $(this).siblings().not($(this).addClass('on')).removeClass('on');
        $('.scrollBox').not($('.scrollBox').eq(index).show()).hide();
    })
})


