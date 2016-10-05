<?php
#获取分类模板设置
$term_id        = get_queried_object_id();
$template       = get_term_meta( $term_id, '_term_template', true );
$queried_object = get_queried_object();

#如果分类中设置了模板，调用模板
if ( ! empty( $template ) ) {
    get_template_part( 'wizhi/taxonomy/archive', $template );
} else {
    get_template_part( 'wizhi/taxonomy/archive' );
}