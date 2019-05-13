/*-- CUSTOM JS --*/

$(document).ready(function(){
    //RERUN POLYFILL FOR SLIDER (IE11 ISSUE)
    //objectFitPolyfill();

    /*//SCROLLING HEADER
    $(window).scroll(function(){
        if($(window).scrollTop()>=1){
            $('.main_header').clearQueue().addClass('active');
        }else {
            $('.main_header').clearQueue().removeClass('active');
        }
    });
    if($(window).scrollTop()>=1){
        $('.main_header').clearQueue().addClass('active');
    }*/

    /*//MENU TOGGLER TODO DO SOMETHING ELEGEANT WITH THIS BULLSHIT
    var left_side_open = 0;
    //LEFT SIDE
    $('.trigger_products').click(function(){
        left_side_open = 1;
        if (window.innerWidth >= 1280){
            $('.overlay_inactive').fadeIn();
        }
        $('.main_header').addClass('active2');
        $('.nav_overlay.left').addClass('active');
        if (window.innerWidth < 1280){
            $('.nav_overlay.right').removeClass('active');
            $('.main_header').removeClass('active3');
        }
        $('.tips_menu, .responsive_menu').removeClass('active');
        $('.products_menu').addClass('active');
    });

    $('.trigger_tips').click(function(){
        left_side_open = 1;
        if (window.innerWidth >= 1280){
            $('.overlay_inactive').fadeIn();
        }
        $('.main_header').addClass('active2');
        $('.nav_overlay.left').addClass('active');
        if (window.innerWidth < 1280){
            $('.nav_overlay.right').removeClass('active');
            $('.main_header').removeClass('active3');
        }
        $('.products_menu, .responsive_menu').removeClass('active');
        $('.tips_menu').addClass('active');
    });

    $('.nav_overlay.left .close_nav_overlay').click(function(){
        left_side_open = 0;
        if(right_side_open === 0){
            $('.overlay_inactive').fadeOut();
        }
        $('.main_header').removeClass('active2');
        $('.nav_overlay.left').removeClass('active');
        $('.tips_menu,.products_menu').removeClass('active');
    });

    var right_side_open = 0;
    //RIGHT SIDE
    $('.trigger_find_pharmacy').click(function(){
        right_side_open = 1;
        if (window.innerWidth >= 1280){
            $('.overlay_inactive').fadeIn();
        }
        $('.main_header').addClass('active3');
        $('.nav_overlay.right').addClass('active');
        if (window.innerWidth < 1280){
            $('.nav_overlay.left').removeClass('active');
            $('.main_header').removeClass('active2');
        }
        $('.my_account_menu').removeClass('active');
        $('.find_pharmacy_menu').addClass('active');
    });

    $('.trigger_my_account').click(function(){
        right_side_open = 1;
        if (window.innerWidth >= 1280){
            $('.overlay_inactive').fadeIn();
        }
        $('.main_header').addClass('active3');
        $('.nav_overlay.right').addClass('active');
        if (window.innerWidth < 1280){
            $('.nav_overlay.left').removeClass('active');
            $('.main_header').removeClass('active2');
        }
        $('.find_pharmacy_menu').removeClass('active');
        $('.my_account_menu').addClass('active');
    });

    $('.nav_overlay.right .close_nav_overlay').click(function(){
        right_side_open = 0;
        if(left_side_open === 0){
            $('.overlay_inactive').fadeOut();
        }
        $('.main_header').removeClass('active3');
        $('.nav_overlay.right').removeClass('active');
        $('.find_pharmacy_menu,.my_account_menu').removeClass('active');
    });

    //RESPONSIVE MENU
    $('.trigger_responsive_menu').click(function(){
        left_side_open = 1;
        if (window.innerWidth >= 1280){
            $('.overlay_inactive').fadeIn();
        }
        $('.main_header').addClass('active2');
        $('.nav_overlay.left').addClass('active');
        if (window.innerWidth < 1280){
            $('.nav_overlay.right').removeClass('active');
            $('.main_header').removeClass('active3');
        }
        $('.tips_menu,.products_menu').removeClass('active');
        $('.responsive_menu').addClass('active');
    });*/

    //TIPS MASONRY LAYOUT
    /*var $container = $('.masonry');

    $container.imagesLoaded( function() {
        $container.isotope({
            // options...
            animationEngine: 'best-available',
            itemSelector: '.col_xl_4'
        });
    });*/

    //MASONRY FILTERING
    /*$('.projects_filter li').on('click', function () {
        $('.projects_filter li').removeClass('active');
        $(this).addClass('active');
        var selector = $(this).data('filter');
        $container.isotope({
            filter: selector
        });
    });*/

    //SLIDERS
    /*if (window.innerWidth < 1280){
        $('.slider_tips').slick({
            dots: true,
            infinite: true,
            slidesToShow: 3,
            slidesToScroll: 1,
            responsive: [
                {
                    breakpoint: 1025,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1,
                        infinite: true,
                        dots: true
                    }
                },{
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        infinite: true,
                        dots: true
                    }
                }
            ]
        });
    }*/
    //MTZ
    /*$('.fixed-action-btn').floatingActionButton({
        direction: 'left',
        hoverEnabled: false
    });*/

    /*$('select').formSelect();*/

    //$('.tabs').tabs();


    //FAQS
    /*$('.faqs_themes li').click(function () {
        if (window.innerWidth < 768){
            $('.xs_faqs_themes').fadeToggle();
            $('.xs_faqs_results').fadeToggle();
        }
        var index = $(this).parents('.faqs_container:eq(0)').find('.faqs_themes li').index(this);

        $(this).parents('.faqs_container:eq(0)').find('.faqs_themes li').removeClass('active');
        $(this).addClass('active');
        /!* show results *!/
        $(this).parents('.faqs_container:eq(0)').find('.faqs_results > li').addClass('dnone');
        $(this).parents('.faqs_container:eq(0)').find('.faqs_results > li').eq(index).removeClass('dnone');
    });

    $('.faqs_list > li').click(function(){
        $(this).toggleClass('active');
        $(this).find('.faq_answer').slideToggle();
    });

    //XS FAQS GO BACK
    $('.xs_trigger_faqs_back').click(function(){
        $('.xs_faqs_themes').fadeToggle();
        $('.xs_faqs_results').fadeToggle();
    });*/

    //COOKIES
    /*$('.close_cookies,.accept_cookies').click(function (){
        $('.cookies_bar').fadeOut();
    });*/

    //INIT MODALS
    /*$(".modal").iziModal({
        title: '',
        subtitle: '',
        headerColor: '#FFFFFF',
        background: null,
        theme: '',  // light
        icon: null,
        iconText: null,
        iconColor: '',
        rtl: false,
        width: 960,
        top: null,
        bottom: null,
        borderBottom: true,
        padding: 0,
        radius: 5,
        zindex: 9999,
        iframe: false,
        iframeHeight: 400,
        iframeURL: null,
        focusInput: true,
        group: '',
        loop: false,
        arrowKeys: true,
        navigateCaption: true,
        navigateArrows: true, // Boolean, 'closeToModal', 'closeScreenEdge'
        history: false,
        restoreDefaultContent: false,
        autoOpen: 0, // Boolean, Number
        bodyOverflow: false,
        fullscreen: false,
        openFullscreen: false,
        closeOnEscape: true,
        closeButton: true,
        appendTo: false, // or false
        appendToOverlay: false, // or false
        overlay: true,
        overlayClose: true,
        overlayColor: 'rgba(0, 0, 0, 0.4)',
        timeout: false,
        timeoutProgressbar: false,
        pauseOnHover: false,
        timeoutProgressbarColor: 'rgba(255,255,255,0.5)',
        transitionIn: 'comingIn',
        transitionOut: 'comingOut',
        transitionInOverlay: 'fadeIn',
        transitionOutOverlay: 'fadeOut',
        onFullscreen: function(){},
        onResize: function(){},
        onOpening: function(){},
        onOpened: function(){},
        onClosing: function(){},
        onClosed: function(){},
        afterRender: function(){}
    });*/

    //INIT MODALS
    /*$(".alert").iziModal({
        bottom: 0,
        width: 600,
        timeout: 5000,
        timeoutProgressbar: true,
        transitionIn: 'fadeInDown',
        transitionOut: 'fadeOutDown',
        pauseOnHover: true
    });*/

    //TEST BTN'S
    /*$('.test_btn').click(function(){
        $(this).parents('.col_xl_6:eq(0)').siblings('.col_xl_6').find('.test_btn').removeClass('active');
        $(this).addClass('active');
    });*/
});


//A HREF ANIMATION
/*$(function() {
    $('a[href*="#"]:not([href="#"])').click(function() {
        if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
            var target = $(this.hash);
            target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
            $('html, body').animate({
                scrollTop: target.offset().top -120
            }, 1000);
            return false;
        }
    });
});*/

//ONSCREEN
/*var os = new OnScreen({
    tolerance: 0
});
os.on('enter', '.x20', function (element) {
    $(element).addClass('onScreen');
});*/


/*MATERIALIZE*/
//SELECT
//$('select').material_select();
//DATEPICKER
//$('.datepicker').pickadate({
//    selectMonths: true, // Creates a dropdown to control month
//    selectYears: 15 // Creates a dropdown of 15 years to control year
//});