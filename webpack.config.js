const defaultConfig = require( '@wordpress/scripts/config/webpack.config' );

module.exports = {
	...defaultConfig,
	entry : {
    'main': [ './assets/styles/main.scss', './assets/scripts/main.js' ],
    'editor-normalization': './assets/styles/editor-normalization.scss',
    'editor': [ './assets/scripts/editor.js', './assets/styles/editor.scss' ],
    'blocks': [ './assets/scripts/blocks.js', './assets/styles/blocks.scss' ],
    'customizer': './assets/scripts/customizer.js',
    'popper': './assets/scripts/popper.js',
    'bootstrap': './assets/scripts/bootstrap.js',
  },
};
