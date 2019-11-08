import $ from 'jquery';

export default class Navbar {
  constructor(elemId) {
    this.elem = document.getElementById(elemId);
    this.originalTheme = this.getTheme();
  }

  getTheme() {
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

  setTheme(className) {
		$( this.elem ).removeClass( this.getTheme() ).addClass( className );
  }

  restoreTheme() {
		this.setTheme( this.originalTheme );
  }
}
