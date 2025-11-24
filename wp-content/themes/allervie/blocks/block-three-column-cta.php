<?php
/**
 * Block Name: 3 Column CTA
 *
 * The template for displaying the custom gutenberg block named 3 column CTA.
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

$alrv_blk_tccta_title   = $block_fields['alrv_blk_tccta_title'];
$alrv_blk_tccta_columns = $block_fields['alrv_blk_tccta_columns'];

?>
<div id="<?php echo $id; ?>"
	class="<?php echo $align_class . ' ' . $class_name . ' ' . $name; ?> glide-block-<?php echo $block_glide_name; ?>">
	<div class="iwd-section">
		<?php if ( $alrv_blk_tccta_title ) { ?>
		<div class="section-head center-align">
			<h2>
				<?php echo $alrv_blk_tccta_title; ?>
			</h2>
		</div>
		<?php } ?>
		<?php if ( $alrv_blk_tccta_columns ) { ?>
		<div class="iwd-cards d-flex align-items-stretch flex-wrap">
			<?php
			foreach ( $alrv_blk_tccta_columns as $col ) {
				$col_heading = $col['heading'];
				$col_text    = $col['text'];
				$col_image   = $col['image'];
				$col_button  = $col['button'];
				?>
			<div class="iwd-sngl-card">
				<div class="iwd-sngl-img">
					<?php
					if ( $col_image ) {
						echo wp_get_attachment_image( $col_image, 'thumb_600' );
					} else {
						?>
					<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/defaults/default-image.webp"
						alt="<?php echo $col_heading; ?>" />
					<?php } ?>
				</div>
				<div class="iwd-sngl-text">
					<h5>
						<?php echo $col_heading; ?>
					</h5>
					<?php
					if ( $col_text ) {
						echo html_entity_decode( $col_text );
					} else {
						?>
						<div class="s-16"></div>
					<?php } ?>
					<?php
					if ( $col_button ) :
						echo glide_acf_button( $col_button, 'button small-btn' );
						endif;
					?>
				</div>
			</div>
			<?php } ?>
		</div>
		<?php } ?>
	</div>
</div>
