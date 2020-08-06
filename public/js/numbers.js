$(function(){
    // Цифры при скролле

    var doCount = true;
    $(document).on("scroll", function(){
        let scrnWidth = $(window).height();
        let docScroll = $(document).scrollTop();
        let counterOffset = $('.counter').offset();

        if(docScroll >= counterOffset.top - scrnWidth && doCount){
            $('.count__num').each(function () {
                $(this).prop('Counter',0).animate({
                Counter: $(this).text()
                }, {
                duration: 1500,
                easing: 'swing',
                step: function (now) {
                    $(this).text(Math.ceil(now));
                }
                });
            });
            doCount = false;
            return doCount;
        }
    });
});
    
