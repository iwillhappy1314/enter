<?php
	/**
	 * 主题附加的功能函数
	 *
	 * @package enter
	 */

	/**
	 * 添加文章排版优化 class 到文章内容
	 *
	 * @param $classes
	 *
	 * @return array
	 */
	function enter_editer_class( $classes ) {
		$classes[] = 'typo';

		return $classes;
	}

	add_filter( 'post_class', 'enter_editer_class' );


	/**
	 * 添加 CSS 到编辑器 body
	 */
	function enter_tiny_mce_before_init( $init_array ) {
		$init_array[ 'body_class' ] = 'typo hentry entry-content';

		return $init_array;
	}

	add_filter( 'tiny_mce_before_init', 'enter_tiny_mce_before_init' );


	/**
	 * 添加自定义 CSS 类到 Body 元素
	 *
	 * @return array
	 */
	function enter_body_classes( $classes ) {
		// 多个作者时, 添加群组博客
		if ( is_multi_author() ) {
			$classes[] = 'group-blog';
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
	 * 预览链接新窗口打开
	 */
	add_action( 'admin_bar_menu', 'customize_my_wp_admin_bar', 80 );
	function customize_my_wp_admin_bar( $wp_admin_bar ) {

		// 获取节点并修改打开方式
		$node                   = $wp_admin_bar->get_node( 'site-name' );
		$node->meta[ 'target' ] = '_blank';

		// 更新节点
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
	function wizhi_get_comment_author_link( $comment_ID ) {
		$comment = get_comment( $comment_ID );
		$url     = get_comment_author_url( $comment );
		$author  = get_comment_author( $comment );

		if ( empty( $url ) || 'http://' == $url ) {
			return $author;
		} else {
			return '<a target="_blank" href="' . $url . '" rel="external nofollow" class="url">' . $author . '</a>';
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
		$before_head = $options[ 'code' ][ "before_head" ];
		echo $before_head;
	}

	/**
	 *  添加设置中的脚本到 wp_footer()
	 */
	add_action( 'wp_footer', 'enter_body_script' );
	function enter_body_script() {
		global $options;;
		$before_body = $options[ 'code' ][ 'before_body' ];
		echo $before_body;
	}


	// 移除存档文字
	add_filter( 'gettext', 'enter_remove_archive_text' );
	add_filter( 'ngettext', 'enter_remove_archive_text' );

	function enter_remove_archive_text( $translated ) {
		$translated = str_ireplace( '存档：', '', $translated );

		return $translated;
	}