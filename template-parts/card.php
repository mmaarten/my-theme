<?php
/**
 * Template part for displaying page content in index.php and archive.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package My/Theme
 */

namespace My\Theme;

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('card'); ?>>

    <?php the_post_thumbnail('large', ['class' => 'card-img-top']); ?>

    <div class="card-body">

        <?php the_title('<h5 class="card-title">', '</h5>'); ?>

        <div class="card-text">

            <?php the_excerpt(); ?>

        </div><!-- .card-text -->

        <a href="<?php echo esc_url(get_permalink()); ?>" class="btn btn-primary stretched-link"><?php esc_html_e('Read More', 'my-theme'); ?></a>

    </div><!-- .card-body -->

</article><!-- #post-<?php the_ID(); ?> -->
