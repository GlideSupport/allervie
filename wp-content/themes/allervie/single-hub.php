<?php
/**
 * The template for displaying all posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Allervie
 * @since 1.0.0
 */

// Global variables
global $pID;
$fields 					 = get_fields_escaped($pID);

$alrv_hub_pg_op = $fields['alrv_hub_pg_op'] ?? 'state_hub';

// Include header
if($alrv_hub_pg_op == 'regional_hub'){
    get_header('regional_hub');
}else {
	get_header( 'state_hub' );
}

if ( have_posts() ) {
	while ( have_posts() ) {
		the_post();
		// Include specific template for the content.
		get_template_part( 'partials/content', 'hub' );
	}
}

if($alrv_hub_pg_op == 'regional_hub'){
    get_footer('regional_hub');
}else {
	get_footer( 'state_hub' );
}
