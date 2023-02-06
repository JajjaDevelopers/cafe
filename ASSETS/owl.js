$("document").ready(function(){
  $(".owl-carousel").owlCarousel(
    {
      nav:true,
      // navText:["Prev","Next"],
      navText:["<i class='fas fa-chevron-left'></i>",
      "<i class='fas fa-chevron-right'></i>"],
      slideBy:2,
      margin:10,
      autoplay:true,
      animateIn:"fadeIn",
      animateOut:"fadeOut",
      loop:true,
    }
  );
})