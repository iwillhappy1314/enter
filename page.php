<?php
/**
 * The template for displaying all pages.
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

	<header class="page-header">
		<div class="container">
			<?php
			if ( function_exists('yoast_breadcrumb') ) {
				yoast_breadcrumb('<p id="breadcrumbs" class="breadcrumbs">','</p>');
			}
			?>
			<?php
			the_title( '<h1 class="page-title">', '</h1>' );
			the_archive_description( '<div class="taxonomy-description">', '</div>' );
			?>
		</div>
	</header>

	<div class="container">
		<div class="pure-g row">

			<div id="primary" class="col-sm-12 col-md-9 content-area">
				<main id="main" class="site-main" role="main">

					<?php while ( have_posts() ) : the_post(); ?>

						<?php get_template_part( 'wizhi/content', 'page' ); ?>

						<?php 
						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;
						?>

					<?php endwhile; ?>

				</main>
			</div><!-- #primary -->

			<?php get_sidebar(); ?>

		</div>
	</div>

<?php get_footer(); ?>