var counter = 0;
var animateSpeed = 3000;
var timer;
var slidesCount = 0;
var controlsType = 'bullets';
var sliderWidth = 'inherit';
var sliderHeight = 'inherit';
var sliderArrows = true;
var sliderEffect = 'fade';
var transitionSpeed = 1;


$(document).ready(function(){
    var viewport;
    animateSpeed = parseInt($('.slider').attr('data-animate-speed')) * 1000;
    transitionSpeed = parseInt($('.slider').attr('data-transition-speed'));

    controlsType = $('.slider').attr('data-controls-type');
    sliderWidth  = $('.slider').attr('data-width');
    sliderHeight = $('.slider').attr('data-height');
    sliderArrows = $('.slider').attr('data-arrows');
    sliderEffect = $('.slider').attr('data-effect');
    //var minSliderHeight = $( window ).height() - $( 'header' ).height() - $( '.navbar-fixed-bottom' ).height();

    var $slider = $('.slider');
    if(animateSpeed == 0) animateSpeed = 5000;

    viewport = get_viewport(sliderWidth, sliderHeight);

    /**Resize*/
    $(window).resize(function(){
        viewport = get_viewport(sliderWidth, sliderHeight);
        resize_viewport();
    });

    $('.slider div.slide').wrapAll('<div class="slider-inner">');

    $('.slider div.slide').each(function(){
        var imgSrc 		= $(this).attr('data-img');
        var link 		= $(this).attr('data-link');
        var slideHtml 	= $(this).html();
        slidesCount++;
        $('.slider-inner').append('<div class="slide ' + slidesCount + '" style="opacity: 0;"><img alt="slide" class="slide-image slide-image' + slidesCount + '" src="' + imgSrc + '" data-bgfit="cover" data-bgposition="left top" data-bgrepeat="no-repeat" >' + slideHtml + '</div>');

        $(this).remove();
    });

    if(counter++ == 0)
    {
        setTimeout(function(){
            timerStart('start');
            slide(1, 0);
        }, 100);
    }

    /**BULLETS*/
    for(var i = slidesCount; i > 0; i--){
        switch (controlsType){
            case 'thumbs' :
                $('.slider').prepend('<div class="slider-handler slider-handler-images" data-id="' + i + '"><img src="' + $('.slide-image' + i).attr('src') + '"></div>');
                break;

            case 'numbers' :
                $('.slider').prepend('<div class="slider-handler" data-id="' + i + '">' + i + '</div>');
                break;

            case 'bullets' :
                $('.slider').prepend('<div class="slider-handler" data-id="' + i + '"></div>');
                break;
        }
    }

    $('.slider-handler').wrapAll('<div class="slider-handler-wrapper"><div class="slider-handler-wrapper-inner">');

    //$('.slider').css('height', minSliderHeight);
    //$('.slider-image img.slide-image-').css('min-height', minSliderHeight);

    //counter = 1;



    $(document).on('mouseenter', '.slider-handler', function(){
        var slideOld = counter;
        counter = $(this).attr('data-id');
        slide(counter,slideOld);
        timerStart('stop');
    });

    $(document).on('mouseleave', '.slider-handler', function(){
        timerStart('start');
    });


    if(sliderEffect == 'slide'){

    }

    if(viewport.width > viewport.height){
        if(viewport.width/2 > viewport.height)
            $('.slide-image').css({'min-width' : '100%', 'width': '100%', 'height' : 'auto'});
        else
            $('.slide-image').css({'min-width' : '100%', 'width': 'auto', 'height' : '100%'});

        $("img.slide-image").last().load(function() {
            $('.slide-image').each(function() {
                var diff_height = viewport.height - $(this).height();
                var diff_width = viewport.width - $(this).width();
                $(this).css({'top' : diff_height/2, 'left' : diff_width/2});
            });
        });
    }
    else
    {
        $('.slide-image').css({'width' : 'auto', 'height': '100%', 'top' : 0});
        $("img.slide-image").last().load(function() {
            $('.slide-image').each(function() {
                var diff_height = viewport.height - $(this).height();
                var diff_width = viewport.width - $(this).width();
                $(this).css({'top' : diff_height/2, 'left' : diff_width/2});
            });
        });
    }

    $('.slide').css({'transition' : transitionSpeed + 's'});


    var controlsPosition = $('.slider').attr('data-controls-position');
    var controlsInline = $('.slider').attr('data-controls-inline');
    if(controlsInline == 'false') $('.slider-handler').css({'display' : 'block'})

    var controlsPos = controlsPosition.split(' ');

    if(controlsPos[0].indexOf("%") > 0)
        $('.slider-handler-wrapper').css({'left' : controlsPos[0] });
    else
    if(controlsPos[0] !== 'center')
        $('.slider-handler-wrapper-inner').css({'float' : controlsPos[0]});
    else
        $('.slider-handler-wrapper-inner').css({'margin' : '5px auto'});

    if(controlsPos[1].indexOf("%") > 0)
        $('.slider-handler-wrapper').css({'top' : controlsPos[1] });
    else
        switch (controlsPos[1]) {
            case 'top'    : $('.slider-handler-wrapper').css({'top' : '0'});  break;
            case 'center' : $('.slider-handler-wrapper').css({'top' : (viewport.height - $('.slider-handler-wrapper-inner').height())/2}); break;
            case 'bottom' : $('.slider-handler-wrapper').css({'bottom' : '0'}); break;
        }


    if(sliderArrows == 'true'){
        $slider.prepend('<div class="arrow-left"><span>&lsaquo;</span></div><div class="arrow-right"><span>&rsaquo;</span></div>');
    }

    $(document).on('click', '.arrow-left', function(){
        var slideOld = counter;
        counter--;
        if(counter == 0) counter = slidesCount;
        slide(counter,slideOld);
        timerStart('start');
    });

    $(document).on('click', '.arrow-right', function(){
        var slideOld = counter;
        counter++;
        if(counter == slidesCount + 1) counter = 1;
        slide(counter,slideOld);
        timerStart('start');
    });

    $(document).on('mouseleave', '.arrow-right', function(){timerStart('start');});
    $(document).on('mouseleave', '.arrow-left', function(){timerStart('start');});
});


function get_viewport(sliderWidth, sliderHeight){
    window.viewport = {'width' : $(window).width(), 'height' : $(window).height()};
    $('.slider').css({'width' : viewport.width, 'height' : viewport.height});

    if(sliderWidth != 'fullscreen' || sliderHeight != 'fullscreen')
        $('.slider').parent().css('position', 'relative');

    if(sliderWidth == 'inherit'){
        viewport.width = $('.slider').parent().width();
        $('.slider').css({'width' : viewport.width});
    }

    if(sliderHeight == 'inherit'){
        viewport.height = $('.slider').parent().height();
        $('.slider').css({'height' : viewport.height});
    }

    if(sliderWidth != 'inherit' && sliderWidth != 'fullscreen'){
        viewport.width = sliderWidth;
        $('.slider').css({'width' : sliderWidth});
    }

    if(sliderHeight != 'inherit' && sliderHeight != 'fullscreen'){
        viewport.height = sliderHeight;
        $('.slider').css({'height' : sliderHeight});
    }
    return viewport;
}

function resize_viewport(){
    if(viewport.width > viewport.height){
        if(viewport.width/2 > viewport.height)
            $('.slide-image').css({'min-width' : '100%', 'width': '100%', 'height' : 'auto'});
        else
            $('.slide-image').css({'min-width' : '100%', 'width': 'auto', 'height' : '100%'});

        $('.slide-image').each(function() {
            var diff_height = viewport.height - $(this).height();
            var diff_width = viewport.width - $(this).width();
            $(this).css({'top' : diff_height/2, 'left' : diff_width/2});
        });
    }
    else
    {
        $('.slide-image').css({'width' : 'auto', 'height': '100%', 'top' : 0,  'top' : 0, 'left' : 0});

        $('.slide-image').each(function() {
            var diff_height = viewport.height - $(this).height();
            var diff_width = viewport.width - $(this).width();
            $(this).css({'top' : diff_height/2, 'left' : diff_width/2});
        });
    }
}


/**
 * function sliding slides
 * @param slide int with new slide
 * @param slideOld int with old slide
 */
function slide(slide, slideOld){
    console.log(slide + ' ' + slideOld);
    if(window.sliderEffect == 'fade'){
        $('.slide.' + slideOld).css({'opacity':'0', 'z-index': '0'});
        $('.slide.' + slide).css({'opacity':'1', 'z-index': '1'});
    }

    if(window.sliderEffect == 'slide'){
        /*
         $('.slide.' + slideOld).css({'opacity':'0', 'transition' : transitionSpeed, 'left':viewport.width * -1, 'z-index': '0'});
         $('.slide.' + slide).css({'opacity':'1', 'z-index': '1'});

         setTimeout(function(){
         $('.slide.' + slideOld).css({'transition' : 0, 'left':0});
         }, animateSpeed)
         */

    }

    $('.active-slide').removeClass('active-slide');
    $('[data-id="' + slide + '"]').addClass('active-slide');

    /**Looping each div in current slide*/
    /** var speed -- speed of animation
     *  var start_from -- starting position of labels
     *  var what_to_do -- what need to do with labels
     */
    $('.slide.' + slide + ' div').each(function(){
        var curr        = $(this);
        var speed       = curr.attr('data-speed');
        var start_from  = curr.attr('data-start-from');
        var what_to_do  = curr.attr('data-move-to');

        /**Checking if exists starting position in current label*/
        if(typeof start_from !== 'undefined'){
            start_from = start_from.split(';');
            curr.css({'left' : start_from[0] + '%', 'top' : start_from[1] + '%'});
        }

        /**Checking if exists what to do in current label*/
        if(typeof what_to_do !== 'undefined'){
            what_to_do = what_to_do.split(';');

            /**Little pause before start animation */
            setTimeout(function(){
                curr.css({'transition' : speed + 's', 'left' : what_to_do[0] + '%', 'top' : what_to_do[1] + '%'});
            }, 1000)

            setTimeout(function(){
                //console.log(curr.parent());curr.parent().html('');
                curr.css({'transition' : 0 + 's', 'left' : start_from[0] + '%', 'top' : start_from[1] + '%'});
            }, animateSpeed)
        }
    });
}



/**
 * Timer Actions
 * @param action start/stop timer
 */
function timerStart(action){
    clearTimeout(timer);
    if(action == 'start'){
        timer = setInterval(function()
        {
            var slideOld = counter;
            counter++;

            if(counter == slidesCount + 1) counter = 1;
            slide(counter, slideOld);
        }, animateSpeed);
    }

    if(action == 'stop')
        clearTimeout(timer);
}