<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package My/Theme
 */

namespace My\Theme;

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

    <?php

    if (function_exists('wp_body_open')) {
        wp_body_open();
    }

    ?>

    <div id="page" class="site">

        <a class="skip-link visually-hidden" href="#content"><?php esc_html_e('Skip to content', 'my-theme'); ?></a>

        <header id="masthead" class="site-header">

            <?php get_template_part('template-parts/top', 'navigation'); ?>

            <div id="sticky-header">

                <?php get_template_part('template-parts/main', 'navigation'); ?>

            </div><!-- #sticky-header -->

            <?php get_template_part('template-parts/header', 'widgets'); ?>

        </header><!-- #masthead -->

        <div id="content" class="site-content">
