<?php
/**
 * Block Name: Video
 *
 * The template for displaying the custom gutenberg block named BlockName.
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

 $alrv_blk_video_title   = $block_fields['alrv_blk_video_title'];
 $alrv_blk_video_text    = html_entity_decode( $block_fields['alrv_blk_video_text'] );
 $alrv_blk_video_img     = $block_fields['alrv_blk_video_img'];
 $alrv_blk_video_vdourl  = $block_fields['alrv_blk_video_vdourl'];
 $alrv_blk_video_overlap = $block_fields['alrv_blk_video_overlap'];
 $overlay_class          = null;
if ( $alrv_blk_video_overlap ) {
	$overlay_class = ' overlap-bottom ';
}
$alrv_blk_video_hash_id = ( isset( $block_fields['alrv_blk_video_hash_id'] ) ) ? $block_fields['alrv_blk_video_hash_id'] : null;
?>
<?php if ( $alrv_blk_video_hash_id ) { ?>
<div id="<?php echo sanitize_title( $alrv_blk_video_hash_id ); ?>" class="block-hash-scroll"></div>
<?php } ?>
<div id="<?php echo $id; ?>"
	class="<?php echo $align_class . ' ' . $class_name . ' ' . $name; ?> glide-block-<?php echo $block_glide_name; ?>">


	<div class="video-section-container <?php echo $overlay_class; ?>">
		<?php if ( $alrv_blk_video_title || $alrv_blk_video_text ) { ?>
			<div class="section-head center-align">
				<?php if ( $alrv_blk_video_title ) { ?>
					<h2><?php echo $alrv_blk_video_title; ?></h2>
				<?php } ?>
				<?php if ( $alrv_blk_video_text ) { ?>
					<?php echo $alrv_blk_video_text; ?>
				<?php } ?>
			</div>
		<?php } ?>
		<?php if (!empty($alrv_blk_video_vdourl)) { ?>
		<a href="<?php echo $alrv_blk_video_vdourl; ?>" class="video-section">
			<?php } 
			if (!empty($alrv_blk_video_img) ) {
			?>
			<div class="video-bg d-flex align-items-center justify-content-center"
				style="background-image: url(<?php echo wp_get_attachment_image_url( $alrv_blk_video_img, 'thumb_1600' ); ?>);">
				<?php if ( $alrv_blk_video_vdourl ) { ?>
				<div class="play-icon d-flex justify-content-center align-items-center">
					<img width="30" height="30" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/play-icon.svg"
						alt="Play Icon">
				</div>
				<?php } ?>
			</div>
			<?php 
			}
			 if ( $alrv_blk_video_vdourl ) { ?>
		</a>
		<?php } ?>
	</div>


</div>
