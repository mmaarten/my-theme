/**
 * Sticky Header
 */
(function( $ )
{
	'use strict';

	var elem, spacer, adminBar, isStuck, bottom;

	var init = function()
	{
		elem     = document.getElementById( 'sticky-header' );
		spacer   = document.createElement( 'div' );
		adminBar = document.getElementById( 'wpadminbar' );

		isStuck = false;
		bottom  = elem.offsetTop + elem.offsetHeight;

		if ( adminBar )
		{
			adminBar.style.position = 'absolute';
		}

		window.addEventListener( 'scroll', update.bind( this ) );

		update();
	};

	document.addEventListener( 'DOMContentLoaded', init );

	var stick = function()
	{
		// Stop when already stuck
		if ( isStuck )
		{
			return;
		}

		// Update spacer height
		spacer.style.height = elem.offsetHeight + 'px';

		// Add spacer to DOM
		elem.parentElement.insertBefore( spacer, elem );

		// Add sticky class
		elem.classList.add( 'is-stuck' );

		// Update state
		isStuck = true;

		// Notify
		$( document.body ).trigger( 'theme.masthead.stuck', [ isStuck ] );
	};

	var unstick = function()
	{
		// Stop when already unstuck
		if ( ! isStuck )
		{
			return;
		}

		// Remove spacer from DOM
		elem.parentElement.removeChild( spacer );

		// Remove sticky class
		elem.classList.remove( 'is-stuck' );

		// Update state
		isStuck = false;

		// Notify
		$( document.body ).trigger( 'theme.masthead.unstuck', [ isStuck ] );
	};

	var update = function()
	{
		var scrollTop = $( document ).scrollTop();

		if ( scrollTop > bottom )
		{
			stick();
		}

		else if ( scrollTop <= Math.max( bottom - elem.offsetHeight, 0 ) )
		{
			unstick();
		}
	};

})( jQuery );
