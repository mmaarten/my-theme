import $ from 'jquery';

export default class Navbar {
  static init() {
    this.elem = document.getElementById('main-navigation');
    this.originalTheme = this.getTheme();
  }

  static getTheme() {
    const classNames = [];

    var m = this.elem.className.match(/(?:^| )(navbar-(?:light|dark))(?: |$)/);

    if (m) {
      classNames.push( m[1] );
    }

    var m = this.elem.className.match(/(?:^| )(bg-[a-z]+)(?: |$)/);

    if (m) {
      classNames.push( m[1] );
    }

    return classNames.join( ' ' );
  }

  static setTheme( className ) {
    $(this.elem).removeClass( this.getTheme() ).addClass( className );
  }

  static restoreTheme() {
    $(this.elem).removeClass( this.getTheme() ).addClass( this.originalTheme );
  }
}

Navbar.init();
