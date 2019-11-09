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
const WebpackAssetsManifest = require('webpack-assets-manifest');

const rootPath = process.cwd();

const config = {
  filename : '[name]_[hash]',
  paths: {
    root: rootPath,
    assets: path.join(rootPath, 'assets'),
    dist: path.join(rootPath, 'build'),
  },
};

const userConfig = require(`${config.paths.assets}/config.json`);

module.exports = {
  context: config.paths.assets,
  entry : userConfig.entry,
  output: {
    filename: `scripts/${config.filename}.js`,
    path: config.paths.dist,
    publicPath: `${userConfig.publicPath}/${path.basename(config.paths.dist)}/`,
  },
  stats: {
    children: false,
  },
  resolve: {
    // Directories where to look for modules
    modules: [
      config.paths.assets,
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
    rules: [
      {
        test: /\.js$/,
        exclude: /node_modules/,
        use: {
          loader: 'babel-loader',
          options: {
            presets: ['@babel/preset-env']
          }
        }
      },
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
        include: config.paths.assets,
        use: [
          {
            loader: 'file-loader',
            options: {
              name: `[path]${config.filename}.[ext]`,
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
              name: `${config.filename}.[ext]`,
            },
          },
        ],
      },
    ],
  },
  plugins: [
    // Remove all files inside output.path director
    new CleanWebpackPlugin(),
    // Extract CSS into separate files
    new MiniCssExtractPlugin({
      filename: `styles/${config.filename}.css`,
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
    // generate a JSON file that matches the original filename with the hashed version.
    new WebpackAssetsManifest({
      output: 'assets.json',
      space: 2,
      writeToDisk: false,
      assets: {},
      replacer: (key, value) => {
        if (typeof value === 'string') {
          return value;
        }
        const manifest = value;
        // Prepend scripts/ or styles/ to manifest keys
        Object.keys(manifest).forEach((src) => {
          const sourcePath = path.basename(path.dirname(src));
          const targetPath = path.basename(path.dirname(manifest[src]));
          if (sourcePath === targetPath) {
            return;
          }
          manifest[`${targetPath}/${src}`] = manifest[src];
          delete manifest[src];
        });
        return manifest;
      },
    }),
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
