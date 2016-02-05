var everywhereDrop = $('#everywhere');
var scrollBut = $('#scrollTop');
var sortBut = $('#arrowSort');

var filter = $('.filer');
var scroll = $(".setScroll");
var fancyBox = $('.fancybox');
var tabs = $('#tabs-block');


$(document).mouseup(function (e){

    if (everywhereDrop.is(e.target)) {

        everywhereDrop.toggleClass('active');
    } else if(everywhereDrop.has(e.target).length !== 0) {
        if((e.target.nodeName.toLowerCase() == 'label') || $(e.target).hasClass('l-sort__header')) {
            everywhereDrop.find('.l-sort__header').html(e.target.innerHTML);
            everywhereDrop.toggleClass('active');
        }
    } else {
        everywhereDrop.removeClass('active');
    }
});

$(window).scroll(function(){
    if( $(this).scrollTop() > $(this).height()) {
        scrollBut.show();
    } else {
        scrollBut.hide();
    }
});

scrollBut.bind('click',function(){
    $('body').animate({scrollTop:0}, 500);
});

sortBut.bind('click',function(){
    $('body').animate({scrollTop: $('#sort').offset().top}, 500);
});





(function($){
    if(filter.length > 0) {

        filter.selectize({
            create: true
        });
    }

    $(window).load(function(){
        if(scroll.length > 0) {
            scroll.mCustomScrollbar({
                scrollbarPosition: 'inside',
                autoHideScrollbar: true,
                autoDraggerLength: false
            });
        }
    });

    $(document).ready(function() {

        if(fancyBox.length > 0) {
            fancyBox.fancybox();
        }
    });

    if(tabs.length > 0) {
        tabs.responsiveTabs({
            scrollToAccordion: true,
            rotate: false,
            animation: 'slide',
            startCollapsed: 'accordion',
            enabled: 0
        });
    }

})(jQuery);
