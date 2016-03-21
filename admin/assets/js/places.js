window.addEvent('domready', function() {
  var combos = document.querySelectorAll('[data-action="submits"]');
  for (var i=0; i<combos.length; i++) {
    combos[i].addEventListener('blur', function() {document.getElementById('adminForm').submit();});    
  }
});
