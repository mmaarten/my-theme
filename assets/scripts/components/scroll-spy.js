import $ from 'jquery';

const url = require('url');

(function(){

  // Make sure that navigation links that refer to the current page only have hashes.
  var currentURL = url.parse( window.location.href );

  const links = document.querySelectorAll('#main-navigation a');
  links.forEach(function(link){
    var linkURL = url.parse( link.getAttribute('href') );
    if (linkURL.hash && linkURL.origin === currentURL.origin && linkURL.pathname === currentURL.pathname ) {
      link.setAttribute('href', linkURL.hash);
    }
  });

  // Init scrollspy
  $('body').scrollspy({ target: '#main-navigation' });

})();
