var everywhereDrop = $('#everywhere');
var scrollBut = $('#scrollTop');

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

$(document).ready(function() {
    $('.fancybox').fancybox();
});

(function($){
    $(window).load(function(){
        $(".setScroll").mCustomScrollbar({
            scrollbarPosition : 'inside',
            autoHideScrollbar : true,
            autoDraggerLength : false

        });
    });
})(jQuery);