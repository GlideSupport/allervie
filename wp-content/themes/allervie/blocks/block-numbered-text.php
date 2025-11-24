<?php
/**
 * Block Name: Numbered Text
 *
 * The template for displaying the custom gutenberg block named Numbered Text.
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
$alrv_blk_nt_title         = $block_fields['alrv_blk_nt_title'];
$alrv_blk_nt_text          = html_entity_decode( $block_fields['alrv_blk_nt_text'] ); // for removing html from input
$alrv_blk_nt_numbered_text = $block_fields['alrv_blk_nt_numbered_text'];
$alrv_blk_nt_hash_id       = ( isset( $block_fields['alrv_blk_nt_hash_id'] ) ) ? $block_fields['alrv_blk_nt_hash_id'] : null;
?>
<?php if ( $alrv_blk_nt_hash_id ) { ?>
<div id="<?php echo sanitize_title( $alrv_blk_nt_hash_id ); ?>" class="block-hash-scroll"></div>
<?Php } ?>
<div id="<?php echo $id; ?>"
	class="<?php echo $align_class . ' ' . $class_name . ' ' . $name; ?> glide-block-<?php echo $block_glide_name; ?>">

	<div class="numbered-text-section d-flex justify-content-between flex-wrap">
		<div class="numbrd-left">
			<?php if ( $alrv_blk_nt_title ) { ?>
			<h2 class="med-heading">
				<?php echo $alrv_blk_nt_title; ?>
			</h2>
			<?php } ?>
			<?php if ( $alrv_blk_nt_text ) { ?>
				<?php echo html_entity_decode( $alrv_blk_nt_text ); ?>
			<?php } ?>
		</div>
		<div class="numbrd-right">
			<?php
			if ( $alrv_blk_nt_numbered_text ) {
				$text_counter = 0;
				foreach ( $alrv_blk_nt_numbered_text as $text ) {
					$text_counter++;
					$text_heading = $text['heading'];
					$hash_id      = $text['hash_id'];
					$text_text    = html_entity_decode( $text['text'] );
					?>
					<div class="block-hash-scroll" id="<?php echo $hash_id; ?>"></div>
					<div class="nmbrd-row d-flex">
						<div class="nmbrd-count">
							<h2 class="gray-text"><?php echo sprintf( '%02d', $text_counter ); ?></h2>
						</div>
							<?php if ( $text_heading || $text_text ) { ?>
						<div class="nmbrd-content">
								<?php if ( $text_heading ) { ?>
							<p class="gray-text text-initial heading-4">
									<?php echo $text_heading; ?>
							</p>
							<?php } ?>
								<?php if ( $text_text ) { ?>
									<?php echo $text_text; ?>
							<?php } ?>
						</div>
						<?php } ?>
					</div>
					<?php
				}
			}
			?>

		</div>
	</div>

</div>
