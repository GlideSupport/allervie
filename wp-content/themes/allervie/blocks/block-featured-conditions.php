<?php
/**
 * Block Name:  Conditions (Single Location)
 *
 * The template for displaying the custom gutenberg block named Buttons.
 *
 * @link https://www.advancedcustomfields.com/resources/blocks/
 *
 * @package Allervie
 * @since 1.0.0
 */

// Get all the fields from ACF for this block ID
// $block_fields = get_fields( $block['id'] );
$block_fields = get_fields_escaped( $block['id'] );
// $block_fields = get_fields_escaped( $block['id'] ,'sanitize_text_field' ); // if want to remove all html


// Set the block name for it's ID & class from it's file name
$block_glide_name = $block['name'];
$block_glide_name = str_replace( 'acf/', '', $block_glide_name );

// Set the preview thumbnail for this block for gutenberg editor view.
if ( isset( $block['data']['preview_image_help'] ) ) {    /* rendering in inserter preview  */
	echo '<img src="' . $block['data']['preview_image_help'] . '" style="width:100%; height:auto;">';
}

// create align class ("alignwide") from block setting ("wide").
$align_class = $block['align'] ? 'align' . $block['align'] : '';

// Get the class name for the block to be used for it.
$class_name = ( isset( $block['className'] ) ) ? $block['className'] : null;

// Making the unique ID for the block.
$id = 'block-' . $block_glide_name . '-' . $block['id'];

// Making the unique ID for the block.
if ( $block['name'] ) {
	$block_name = $block['name'];
	$block_name = str_replace( '/', '-', $block_name );
	$name       = 'block-' . $block_name;
}

//Variation Field for New Layout (5 Conditions in Mobile, Layout similar to services)
// $conditions_alv_layout   = $block_fields['conditions_alv_layout'];

$pID = get_the_ID();
if ( function_exists( 'get_fields' ) && function_exists( 'get_fields_escaped' ) ) {
	$post_fields = get_fields_escaped( $pID );
}
$alrv_slo_conditions_on_location    = ( isset( $post_fields['alrv_slo_conditions_on_location'] ) ) ? $post_fields['alrv_slo_conditions_on_location'] : null;
$alrv_slo_providers_title_condition = ( isset( $post_fields['alrv_slo_providers_title_condition'] ) ) ? $post_fields['alrv_slo_providers_title_condition'] : null;
$alrv_slo_providers_ctitle_bn       = ( isset( $post_fields['alrv_slo_providers_ctitle_bn'] ) ) ? $post_fields['alrv_slo_providers_ctitle_bn'] : null;

?>
<div id="<?php echo $id; ?>" class="<?php echo $align_class . ' ' . $class_name . ' ' . $name; ?> glide-block-<?php echo $block_glide_name; ?> premier-allergist-location">

	<?php if ( $alrv_slo_conditions_on_location ) { ?>

		<div class="servies-section">
			<div class="section-head center-align">
				<h2>
					<?php echo $alrv_slo_providers_title_condition; ?>
				</h2>
			</div>
			<div class="service-teaser srv-cards owl-carousel owl-theme">
				<?php
					global $post;
				foreach ( $alrv_slo_conditions_on_location as $key => $condition ) {
					$post = $condition;
					setup_postdata( $post );
					$pID        = get_the_ID();
					$conditions = get_the_terms( $pID, 'conditions' );

					$the_title   = get_the_title( $pID );
					$the_content = get_the_excerpt( $pID );


					$src = wp_get_attachment_image_src( get_post_thumbnail_id( $pID ), 'thumb_400', false );
					if ( $src ) {
						$src = $src[0];
					}
					?>
				<div class="item">
					<div class="srv-sngl-card">
						<div class="srv-sngl-img">
						<?php if ( $src ) { ?>
								<img src="<?php echo $src; ?>" alt="<?php the_title(); ?>">
							<?php } else { ?>
								<img src="<?php echo esc_url( get_template_directory_uri() ) . '/assets/img/admin/defaults/default-image.webp'; ?>" alt="<?php the_title(); ?>">
							<?php } ?>
						<?php
						if ( $conditions ) {
							foreach ( $conditions as $condition ) {
								$color = get_term_meta( $condition->term_id, 'alrv_tax_cco_color' )[0];
								// dump($color);
								?>
								<div class="services-catagories">
									<span class="cat-btn" style="background-color: <?php echo $color; ?>;"><?php echo $condition->name; ?> </span>
								</div>
								<?php } ?>
							<?php } ?>
						</div>
						<div class="srv-sngl-text">
							<p class="heading-5">
								<?php echo $the_title; ?>
							</p>
							<p>
								<?php echo $the_content; ?>
							</p>
							<a href="<?php echo get_the_permalink( $pID ); ?>" class="button small-btn hide-on-mobile"><?php _e( 'learn more', 'alrv_td' ); ?></a>
							<a href="<?php echo get_the_permalink( $pID ); ?>" class="learn-more show-on-mobile"><?php _e( 'learn more', 'alrv_td' ); ?></a>
						</div>
					</div>
				</div>
			<?php } ?>

			</div>
			<div class="s-30"></div>
			<?php if ( $alrv_slo_providers_ctitle_bn ) { ?>
				<div class="center-align">
					<?php echo glide_acf_button( $alrv_slo_providers_ctitle_bn, 'loadmore-btn' ); ?>
				</div>
			<?php } ?>

		</div>
	<?php } ?>
</div>
