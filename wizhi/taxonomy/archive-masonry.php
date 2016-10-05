<?php
/**
 * Loop Template Name: Masonry 布局存档
 *
 */

get_header(); ?>

	<script type="text/javascript" src="<?php bloginfo( 'template_url' ); ?>/front/dist/scripts/ias.js"></script>
	<script type="text/javascript" src="<?php bloginfo( 'template_url' ); ?>/front/dist/scripts/masonry.js"></script>
	<script type="text/javascript" src="<?php bloginfo( 'template_url' ); ?>/front/dist/scripts/imagesloaded.js"></script>

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
					if ( have_posts() ) : ?>

						<div class="pure-g row masonry">
							<?php
							while ( have_posts() ) : the_post();
								get_template_part( 'wizhi/content', 'masonry' );
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

			<script>

				jQuery(document).ready(function ($) {
					var container = document.querySelector('.masonry');

					// 瀑布流布局
					jQuery('.masonry').imagesLoaded(function () {

						var msnry = new Masonry(container, {
							itemSelector: 'article',
							isAnimated: true
						});

						var ias = jQuery.ias({
							container: '.masonry',
							item: 'article',
							pagination: '.pagination',
							next: '.nextpostslink'
						});

						ias.on('render', function (items) {
							$(items).css({opacity: 0});
						});

						ias.on('rendered', function (items) {
							msnry.appended(items);
						});

						// 添加加载指示器
						ias.extension(new IASSpinnerExtension());

						// 3页后显示查看更多
						ias.extension(new IASTriggerExtension({
							offset: 3,
							text: '查看更多精彩'
						}));

						// 加载完成时显示的文字
						ias.extension(new IASNoneLeftExtension({text: "暂时没有更多了."}));

					});

				});

			</script>

		</div>
	</div>

<?php get_footer(); ?>