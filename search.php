<?php
/**
 * The template for displaying search results pages.
 *
 * @link    https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
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
			<h1 class="page-title"><?php printf( esc_html__( 'Search Results for: %s', 'enter' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
		</div>
	</header>

	<div class="container">
		<div class="pure-g row">

			<div id="primary" class="pure-u-1 pure-u-md-3-4 content-area">
				<main id="main" class="col site-main archive" role="main">

					<?php if ( have_posts() ) : ?>

						<?php while ( have_posts() ) : the_post(); ?>
							<?php get_template_part( 'wizhi/content', 'list' ); ?>
						<?php endwhile; ?>

						<?php
						if ( function_exists( 'wizhi_bootstrap_pagination' ) ):
							wizhi_bootstrap_pagination();
						endif;
						?>

					<?php else : ?>

						<?php get_template_part( 'wizhi/content', 'none' ); ?>

					<?php endif; ?>

				</main>
			</div><!-- #primary -->

			<?php get_sidebar(); ?>

		</div>
	</div>

<?php get_footer(); ?>