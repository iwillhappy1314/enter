<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package enter
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 *
 * @return array
 */
function enter_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}

add_filter( 'body_class', 'enter_body_classes' );


/**
 * 设置缩略图质量
 */
add_filter( 'wp_editor_set_quality', 'wp_editor_set_quality_medium' );
function wp_editor_set_quality_medium( $quality ) {
	return 70;
}


/**
 * 修改 SSL 缩略图链接
 *
 * @param $url
 * @param $post_id
 *
 * @return string
 */
function ssl_post_thumbnail_urls( $url, $post_id ) {
	//Skip file attachments
	if ( ! wp_attachment_is_image( $post_id ) ) {
		return $url;
	}

	//Correct protocol for https connections
	list( $protocol, $uri ) = preg_split( '@(://)@', $url, 2 );
	if ( is_ssl() ) {
		if ( 'http' == $protocol ) {
			$protocol = 'https';
		}
	} else {
		if ( 'https' == $protocol ) {
			$protocol = 'http';
		}
	}

	return $protocol . '://' . $uri;
}

add_filter( 'wp_get_attachment_url', 'ssl_post_thumbnail_urls', 10, 2 );


/**
 * 预览链接新窗口打开
 */
add_action( 'admin_bar_menu', 'customize_my_wp_admin_bar', 80 );
function customize_my_wp_admin_bar( $wp_admin_bar ) {

	//Get a reference to the view-site node to modify.
	$node = $wp_admin_bar->get_node( 'site-name' );

	//Change target
	$node->meta[ 'target' ] = '_blank';

	//Update Node.
	$wp_admin_bar->add_node( $node );

}


/**
 * 修改自动摘要长度
 */
function wizhi_custom_excerpt_length( $length ) {
	return 220;
}

add_filter( 'excerpt_length', 'wizhi_custom_excerpt_length', 999 );


/**
 * 后台显示缩略图标题
 */
add_filter( 'manage_posts_columns', 'wizhi_add_thumb_col' );
function wizhi_add_thumb_col( $cols ) {
	$cols[ 'thumbnail' ] = __( 'Thumbnail' );

	return $cols;
}

/**
 * 后台显示缩略图
 */
add_action( 'manage_posts_custom_column', 'wizhi_get_thumb_show' );
function wizhi_get_thumb_show( $column_name ) {
	if ( $column_name == 'thumbnail' ) {
		echo get_the_post_thumbnail( get_the_ID(), [ 64, 64 ] );
	}
}


/**
 * 评论作者链接新窗口打开
 */
add_filter( 'get_comment_author_link', 'wizhi_get_comment_author_link' );
function wizhi_get_comment_author_link() {
	$url    = get_comment_author_url( $comment_ID );
	$author = get_comment_author( $comment_ID );
	if ( empty( $url ) || 'http://' == $url ) {
		return $author;
	} else {
		return "<a target='_blank' href='$url' rel='external nofollow' class='url'>$author</a>";
	}
}

/**
 * 不要显示静态资源版本号
 */
add_filter( 'script_loader_src', 'wizhi_remove_script_version', 15, 1 );
add_filter( 'style_loader_src', 'wizhi_remove_script_version', 15, 1 );
function wizhi_remove_script_version( $src ) {
	$parts = explode( '?', $src );

	return $parts[ 0 ];
}


/**
 *  添加设置中的脚本到 wp_head()
 */
add_action( 'wp_head', 'enter_head_script' );
function enter_head_script() { 
	global $options;
	$before_head = $options['code']["before_head"];
	echo $before_head;
}

/**
 *  添加设置中的脚本到 wp_footer()
 */
add_action( 'wp_footer', 'enter_body_script' );
function enter_body_script() { 
	global $options;;
	$before_body = $options['code']['before_body'];
	echo $before_body;
}