<?php

add_action( 'init', 'wizhi_enter_settings' );
function wizhi_enter_settings() {

	// 添加自定义子菜单
	if ( function_exists( 'fm_register_submenu_page' ) ) {
		fm_register_submenu_page( 'wizhi_enter_settings', 'themes.php', __( 'Theme Options', 'enter' ) );
	}

	// 设置选项页面
	add_action( 'fm_submenu_wizhi_enter_settings', function () {

		$fm = new Fieldmanager_Group( [
			'name'     => 'wizhi_enter_settings',
			'children' => [
				"favicon" => new Fieldmanager_Media( __( 'Favicon', 'enter' ) ),
				"logo" => new Fieldmanager_Media( __( 'Site Logo', 'enter' ) ),
				"beian" => new Fieldmanager_TextField( __( 'Beian Number', 'enter' ) ),
				"before_head" => new Fieldmanager_TextArea( __( 'Code before </head>', 'enter' ) ),
				"before_body" => new Fieldmanager_TextArea( __( 'Code before </body>', 'enter' ) ),
			],
		] );

		$fm->activate_submenu_page();

	} );

}