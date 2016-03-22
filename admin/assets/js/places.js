jQuery.noConflict();
var Places = (function () {
  var outer = [], inner = [], $;
  outer.init = function() {$=window.jQuery;};
  return outer;
})();
window.addEvent('domready', function() {
  Places.init();
});
// let's late-load jQuery
/*(function() {
    function async_load(){
        var s = document.createElement('script');
        s.type = 'text/javascript';
        s.async = true;
        s.src = '//ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js';
        var x = document.getElementsByTagName('script')[0];
        x.parentNode.insertBefore(s, x);

    }
    if (window.attachEvent)
        window.attachEvent('onload', async_load);
    else
        window.addEventListener('load', async_load, false);
})();*/