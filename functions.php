<?php
/**
 * Boot
 *
 * @package My/Theme
 */

namespace My\Theme;

require get_template_directory() . '/vendor/autoload.php';

Setup::init();
Assets::init();
Widgets::init();
Navs::init();
Editor::init();
Blocks::init();
Customizer::init();

require get_template_directory() . '/inc/template-functions.php';
require get_template_directory() . '/inc/template-tags.php';
