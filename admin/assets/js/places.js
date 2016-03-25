jQuery.noConflict();
var Places = (function($) {
    var outer = [],
        inner = [];
    inner.events = function () {
        $(document).on('click', '#wards-all, #divs-all', function (){

        });
        $(document).on('click', '#wards-none, #divs-none', function (){
            
        });
        $(document).on('click', '#wards-send, #divs-send', function (){
            
        });
    };
    inner.build = function() {
        $("#selectcontrol").MultiColumnSelect({
            multiple: true, // Single or Multiple Select- Default Single
            useOptionText: true, // Use text from option. Use false if you plan to use images
            hideselect: true, // Hide Original Select Control
            openmenuClass: 'mcs-open', // Toggle Open Button Class
            openmenuText: 'Filter by Ward', // Text for button
            openclass: 'open', // Class added to Toggle button on open
            containerClass: 'mcs-container', // Class of parent container
            itemClass: 'mcs-item', // Class of menu items
            idprefix: '', // Assign as ID to items eg 'item-' = #item-1, #item-2, #item-3...
            duration: 200, //Toggle Height duration
            onOpen: function() {},
            onClose: function() {},
            onItemSelect: function() {}
        });
        $('#selectcontrol').MultiColumnSelectAddItem('all','All','wards-');
        $('#selectcontrol').MultiColumnSelectAddItem('none','None','wards-');
        $('#selectcontrol').MultiColumnSelectAddItem('invert','Invert','wards-');
        $('#selectcontrol').MultiColumnSelectAddItem('submit','Submit','wards-');
        $("#selectcontrol2").MultiColumnSelect({
            multiple: true, // Single or Multiple Select- Default Single
            useOptionText: true, // Use text from option. Use false if you plan to use images
            hideselect: true, // Hide Original Select Control
            openmenuClass: 'mcs-open', // Toggle Open Button Class
            openmenuText: 'Filter by Division', // Text for button
            openclass: 'open', // Class added to Toggle button on open
            containerClass: 'mcs-container', // Class of parent container
            itemClass: 'mcs-item', // Class of menu items
            idprefix: 'divs-', // Assign as ID to items eg 'item-' = #item-1, #item-2, #item-3...
            duration: 200, //Toggle Height duration
            onOpen: function() {},
            onClose: function() {},
            onItemSelect: function() {}
        });
        $('#selectcontrol2').MultiColumnSelectAddItem('divs-all','All','');
        $('#selectcontrol2').MultiColumnSelectAddItem('divs-none','None','');
        $('#selectcontrol2').MultiColumnSelectAddItem('divs-none','Invert','');
        $('#selectcontrol2').MultiColumnSelectAddItem('divs-send','Submit','');        
    };
    outer.init = function() {
        inner.build();
    };
    return outer;
})(jQuery);
window.addEvent('domready', function() {
    Places.init();
});
