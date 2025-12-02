<?php
/**
 * Filters for content tags
 */

namespace Launchpad\Content\Filters;

/**
 * A function for updating the archive title to remove prefixes.
 *
 * @param string $title the current title to be filtered.
 */
function update_archive_title( string $title ): string {
	if ( is_category() ) {
		$title = single_cat_title( '', false );
	} elseif ( is_tag() ) {
		$title = single_tag_title( '', false );
	} elseif ( is_post_type_archive() ) {
		$title = post_type_archive_title( '', false );
	}
	return $title;
}

add_filter( 'get_the_archive_title', __NAMESPACE__ . '\\update_archive_title' );

/**
 * Replace the password protection form
 *
 * @param string   $output           The password form HTML output.
 * @param \WP_Post $post             Post object.
 * @param string   $invalid_password The invalid password message.
 */
function replace_password_form( string $output, \WP_Post $post, string $invalid_password ): string {
	$post = get_post( $post );
	$field_id = 'pwbox-' . ( empty( $post->ID ) ? wp_rand() : $post->ID );
	$invalid_password_html = '';
	$aria_described_by = array( 'desc-' . $field_id );
	$class = '';
	$redirect_field = '';

	// If the referrer is the same as the current request, the user has entered an invalid password.
	if ( ! empty( $post->ID ) && wp_get_raw_referer() === get_permalink( $post->ID ) && isset( $_COOKIE[ 'wp-postpass_' . COOKIEHASH ] ) ) {
		$invalid_password_html = '<div class="post-password-form-invalid-password" role="alert" id="error-' . $field_id . '">' . $invalid_password . '</div>';
		$aria_described_by[] = 'error-' . $field_id;
		$class = ' password-form-error';
	}

	if ( ! empty( $post->ID ) ) {
		$redirect_field = sprintf(
			'<input type="hidden" name="redirect_to" value="%s" />',
			esc_attr( get_permalink( $post->ID ) )
		);
	}

	$output = '<form action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" class="post_password_form' . $class . '" method="post">' . $redirect_field;
	$output .= '<div class="post_password_input_group">';
	$output .= '<label class="post_password_label" for="' . $field_id . '">' . __( 'Password:', 'launchpad' ) . '</label>';
	$output .= '<span id="desc-' . $field_id . '">' . __( 'This content is password protected. To view it, please enter your password below:', 'launchpad' ) . '</span>';
	$output .= $invalid_password_html;
	$output .= '<input name="post_password" class="post_password_input" id="' . $field_id . '" type="password" spellcheck="false" required size="20" aria-describedby="' . esc_attr( join( ' ', $aria_described_by ) ) . '" />';
	$output .= '</div>';
	$output .= '<button class="post_password_submit" type="submit">' . esc_attr_x( 'Submit', 'post password form', 'launchpad' ) . '</button>';
	$output .= '</form>';
	return $output;
}
add_filter( 'the_password_form', __NAMESPACE__ . '\\replace_password_form', 10, 3 );

remove_filter( 'the_content', 'wpautop' );
