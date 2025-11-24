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
$alrv_blk_info_title            = $block_fields['alrv_blk_info_title'];
$alrv_blk_info_hash_id            = $block_fields['alrv_blk_info_hash_id'];
$alrv_blk_info_text             = html_entity_decode( $block_fields['alrv_blk_info_text'] );
$alrv_blk_info_select_variation = $block_fields['alrv_blk_info_select_variation'];
$alrv_blk_info_button = $block_fields['alrv_blk_info_button'];

if ( $alrv_blk_info_select_variation == 'colored' ) {
	$alrv_blk_info_variation = ' info-colored-variation ';
} else {
	$alrv_blk_info_variation = ' ';
}
?>
<?php if ( $alrv_blk_info_hash_id ) { ?>
<div id="<?php echo sanitize_title( $alrv_blk_info_hash_id ); ?>" class="block-hash-scroll"></div>
<?Php } ?>
<div id="<?php echo $id; ?>"
	class="<?php echo $align_class . ' ' . $class_name . ' ' . $name; ?> glide-block-<?php echo $block_glide_name; ?>">
<?php if($alrv_blk_info_title){ ?>
	<div class="information-section d-flex flex-wrap <?php echo $alrv_blk_info_variation; ?>">
		<div class="info-icon info-icon-blue">
			<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/information-blue-icon.svg"
				alt="">
		</div>
		<div class="info-icon info-icon-white">
			<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/information-white-icon.svg"
				alt="">
		</div>
		<div class="info-text">
			<?php if($alrv_blk_info_title){ ?>
			<p class="heading-4"><?php echo $alrv_blk_info_title; ?></p>
			<?php } ?>
			<?php if($alrv_blk_info_text){ ?>
				<?php echo $alrv_blk_info_text; ?>
			<?php } ?>
			<?php
			if ($alrv_blk_info_button):
				echo glide_acf_button($alrv_blk_info_button, 'button small-btn');
			endif;?>
		</div>
	</div>
	<?php } ?>
</div>
