<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link    https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package enter
 */

?>

</div><!-- #content -->

<footer id="colophon" class="site-footer" role="contentinfo">


	<div class="col-md-9">
		<nav id="footer-navigation" class="clearfix footer-navigation" role="navigation">
			<?php wp_nav_menu( [
				'theme_location' => 'footer',
				'menu_id'        => 'footer-menu',
				'container'      => 'div',
			] ); ?>
		</nav>
	</div>


	<div class="col-md-3">
		<div class="text-right site-info pure-center-md">
			Copyright ©<?= date( 'Y' ); ?> <a href="<?= home_url(); ?>"><?php bloginfo( 'name' ); ?></a>

			<?php global $options; ?>
			<?php if ( $options[ 'site' ][ 'beian' ] ) : ?>
				<a rel="nofollow" target="_blank" href="http://www.miibeian.gov.cn/"><?= $options[ 'site' ][ 'beian' ]; ?></a>
			<?php endif; ?>
		</div>
	</div>

</footer>

</div><!-- #page -->

<?php wp_footer(); ?>


<script id="__bs_script__">//<![CDATA[
	document.write("<script async src="
	http://HOST:3000/browser-sync/browser-sync-client.2.13.0.js"><\/script>".replace("HOST", location.hostname));
	//]]></script>

</body>
</html>
