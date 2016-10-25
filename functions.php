<?php
	/**
	 * 主题功能和定义
	 *
	 * @package enter
	 */

	if ( ! function_exists( 'enter_setup' ) ) :
		/**
		 * 设置默认选项、添加 WordPress 功能支持
		 */
		function enter_setup() {
			/*
			 * 主题翻译支持
			 */
			load_theme_textdomain( 'enter', get_template_directory() . '/languages' );

			// 添加默认的文章和评论 RSS 源链接到 head 中
			add_theme_support( 'automatic-feed-links' );

			/*
			 * 添加标题标签支持
			 */
			add_theme_support( 'title-tag' );

			/*
			 * 文章缩略图大小
			 */
			add_theme_support( 'post-thumbnails' );
			add_image_size( 'archive', 200, 150, true );
			add_image_size( 'masonry', 210, 160, true );

			/*
			 * 菜单位置，在 wp_nav_menu() 中使用
			 */
			register_nav_menus( [
				'primary' => esc_html__( 'Primary', 'enter' ),
				'footer'  => esc_html__( 'Footer', 'enter' ),
			] );

			/*
			 * 转化默认的表单元素为 HTML5
			 */
			add_theme_support( 'html5', [
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			] );

			/**
			 * 支持 WooCommerce
			 */
			add_theme_support( 'woocommerce' );

			/**
			 * 添加编辑器样式
			 */
			add_editor_style( get_template_directory_uri() . '/front/dist/styles/editor.css' );

			/**
			 * 基于主题设计和样式, 设置内容宽度
			 */
			function enter_content_width() {
				$GLOBALS[ 'content_width' ] = apply_filters( 'enter_content_width', 640 );
			}

		}
	endif;

	add_action( 'after_setup_theme', 'enter_setup' );

	/**
	 * 注册小工具区域
	 */
	function enter_widgets_init() {
		register_sidebar( [
			'name'          => esc_html__( 'Sidebar', 'enter' ),
			'id'            => 'sidebar-main',
			'description'   => esc_html__( 'Add widgets here.', 'enter' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		] );
	}

	add_action( 'widgets_init', 'enter_widgets_init' );


	/**
	 * 添加样式和脚本
	 */
	function wizhi_enter_scripts() {
		wp_enqueue_style( 'enter-style', get_template_directory_uri() . '/front/dist/styles/main.css' );
		wp_enqueue_script( 'enter-script', get_template_directory_uri() . '/front/dist/scripts/main.js', [ 'jquery' ], '20151215', true );

		wp_enqueue_style( 'enter-style-old', get_template_directory_uri() . '/front/dist/styles/old.css' );
		wp_style_add_data( 'enter-style-old', 'conditional', 'lt IE 9' );

		wp_enqueue_script( 'enter-html5shiv', get_template_directory_uri() . '/front/dist/scripts/html5shiv.js', [], '30', false );
		wp_script_add_data( 'enter-html5shiv', 'conditional', 'lt IE 9' );

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}

	add_action( 'wp_enqueue_scripts', 'wizhi_enter_scripts' );


	$options = get_option( 'wizhi_enter_settings' );

	/**
	 * 自定义模板标签
	 */
	require get_template_directory() . '/inc/template-tags.php';

	/**
	 * 主题附加功能函数
	 */
	require get_template_directory() . '/inc/extras.php';

	/**
	 * 自定义字段
	 */
	require get_template_directory() . '/inc/fields.php';

	/**
	 * 主题设置
	 */
	require get_template_directory() . '/inc/settings.php';

