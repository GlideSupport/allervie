<?php
/**
 * Template Name: Events
 * Template Post Type: page
 *
 * This template is for displaying home page.
 *
 * @link https://developer.wordpress.org/themes/template-files-section/page-template-files/
 *
 * @package Allervie
 * @since 1.0.0
 */

// Include header
get_header();

// Global variables
global $option_fields;
global $pID;
global $fields;

$alrv_teho_title = glide_page_title( 'alrv_teho_title' );
$alrv_teho_title_past = (isset($fields['alrv_teho_title_past'])) ? $fields['alrv_teho_title_past'] : null;

?>
<section id="hero-section" class="hero-section lblue-container">
	<!-- Hero Start -->
	<div class="hero-event">
		<div class="wrapper">
			<div class="d-flex justify-content-center align-items-start">
				<div class="banner-text center-align">
					<h1 class="heading"><?php echo $alrv_teho_title; ?></h1>
				</div>
			</div>
			<div class="s-30"></div>
			<div class="events-cards">
				<?php
				// WP_Query arguments
				global $paged;
				$args = array(
					'post_type'      => array( 'event' ),
					'posts_per_page' => get_option( 'posts_per_page' ), // how many posts you need
					'paged'          => ( get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1 ),
					'meta_key'   => 'alrv_seo_start_date',
					'orderby'    => 'meta_value',
					'order'      => 'ASC',
					'meta_query' => array(
							array(
								'date_clause' => array(
									'key'     => 'alrv_seo_end_date',
									'value'   => date( 'Y-m-d' ),
									'compare' => '>=',
									'type'    => 'DATE',
								),
							),
						),
				);
				// The Query
				$query = new WP_Query( $args );
				// The Loop
				if ( $query->have_posts() ) {
					while ( $query->have_posts() ) {
						$query->the_post();
						// Include specific template for the content.
						get_template_part( 'partials/content', 'archive-event' );
					}
				} else {
					// If no content, include the "No posts found" template.
					get_template_part( 'partials/content', 'none' );
				}
				wp_reset_postdata();
				wp_reset_query();
				?>
			</div>
		</div>
	</div>
	<!-- Hero End  -->

	<?php
	if ( function_exists( 'glide_pagination' ) ) {
		?>
	<div class="center-align"> <?php glide_pagination( $query->max_num_pages ); ?></div>
	<?php } ?>
	<?php
	wp_reset_postdata();
	wp_reset_query();
	?>
</section>
<div class="s-60"></div>
<section id="page-section" class="page-section">
	<div class="hero-event">
		<div class="wrapper">

			<div class="d-flex justify-content-center align-items-start">
				<div class="banner-text center-align">
					<h1 class="heading"><?php echo $alrv_teho_title_past; ?></h1>
				</div>

			</div>
			<div class="s-30"></div>
			<div class="events-cards">
				<?php
				// WP_Query arguments
				global $paged;
				$args = array(
					'post_type'      => array( 'event' ),
					'posts_per_page' => 5, // how many posts you need
					'meta_key'   => 'alrv_seo_start_date',
					'orderby'    => 'meta_value',
					'order'      => 'DSC',
					'meta_query' => array(
							array(
								'date_clause' => array(
									'key'     => 'alrv_seo_end_date',
									'value'   => date( 'Y-m-d' ),
									'compare' => '<',
									'type'    => 'DATE',
								),
							),
						),
				);
				// The Query
				$query = new WP_Query( $args );
				// The Loop
				if ( $query->have_posts() ) {
					while ( $query->have_posts() ) {
						$query->the_post();
						// Include specific template for the content.
						get_template_part( 'partials/content', 'archive-event' );
					}
				} else {
					// If no content, include the "No posts found" template.
					get_template_part( 'partials/content', 'none' );
				}
				wp_reset_postdata();
				wp_reset_query();
				?>
			</div>
		</div>
	</div>
</section>
<?php get_footer(); ?>
