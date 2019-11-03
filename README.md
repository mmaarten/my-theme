# My Theme
Bootstrap driven WordPress starter theme

## Features
- [Sass](https://sass-lang.com/) for stylesheets
- [Webpack](https://webpack.js.org/) for compiling assets, optimising images, and concatenating and minifying files
- [Bootstrap](https://getbootstrap.com/) 4 CSS framework
- [Fontawesome](https://fontawesome.com/) icon library.
- Complete setup for creating block types.

## Requirements
- [Node JS](https://nodejs.org)
- [Composer](https://getcomposer.org/)
- PHP >= 5.4
- WordPress >= 5.0

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
Requirement: [wp cli](https://wp-cli.org/)

**Create distribution archive**
Run `wp dist-archive .` inside the `wp-content/themes/my-theme` directory.
[more info](https://developer.wordpress.org/cli/commands/dist-archive/)

**Create POT translation file**
Run `wp i18n make-pot . languages/my-theme.pot` inside the `wp-content/themes/my-theme` directory.
[more info](https://developer.wordpress.org/cli/commands/i18n/make-pot/)
