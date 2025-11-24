<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Allervie
 * @since 1.0.0
 */

	// WP_Query arguments
	$paged           = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
	$conditions_args = array(
		'post_type'      => array( 'service' ),
		'order'          => 'ASC',
		'orderby'        => 'date',
		'posts_per_page' => 16, // how many posts you need
		'paged'          => $paged, // add the 'paged' parameter to the query
	);
	// The Query
	$conditions_query = new WP_Query( $conditions_args );
	if ( $conditions_query->have_posts() ) {
		?>
<!-- Services Toolkit section -->
		<section>
			<div class="wrapper">
				<div class="servies-section">
					<div class="srv-cards d-flex align-items-stretch flex-wrap">
						<?php
						while ( $conditions_query->have_posts() ) {
							$conditions_query->the_post();
							$condition_term = get_the_terms( $post->ID, 'services' );

							get_template_part( 'partials/content', 'archive-service' );

						}
						?>
					</div>
					<div class="s-100"></div>
				</div>
					<?php
					if ( function_exists( 'glide_pagination' ) ) {
						?>
				<div class="center-align"> <?php glide_pagination( $conditions_query->max_num_pages ); ?></div>
					<?php } ?>
				<div class="ts-80"></div>
			</div>
		</section>
		<?php
	} wp_reset_postdata();
	wp_reset_query();
	?>
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>


	<?php get_template_part( 'partials/content' ); ?>


</div>
