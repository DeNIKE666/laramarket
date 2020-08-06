$(function(){

    // Переключение текста в карточке товара

    $('.productChar__item').on('click', function(){
        $('.productChar__item').toggleClass('productChar__item-active');
        $('.productChar__line').toggleClass('productChar__line-right');
        $('.productChar__text').toggleClass('productChar__text-show');
    });


    // Фотографии в карточке товара
    $('.productNav__item').on('click', function(){
        $('.productNav__item').removeClass('productNav__item-active');
        $(this).addClass('productNav__item-active');
        let newSrc = $(this).find('img').attr('src');
        $('.productImg img').attr('src', newSrc);
    });

    // Слайдер в карточке товара
    $('.productSlider').owlCarousel({
        loop: true,
        margin: 10,
        autoplay: true,
        items: 1,
        nav: false,
        dots: true,
        autoHeight: true
    });

    // цвета
    $('.colors div').on('click', function(){
        $('.colors div').removeClass('active');
        $(this).addClass('active');
    });

    // размеры
    $('.sizes div').on('click', function(){
        $('.sizes div').removeClass('active');
        $(this).addClass('active');
    });

    // Корзина радио баттон
    $('.cartDeliveryItem__radio').on('click', function(){
        $(this).parent().parent().find('.cartDeliveryItem__radio .radio').removeClass('active');
        $(this).find('.radio').addClass('active');
        $('.cartDeliveryItem__check .check').removeClass('active');
        $(this).next().find('.check').eq(0).addClass('active');
    });

    // Корзина чек баттон
    $('.cartDeliveryItem__check').on('click', function(){
        if($(this).parent().prev().find('.radio').hasClass('active')){
            $('.cartDeliveryItem__check .check').removeClass('active');
            $(this).find('.check').addClass('active');
        } 
    });

    // Сортировка в каталоге
    $('.catalogSort').on('click', function(){
        $('.catalogSort__drop').fadeToggle();
    });

    $('.catalogSort__drop').hover(function(){

    }, function(){
        $('.catalogSort__drop').fadeOut();
    });

    $('.catalog').on('click', function(){
        $('.catalogSort__drop').fadeOut();
    });

    $('.catalogSort__drop span').on('click', function(){
        let oldName = $('.catalogSort>span').html();
        let newName = $(this).html();
        $('.catalogSort>span').html(newName);
        $(this).html(oldName);
    });

    // Фильтр в каталоге
    $('.catalogFilter__title').on('click', function(){
        $(this).next().slideToggle();
    });

    $('.catalogFilter__check').on('click', function(){
        $(this).find('div').toggleClass('active');
    });

    $('.catalogFilter__radio').on('click', function(){
        $(this).parent().find('.catalogFilter__radio div').removeClass('active');
        $(this).find('div').addClass('active');
    });

    // Ползунок в фильтре
    $('.filterRange').slider({
        animate: "slow",
        range: true,  
        values: [20000, 60000],
        step: 100,
        min: 0,
        max: 100000,
        slide : function(event, ui) {  
            let values = ui.values;
            $("#result-polzunok").text(ui.value); 
            let min = values[0];
            let max = values[1];
            $('.filterPrice-min').val(min);
            $('.filterPrice-max').val(max);      
        }
    });

    // Личный кабинет
    $('.lc-btn').on('click', function(){
        $('.lc-menu').fadeIn();
    });

    $('.lc-btn-auth').on('click', function(){
        $('.lc-enter').fadeIn();
    });
    
    $('.lc__close').on('click', function(){
        $('.lc').fadeOut();
    });

    // Модалки/менюшки скрываются 
    $('main').on('click', function(){
        $('.lc').fadeOut();
        $('.catalogDropWrap').fadeOut();
        $('.burgerDropWrap').fadeOut();
    });

    // Модалки
    $('.popUp-auth-btn').on('click', function(){
        $('.popUp-auth').fadeIn();
    });

    $('.popUp-reg-btn').on('click', function(){
        $('.popUp-reg').fadeIn();
    });

    $('.popUp__layer').on('click', function(){
        $('.popUp').fadeOut();
    });

    // Каталог меню
    $('.headerBottom__btn').on('click', function(){
        $('.catalogDropWrap').fadeToggle();
    });

    $('.catalogDrop__item').hover(function(){
        $('.catalogDrop__item').removeClass('catalogDrop__item-active');
        $(this).addClass('catalogDrop__item-active');
        let name = $(this).text().trim();
        $('.catalogDrop__right').removeClass('catalogDrop__right-show');
        $('.catalogDrop__right[name="' + name + '"]').addClass('catalogDrop__right-show');
    }, function(){

    });

    // Моб меню
    $('.headerTop__burger').on('click', function(){
        $('.burgerDropWrap').fadeIn();
    });

    $('.burgerDropNav__item').on('click', function(){
        $(this).parent().addClass('burgerDropNav-active');
        $(this).addClass('burgerDropNav__item-active');
    });

    $('.burgerDrop__close').on('click', function(){
        $('.burgerDropWrap').fadeOut();
        $('.burgerDropNav').removeClass('burgerDropNav-active');
        $('.burgerDropNav__item').removeClass('burgerDropNav__item-active');
    });

});