<?php
/**
 * The template for displaying archive pages.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package enter
 */

$object = get_queried_object();
$template = get_archive_option($object->name)['template'];

if ( ! empty( $template ) ) {
	get_template_part( 'wizhi/archive/archive', $template );
} else {
	get_template_part( 'wizhi/archive/archive' );
}