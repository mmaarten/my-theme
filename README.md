# My Theme
Bootstrap driven WordPress starter theme.

## Features
- [Sass](https://sass-lang.com/) for stylesheets
- [Webpack](https://webpack.js.org/) for compiling assets, optimising images, and concatenating and minifying files
- [Bootstrap](https://getbootstrap.com/) 4 CSS framework
- [Fontawesome](https://fontawesome.com/) icon library.

## Requirements
- [Node JS](https://nodejs.org)
- [Composer](https://getcomposer.org/)
- PHP >= 5.4
- [WordPress](https://wordpress.org/) >= 5.0

## Installation
1. [Download](https://github.com/mmaarten/my-theme/archive/master.zip) and extract zip into `wp-content/themes/` folder.
1. Run `npm install` to install dependencies.
1. Run `composer install` to install dependencies.
1. Run `npm run build` to compile assets.
1. Activate theme via WordPress admin menu: Appearance/Themes.

## Development
Run `composer install` to install dependencies.

Run `npm install` to install dependencies.

### Build commands
Run `npm run start` to compile assets when files change.

Run `npm run build` to compile and optimize assets.

#### WordPress CLI commands

Run `wp dist-archive .` to create distribution archive.

Run `wp i18n make-pot . languages/my-theme.pot` to create POT file.
