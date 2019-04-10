window.initDetectScrollElem = function () {
    const items = {
        'overview': {},
        'price': {},
        'position': {},
        'comment': {},
        'info': {}
    };
    _.forOwn(items, function (item, name) {
        item.top = $('.__anchor_' + name).offset().top;
    });

    const fixedClass = 'fixed';
    const hotelNavBar = $('.hotel_NavBar');
    // 需先確認無固定後再取得高度
    hotelNavBar.removeClass(fixedClass);
    const hotelNavBarOffsetTop = hotelNavBar.offset().top;
    const breadcrumb = $('.breadcrumb-outer');
    breadcrumb.removeClass(fixedClass);
    const breadcrumbOffsetTop = breadcrumb.offset().top;

    $(window).scroll(function () {
        let lastScrollToItem = null;

        _.forOwn(items, function (item, name) {
            const targetItem = $('.__item_' + name);
            targetItem.removeClass('current');
            if ($(window).scrollTop() > item.top - 190) {
                lastScrollToItem = targetItem;
            }
        });

        if (lastScrollToItem !== null) {
            lastScrollToItem.addClass('current');
        }

        if (window.isMobile()) {
            fixedElem(breadcrumbOffsetTop, breadcrumb, fixedClass, 10);
        }
        fixedElem(hotelNavBarOffsetTop, hotelNavBar, fixedClass, window.isMobile() ? 10 : 115);
    });

    window.scrollTo(window.scrollX, window.scrollY - 1);
};

function fixedElem(topOffset, elem, className, t) {
    if ($(window).scrollTop() + t > topOffset) {
        if ( ! elem.hasClass(className)) {
            adjustHeight(115);
            elem.addClass(className);
        }
    } else {
        if (elem.hasClass(className)) {
            adjustHeight(70);
            elem.removeClass(className)
        }
    }
}

(function() {
    initDetectScrollElem()
} ());