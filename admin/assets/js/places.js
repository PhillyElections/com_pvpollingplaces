jQuery.noConflict();
var Places = (function($) {
    var outer = [],
        inner = [];
    outer.init = function() {
        $("#selectcontrol").MultiColumnSelect({
            multiple: true, // Single or Multiple Select- Default Single
            useOptionText: true, // Use text from option. Use false if you plan to use images
            hideselect: true, // Hide Original Select Control
            openmenuClass: 'mcs-open', // Toggle Open Button Class
            openmenuText: 'Filter by Ward', // Text for button
            openclass: 'open', // Class added to Toggle button on open
            containerClass: 'mcs-container', // Class of parent container
            itemClass: 'mcs-item', // Class of menu items
            idprefix: 'wards-', // Assign as ID to items eg 'item-' = #item-1, #item-2, #item-3...
            duration: 200, //Toggle Height duration
            onOpen: function() {},
            onClose: function() {},
            onItemSelect: function() {}
        });
        $('#selectcontrol').MultiColumnSelectAddItem('wards-all','All','');
        $('#selectcontrol').MultiColumnSelectAddItem('wards-none','None','');
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
        $('#selectcontrol').MultiColumnSelectAddItem('divs-all','All','');
        $('#selectcontrol').MultiColumnSelectAddItem('divs-none','None','');
    };
    return outer;
})(jQuery);
window.addEvent('domready', function() {
    Places.init();
});
