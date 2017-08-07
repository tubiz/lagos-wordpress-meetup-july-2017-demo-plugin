<?php
/*
	Plugin Name: Lagos WordPress Meetup July 2017 Demo Plugin
	Plugin URI:  https://bosun.me
	Description: A demo plugin for the July 2017, Lagos WordPress Meetup
	Version:     1.0.0
	Author:      Tunbosun Ayinla
	Author URI:  https://bosun.me
	License:     GPL2
	License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/


// Add additional content before each post/page content on the frontend
function tbz_content_filter( $content ) {
    $additional_content = '<p>This is the additional content</p>';
    return $additional_content . $content;
}
add_filter( 'the_content', 'tbz_content_filter' );


// Add Lagos: before each post/page title on the frontend
function tbz_title_filter( $title ) {
    $new_title = 'Lagos: ';
    return $new_title . $title;
}
add_filter( 'the_title', 'tbz_title_filter' );


// Add 'Are you a staff' text on the WordPress login page
function tbz_login_action() {
    echo '<h1>Are you a site admin?</h1>';
}
add_action( 'login_header', 'tbz_login_action' );


// Send a mail to the specfied email anytime a post/page is published
function tbz_save_post_action( $post_id ) {
	// If this is just a revision, don't send the email.
	if ( wp_is_post_revision( $post_id ) )
		return;

	$post_title = get_the_title( $post_id );
	$post_url = get_permalink( $post_id );
	$subject = 'A post has been updated';

	$message = "A post has been updated on your website:\n\n";
	$message .= $post_title . ": " . $post_url;

	// Send email to admin.
	wp_mail( 'admin@example.com', $subject, $message );
}
add_action( 'save_post', 'tbz_save_post_action' );


// Add a notice on the WordPress admin page
function tbz_admin_notice_action() {
    echo '<div class="notice notice-success"><p>This is a notice for the Lagos WordPress meetup</p></div>';
}
add_action( 'admin_notices', 'tbz_admin_notice_action' );


// Add the specified text in the WordPress admin footer
function tbz_admin_footer_action() {
    echo '<p style="margin-left: 180px">This is the additional footer content</p>';
}
add_action( 'admin_footer', 'tbz_admin_footer_action' );