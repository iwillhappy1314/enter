<?php
/**
 * Loop Template Name: 分类法过滤存档
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

					<?php
					// 这里是所需要的参数, 下面的都不用改动
					$object   = get_queried_object();
					$slug     = isset( $_GET[ 'slug' ] ) ? $_GET[ 'slug' ] : false;
					$link     = get_post_type_archive_link( $object->name );
					$taxonomy = 'prodcat';

					$args = [
						'taxonomy'   => $taxonomy,
						'hide_empty' => false,
					];

					$terms = get_terms( $args );
					?>

					<div class="text-center sep-big">
						<div class="btn-group" role="group">
							<a href="<?= $link; ?>" class="btn <?= ( ! $slug ) ? 'btn-primary' : 'btn-default'; ?>">全部</a>
							<?php foreach ( $terms as $term ): ?>
								<a href="<?= $link; ?>?slug=<?= $term->slug; ?>" class="btn <?= ( $slug == $term->slug ) ? 'btn-primary' : 'btn-default'; ?>">
									<?= $term->name; ?>
								</a>
							<?php endforeach; ?>
						</div>
					</div>

					<?php

					if ( $slug ) {
						$args = [
							'post_type' => $object->name,
							'tax_query' => [
								[
									'taxonomy' => $taxonomy,
									'field'    => 'slug',
									'terms'    => $slug,
								],
							],
						];

						$wp_query = new WP_Query( $args );
					}

					?>

					<?php if ( have_posts() ) : ?>

						<div class="pure-g row">
							<?php
							while ( have_posts() ) : the_post();
								get_template_part( 'wizhi/content', 'col5' );
							endwhile;
							?>
						</div>

						<?php if ( function_exists( 'wizhi_bootstrap_pagination' ) ):
							wizhi_bootstrap_pagination();
						endif;

					else :

						get_template_part( 'wizhi/content', 'none' );

					endif; ?>

				</main>
			</div>

		</div>
	</div>

<?php get_footer(); ?>