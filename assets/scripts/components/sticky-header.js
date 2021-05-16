import $ from 'jquery';

(function(){

  var elem = document.getElementById( 'sticky-header' );
  var spacer = document.createElement( 'div' );
  var adminBar = document.getElementById( 'wpadminbar' );

  var isStuck = false;
  var bottom  = elem.offsetTop + elem.offsetHeight;

  if (adminBar) {
    adminBar.style.position = 'absolute';
  }

  window.addEventListener( 'scroll', function() {
    var scrollTop = document.documentElement.scrollTop;

		if (! isStuck && scrollTop > bottom) {
  		spacer.style.height = elem.offsetHeight + 'px';
  		elem.parentElement.insertBefore(spacer, elem);
  		elem.classList.add('is-stuck');
  		isStuck = true;
      $(document.body).trigger('header.stuck');
		} else if (isStuck && scrollTop <= Math.max(bottom - elem.offsetHeight, 0)) {
  		elem.parentElement.removeChild(spacer);
  		elem.classList.remove('is-stuck');
  		isStuck = false;
      $(document.body).trigger('header.unstuck');
		}
  });

})();
