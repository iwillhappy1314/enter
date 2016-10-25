<?php
/**
 * enter functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package enter
 */

if ( ! function_exists( 'enter_setup' ) ) :
/**
 * 设置默认选项、添加 WordPress 功能支持
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function enter_setup() {
	/*
	 * 主题翻译支持
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on enter, use a find and replace
	 * to change 'enter' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'enter', get_template_directory() . '/languages' );

	// 添加默认的文章和评论 RSS 源链接到 head 中
	add_theme_support( 'automatic-feed-links' );

	/*
	 * 添加标题标签支持
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'archive', 200, 150, true );
	add_image_size( 'masonry', 210, 160, true );

	// 菜单位置，在 wp_nav_menu() 中使用
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'enter' ),
		'footer' => esc_html__( 'Footer', 'enter' ),
	) );

	/*
	 * 转化默认的表单元素为 HTML5
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/**
     * 支持 WooCommerce
     */
	add_theme_support( 'woocommerce' );

    /**
     * 添加编辑器样式
     */
    add_editor_style( get_template_directory_uri() . '/front/dist/styles/editor.css' );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'enter_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif;
add_action( 'after_setup_theme', 'enter_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function enter_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'enter_content_width', 640 );
}
add_action( 'after_setup_theme', 'enter_content_width', 0 );

/**
 * 注册小工具区域
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function enter_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'enter' ),
		'id'            => 'sidebar-main',
		'description'   => esc_html__( 'Add widgets here.', 'enter' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
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

    wp_enqueue_script('enter-html5shiv', get_template_directory_uri() . '/front/dist/scripts/html5shiv.js', [], '30', false);
    wp_script_add_data('enter-html5shiv', 'conditional', 'lt IE 9');

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'wizhi_enter_scripts' );


$options = get_option('wizhi_enter_settings'); 


/**
 * 实现自定义头部功能
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * 自定义模板标签
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * 主题附加功能函数
 */
require get_template_directory() . '/inc/extras.php';

/**
 * 主题自定义
 */
require get_template_directory() . '/inc/customizer.php';


/**
 * 自定义字段
 */
require get_template_directory() . '/inc/fields.php';


/**
 * 主题设置
 */
require get_template_directory() . '/inc/settings.php';

