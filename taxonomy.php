<?php
#获取分类模板设置
$object   = get_queried_object();
$term_id  = get_queried_object_id();
$template = get_term_meta( $term_id, '_term_template', true );

if ( function_exists( 'get_post_types_by_taxonomy' ) ) {
    $post_type          = get_post_types_by_taxonomy( $object->taxonomy );
    $post_type_settings = get_archive_option( $post_type[ 0 ] );

    if ( $post_type_settings & ! $template ) {
        $template = $post_type_settings[ 'template' ];
    }
}

#如果分类中设置了模板，调用模板
if ( ! empty( $template ) ) {
    get_template_part( 'wizhi/archive/archive', $template );
} else {
    get_template_part( 'wizhi/archive/archive' );
}