

function main() {

    (function () {
        'use strict';

            $(window).bind('scroll', function() {
                var navHeight = $(window).height() - 100;
                if ($(window).scrollTop() > navHeight) {
                    $('.navbar-default').addClass('on');
                } else {
                    $('.navbar-default').removeClass('on');
                }
            });

            $('body').scrollspy({
                target: '.navbar-default',
                offset: 80
            })

    }());

}
main();




/**********
 MOBILE MENU
 **********/
$('.menu-toggle').click(function(e){
    //click event for left clicks only! http://www.jacklmoore.com/notes/click-events
    if (!(e.which > 1 || e.shiftKey || e.altKey || e.metaKey)) {
        e.preventDefault();
        if($(this).parent().find('.menu').hasClass('expanded-mobile-menu')){
            $(this).removeClass('expanded-menu-toggle').parent().removeClass('nav-expanded').find('.menu').removeClass('expanded-mobile-menu');
        }else{
            $(this).addClass('expanded-menu-toggle').parent().addClass('nav-expanded').find('.menu').addClass('expanded-mobile-menu');
        }
    }
});


/**
 * If a user uploaded a Photo Banner Image for a Travel Flyer, then hide the Dropzone file form.
 * -- this script belongs in 'travelflyers/show.blade.php, and profile/index.blade.php' --
 */
if($('#Banner-image').length){
    $('#FlyerBannerFormUpload').hide();
}


/**
 * When an image is uploaded, the user who owns the flyer photos can delete them by clicking the X button
 * -- this script belongs in 'travelflyers/show.blade.php' --
 */
$('.img-wrap .close').on('click', function() {
    var id = $(this).closest('.img-wrap').find('img').data('id');
});

/**
 * If a user uploaded a Profile Image for their Profile, then hide the Dropzone file form.
 * -- this script belongs in 'profile/index.blade.php' --
 */
if($('#Profile-image').length){
    $('#ProfileFormUpload').hide();
}


/**
 * Count the letter in the Travel Flyer description textarea.
 */
$(document).ready(function() {
    var text_max = 3000;
    $('#textarea_count').html(text_max + ' characters remaining');

    $('#description').keyup(function() {
        var text_length = $('#description').val().length;
        var text_remaining = text_max - text_length;

        $('#textarea_count').html(text_remaining + ' characters remaining');
    });
});


/**
 * Shows a hover effect on thumb liked and thumb like incTravel Flyer show blade.
 */
$('#thumbs-popup')
    .popup({
        popup : $('#popup2'),
        on    : 'hover',
        hoverable: true
    });


$('#thumbs-like-popup')
    .popup({
        popup : $('#popup1'),
        on    : 'hover',
        hoverable: true
    });


/**
 * This is used in the public statuses section | users/index.blade.php.
 * When a user posts a status, page refreshes, and keeps its scroll position.
 */
(function($){

    /**
     * Store scroll position for and set it after reload
     *
     * @return {boolean} [loacalStorage is available]
     */
    $.fn.scrollPosReaload = function(){
        if (localStorage) {
            var posReader = localStorage["posStorage"];
            if (posReader) {
                $(window).scrollTop(posReader);
                localStorage.removeItem("posStorage");
            }
            $(this).click(function(e) {
                localStorage["posStorage"] = $(window).scrollTop();
            });

            return true;
        }

        return false;
    };

    /* ================================================== */

    $(document).ready(function() {
        // Feel free to set it for any element who trigger the reload
        $('form').scrollPosReaload();
    });

}(jQuery));



//# sourceMappingURL=main.js.map
