var scale = 1.0;
function bind_scale_events(){
  $("#event_view").bind('mousewheel DOMMouseScroll', function(event){
    scale+=event.originalEvent.wheelDelta/260*scale;
    if (scale<0.7) scale = 0.7;
    if (scale>1.5) scale = 1.5;
    $("#event_view").css("transform","scale("+scale+")")
    //$(window).scrollTop($(window).scrollTop()/scale);
    //$(window).scrollLeft($(window).scrollLeft()/scale);
  });
  $("#event_view").on({
      'mousemove': function(e) {
          clicked && updateScrollPos(e);
      },
      'mousedown': function(e) {
          clicked = true;
          clickY = e.pageY;
          clickX = e.pageX;
          console.log(e.pageY);
      },
      'mouseup': function() {
          clicked = false;
      }
  });
}
var clicked = false, clickY,clickX;

var updateScrollPos = function(e) {
  $(window).scrollTop($(window).scrollTop() + (clickY - e.pageY));
  $(window).scrollLeft($(window).scrollLeft() + (clickX - e.pageX));
}
