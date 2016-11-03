<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link    https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package enter
 */

get_header(); ?>

	<header class="page-header">
		<div class="container">
			<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'enter' ); ?></h1>
		</div>
	</header>

	<div id="primary" class="col-sm-12 col-md-9 content-area">
		<main id="main" class="site-main" role="main">

			<section class="error-404 not-found">

				<div class="page-content">
					<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'enter' ); ?></p>
				</div>

			</section>

		</main>
	</div>

<?php get_footer(); ?>