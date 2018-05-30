/*price range*/

function showCart(result) {
    $('#cart .modal-body').html(result);
    $('#cart').modal();
}


var RGBChange = function () {
    $('#RGB').css('background', 'rgb(' + r.getValue() + ',' + g.getValue() + ',' + b.getValue() + ')')
};

/*scroll to top*/

$(document).ready(function () {

    var body = $('body');

    $('#sl2').slider();
    $('.category-products').dcAccordion();


    $('.add-to-cart').on('click', function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        var qty = $('#qty').val();
        $.ajax({
            method: "GET",
            url: "/cart/add",
            data: {
                'id': id,
                'qty':qty
            },
            success: function (result) {
                if (!result) {
                    console.log('result is empty');
                    return false;
                }
                showCart(result);
            },
            error: function () {
                alert('error');
            }
        });
    });

    body.on('click', '#clear-cart', (function () {
        $.ajax({
            method: "GET",
            url: "/cart/clear",

            success: function (result) {
                if (!result) {
                    console.log('error');
                    return false;
                }
                showCart(result);
            },
            error: function () {
                alert('error');
            }
        });
    }));

    body.on('click', '.del-item', (function () {
        var id = $(this).data('id');
        $.ajax({
            method: "GET",
            url: "/cart/del-item",
            data: {
                'id': id
            },
            success: function (result) {
                if (!result) {
                    console.log('result is empty');
                    return false;
                }
                showCart(result);
            },
            error: function () {
                alert('error');
            }
        });

    }));
    body.on('click', '.show-cart', (function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        $.ajax({
            method: "GET",
            url: "/cart/show-cart",
            success: function (result) {
                if (!result) {
                    console.log('result is empty');
                    return false;
                }
                showCart(result);
            },
            error: function () {
                alert('error');
            }
        });

    }));

    $(function () {
        $.scrollUp({
            scrollName: 'scrollUp', // Element ID
            scrollDistance: 300, // Distance from top/bottom before showing element (px)
            scrollFrom: 'top', // 'top' or 'bottom'
            scrollSpeed: 300, // Speed back to top (ms)
            easingType: 'linear', // Scroll to top easing (see http://easings.net/)
            animation: 'fade', // Fade, slide, none
            animationSpeed: 200, // Animation in speed (ms)
            scrollTrigger: false, // Set a custom triggering element. Can be an HTML string or jQuery object
            //scrollTarget: false, // Set a custom target element for scrolling to the top
            scrollText: '<i class="fa fa-angle-up"></i>', // Text for element, can contain HTML
            scrollTitle: false, // Set a custom <a> title if required.
            scrollImg: false, // Set true to use image
            activeOverlay: false, // Set CSS color to display scrollUp active point, e.g '#00FFFF'
            zIndex: 2147483647 // Z-Index for the overlay
        });
    });
});
