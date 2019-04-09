(function() {
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

    const hotelNavBar = $('.hotel_NavBar');
    const hotelNavBarOffsetTop = hotelNavBar.offset().top;
    const breadcrumb = $('.breadcrumb-outer');
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
            fixedElem(breadcrumbOffsetTop, breadcrumb, 'fixed', 10);
        }
        fixedElem(hotelNavBarOffsetTop, hotelNavBar, 'fixed', window.isMobile() ? 10 : 115);
    });
} ());

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