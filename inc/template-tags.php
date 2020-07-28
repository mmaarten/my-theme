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
 * Button
 *
 * @link https://getbootstrap.com/docs/4.0/components/buttons/
 * @param array $args
 */
function button($args)
{
    $args = wp_parse_args($args, [
        'text'     => '',
        'link'     => '',
        'link_tab' => false,
        'type'     => 'primary',
        'outline'  => false,
        'size'     => '',
        'toggle'   => '',
    ]);

    $atts = [
        'class' => 'btn',
        'role'  => 'button',
    ];

    if ($args['link']) {
        $atts['href'] = esc_url($args['link']);
    }

    if ($args['link_tab']) {
        $atts['target'] = '_blank';
    }

    if ($args['type']) {
        if ($args['outline']) {
            $atts['class'] .= " btn-outline-{$args['type']}";
        } else {
            $atts['class'] .= " btn-{$args['type']}";
        }
    }

    if ($args['size']) {
        $atts['class'] .= " btn-{$args['size']}";
    }

    if ($args['toggle']) {
        $atts['data-toggle'] = $args['toggle'];
    }

    echo '<a' . html_atts($atts) . '>' . $args['text'] . '</a>';
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

    $args = wp_parse_args($args, [
        'items'           => [],
        'controls'        => true,
        'indicators'      => false,
        'autoplay'        => true,
        'render_callback' => null,
    ]);

    $carousel_id = !empty($args['id']) ? $args['id'] : "carousel-$instance";
    $items       = is_array($args['items']) ? $args['items'] : [];

    if (! $items) {
        return;
    }

    $atts = [
        'id'    => $carousel_id,
        'class' => 'carousel slide',
    ];

    if ($args['autoplay']) {
        $atts['data-ride'] = 'carousel';
    }

    echo '<div' . html_atts($atts) . '>';

    // Indicators
    if ($args['indicators']) {
        echo '<ol class="carousel-indicators">';
        for ($i=0; $i < count($items); $i++) {
            $is_active = $i === 0;
            $indicator_atts = [
                'data-target' => "#$carousel_id",
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
        $is_active = $i === 0;
        $item_atts = [
            'class' => 'carousel-item',
        ];
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
        echo '<span class="sr-only">' . esc_html__('Previous', 'my-theme') . '</span>';
        echo '</a>';
        echo '<a class="carousel-control-next" href="#' . esc_attr($carousel_id) . '" role="button" data-slide="next">';
        echo '<span class="carousel-control-next-icon" aria-hidden="true"></span>';
        echo '<span class="sr-only">' . esc_html__('Next', 'my-theme') . '</span>';
        echo '</a>';
    }

    echo '</div>'; // .carousel
}

/**
 * Modal
 *
 * @link https://getbootstrap.com/docs/4.0/components/modal/
 * @param array $args
 */
function modal($args)
{
    static $instance = 0;

    $instance++;

    $args = wp_parse_args($args, [
        'title'  => '',
        'body'   => '',
        'footer' => '',
        'size'   => '',
        'center' => false,
    ]);

    $modal_id = !empty($args['id']) ? $args['id'] : "modal-$instance";
    $title_id = "$modal_id-title";

    $modal_atts = [
        'id'          => $carousel_id,
        'class'       => 'modal',
        'tabindex'    => -1,
        'role'        => 'dialog',
        'aria-hidden' => 'true',
    ];

    if ($args['title']) {
        $modal_atts['aria-labelledby'] = $title_id;
    }

    $dialog_atts = [
        'class' => 'modal-dialog',
        'role'  => 'document',
    ];

    if ($args['size']) {
        $dialog_atts['class'] .= " {$args['size']}";
    }

    if ($args['center']) {
        $dialog_atts['class'] .= ' modal-dialog-centered';
    }

    echo '<div' . html_atts($modal_atts) . '>';
    echo '<div' . html_atts($dialog_atts) . '>';
    echo '<div class="model-content">';

    echo '<div class="modal-header">';
    if ($args['title']) {
        printf('<h5 class="modal-title" id="%s">%s</h5>', esc_attr($title_id), $args['title']);
    }
    echo '<button type="button" class="close" data-dismiss="modal" aria-label="' . esc_attr__('Close', 'my-theme') . '">';
    echo '<span aria-hidden="true">&times;</span>';
    echo '</button>';
    echo '</div>'; // .modal-header

    echo '<div class="modal-body">';
    echo $args['body'];
    echo '</div>'; // .modal-body

    if ($args['footer']) {
        echo '<div class="modal-footer">';
        echo $args['footer'];
        echo '</div>'; // .modal-footer
    }

    echo '</div>'; // .modal-content
    echo '</div>'; // .modal-dialog
    echo '</div>'; // .modal
}
