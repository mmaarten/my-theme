import $ from 'jquery';

export default class StickyHeader {
  static init() {
    this.elem = document.getElementById( 'sticky-header' );
		this.spacer = document.createElement( 'div' );
		this.adminBar = document.getElementById( 'wpadminbar' );

		this.isStuck = false;
		this.bottom  = this.elem.offsetTop + this.elem.offsetHeight;

		if ( this.adminBar ) {
			this.adminBar.style.position = 'absolute';
		}

		window.addEventListener( 'scroll', this.update.bind( this ) );

		this.update();
  }

	static stick() {
		// Stop when already stuck
		if ( this.isStuck ) {
			return;
		}

		// Update spacer height
		this.spacer.style.height = this.elem.offsetHeight + 'px';

		// Add spacer to DOM
		this.elem.parentElement.insertBefore( this.spacer, this.elem );

		// Add sticky class
		this.elem.classList.add( 'is-stuck' );

		// Update state
		this.isStuck = true;

		// Notify
		$( document.body ).trigger( 'my-theme.masthead.stuck', [ this.isStuck ] );
	};

	static unstick() {
		// Stop when already unstuck
		if ( ! this.isStuck ) {
			return;
		}

		// Remove spacer from DOM
		this.elem.parentElement.removeChild( this.spacer );

		// Remove sticky class
		this.elem.classList.remove( 'is-stuck' );

		// Update state
		this.isStuck = false;

		// Notify
		$( document.body ).trigger( 'my-theme.masthead.unstuck', [ this.isStuck ] );
	};

	static update() {
		var scrollTop = $( document ).scrollTop();

		if ( scrollTop > this.bottom ) {
			this.stick();
		}

		else if ( scrollTop <= Math.max( this.bottom - this.elem.offsetHeight, 0 ) ) {
			this.unstick();
		}
	};

}

StickyHeader.init();
