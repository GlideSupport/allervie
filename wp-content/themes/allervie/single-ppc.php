<?php
/**
 * The template for displaying all posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Allervie
 * @since 1.0.0
 */

// Include header
get_header('ppc');

// Global variables
// global $option_fields;
// global $pID;
// global $fields;
if ( have_posts() ) {
	while ( have_posts() ) {
		the_post();
		// Include specific template for the content.
		get_template_part( 'partials/content', 'ppc' );
	}
}
get_footer('ppc');
