<?php
	/**
	 * 文章或分类的自定义字段
	 *
	 * @package enter
	 */

	if ( class_exists( 'Fieldmanager_Group' ) ) {

		add_action( 'after_setup_theme', function () {
			$fm = new Fieldmanager_Group( [
				'name'           => 'demo-group',
				'serialize_data' => false,
				'add_to_prefix'  => false,
				'children'       => [
					'field-one' => new Fieldmanager_TextField( '字段1' ),
					'field-two' => new Fieldmanager_TextField( '字段2' ),
				],
			] );
			$fm->add_meta_box( '文章数据', [ 'test' ] );
		} );


		add_action( 'after_setup_theme', function () {
			$fm = new Fieldmanager_Group( [
				'name'           => 'sanshi_order_info',
				'tabbed'         => 'horizontal',
				'serialize_data' => false,
				'add_to_prefix'  => false,
				'children'       => [

					'general' => new Fieldmanager_Group( [
						'serialize_data' => false,
						'add_to_prefix'  => false,
						'label'          => '基本信息',
						'children'       => [
							'total'      => new Fieldmanager_Textfield( '订单合计' ),
							'status'     => new Fieldmanager_Textfield( '订单状态' ),
							'pay_method' => new Fieldmanager_Textfield( '支付方式' ),
						],
					] ),

					'address' => new Fieldmanager_Group( [
						'serialize_data' => false,
						'add_to_prefix'  => false,
						'label'          => '收货地址',
						'children'       => [
							'address'   => new Fieldmanager_TextArea( [
								'label'      => '收货地址',
								'attributes' => [
									'rows'     => 5,
									'cols'     => 50,
									'readonly' => true,
								],
							] ),
							'people'    => new Fieldmanager_Textfield( [
								'label'      => '联系人',
								'attributes' => [
									'readonly' => true,
								],
							] ),
							'telephone' => new Fieldmanager_Textfield( [
								'label'      => '电话',
								'attributes' => [
									'readonly' => true,
								],
							] ),
							'celephone' => new Fieldmanager_Textfield( [
								'label'      => '手机',
								'attributes' => [
									'readonly' => true,
								],
							] ),
							'zipcode'   => new Fieldmanager_Textfield( [
								'label'      => '邮编',
								'attributes' => [
									'readonly' => true,
								],
							] ),
						],
					] ),

				],
			] );
			$fm->add_meta_box( '订单信息', 'ord' );
		} );

	}