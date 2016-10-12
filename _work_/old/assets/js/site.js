var $globule = $('.globule'),
$globOutline = $('.glob-outline'),
$mainNav = $('#main-nav'),
$footer = $('footer'),
$content = $('#content'),
window_width = $(window).width();

// Sizing Globules - Based on page width; Duration defaults at 1100
function sizeGlobs() {
    if (window_width >= 1200) {
        $globOutline.animate({
            width: '170px',
            height: '170px',
            left: '0px',
            top: '0px'
        }, 1100, 'easeOutBounce');
    }
    else if (window_width >= 980) {
        $globOutline.animate({
            width: '140px',
            height: '140px',
            left: '0px',
            top: '0px'
        }, 1100, 'easeOutBounce', function() {
            $globOutline.css({
                width: '170px',
                height: '170px'
            });
        });

    }
    else {
        $globOutline.animate({
            width: '170px',
            height: '170px',
            left: '0px',
            top: '0px'
        }, 1100, 'easeOutBounce')
    }

    $globule.height($globule.width());
};

// Landing Page set up
function landingPage() {
    var windowHeight = $(window).height(),
    footerHeight = $footer.outerHeight(),
    emptySpace = Math.ceil(windowHeight - $mainNav.outerHeight() - footerHeight),
    marginTop = Math.floor(emptySpace / 2),
    marginBottom = Math.ceil(emptySpace / 2),
    $landingPage = $('#landingPage');

    $mainNav.css({
        'margin-top': marginTop,
        'margin-bottom': marginBottom + 28
    });
};

// Page Load Events - Sets up 'Landing Page' if scroll is at top of page and sizes the globules OR just sizes the globules
$(window).load(function(){
    if (window_width > 980 && window.location.hash == '') {
        $('body').css({
            'overflow': 'hidden'
        });
        landingPage();
    };

    sizeGlobs();

    $mainNav.css({
        'visibility': 'visible'
    });
    $content.css({
        'visibility': 'visible'
    });

});

// Exit 'Landing Page'
$('.section_name').click(function(){
    $('body').css({
        'overflow': 'inherit'
    });
    $mainNav.css({
        'margin-top': '0',
        'margin-bottom': '0'
    });


});

// Twiiter Bootstrap Settings and Modifications
// Carousel
$('#myCarousel').carousel({
    interval: 4000
});

// 'Experience' Tool Tips
$('.bar').tooltip()

// Mobile Menu - Hide after selecting item
$('.navbar .nav > li').click(function(){
    $('.navbar .nav > li').removeClass('active');
    $(this).addClass('active');
    $('.collapse').collapse('hide');
});




var options = {
    beforeSubmit:  validate,  // pre-submit callback
    success:       showResponse,  // post-submit callback
    resetForm: true        // reset the form after successful submit
};

$('#contact_us').ajaxForm(options);

function showResponse(responseText, statusText){
    $("#contact_us_ok").fadeIn("slow");
    setTimeout(function() {
        $("#contact_us_ok").fadeOut("slow");
    }, 3000);
}

function validate(formData, jqForm, options) {
    
    var nameValue = $('input[name=contact_name]').fieldValue();
    var emailValue = $('input[name=contact_email]').fieldValue();
    var messageValue = $('textarea[name=contact_message]').fieldValue();

    var correct = true;

    if (!nameValue[0]) {
        $(".error1").fadeIn("slow");
        correct = false;
    } else {
        $(".error1").fadeOut("slow");
    }

    if (!emailValue[0]) {
        $(".error2").fadeIn("slow");
        correct = false;
    } else {
        $(".error2").fadeOut("slow");
    }
    
    if (!messageValue[0]) {
        $(".error3").fadeIn("slow");
        correct = false;
    } else {
        $(".error3").fadeOut("slow");
    }
    setTimeout(function() {
        $(".alert-error").fadeOut("slow");
    }, 3000);
    
    if (!correct) {
        return false;
    }
}
