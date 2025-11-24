<?php
/**
 * Template Name: Conditions
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

$alrv_pagetitle = glide_page_title( 'alrv_tco_title' );

$alrv_to_cp_conditions_page_link = ( isset( $option_fields['alrv_to_cp_conditions_page_link'] ) && $option_fields['alrv_to_cp_conditions_page_link'] != '' ) ? $option_fields['alrv_to_cp_conditions_page_link'] : null;
$conditions_terms                = get_terms(
	array(
		'taxonomy'   => 'conditions',
		'hide_empty' => false,
	)
);
?>
<section id="hero-section" class="hero-section what-we-treat-hero-section aqua-gradiant-container">
	<!-- hero start -->
	<div class="hero-what-we-treat">
		<div class="wrapper">
			<div class="d-flex justify-content-center">
				<div class="banner-text center-align">
					<h1><?php echo $alrv_pagetitle; ?></h1>
					<div class="s-30"></div>
					<div class="cdns-categories mobile-hide">
						<?php if ( $alrv_to_cp_conditions_page_link ) { ?>
						<a href="<?php echo $alrv_to_cp_conditions_page_link; ?>"
							class="button show-all-catagories white-btn current">all</a>
						<?php } ?>
						<?php
						if ( $conditions_terms ) {
							foreach ( $conditions_terms as $condition ) {
								?>
						<a href="<?php echo get_term_link( $condition ); ?>" class="button white-btn">
							<span
								style="background-color: <?php echo get_field( 'alrv_tax_cco_color', $condition->taxonomy . '_' . $condition->term_id ); ?>;"></span>
								<?php echo $condition->name; ?>
						</a>
								<?php
							}
						}
						?>
					</div>
					<div class="menu-dropdown desktop-hide">
						<div class="cdn-cat-mobile desktop-hide">Select filter</div>
						<ul class="locations">

							<?php
							if ( $conditions_terms ) {
								foreach ( $conditions_terms as $condition ) {
									?>
								<li>
									<a href="<?php echo get_term_link( $condition ); ?>"><?php echo $condition->name; ?></a>
								</li>
									<?php
								}
							}
							?>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- hero end -->
</section>
<section id="page-section" class="page-section">
	<!-- Content Start -->
	<div class="wrapper glide-block-services-we-provide-tmp">
		<div class="servies-section">
			<div class="srv-cards d-flex align-items-stretch flex-wrap">
				<?php
				$paged           = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
				$args = array(
					'post_type'      => array( 'condition' ),
					'order'          => 'ASC',
					'orderby'        => 'title',
					'posts_per_page' => get_option( 'posts_per_page' ), // how many posts you need
					'paged'          => $paged, // add the 'paged' parameter to the query
				);
				// The Query
				$query = new WP_Query( $args );
				if ( $query->have_posts() ) {
					while ( $query->have_posts() ) {
						$query->the_post();
						// Include specific template for the content.
						get_template_part( 'partials/content', 'archive-condition' );
					}
				}
				?>
			</div>
			<div class="s-100"></div>
		</div>
		<?php if ( function_exists( 'glide_pagination' ) ) { ?>
			<div class="center-align"> <?php glide_pagination( $query->max_num_pages ); ?></div>
		<?php }
		wp_reset_postdata();
		wp_reset_query();
		?>
		<div class="ts-80"></div>
	</div>
	<div class="clear"></div>
	<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<?php get_template_part( 'partials/content' ); ?>
	</div>
	<!-- Content End -->
</section>
<?php get_footer(); ?>
