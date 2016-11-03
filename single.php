<?php
/**
 * The template for displaying all single posts.
 *
 * @link    https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package enter
 */

get_header(); ?>

	<header class="page-header">
		<div class="container">
			<?php
			if ( function_exists( 'yoast_breadcrumb' ) ) {
				yoast_breadcrumb( '<p id="breadcrumbs" class="breadcrumbs">', '</p>' );
			}
			?>
			<?php
			the_title( '<h1 class="page-title">', '</h1>' );
			the_archive_description( '<div class="taxonomy-description">', '</div>' );
			?>
		</div>
	</header>

	<div id="primary" class="col-sm-12 col-md-9 content-area">
		<main id="main" class="site-main" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'wizhi/content', get_post_format() ); ?>

				<?php the_post_navigation(); ?>

				<?php
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
				?>

			<?php endwhile; ?>

		</main>
	</div><!-- #primary -->

	<?php get_sidebar(); ?>

<?php get_footer(); ?>