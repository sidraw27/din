window.scrollToAnchor = function(target = null, offset = 120) {
    let anchor = null;

    if (target === null) {
        const url = window.location.href;
        const parts = url.split("#");
        anchor = parts[1];
    } else {
        anchor = target;
    }

    if (anchor !== null && anchor !== undefined) {
        if (anchor.match(/^[a-zA-Z ]+$/)) {
            const target = $(".__anchor_" + anchor);

            if (target.length > 0) {
                $('html,body').animate({scrollTop: target.offset().top - offset}, 'slow');
            }
        }
    }
};

window.adjustHeight = function (pixel = 0) {
    $('.__adjust_top').css('height', pixel + 'px');
};

(function () {
    scrollToAnchor(null, 100);

    const searchBox = $('.searchBox');
    const searchBoxTop = searchBox.offset().top;

    $(window).scroll(function () {
        const searchBoxFixedClass = 'fixed';
        if ($(window).scrollTop() > searchBoxTop) {
            if ( ! searchBox.hasClass(searchBoxFixedClass)) {
                adjustHeight(70);
                searchBox.addClass(searchBoxFixedClass);
            }
        } else {
            if (searchBox.hasClass(searchBoxFixedClass)) {
                adjustHeight(0);
                searchBox.removeClass(searchBoxFixedClass);
            }
        }
    });
} ());