<?php
/**
 * Loop Template Name: Toogle 存档模板
 *
 */

get_header(); ?>

	<header class="page-header">
		<div class="wrap">
			<?php
			if ( function_exists('yoast_breadcrumb') ) {
				yoast_breadcrumb('<p id="breadcrumbs" class="breadcrumbs">','</p>');
			}
			?>
			<?php
			the_archive_title( '<h1 class="page-title">', '</h1>' );
			the_archive_description( '<div class="taxonomy-description">', '</div>' );
			?>
		</div>
	</header>

	<div class="wrap">
		<div class="pure-g row">

			<div id="primary" class="pure-u-1">
				<main id="main" class="col site-main" role="main">

					<?php if ( have_posts() ) : ?>

						<?php while ( have_posts() ) : the_post(); ?>
							<dl class="accordion sep">
								<?php while ( have_posts() ) : the_post(); ?>

									<dt>
										<a href="#">
											<i class="fa fa-question-circle-o highlight" aria-hidden="true"></i> <?php the_title(); ?>
										</a>
									</dt>
									<dd class="typo">
										<?php the_content(); ?>
									</dd>

								<?php endwhile; ?>
							</dl>
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

		</div>
	</div>

<?php get_footer(); ?>