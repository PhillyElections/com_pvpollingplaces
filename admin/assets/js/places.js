jQuery.noConflict();
var Places = (function () {
  var outer = [], inner = [], $;
  outer.init = function() {$=window.jQuery;};
  return outer;
})();
window.addEvent('domready', function() {
  console.log('in domready');
  Places.init();

jQuery("#selectcontrol").MultiColumnSelect({

            multiple:           true,              // Single or Multiple Select- Default Single
            useOptionText :     true,               // Use text from option. Use false if you plan to use images
            hideselect :        true,               // Hide Original Select Control
            openmenuClass :     'mcs-open',         // Toggle Open Button Class
            openmenuText :      'Choose An Option', // Text for button
            openclass :         'open',             // Class added to Toggle button on open
            containerClass :    'mcs-container',    // Class of parent container
            itemClass :         'mcs-item',         // Class of menu items
            idprefix : null,                        // Assign as ID to items eg 'item-' = #item-1, #item-2, #item-3...
            duration : 200,                         //Toggle Height duration
            onOpen : function(){},
            onClose : function(){},
            onItemSelect : function(){}

});

//Add item to selectbox
//jQuery('#selectcontrol, #selectcontrol2').MultiColumnSelectAddItem(OptionID,OptionValue,IDPrefix);


//Destroy plugin
//jQuery("#selectcontrol, #selectcontrol2").MultiColumnSelectDestroy();
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