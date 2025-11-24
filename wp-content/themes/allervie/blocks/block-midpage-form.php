<?php
/**
 * Block Name: Midpage Form
 *
 * The template for displaying the custom gutenberg block named Midpage Form.
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
$alrv_blk_midpage_form_title = (isset($block_fields['alrv_blk_midpage_form_title'])) ? $block_fields['alrv_blk_midpage_form_title'] : null;
$alrv_blk_midpage_form_text = (isset($block_fields['alrv_blk_midpage_form_text'])) ? $block_fields['alrv_blk_midpage_form_text'] : null;
$alrv_blk_midpage_form = (isset($block_fields['alrv_blk_midpage_form'])) ? $block_fields['alrv_blk_midpage_form'] : null;

?>

<div id="<?php echo $id; ?>"
	class="<?php echo $align_class . ' ' . $class_name . ' ' . $name; ?> glide-block-<?php echo $block_glide_name; ?>">
	<div class="midpage-form-section">
		<div class="wrapper">
			<div class="midpage-form-content center-align">
				<div class="midpage-content">
					<?php if ( $alrv_blk_midpage_form_title ) { ?>
					<h2 class="med-heading">
						<?php echo $alrv_blk_midpage_form_title; ?>
					</h2>
					<?php } ?>
					<?php if ( $alrv_blk_midpage_form_text ) { ?>
					<?php echo html_entity_decode($alrv_blk_midpage_form_text); ?>
					<?php } ?>
				</div>
				<div class="midpage-form">
					<?php
						if ( $alrv_blk_midpage_form ) {
							echo do_shortcode( '[gravityform id="' . $alrv_blk_midpage_form . '" title=false description=false ajax=true]' );
						}
					?>
				</div>
			</div>
		</div>
	</div>
</div>