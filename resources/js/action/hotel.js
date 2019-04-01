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

    const topOffset = $('.hotel_NavBar').offset().top;

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

        fixedNavBar(topOffset);
    });
} ());

function fixedNavBar(topOffset) {
    const navBar = $('.hotel_NavBar');
    const navBarFixedClass = 'navbar-fixed';

    if ($(window).scrollTop() + 110 > topOffset) {
        if ( ! navBar.hasClass(navBarFixedClass)) {
            adjustHeight(115);
            navBar.addClass(navBarFixedClass);
        }
    } else {
        if (navBar.hasClass(navBarFixedClass)) {
            adjustHeight(70);
            navBar.removeClass(navBarFixedClass)
        }
    }
}