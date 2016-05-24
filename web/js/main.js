var everywhereDrop = $('#everywhere');
var everythingDrop = $('#everything');
var allTimeDrop = $('#allTime');
var scrollBut = $('#scrollTop');
var sortBut = $('#arrowSort');
var userCab = $('#userBut');
var scroll = $('.scroll');
var filter = $('.filer');
var fancyBox = $('.fancybox');
var tabs = $('#tabs-block');
var tabsAdmin = $('#tabs-block-admin');
var sign = $('#sign');
var butClose = $('#closeBut');
var outerForm = $('.sign-tabs');
var burger = $('.navigation__burger');
var navigation = $('.navigation:first-child');
var cabHead = $('.user-cabinet__head');
function close(elem) {
    if (butClose.is(elem) || outerForm.is(elem)) {
        sign.hide();
    }
};
burger.click(function () {
    navigation.toggleClass('active');
    if (navigation.hasClass('active')) {
        navigation.find('.navigation__items').hide().slideDown();
    } else {
        navigation.find('.navigation__items').slideUp();
    }
});
var scrollInit = function (elem) {
    if (!elem.length > 0) {
        return;
    } else {
        elem.mCustomScrollbar({
            scrollbarPosition: 'inside', autoDraggerLength: false
        });
    }
};
userCab.bind('click', function (e) {
    var but = this;
    if (!$(but).find('.user-cabinet__head').hasClass('active')) {
        $(but).find('.user-cabinet__head').addClass('active');
        $(but).find('.user-cabinet__menu').slideDown('slow');
    } else {
        $(but).find('.user-cabinet__menu').slideUp(function () {
            $(but).find('.user-cabinet__head').removeClass('active');
        });
    }
});
$(document).bind('mousedown', function (e) {
    close(e.target);
});
$(document).bind('touchstart resize', function (e) {
    if (!(cabHead).is(e.target) && $(cabHead).hasClass('active')) {
        userCab.trigger('click');
    }
});
$(document).bind('mouseup resize', function (e) {
    if (everywhereDrop.is(e.target)) {
        everywhereDrop.toggleClass('active');
    } else if (everywhereDrop.has(e.target).length !== 0) {
        if ((e.target.nodeName.toLowerCase() == 'label') || $(e.target).hasClass('l-sort__header')) {
            everywhereDrop.find('.l-sort__header').html(e.target.innerHTML);
            everywhereDrop.toggleClass('active');
        }
    } else {
        everywhereDrop.removeClass('active');
    }

    if ($(window).width() < 960) {
        if (everythingDrop.is(e.target)) {
            everythingDrop.toggleClass('active');
        } else if (everythingDrop.has(e.target).length !== 0) {
            if ((e.target.nodeName.toLowerCase() == 'label') || $(e.target).hasClass('l-sort__header')) {
                everythingDrop.find('.l-sort__header').html(e.target.innerHTML);
                everythingDrop.toggleClass('active');
            }
        } else {
            everythingDrop.removeClass('active');
        }
    }

    if ($(window).width() < 700) {
        if (allTimeDrop.is(e.target)) {
            allTimeDrop.toggleClass('active');
        } else if (allTimeDrop.has(e.target).length !== 0) {
            if ((e.target.nodeName.toLowerCase() == 'label') || $(e.target).hasClass('l-sort__header')) {
                allTimeDrop.find('.l-sort__header').html(e.target.innerHTML);
                allTimeDrop.toggleClass('active');
            }
        } else {
            allTimeDrop.removeClass('active');
        }
    }
});
$(window).bind('scroll resize', function () {
    if (($(this).scrollTop() > $(this).height()) && ( $(this).width() > 960)) {
        scrollBut.show();
    } else {
        scrollBut.hide();
    }
});
scrollBut.bind('click', function () {
    $('body').animate({scrollTop: 0}, 500);
});
sortBut.bind('click', function () {
    $('body').animate({scrollTop: $('#sort').offset().top}, 500);
});
(function filInit() {
    if (!(filter.length > 0)) {
        return;
    } else {
        filter.selectize({
            create: true
        });
    }
})();
$(window).bind('load resize', function () {
    if (everywhereDrop.length > 0) {
        if ($(window).width() > 959) {
            scrollInit(everywhereDrop.find('.l-sort__list'));
        } else {
            everywhereDrop.find('.l-sort__list').mCustomScrollbar('destroy');
        }
    }

    if (!(scroll.length > 0)) {
        return;
    } else {
        if ($(window).width() > 959) {
            scroll.mCustomScrollbar({
                scrollbarPosition: 'outside',
                autoHideScrollbar: true,
                live: 'true',
                alwaysShowScrollbar: 0,
                autoExpandScrollbar: true
            });
        } else {
            scroll.mCustomScrollbar('destroy');
        }
    }
});
(function fancyInit() {
    if (!(fancyBox.length > 0)) {
        return;
    } else {
        fancyBox.fancybox();
    }
})();
(function tabInit() {
    if (!(tabs.length > 0)) {
        return;
    } else {
        tabs.responsiveTabs({
            scrollToAccordion: true,
            rotate: false,
            animation: 'slide',
            startCollapsed: 'accordion',
            enabled: 0,
            setHash: true
        })
    }
})();
(function adminTabs() {
    if (!(tabsAdmin.length > 0)) {
        return;
    } else {
        tabsAdmin.responsiveTabs({
            scrollToAccordion: true,
            rotate: false,
            animation: 'slide',
            startCollapsed: 'accordion',
            enabled: 0,
            setHash: true
        })
    }
})();
var elem = $(".clock__number");
if (elem.length) {
    var days = elem.eq(0);
    var hours = elem.eq(1);
    var minutes = elem.eq(2);
    (function () {
        var interval = setInterval(function () {
            minutes.text(+minutes.text() <= 10 ? "0" + (minutes.text() - 1) : +minutes.text() - 1);
            if (!+minutes.text()) {
                if (hours.text() > 0) {
                    minutes.text(59);
                    hours.text(+hours.text() <= 10 ? "0" + (hours.text() - 1) : +hours.text() - 1);
                    if (+hours.text() <= 0) {
                        if (+days.text() > 0) {
                            hours.text(23);
                            days.text(+days.text() <= 10 ? "0" + (days.text() - 1) : +days.text() - 1);
                            if (+days.text() <= 0) {
                                days.text("00");
                            }
                        } else {
                            hours.text("00");
                        }
                    }
                } else {
                    clearInterval(interval);
                }
            }
        }, 1000 * 60);
    })();
}
$(function () {
    $('.search_button').click(function () {
        $('.search-form-wrap').show();
    });

    $('.close-icon').click(function () {
        $('.search-form-wrap').hide();
        $("input[name=search]").val('');
        $("#search-results").children().remove();
    });

    $('.search_button_form').click(function () {
        var search = $("input[name=search]").val();
        var $ulElement = $("#search-results");
        $.ajax({
            url: 'event-search',
            data: { 'search': search },
            success: function (response) {
                if (true === response.status) {
                    $ulElement.children().remove();
                    $ulElement.append(response.template);
                }
            }
        });
    });
});

