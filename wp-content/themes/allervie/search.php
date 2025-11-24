<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Allervie
 * @since 1.0.0
 */

// Include header.
get_header();


// Global variables.
global $option_fields;
global $pID;
global $fields;

// Required if you want different search results style for separate CPT etc
// $post_type = get_post_type();

/**
* Search Masthead
*/

$search_post_type = $_GET['post_type'];
if ( $search_post_type == 'provider' ) {
	get_template_part( 'partials/content-search', $search_post_type );
} else {

	?>
<section id="hero-section" class="hero-section container-780 hero-default">
	<div class="s-100"></div>
	<!-- hero start -->
	<div class="hero-event ">
		<div class="wrapper">
			<div class="d-flex justify-content-center align-items-start">
				<div class="banner-text center-align">
					<h1 class="heading"><?php _e( 'Search Results', 'alrv_td' ); ?></h1>
					<?php
					printf(
						/* translators: %s: search term. */
						esc_html__( 'Results for "%s"', 'alrv_td' ),
						'<span class="search-term">' . esc_html( get_search_query() ) . '</span>'
					);
					?>
					</p>
				</div>
			</div>
		</div>
	</div>
	<div class="s-100"></div>
	<!-- Hero End -->
</section>

<section id="page-section" class="page-section">
	<!-- Content Start -->
	<div class="wrapper">
		<div class="post-archive three-columns">
			<?php
			if ( have_posts() ) {
				while ( have_posts() ) {
					the_post();
					// Include specific template for the content
					get_template_part( 'partials/content', 'archive-post' );
				}
				?>
				<?php
			} else {
				// If no content, include the "No posts found" template.
				get_template_part( 'partials/content', 'none' );
			}
			?>
		</div>
		<div class="ts-40"></div>
		<?php
		if ( function_exists( 'glide_pagination' ) ) {
			?>
			<?php
			glide_pagination( $wp_query->max_num_pages );
			?>
		<div class="ts-80"></div>
			<?php
		}
		?>

	</div>
	<!-- Content End -->
</section>

<?php } ?>

<?php get_footer(); ?>
