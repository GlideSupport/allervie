<?php
/**
 * Block Name: Pollen Count
 *
 * The template for displaying the custom gutenberg block named pollen count.
 *
 * @link https://www.advancedcustomfields.com/resources/blocks/
 *
 * @package BaseTheme Package
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

$alrv_blk_pln_title  = $block_fields['alrv_blk_pln_title'];
$alrv_blk_pln_image  = $block_fields['alrv_blk_pln_image'];
$alrv_blk_pln_text   = $block_fields['alrv_blk_pln_text'];
$alrv_blk_pln_button = $block_fields['alrv_blk_pln_button'];
if ( $alrv_blk_pln_button ) {
	$alrv_blk_pln_button_url    = $alrv_blk_pln_button['url'];
	$alrv_blk_pln_button_title  = $alrv_blk_pln_button['title'];
	$alrv_blk_pln_button_target = $alrv_blk_pln_button['target'] ? $alrv_blk_pln_button['target'] : '';
}
?>
<div id="<?php echo $id; ?>"
	class="<?php echo $align_class . ' ' . $class_name . ' ' . $name; ?> glide-block-<?php echo $block_glide_name; ?>">
<?php if($alrv_blk_pln_title){ ?>
	<div class="iat-section iat-boxed d-flex justify-content-between flex-wrap">
		<div class="iat-image column">
			<?php echo wp_get_attachment_image( $alrv_blk_pln_image, 'thumb_600' ); ?>
		</div>
		<div class="iat-text column">
			<?php if ( $alrv_blk_pln_title ) { ?>
			<p class="text-initial heading-4"><?php echo $alrv_blk_pln_title; ?></p>
			<?php } ?>
			<?php
			if ( $alrv_blk_pln_text ) {
				echo html_entity_decode( $alrv_blk_pln_text );
			}
			?>
			<?php if ( $alrv_blk_pln_button_url ) { ?>
			<a href="<?php echo $alrv_blk_pln_button_url; ?>"
				target="<?php echo $alrv_blk_pln_button_target; ?>" class="button"
				><?php echo $alrv_blk_pln_button_title; ?></a>
			<?php } ?>
		</div>
	</div>

	<div id="pollen-count-output"></div>
	<?php } ?>
</div>
