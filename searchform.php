<?php
/**
 * Template for displaying search forms
 *
 * @package My/Theme
 */

namespace My\Theme;

$my_theme_unique_id = uniqid('search-form-');

?>

<form class="search-form" action="<?php echo esc_url(home_url('/')); ?>" method="get" role="search">

    <div class="input-group">

        <label for="<?php echo esc_attr($my_theme_unique_id); ?>">
            <span class="sr-only"><?php echo esc_html_x('Search for:', 'label', 'my-theme'); ?></span>
        </label>

        <input type="search" id="<?php echo esc_attr($my_theme_unique_id); ?>" class="form-control" placeholder="<?php echo esc_attr_x('Search &hellip;', 'placeholder', 'my-theme'); ?>" value="<?php echo get_search_query(); ?>" name="s" />

        <div class="input-group-append">
            <button type="submit" class="btn btn-primary"><?php esc_html_e('Search', 'my-theme'); ?></button>
        </div>

    </div><!-- .input-group -->

</form><!-- .search-form -->
