
/*bouncing infinitely at intervals*/
$(function() {
    setInterval(function() {
        var animationName = 'animated bounce';
        var animationend = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';
        $('#introButton').addClass(animationName).one(animationend, function() {
            $(this).removeClass(animationName);
        });
    }, 5000);
});

var tl = new TimelineMax();
tl.staggerFrom(".rez", 0.5, {opacity:0, cycle:{x:function(i){return i*40;}, ease:function(i){return Back.easeOut;}}}, 0.2);
tl.timeScale(0.5);

//scrollmagic animations
var controller = new ScrollMagic.Controller();

new ScrollMagic.Scene({
    triggerElement: "#header",
    triggerHook: "onLeave"
})
    .setPin("#header")
    .addTo(controller);

new ScrollMagic.Scene({
    triggerElement: "#header",
    triggerHook: "onLeave"
})
    .setPin("#shopNav")
    .addTo(controller);

new ScrollMagic.Scene({
    triggerElement: "#BMResults",
    triggerHook: "onCenter",
    reverse: false
})
    .setTween(tl)
    .addTo(controller);

new ScrollMagic.Scene({
    triggerElement: "#whoAreWe h1",
    triggerHook: "onCenter",
    offset: -150,
    reverse: false
})
    .setTween(TweenMax.from("#whoAreWe h1", 1, {x: -450, autoAlpha: 0.0, ease: Power1.easeIn}))
    .addTo(controller);

new ScrollMagic.Scene({
    triggerElement: ".whoAreWe",
    triggerHook: "onCenter",
    offset: -150,
    reverse: false
})
    .setTween(TweenMax.from(".whoAreWe", 1.2, {y: -400, autoAlpha: 0.0, ease: Power1.easeIn}))
    .addTo(controller);

new ScrollMagic.Scene({
    triggerElement: "#fcc",
    triggerHook: "onCenter",
    offset: -400,
    reverse: false
})
    .setTween(TweenMax.from("#fcc", 0.6, {y: 350, autoAlpha: 0.0, ease: Power4.easeOut}))
    .addTo(controller);

new ScrollMagic.Scene({
    triggerElement: "#wlt",
    triggerHook: "onCenter",
    offset: -400,
    reverse: false
})
    .setTween(TweenMax.from("#wlt", 0.6, {y: 350, autoAlpha: 0.0, ease: Power4.easeIn}))
    .addTo(controller);

new ScrollMagic.Scene({
    triggerElement: "#dmp",
    triggerHook: "onCenter",
    offset: -400,
    reverse: false
})
    .setTween(TweenMax.from("#dmp", 0.6, {y: 350, autoAlpha: 0.0, ease: Power4.easeIn}))
    .addTo(controller);

new ScrollMagic.Scene({
    triggerElement: "#ofd",
    triggerHook: "onCenter",
    offset: -400,
    reverse: false
})
    .setTween(TweenMax.from("#ofd", 0.6, {y: 350, autoAlpha: 0.0, ease: Power4.easeOut}))
    .addTo(controller);

new ScrollMagic.Scene({
    triggerElement: "#bmi",
    triggerHook: "onCenter",
    offset: -400,
    reverse: false
})
    .setTween(TweenMax.from("#bmi", 0.6, {y: 350, autoAlpha: 0.0, ease: Power4.easeOut}))
    .addTo(controller);

new ScrollMagic.Scene({
    triggerElement: ".inl1",
    triggerHook: "onEnter",
    reverse: false
})
    .setTween(TweenMax.from(".inl1", 0.8, {x: 400, scale: 0.6, autoAlpha: 0.0, ease: Power2.easeOut}))
    .addTo(controller);

new ScrollMagic.Scene({
    triggerElement: ".inl2",
    triggerHook: "onEnter",
    reverse: false
})
    .setTween(TweenMax.from(".inl2", 0.8, {x: 400, scale: 0.6, autoAlpha: 0.0, ease: Power2.easeOut}))
    .addTo(controller);

new ScrollMagic.Scene({
    triggerElement: ".basic",
    triggerHook: "onEnter",
    reverse: false
})
    .setTween(TweenMax.from(".basic", 1, {x: -400, autoAlpha: 0.0, ease: Power2.easeOut}))
    .addTo(controller);

new ScrollMagic.Scene({
    triggerElement: ".premium",
    triggerHook: "onEnter",
    reverse: false
})
    .setTween(TweenMax.from(".premium", 1, {x: 400, autoAlpha: 0.0, ease: Power2.easeOut}))
    .addTo(controller);