# My Theme

Bootstrap driven WordPress starter theme
based on the [Underscores](https://github.com/automattic/_s) theme by [Automattic](https://automattic.com/).

## Features

- [Sass](https://sass-lang.com/) for stylesheets
- [Webpack](https://webpack.js.org/) for compiling assets, optimising images, and concatenating and minifying files
- Browsersync
- [Bootstrap](https://getbootstrap.com/) 4 CSS framework
- [Fontawesome](https://fontawesome.com/) icon library.

## Requirements

- [Node JS](https://nodejs.org)
- [Composer](https://getcomposer.org/)
- PHP >= 5.3

## Installation

1. [Download](https://github.com/mmaarten/my-theme/archive/master.zip) and extract zip into `wp-content/themes/` folder.
1. Run `npm install` to install dependencies.
1. Run `composer install` to install dependencies.
1. Run `npm run build` to compile assets.
1. Activate theme via WordPress admin menu: Appearance/Themes.

## Development

Run `npm install` to install dependencies.

Run `composer install` to install additional dependencies.

### Build commands

Run `npm run start` to compile assets when files change. start Browsersync session.

Run `npm run build` to compile assets.

Run `npm run build:production` to compile and optimize assets.

Run `npm run pot` to generate POT file.

Run `npm run dist-archive` to create a distribution archive.
