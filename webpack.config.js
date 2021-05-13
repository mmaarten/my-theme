const defaultConfig = require( '@wordpress/scripts/config/webpack.config' );

module.exports = {
	...defaultConfig,
	entry : {
    'main': [ './assets/styles/main.scss', './assets/scripts/main.js' ],
    'editor-normalization': './assets/styles/editor-normalization.scss',
    'editor': './assets/styles/editor.scss',
    'blocks': './assets/styles/blocks.scss',
    'customizer': './assets/scripts/customizer.js',
    'popper': './assets/scripts/popper.js',
    'bootstrap': './assets/scripts/bootstrap.js',
    'owl-carousel': [ './assets/styles/owl-carousel.scss', './assets/scripts/owl-carousel.js' ],
    'owl-carousel-theme': './assets/styles/owl-carousel-theme.scss',
    'fancybox': [ './assets/styles/fancybox.scss', './assets/scripts/fancybox.js' ]
  },
};
