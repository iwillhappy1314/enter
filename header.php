<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link    https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package enter
 */

?><!DOCTYPE html>
<!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?> <![endif]-->
<!--[if IE 8]>
<html class="no-js lt-ie9" <?php language_attributes(); ?> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" <?php language_attributes(); ?> <!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="author" content="此网站由 WordPress 智库( https://www.wpzhiku.com )定制开发，如遇问题或Bug，请联系 QQ: 470266798（一刀）解决，同时也欢迎新老客户咨询合作。">
	<meta http-equiv="X-UA-Compatible" content="edge"/>
	<meta name="renderer" content="webkit|ie-comp|ie-stand"/>
	<meta name="referrer" content="always"/>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<link rel="shortcut icon" href="<?php bloginfo( 'template_url' ); ?>/front/dist/images/favicon.png" type="image/png" />

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div id="page" class="site">

	<header id="masthead" class="site-header" role="banner">

		<div class="wrap">
			<div class="pure-g row">
				<div class="pure-u-1 pure-u-md-1-4">
					<div class="col">
						<div class="site-branding pure-center-md">
							<h1 class="site-title">
								<?php $logo = get_option('site_logo'); ?>
								<?php if($logo) : ?>
									<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?= $logo; ?>" alt="<?php bloginfo( 'name' ); ?>"></a>
								<?php else: ?>
									<a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
								<?php endif; ?>
							</h1>
						</div><!-- .site-branding -->
					</div>
				</div>

				<div class="pure-u-1 pure-u-md-3-4">
					<div class="col">
						<nav id="site-navigation" class="clearfix main-navigation" role="navigation">
							<?php wp_nav_menu( [
								'theme_location'  => 'primary',
								'menu_id'         => 'primary-menu',
								'container'       => 'div',
								'container_class' => 'pull-right',
								'menu_class'      => 'sf-menu',
							] ); ?>
						</nav><!-- #site-navigation -->
					</div>
				</div>
			</div>
		</div>

	</header><!-- #masthead -->

	<div id="content" class="site-content">
