$(function() {
 $('#navigation li').stop().animate({'marginLeft':'10px'},1000);
 
 $('#navigation').hover(
  function () {
   $('li',$(this)).stop().animate({'marginLeft':'-300px'},500);
  },
  function () {
   $('li',$(this)).stop().animate({'marginLeft':'10px'},500);
  }
 );
});
