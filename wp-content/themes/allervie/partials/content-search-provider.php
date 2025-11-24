<?php
/**
 * Template part for displaying posts in an archive
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Allervie
 * @since 1.0.0
 */
$block_fields = get_fields_escaped( $block['id'] );

$image                     = get_the_post_thumbnail_url();
$title                     = get_the_title();
$alrv_cpt_team_designation = $block_fields['alrv_cpt_team_designation'];
$alrv_cpt_team_text        = html_entity_decode( $block_fields['alrv_cpt_team_text'] );

$paged                   = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
	$all_locations_query = array(
		'post_type'      => 'location',
		'posts_per_page' => -1, // how many posts you need
		'orderby'        => 'title',
		'order'          => 'ASC',
		'paged'          => $paged, // add the 'paged' parameter to the query
	);

	$all_locations_posts = new WP_Query( $all_locations_query );

	$providers_type = get_terms(
		array(
			'taxonomy'   => 'providers-type',
			'hide_empty' => false,
		)
	);

	?>

<section id="hero-section" class="hero-section">
	<!-- Hero Start -->
	<div class="hero-single">
		<div class="wrapper">
			<div class="prdr-hero-inner">
				<div class="banner-text center-align">
					<h1>Providers Search Results</h1>
					<p>
						<?php
						printf(
						/* translators: %s: search term. */
							esc_html__( 'Results for "%s"', 'alrv_td' ),
							'<span class="search-term">' . esc_html( get_search_query() ) . '</span>'
						);
						?>
					</p>
				</div>
				<div class="s-40"></div>
				<div class="provider-filter d-flex justify-content-between flex-wrap">

					<select name="providers-type" id="providers-type" class="prdr-filter">
						<option value="*"> <?php _e( 'Select Type', 'alrv_td' ); ?></option>
						<?php foreach ( $providers_type as $type ) { ?>
						<option value="<?php echo $type->slug; ?>">
							<?php echo $type->name; ?>
						</option> <?php } ?>
					</select>

					<?php if ( $all_locations_posts->have_posts() ) { ?>
					<select name="providers-location" id="providers-location" class="prdr-filter">
						<option value="*"> <?php _e( 'Select Location', 'alrv_td' ); ?></option>
						<?php
						while ( $all_locations_posts->have_posts() ) {
							$all_locations_posts->the_post();
							global $post;
							?>
						<option value="<?php echo $post->post_name; ?>">
							<?php echo the_title(); ?>
						</option>
						<?php } ?>
					</select>
					<?php } ?>

					<div class="search-form-new prdr-filter">
						<form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>"
							id="searchform">
							<div id="search-top">
								<input type="search" class="search-field"
									placeholder="<?php echo esc_attr_x( 'Search …', 'placeholder' ); ?>"
									value="<?php echo get_search_query(); ?>" name="s"
									title="<?php echo esc_attr_x( 'Search for:', 'label' ); ?>" />
								<input type="hidden" name="post_type" value="provider" />
								<div class="prdr-serach-btn">
									<input type="submit" class="search-button" value="" />
								</div>
							</div>
						</form>

					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Hero End -->
</section>
<section id="page-section" class="page-section">
	<div class="wrapper">
		<div class="providers-section">
			<div class="providers-section d-flex flex-wrap">
				<!-- Content Start -->
				<?php
				// The Loop
				if ( have_posts() ) {
					while ( have_posts() ) {
						the_post();
						// Include specific template for the content.
						get_template_part( 'partials/content', 'archive-providers' );
					}
				} else {
					// If no content, include the "No posts found" template.
					get_template_part( 'partials/content', 'none' );
				}
				?>
			</div>
			<?php
			if ( function_exists( 'glide_pagination' ) ) {
				?>
			<div class="s-100"></div>
			<div class="center-align">
				<?php glide_pagination( $all_providers_posts->max_num_pages ); ?>
			</div>
			<?php } ?>
		</div>
	</div>
	<div class="clear"></div>
	<div class="ts-80"></div>
	<!-- Content End -->
</section>
