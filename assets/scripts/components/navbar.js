import $ from 'jquery';

export default class Navbar {
  static init() {
    this.elem = document.getElementById('main-navigation');
    this.originalTheme = this.getTheme();
  }

  static getTheme() {
    let className = [];

		// get `navbar-light` or `navbar-dark`
		const m1 = this.elem.className.match( /(?:^| )(navbar-(?:light|dark))(?: |$)/ );
		if ( m1 ) {
			className.push( m1[1] );
		}

		// get `bg-{slug}`
		const m2 = this.elem.className.match( /(?:^| )(bg-[\w-]+)(?: |$)/ );
		if ( m2 ) {
			className.push( m2[1] );
		}

		// Return string
		return className.join( ' ' );
  }

  static setTheme(className) {
		$( this.elem ).removeClass( this.getTheme() ).addClass( className );
  }

  static restoreTheme() {
		this.setTheme( this.originalTheme );
  }
}

Navbar.init();
