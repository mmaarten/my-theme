<?php
/**
 * Template Tags
 *
 * @package My/Theme
 */

namespace My\Theme;

/**
 * Prints HTML with meta information for the current post-date/time.
 */
function posted_on()
{
    $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
    if (get_the_time('U') !== get_the_modified_time('U')) {
        $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>'
                     . '<time class="updated" datetime="%3$s">%4$s</time>';
    }

    $time_string = sprintf(
        $time_string,
        esc_attr(get_the_date(DATE_W3C)),
        esc_html(get_the_date()),
        esc_attr(get_the_modified_date(DATE_W3C)),
        esc_html(get_the_modified_date())
    );

    $posted_on = sprintf(
        /* translators: %s: post date. */
        esc_html_x('Posted on %s', 'post date', 'my-theme'),
        '<a href="' . esc_url(get_permalink()) . '" rel="bookmark">' . $time_string . '</a>'
    );

    echo '<span class="posted-on">' . $posted_on . '</span>';

    // Byline.

    $byline = sprintf(
        /* translators: %s: post author. */
        esc_html_x('by %s', 'post author', 'my-theme'),
        sprintf(
            '<span class="author vcard"><a class="url fn n" href="%s">%s</a></span>',
            esc_url(get_author_posts_url(get_the_author_meta('ID'))),
            esc_html(get_the_author())
        )
    );

    echo '<span class="byline"> ' . $byline . '</span>';
}

/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function entry_footer()
{
    // Hide category and tag text for pages.
    if ('post' === get_post_type()) {
        /* translators: used between list items, there is a space after the comma */
        $categories_list = get_the_category_list(esc_html__(', ', 'my-theme'));
        if ($categories_list) {
            /* translators: 1: list of categories. */
            printf('<span class="cat-links">' . esc_html__('Posted in %1$s', 'my-theme') . '</span>', $categories_list);
        }

        /* translators: used between list items, there is a space after the comma */
        $tags_list = get_the_tag_list('', esc_html_x(', ', 'list item separator', 'my-theme'));
        if ($tags_list) {
            /* translators: 1: list of tags. */
            printf('<span class="tags-links">' . esc_html__('Tagged %1$s', 'my-theme') . '</span>', $tags_list);
        }
    }

    if (! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() )) {
        echo '<span class="comments-link">';
        comments_popup_link(
            sprintf(
                wp_kses(
                    /* translators: %s: post title */
                    __('Leave a Comment<span class="sr-only"> on %s</span>', 'my-theme'),
                    array(
                        'span' => array(
                            'class' => array(),
                        ),
                    )
                ),
                get_the_title()
            )
        );
        echo '</span>';
    }

    edit_post_link(
        sprintf(
            wp_kses(
                /* translators: %s: Name of current post. Only visible to screen readers */
                __('Edit <span class="sr-only">%s</span>', 'my-theme'),
                array(
                    'span' => array(
                        'class' => array(),
                    ),
                )
            ),
            get_the_title()
        ),
        '<span class="edit-link">',
        '</span>'
    );
}

/**
 * Displays an optional post thumbnail.
 *
 * Wraps the post thumbnail in an anchor element on index views, or a div
 * element when on single views.
 */
function post_thumbnail()
{
    if (post_password_required() || is_attachment() || ! has_post_thumbnail()) {
        return;
    }

    if (is_singular()) :
        ?>

        <div class="post-thumbnail">
        <?php the_post_thumbnail(); ?>
        </div><!-- .post-thumbnail -->

    <?php else : ?>
        <a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
            <?php
            the_post_thumbnail(
                'post-thumbnail',
                array(
                    'alt' => the_title_attribute(
                        array(
                            'echo' => false,
                        )
                    ),
                )
            );
            ?>
        </a>

            <?php
    endif; // End is_singular().
}

/**
 * Display pagination for the posts.
 *
 * @param array $args Arguments for the paginate_links function.
 */
function pagination($args = array())
{
    if ($GLOBALS['wp_query']->max_num_pages <= 1) {
        return;
    }

    $args = wp_parse_args(
        $args,
        array(
            'mid_size'           => 2,
            'prev_next'          => true,
            'prev_text'          => __('&laquo;', 'my-theme'),
            'next_text'          => __('&raquo;', 'my-theme'),
            'screen_reader_text' => __('Posts navigation', 'my-theme'),
            'type'               => 'array',
            'current'            => max(1, get_query_var('paged')),
        )
    );

    $links = paginate_links($args);

    ?>

    <nav class="pagination-nav" aria-label="<?php echo esc_attr($args['screen_reader_text']); ?>">

        <ul class="pagination">

        <?php foreach ($links as $key => $link) : ?>
            <li class="page-item<?php echo strpos($link, 'current') ? ' active' : ''; ?>">
                <?php echo str_replace('page-numbers', 'page-link', $link); ?>
            </li><!-- .page-item -->

        <?php endforeach; ?>

        </ul><!-- .pagination -->

    </nav><!-- .pagination-nav -->

    <?php
}

/**
 * Display navigation to next/previous post when applicable.
 */
function post_nav()
{
    // Don't print empty markup if there's nowhere to navigate.
    $previous = ( is_attachment() ) ? get_post(get_post()->post_parent) : get_adjacent_post(false, '', true);
    $next     = get_adjacent_post(false, '', false);

    if (! $next && ! $previous) {
        return;
    }
    ?>

    <nav class="container navigation post-navigation">

        <h2 class="sr-only"><?php esc_html_e('Post navigation', 'my-theme'); ?></h2>

        <div class="row nav-links justify-content-between">

        <?php

        if (get_previous_post_link()) {
            previous_post_link(
                '<span class="nav-previous">%link</span>',
                _x('&laquo; %title', 'Previous post link', 'my-theme')
            );
        }

        if (get_next_post_link()) {
            next_post_link(
                '<span class="nav-next">%link</span>',
                _x('%title &raquo;', 'Next post link', 'my-theme')
            );
        }

        ?>

        </div><!-- .nav-links -->

    </nav><!-- .navigation -->

    <?php
}

/**
 * Breadcrumb navigation
 *
 * Dependency: Breadcrumb NavXT
 *
 * @uses bcn_display_list()
 *
 * @link https://wordpress.org/plugins/breadcrumb-navxt/
 *
 * @param string $before The HTML to render before the navigation.
 * @param string $after  The HTML to render after the navigation.
 */
function breadcrumb_nav($before = '', $after = '')
{
    // Check Dependency.
    if (! function_exists('bcn_display_list')) {
        trigger_error(
            // translators: %s: the name of the coding function.
            sprintf(__('function %s does not exist.', 'my-theme'), '<code>bcn_display_list</code>'),
            E_USER_WARNING
        );
        return;
    }

    // Get items. Arguments: return, linked, reverse and force.
    $items = bcn_display_list(true, true, false, false);

    // Stop when no items.
    if (! trim($items)) {
        return;
    }

    // Add CSS classes.
    $items = str_replace('<li class="', '<li class="breadcrumb-item ', $items);
    $items = preg_replace('/class="(.*?)current-item(.*?)"/', 'class="$1active$2"', $items);

    ?>

    <?php echo $before; ?>

    <nav class="breadcrumb-nav" aria-label="breadcrumb">

        <ol class="breadcrumb">

        <?php echo $items; ?>

        </ol><!-- .breadcrumb -->

    </nav><!-- .breadcrumb-nav -->

    <?php echo $after; ?>

    <?php
}

/**
 * Carousel
 *
 * @link https://getbootstrap.com/docs/4.0/components/carousel/
 * @param array $args
 */
function carousel($args)
{
    static $instance = 0;

    $instance++;

    /**
     * Arguments
     */

    $args = wp_parse_args($args, [
        'id'              => '',
        'items'           => [],
        'indicators'      => false,
        'controls'        => true,
        'autoplay'        => false,
        'render_callback' => null,
    ]);

    $items = is_array($args['items']) ? $args['items'] : [];
    $carousel_id = !empty($args['id']) ? $args['id'] : "modal-$instance";

    /**
     * HTML Attributes
     */

    $atts = [
        'class'       =>'carousel slide',
        'id'          => $carousel_id,
    ];

    if ($args['autoplay']) {
        $atts['data-ride'] = 'carousel';
    }

    /**
     * Output
     */

    echo '<div' . html_atts($atts) . '>';

    // Indicators

    if ($args['indicators']) {
        echo '<ol class="carousel-indicators">';
        for ($i=0; $i < count($items); $i++) {
            $is_active = $i == 0;
            $indicator_atts = [
                'data-target' => "#{$carousel_id}",
                'data-slide-to' => $i,
            ];

            if ($is_active) {
                $indicator_atts['class'] = 'active';
            }
            echo '<li' . html_atts($indicator_atts) . '></li>';
        }
        echo '</ol>'; // .carousel-indicators
    }

    // Items

    echo '<div class="carousel-inner">';

    for ($i=0; $i < count($items); $i++) {
        $item = $items[$i];

        $is_active = $i == 0;
        $item_atts = ['class' =>  'carousel-item'];

        if ($is_active) {
            $item_atts['class'] .= ' active';
        }

        echo '<div' . html_atts($item_atts) . '>';

        if (is_callable($args['render_callback'])) {
            call_user_func($args['render_callback'], $item, $i);
        }

        echo '</div>'; // .carousel-item
    }

    echo '</div>'; // .carousel-inner

    // Controls

    if ($args['controls']) {
        echo '<a class="carousel-control-prev" href="#' . esc_attr($carousel_id) . '" role="button" data-slide="prev">';
        echo '<span class="carousel-control-prev-icon" aria-hidden="true"></span>';
        echo '<span class="sr-only">' . esc_attr__('Previous', 'my-theme') . '</span>';
        echo '</a>';

        echo '<a class="carousel-control-next" href="#' . esc_attr($carousel_id) . '" role="button" data-slide="next">';
        echo '<span class="carousel-control-next-icon" aria-hidden="true"></span>';
        echo '<span class="sr-only">' . esc_attr__('Next', 'my-theme') . '</span>';
        echo '</a>';
    }

    //

    echo '</div>'; // .carousel
}

/**
 * Render Modal
 *
 * @link https://getbootstrap.com/docs/4.0/components/modal/
 * @param array $args
 */
function modal($args)
{
    static $instance = 0;

    $instance++;

    /**
     * Arguments
     */

    $args = wp_parse_args($args, [
        'id'     => '',
        'title'  => '',
        'body'   => '',
        'size'   => '',
        'center' => false,
    ]);

    $modal_id = !empty($args['id']) ? $args['id'] : "modal-$instance";
    $title_id = "$modal_id-title";

    /**
     * HTML Attributes
     */

    // Modal

    $modal_atts = [
        'class'       =>'modal fade',
        'id'          => $modal_id,
        'tabindex'    =>'-1',
        'role'        =>'dialog',
        'aria-hidden' =>'true',
    ];

    if ($args['title']) {
        $modal_atts['aria-labelledby'] = $title_id;
    }

    // Dialog

    $dialog_atts = [
        'class' =>'modal-dialog',
        'role'  =>'document',
    ];

    if ($args['size']) {
        $dialog_atts['class'] .= " modal-{$args['size']}";
    }

    if ($args['center']) {
        $dialog_atts['class'] .= ' modal-dialog-centered';
    }

    /**
     * Output
     */
    ?>

    <div<?php echo html_atts($modal_atts); ?>>
        <div<?php echo html_atts($dialog_atts); ?>>
            <div class="modal-content">
                <div class="modal-header">
                    <?php if ($args['title']) : ?>
                    <h5 class="modal-title" id="<?php echo esc_attr($title_id) ?>"><?php echo esc_html($args['title']); ?></h5>
                    <?php endif; ?>
                    <button type="button" class="close" data-dismiss="modal" aria-label="<?php esc_attr_e('Close', 'my-theme'); ?>">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div><!-- .modal-header -->
                <div class="modal-body">
                    <?php echo $args['body']; ?>
                </div><!-- .modal-body -->
            </div><!-- .modal-content -->
        </div><!-- .modal-dialog -->
    </div><!-- .modal -->

    <?php
}

/**
 * Render Button
 *
 * @link https://getbootstrap.com/docs/4.0/components/buttons/
 * @param array $args
 */
function button($args)
{
    /**
     * Arguments
     */

    $args = wp_parse_args($args, [
        'text'     => '',
        'link'     => '',
        'link_tab' => false,
        'type'     => 'primary',
        'outline'  => false,
        'size'     => '',
        'toggle'   => '',
    ]);

    /**
     * HTML Attributes
     */

    $atts = ['class' => 'btn', 'role' => 'button'];

    // Type
    if ($args['type']) {
        if ($args['outline']) {
            $atts['class'] .= " btn-outline-{$args['type']}";
        } else {
            $atts['class'] .= " btn-{$args['type']}";
        }
    }

    // Size
    if ($args['size']) {
        $atts['class'] .= " btn-{$args['size']}";
    }

    // Link
    if ($args['link']) {
        $atts['href'] = esc_url($args['link']);
    }

    // Open link in new window.
    if ($args['link_tab']) {
        $atts['target'] = '_blank';
    }

    // Toggle
    if ($args['toggle']) {
        $atts['data-toggle'] = $args['toggle'];
    }

    /**
     * Output
     */

    echo '<a ' . html_atts($atts) . '>' . $args['text'] . '</a>';
}

function gallery($args)
{
    static $instance = 0;

    $instance++;

    $args = wp_parse_args($args, [
        'id'      => '',
        'columns' => 4,
        'size'    => 'thumbnail',
        'link'    => '',
        'ids'     => [],
    ]);

    $gallery_id = !empty($args['id']) ? $args['id'] : "gallery-$instance";
    $attachment_ids = is_array($args['ids']) ? $args['ids'] : [];

    if (! $attachment_ids) {
        return;
    }

    $attachments = get_posts([
        'post_type'      => 'attachment',
        'post_status'    => 'inherit',
        'post_mime_type' => 'image',
        'include'        => $attachment_ids,
        'orderby'        => 'post__in',
    ]);

    $atts = [
        'id'    => $gallery_id,
        'class' => 'gallery',
    ];

    $column_classes = breakpoint_classes($args['columns'], 'gallery-columns');

    if ($column_classes) {
        $atts['class'] .= ' ' . $column_classes;
    }

    echo '<div ' . html_atts($atts) . '>';

    foreach ($attachments as $attachment) {
        $has_caption = trim($attachment->post_excerpt) ? true : false;
        $caption_id = "$gallery_id-{$attachment->ID}";
        $atts = $has_caption ? ['aria-describedby' => $caption_id] : [];

        echo '<figure class="gallery-item">';

        echo '<div class="gallery-icon">';

        if ($args['link'] == 'file') {
            echo wp_get_attachment_link($attachment->ID, $args['size'], false, false, false, $atts);
        } elseif ($args['link'] == 'page') {
            echo wp_get_attachment_link($attachment->ID, $args['size'], true, false, false, $atts);
        } elseif ($args['link'] == 'lightbox') {
            list($image_url) = wp_get_attachment_image_src($attachment->ID, 'my-theme-full-width');
            printf('<a href="%s" data-fancybox="%s">', esc_url($image_url), esc_attr($gallery_id));
            echo wp_get_attachment_image($attachment->ID, $args['size'], false, $atts);
            echo '</a>';
        } else {
            echo wp_get_attachment_image($attachment->ID, $args['size'], false, $atts);
        }

        echo '</div>'; // gallery-icon

        if ($has_caption) {
            printf(
                '<figcaption class="gallery-caption" id="%s">%s</figcaption>',
                esc_attr($caption_id),
                wptexturize($attachment->post_excerpt)
            );
        }

        echo '</figure>'; // gallery-item
    }

    echo '</div>'; // .gallery
}

/**
 * @param int $attachment_id
 * @param string $size
 * @param string $ratio
 */
function cover_image($attachment_id, $size = 'large', $ratio = '4by3')
{
    list($image_url) = wp_get_attachment_image_src($attachment_id, $size);

    if (! $image_url) {
        return;
    }

    $atts = [
        'class' => sprintf('cover-image bg-cover bg-center embed-responsive embed-responsive-%s', $ratio),
    ];

    echo '<span' . html_atts($atts) . '>';

    echo wp_get_attachment_image($attachment_id, $size, false, ['class' => 'responsive-item invisible']);

    echo '</span>'; // .cover-image
}
