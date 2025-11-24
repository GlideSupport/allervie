<?php
/**
 * Block Name: Image Alongside text
 *
 * The template for displaying the custom gutenberg block named image alongside text.
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
// $custom_field_of_block = html_entity_decode( $block_fields['custom_field_of_block'] ); // for keeping html from input
// $custom_field_of_block = html_entity_remove($block_fields['custom_field_of_block']); // for removing html from input

$alrv_blk_iat_title          = $block_fields['alrv_blk_iat_title'];
$alrv_font_size 			= $block_fields['alrv_font_size'];
$alrv_blk_iat_variation      = $block_fields['alrv_blk_iat_variation'];
$alrv_blk_iat_image_location = $block_fields['alrv_blk_iat_image_location'];
$image_location_class        = ' ';
if ( $alrv_blk_iat_image_location == 'right' ) {
	$image_location_class = ' image-at-right ';
}
$alrv_blk_iat_text   = html_entity_decode( $block_fields['alrv_blk_iat_text'] ); // for keeping html from input
$alrv_blk_iat_image  = $block_fields['alrv_blk_iat_image'];
$alrv_blk_iat_button = $block_fields['alrv_blk_iat_button'];

$alrv_blk_iat_image_variation = ( isset( $block_fields['alrv_blk_iat_image_variation'] ) ) ? $block_fields['alrv_blk_iat_image_variation'] : null;
$alrv_to_aob                  = ( isset( $block_fields['alrv_to_aob'] ) ) ? $block_fields['alrv_to_aob'] : null;
$alrv_blk_iat_hash_id         = ( isset( $block_fields['alrv_blk_iat_hash_id'] ) ) ? $block_fields['alrv_blk_iat_hash_id'] : null;

if($alrv_font_size == 'h2'){
	$head_class = 'heading-2';
} elseif($alrv_font_size == 'h3'){
	$head_class = 'heading-3';
} elseif($alrv_font_size == 'h4'){
	$head_class = 'heading-4';
} else{
	$head_class = 'heading-3';
}
?>
<?php if ( $alrv_blk_iat_hash_id ) { ?>
<div id="<?php echo sanitize_title( $alrv_blk_iat_hash_id ); ?>" class="block-hash-scroll"></div>
<?Php } ?>
<div id="<?php echo $id; ?>"
	class="<?php echo $align_class . ' ' . $class_name . ' ' . $name; ?> glide-block-<?php echo $block_glide_name; ?>">

	<?php if ( $alrv_blk_iat_variation == 'simple' ) { ?>

	<div class="iat-section d-flex justify-content-between flex-wrap <?php echo $image_location_class; ?>">
		<div class="iat-image column">
			<?php echo wp_get_attachment_image( $alrv_blk_iat_image, 'thumb_800' ); ?>
		</div>
		<div class="iat-text column">
			<?php if ( $alrv_blk_iat_title ) { ?>
			<h2 class="heading-block <?php echo $head_class;?>"><?php echo $alrv_blk_iat_title; ?></h2>
			<?php } ?>
			<?php
			if ( $alrv_blk_iat_text ) {
				echo $alrv_blk_iat_text;
			}
			?>
			<?php
			if ( $alrv_to_aob == 1 ) {
				$btn_class = 'button apt-btn';
			} else {
				$btn_class = 'loadmore-btn';
			}

			if ( $alrv_blk_iat_button ) :
				echo glide_acf_button( $alrv_blk_iat_button, $btn_class );
					endif;
			?>
		</div>
	</div>

	<?php } elseif ( $alrv_blk_iat_variation == 'bottombg' ) { ?>

	<div
		class="iat-section bottom-bg-shape d-flex justify-content-between flex-wrap <?php echo $image_location_class; ?>">
		<div class="iat-image column">
			<?php echo wp_get_attachment_image( $alrv_blk_iat_image, 'thumb_800' ); ?>
		</div>
		<div class="iat-text column">
			<?php if ( $alrv_blk_iat_title ) { ?>
			<h2 class="heading-block <?php echo $head_class;?>"><?php echo $alrv_blk_iat_title; ?></h2>
			<?php } ?>
			<?php
			if ( $alrv_blk_iat_text ) {
				echo $alrv_blk_iat_text;
			}
			?>
			<?php
			if ( $alrv_to_aob == 1 ) {
				$btn_class = 'button apt-btn';
			} else {
				$btn_class = 'loadmore-btn';
			}

			if ( $alrv_blk_iat_button ) :
				echo glide_acf_button( $alrv_blk_iat_button, $btn_class );
					endif;
			?>
		</div>
	</div>


	<?php } else { ?>


	<div class="iat-section iat-boxed d-flex justify-content-between <?php echo $image_location_class; ?>">
		<div class="iat-image column">
			<?php echo wp_get_attachment_image( $alrv_blk_iat_image, 'thumb_600' ); ?>
		</div>
		<div class="iat-text column">
			<?php if ( $alrv_blk_iat_title ) { ?>
			<h2 class="heading-block <?php echo $head_class;?>"><?php echo $alrv_blk_iat_title; ?></h4>
			<?php } ?>
			<?php
			if ( $alrv_blk_iat_text ) {
				echo $alrv_blk_iat_text;
			}
			?>
			<?php
			if ( $alrv_to_aob == 1 ) {
				$btn_class = 'button apt-btn';
			} else {
				$btn_class = 'button';
			}

			if ( $alrv_blk_iat_button ) :
				echo glide_acf_button( $alrv_blk_iat_button, $btn_class );
					endif;
			?>
		</div>
	</div>


	<?php } ?>

</div>
