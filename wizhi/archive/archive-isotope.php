<?php
/**
 * Loop Template Name: Isotope 过滤存档
 *
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
			the_archive_title( '<h1 class="page-title">', '</h1>' );
			the_archive_description( '<div class="taxonomy-description">', '</div>' );
			?>
		</div>
	</header>


	<div id="primary" class="col-md-12">
		<main id="main" class="site-main" role="main">

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
	</div>

<?php get_footer(); ?>