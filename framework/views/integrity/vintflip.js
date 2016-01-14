jQuery(document).ready(function($) {

  //assign the classes to generate cards
  $("article").addClass("card");
  $(".truimg").addClass("front");
  $(".truimg").css("display","block");

  //setup CSS for card backs
  $(".card").each(function(){
    var w = $(this).find(".truimg").delay(100).css("width").toString().replace("px","");
    var h = $(this).find(".truimg").delay(100).css("height").toString().replace("px","");
    console.log(w);
    console.log(h);
    $(this).find(".back").css({
      "width":w,
      "height":h,
      "margin":"1.5em",
      "background-color":"#fff"
    });
  });

  //enable the flip with some settings
  $(".card").delay( 100 ).flip({
   trigger: 'hover',
   speed: 800
  });

  //remove auto-added CSS after flip is enabled
  $(".front").css("position", "");

});
