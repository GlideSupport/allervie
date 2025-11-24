<?php
/**
 * Block Name: BlockName
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

$alrv_blk_logos_title   = ( $block_fields['alrv_blk_logos_title'] );
$logos                  = ( $block_fields['alrv_blk_logos_rep'] );
$alrv_blk_logos_cta_listing_button   = ( $block_fields['alrv_blk_logos_cta_listing_button'] );
$alrv_blk_logos_hash_id = ( isset( $block_fields['alrv_blk_logos_hash_id'] ) ) ? $block_fields['alrv_blk_logos_hash_id'] : null;

?>
<?php if ( $alrv_blk_logos_hash_id ) { ?>
<div id="<?php echo sanitize_title( $alrv_blk_logos_hash_id ); ?>" class="block-hash-scroll"></div>
<?Php } ?>
<div id="<?php echo $id; ?>"
	class="<?php echo $align_class . ' ' . $class_name . ' ' . $name; ?> glide-block-<?php echo $block_glide_name; ?>">

	<?php if ( $alrv_blk_logos_title ) { ?>
		<div class="section-head center-align">
			<h2> <?php echo $alrv_blk_logos_title; ?></h2>
		</div>
	<?php	} ?>

	<?php if ( $logos ) { 
		$count = 0; ?>
		<div class="logo-grid-section d-flex flex-wrap align-items-center justify-content-center">
			<?php
			foreach ( $logos as $logo ) {
						$logo = $logo['logo'];
						$count++;

				?>
						<div class="logo-sngl d-flex justify-content-center">
								<?php echo wp_get_attachment_image( $logo, 'thumb_400' ); ?>
						</div>
			<?php } 
			?>
		</div>
		 <script>
       		 document.querySelector('.logo-grid-section').classList.add('logo-count-<?php echo $count; ?>');
   		 </script>
	<?php } ?>
	<br>
	<?php if ( $alrv_blk_logos_cta_listing_button ) { ?>
				<div class="condition-block-btn">
					<?php echo glide_acf_button( $alrv_blk_logos_cta_listing_button, 'loadmore-btn' ); ?>
				</div>
				<?php } ?>	
</div>
