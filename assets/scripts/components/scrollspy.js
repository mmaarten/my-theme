import $ from 'jquery';
const URL = require('url');

// Sanitize navigation links
$('#main-navigation a.nav-link').each(function(){

  var url = URL.parse(this.href);

  // Check if url refers to current page.
  if (url.hostname + url.pathname != window.location.hostname + window.location.pathname) {
    return true;
  }

  // Check hash.
  if (! url.hash) {
    return true;
  }

  // Set hash only
  this.setAttribute('href', url.hash);

  // Remove active state.
  $(this).closest('.menu-item').removeClass('active');
});

$('body').scrollspy({
  target: '#main-navigation'
});
