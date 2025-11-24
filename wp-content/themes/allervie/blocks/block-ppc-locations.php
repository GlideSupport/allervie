<?php
/**
 * Block Name: PPC Location
 *
 * The template for displaying the custom gutenberg block named conditions list.
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

$alrv_blk_ppc_title        = $block_fields['alrv_blk_ppc_title'];
$alrv_blk_ppc_text         = html_entity_decode( $block_fields['alrv_blk_ppc_text'] );
$alrv_blk_ppc_button = $block_fields['alrv_blk_ppc_button'];
$alrv_blk_ppc_image = $block_fields['alrv_blk_ppc_image'];
$alrv_blk_ppc_image = wp_get_attachment_image( $alrv_blk_ppc_image, 'thumb_600', null, array( 'class' => '' ) );
?>
<div id="<?php echo $id; ?>" class="<?php echo $align_class . ' ' . $class_name . ' ' . $name; ?> glide-block-<?php echo $block_glide_name; ?>">
	<div class="ppc-locations-block">
		<?php if($alrv_blk_ppc_image){  ?>
			<div class="ppc-logo"> <?php echo $alrv_blk_ppc_image; ?>  </div>
		<?php } ?>
		<div class="ppc-location-content">
				<?php if($alrv_blk_ppc_image){  ?>
					<div class="ppc-logo show-on-mobile"> <?php echo $alrv_blk_ppc_image; ?>  </div>
				<?php } ?>
			<?php if($alrv_blk_ppc_title){  ?>
				<h2 class="heading-3"> <?php echo $alrv_blk_ppc_title; ?>  </h2>
			<?php } ?>
			<?php
				if($alrv_blk_ppc_text){
					echo $alrv_blk_ppc_text;
				}
			?>

			<?php if( $alrv_blk_ppc_button ) { ?>
				<div class="ppc-call-btn">
					<?php echo glide_acf_button( $alrv_blk_ppc_button, 'button aqua-btn ppc-header-phone big-btn' ); ?>
				</div>
			<?php } ?>
		</div>
		<div class="clear"></div>
	</div>
</div>
