<?php
/**
 * Block Name: Services
 *
 * The template for displaying the custom gutenberg block named services.
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

// Block variables

$alrv_srvc_title  = $block_fields['alrv_srvc_title'];
$alrv_srvc_text   = html_entity_decode( $block_fields['alrv_srvc_text'] );
$alrv_srvc_button = $block_fields['alrv_srvc_button'];


global $post;
$lp_select_posts   = array();
$lp_select_posts   = $block_fields['alrv_srvc_services'];
$alrv_srvc_hash_id = ( isset( $block_fields['alrv_srvc_hash_id'] ) ) ? $block_fields['alrv_srvc_hash_id'] : null;
?>
<?php if ( $alrv_srvc_hash_id ) { ?>
<div id="<?php echo sanitize_title( $alrv_srvc_hash_id ); ?>" class="block-hash-scroll"></div>
<?Php } ?>
<div id="<?php echo $id; ?>"
	class="<?php echo $align_class . ' ' . $class_name . ' ' . $name; ?> glide-block-<?php echo $block_glide_name; ?> glide-block-services-we-provide">

	<div class="servies-section">
		<div class="section-head center-align">
			<?php if ( $alrv_srvc_title ) { ?>
				<h2>
					<?php echo $alrv_srvc_title; ?>
				</h2>
			<?php } ?>
			<?php if ( $alrv_srvc_text ) { ?>
					<?php echo $alrv_srvc_text; ?>
			<?php } ?>
		</div>
		<?php if ( $lp_select_posts ) { ?>
		<div class="srv-cards d-flex align-items-stretch flex-wrap">
			<?php
			foreach ( $lp_select_posts as $lp_posts ) {
				$post = $lp_posts;
				setup_postdata( $post );
				$pID             = $post->ID;
				$post_fields     = get_fields( $pID );
				$post_excerpt    = get_the_excerpt( $pID );
				$serviceCategory = get_the_terms( $pID, 'services' );
				foreach ( $serviceCategory as $category ) {
					$current_category = $category;
					$currentColor     = get_field( 'alrv_tax_cso_color', $category->taxonomy . '_' . $category->term_id );
					break;
				}
				$image = wp_get_attachment_image( get_post_thumbnail_id( $pID ), 'thumb_500', false );
				if ( ! $image ) {
					$image = '<img width="500" height="354" src="'.get_template_directory_uri() . '/assets/img/defaults/default-image.webp" alt="'.get_the_title($pID).'" >';
				}

				?>
				<article class="srv-sngl-card">
					<a href="<?php the_permalink(); ?>" class="srv-inner-card">
						<div class="srv-sngl-img">
							<?php echo $image; ?>
							<?php
							if ( $current_category ) {
								?>
							<div class="services-catagories">
								<span class="cat-btn"
									style="background-color: <?php echo $currentColor; ?>;"><?php echo $current_category->name; ?></span>
							</div>
							<?php } ?>
						</div>
						<div class="srv-sngl-text">
							<p class="heading-5">
								<?php the_title(); ?>
							</p>
							<?php if ( $post_excerpt ) { ?>
							<p class="mobile-hide">
								<?php echo $post_excerpt; ?>
							</p>
							<?php } ?>
							<span class="button small-btn hide-on-mobile">learn more</span>
							<span class="learn-more show-on-mobile">learn more</span>
						</div>
					</a>
				</article>
			<?php } ?>
		</div>
		<div class="s-60"></div>
			<?php
		} wp_reset_query();
		wp_reset_postdata();
		?>
		<?php if ( $alrv_srvc_button ) { ?>
		<div class="center-align">
			<?php echo glide_acf_button( $alrv_srvc_button, 'loadmore-btn' ); ?>
		</div>
		<?php } ?>
	</div>

</div>
