$(function(){
    $('#leftTabBox li').click(function(){
        $(this).siblings().not($(this).addClass('on')).removeClass('on');
    })
})


