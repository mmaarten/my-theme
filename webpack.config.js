const defaultConfig = require( '@wordpress/scripts/config/webpack.config' );

module.exports = {
	...defaultConfig,
	entry : {
    'main': [ './assets/styles/main.scss', './assets/scripts/main.js' ],
    'editor-normalization': './assets/styles/editor-normalization.scss',
    'editor-script': './assets/scripts/editor.js',
    'editor-style': './assets/styles/editor.scss',
    'blocks-script': './assets/scripts/blocks.js',
    'blocks-style': './assets/styles/blocks.scss',
    'customizer': './assets/scripts/customizer.js',
    'popper': './assets/scripts/popper.js',
    'bootstrap': './assets/scripts/bootstrap.js',
  },
};
