<?php
/**
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

$alrv_to_cp_services_page_link = ( isset( $option_fields['alrv_to_cp_services_page_link'] ) && $option_fields['alrv_to_cp_services_page_link'] != '' ) ? $option_fields['alrv_to_cp_services_page_link'] : null;
$conditions_terms              = get_terms(
	array(
		'taxonomy'   => 'services',
		'hide_empty' => false,
	)
);

$current_termid = get_queried_object()->term_id;

?>
<section id="hero-section" class="hero-section what-we-treat-hero-section aqua-gradiant-container">
	<!-- hero start -->
	<div class="hero-what-we-treat">
		<div class="wrapper">
			<div class="d-flex justify-content-center">
				<div class="banner-text center-align">
					<h1><?php the_archive_title(); ?></h1>
					<div class="s-30"></div>
					<div class="cdns-categories mobile-hide">
						<?php if ( $alrv_to_cp_services_page_link ) { ?>
						<a href="<?php echo $alrv_to_cp_services_page_link; ?>"
							class="button show-all-catagories white-btn all-cats">all</a>
						<?php } ?>
						<?php
						foreach ( $conditions_terms as $condition ) {
							$current_selected_class = ' ';
							$condition_termid       = $condition->term_id;
							if ( $current_termid == $condition_termid ) {
								$current_selected_class = ' current ';
								?>
						<a href="<?php echo get_term_link( $condition ); ?>"
							style="background-color: <?php echo get_field( 'alrv_tax_cso_color', $condition->taxonomy . '_' . $condition->term_id ); ?>; color:#ffffff;"
							class="button white-btn <?php echo $current_selected_class; ?>">
							<span style="background-color: #ffffff;"></span>
								<?php echo $condition->name; ?>
						</a>
						<?php } else { ?>
						<a href="<?php echo get_term_link( $condition ); ?>"
							class="button white-btn <?php echo $current_selected_class; ?>">
							<span
								style="background-color: <?php echo get_field( 'alrv_tax_cso_color', $condition->taxonomy . '_' . $condition->term_id ); ?>;"></span>
								<?php echo $condition->name; ?>
						</a>

						<?php } ?>
						<?php } ?>
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
	<!-- Services Toolkit section -->
	<div class="wrapper glide-block-services-we-provide-tmp">
		<div class="servies-section">
			<div class="srv-cards d-flex align-items-stretch flex-wrap">
				<?php
				global $wp_query;
				while ( have_posts() ) {
					the_post();

					get_template_part( 'partials/content', 'archive-service' );
				}
				?>
			</div>
			<div class="s-100"></div>
		</div>
			<?php
			if ( function_exists( 'glide_pagination' ) ) {
				?>
		<div class="center-align"> <?php glide_pagination( $wp_query->max_num_pages ); ?></div>
			<?php } ?>
		<div class="ts-80"></div>
	</div>
	<div class="clear"></div>
	<!-- Content End -->
</section> <?php get_footer(); ?>
