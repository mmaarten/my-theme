const path = require('path');
const { argv } = require('yargs');
const webpack = require('webpack');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const UglifyJsPlugin = require('uglifyjs-webpack-plugin');
const OptimizeCssAssetsPlugin = require('optimize-css-assets-webpack-plugin');
const { CleanWebpackPlugin } = require('clean-webpack-plugin');
const { default: ImageminPlugin } = require('imagemin-webpack-plugin');
const imageminMozjpeg = require('imagemin-mozjpeg');
const WebpackBar = require('webpackbar');
const CopyWebpackPlugin = require('copy-webpack-plugin');
const defaultConfig = require('@wordpress/scripts/config/webpack.config');

module.exports = {
  ...defaultConfig,
  context: path.resolve(__dirname, 'assets'),
  entry : {
    'main': [ 'styles/main.scss', 'scripts/main.js' ],
    'editor-styles':  'styles/editor-styles.scss',
    'customizer': 'scripts/customizer.js',
  },
  output: {
    ...defaultConfig.output,
    filename: 'scripts/[name].js',
    path: path.resolve(__dirname, 'build'),
    publicPath: '/wp-content/themes/my-theme/build/',
  },
  resolve: {
    ...defaultConfig.resolve,
    // Directories where to look for modules
    modules: [
      path.resolve(__dirname, 'assets'),
      'node_modules',
    ],
    // Disable extensions filter
    enforceExtension: false,
  },
  // Exclude dependencies from the output bundles
  externals: {
    jquery: 'jQuery',
  },
  module:
  {
    ...defaultConfig.module,
    rules: [
      ...defaultConfig.module.rules,
      {
        test: /\.(scss|sass|css)$/,
        use: [
          {
            // Extract CSS into separate files
            loader : MiniCssExtractPlugin.loader,
          },
          {
            // Interpret @import and url() like import/require() and resolve them.
            loader: 'css-loader',
            options: { sourceMap: true },
          },
          {
            // Process post CSS actions
            loader: 'postcss-loader',
            options: {
              sourceMap: true,
              plugins: function() {
                return [ require('autoprefixer') ];
              },
            },
          },
          {
            // Rewrite relative paths in url() statements based on the original source file.
            loader: 'resolve-url-loader',
            options: { sourceMap: true },
          },
          {
            // Load a Sass/SCSS file and compile it to CSS.
            loader: 'sass-loader',
            options: { sourceMap: true },
          },
        ],
      },
      {
        test: /\.(png|svg|jpe?g|gif|woff|woff2|eot|ttf|otf)$/,
        include: path.resolve(__dirname, 'assets'),
        use: [
          {
            loader: 'file-loader',
            options: {
              name: '[path][name].[ext]',
              limit: 4096,
            },
          },
        ],
      },
      {
        test: /\.(png|svg|jpe?g|gif|woff|woff2|eot|ttf|otf)$/,
        include: /node_modules/,
        use: [
          {
            loader: 'file-loader',
            options: {
              limit: 4096,
              outputPath: 'vendor/',
              name: '[name].[ext]',
            },
          },
        ],
      },
    ],
  },
  plugins: [
    ...defaultConfig.plugins,
    // Remove all files inside output.path director
    new CleanWebpackPlugin(),
    // Extract CSS into separate files
    new MiniCssExtractPlugin({
      filename: 'styles/[name].css',
    }),
    // Automatically load modules
    new webpack.ProvidePlugin({
      $: 'jquery',
      jQuery: 'jquery',
      'window.jQuery': 'jquery',
      Popper: 'popper.js/dist/umd/popper.js',
    }),
    // Copy
    new CopyWebpackPlugin([
      'images/**/*',
      'fonts/**/*',
    ]),
    // Elegant ProgressBar and Profiler
    new WebpackBar(),
  ],
  optimization: {
    minimizer : [
      new OptimizeCssAssetsPlugin({
        cssProcessorPluginOptions: {
          sourceMap: false,
          map: { // Remove all source maps
            inline: false,
            annotation: true,
          },
          preset: ['default', { discardComments: { removeAll: true } }],
        },
      }),
      new ImageminPlugin({
        test: /\.(png|svg|je?pg|gif)$/,
        optipng: { optimizationLevel: 2 },
        gifsicle: { optimizationLevel: 3 },
        pngquant: { quality: '65-90', speed: 4 },
        svgo: {
          plugins: [
            { removeUnknownsAndDefaults: false },
            { cleanupIDs: false },
            { removeViewBox: false },
          ],
        },
        plugins: [imageminMozjpeg({ quality: 75 })],
      }),
      new UglifyJsPlugin({
        test: /\.js(\?.*)?$/i,
        cache: true,
        parallel: true,
        sourceMap: true,
        uglifyOptions: {
          warnings: true,
          output: { comments: false },
          compress: { drop_console: true },
        },
      }),
    ],
  },
};
