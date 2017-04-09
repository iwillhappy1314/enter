<?php
/**
 * Template Name: 全宽模板
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package enter
 */

get_header(); ?>

    <div class="container">

        <div id="primary" class="col-md-12">
            <main id="main" class="site-main" role="main">

				<?php while ( have_posts() ) : the_post(); ?>

                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                        <div class="typo entry-content">
							<?php
							the_content();

							wp_link_pages( array(
								'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'enter' ),
								'after'  => '</div>',
							) );
							?>
                        </div>

                        <footer class="entry-footer">

                        </footer>
                    </article><!-- #post-## -->


				<?php endwhile; ?>

            </main>
        </div>

    </div>

<?php get_footer(); ?>