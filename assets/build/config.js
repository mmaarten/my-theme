const path = require('path');
const { argv } = require('yargs');
const merge = require('webpack-merge');

const userConfig = require(`${__dirname}/../config.json`);

const isProduction = !!((argv.env && argv.env.production) || argv.p);
const rootPath = process.cwd();

const config = merge({
  paths: {
    root: rootPath,
    assets: path.join(rootPath, 'assets'),
    dist: path.join(rootPath, 'dist'),
  },
  enabled: {
    sourceMaps: !isProduction,
    cacheBusting: isProduction,
    optimization : isProduction,
  },
  cacheBusting: '[name]_[hash]',
}, userConfig);

module.exports = merge(config, {
  mode : isProduction ? 'production' : 'development',
  publicPath: `${config.publicPath}/${path.basename(config.paths.dist)}/`,
});

if (undefined === process.env.NODE_ENV) {
  process.env.NODE_ENV = isProduction ? 'production' : 'development';
}
