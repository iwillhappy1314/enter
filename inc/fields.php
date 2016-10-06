<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package enter
 */


add_action( 'after_setup_theme', function() {
    $fm = new Fieldmanager_Group( array(
        'name' => 'demo-group',
        'serialize_data' => false,
        'add_to_prefix'  => false,
        'children' => array(
            'field-one' => new Fieldmanager_TextField( 'First Field' ),
            'field-two' => new Fieldmanager_TextField( 'Second Field' ),
        ),
    ) );
    $fm->add_meta_box( 'Basic Group', array( 'post' ) );
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