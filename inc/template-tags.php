<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package enter
 */

if ( ! function_exists( 'enter_posted_on' ) ) :
	/**
	 * 输入当前文章的发布时间和作者
	 */
	function enter_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string, esc_attr( get_the_date( 'c' ) ), esc_html( get_the_date() ), esc_attr( get_the_modified_date( 'c' ) ), esc_html( get_the_modified_date() ) );

		$posted_on = sprintf( esc_html_x( 'Posted on %s', 'post date', 'enter' ), '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>' );

		$byline = sprintf( esc_html_x( 'by %s', 'post author', 'enter' ), '<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>' );

		echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

	}
endif;


if ( ! function_exists( 'enter_entry_footer' ) ) :
	/**
	 * 在文章内容底部显示分类、标签、评论链接
	 */
	function enter_entry_footer() {
		if ( 'post' === get_post_type() ) {
			$categories_list = get_the_category_list( esc_html__( ', ', 'enter' ) );
			if ( $categories_list && enter_categorized_blog() ) {
				printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'enter' ) . '</span>', $categories_list ); // WPCS: XSS OK.
			}

			$tags_list = get_the_tag_list( '', esc_html__( ', ', 'enter' ) );
			if ( $tags_list ) {
				printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'enter' ) . '</span>', $tags_list ); // WPCS: XSS OK.
			}
		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link( sprintf( wp_kses( __( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'enter' ), [ 'span' => [ 'class' => [ ] ] ] ), get_the_title() ) );
			echo '</span>';
		}

	}
endif;


/**
 * 是否有分类目录
 *
 * @return bool
 */
function enter_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'enter_categories' ) ) ) {
		$all_the_cool_cats = get_categories( [
			'fields'     => 'ids',
			'hide_empty' => 1,
			'number'     => 2,
		] );

		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'enter_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		return true;
	} else {
		return false;
	}
}


/**
 * 清除分类目录缓存
 */
function enter_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'enter_categories' );
}

add_action( 'edit_category', 'enter_category_transient_flusher' );
add_action( 'save_post', 'enter_category_transient_flusher' );
