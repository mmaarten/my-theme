const CopyPlugin = require('copy-webpack-plugin');
const defaultConfig = require('@wordpress/scripts/config/webpack.config');

module.exports = {
	...defaultConfig,
	entry : {
    'main-script': './assets/scripts/main.js',
    'main-style': './assets/styles/main.scss',
    'editor-normalization': './assets/styles/editor-normalization.scss',
    'editor-script': './assets/scripts/editor.js',
    'editor-style': './assets/styles/editor.scss',
    'blocks-script': './assets/scripts/blocks.js',
    'blocks-style': './assets/styles/blocks.scss',
    'customizer': './assets/scripts/customizer.js',
    'popper': './assets/scripts/popper.js',
    'bootstrap': './assets/scripts/bootstrap.js',
  },
  plugins : [
    ...defaultConfig.plugins,
    new CopyPlugin({
      patterns: [
        { from: './assets/images/', to: 'images/', noErrorOnMissing: true, globOptions: { dot: false } },
        { from: './assets/fonts/', to: 'fonts/', noErrorOnMissing: true, globOptions: { dot: false } },
      ],
    }),
  ],
};
