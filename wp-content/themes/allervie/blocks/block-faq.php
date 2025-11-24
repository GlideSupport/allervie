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

   $alrv_blk_faq_title   = $block_fields['alrv_blk_faq_title'];
   $alrv_blk_faq_faqs    = $block_fields['alrv_blk_faq_faqs'];
   $alrv_blk_faq_hash_id = ( isset( $block_fields['alrv_blk_faq_hash_id'] ) ) ? $block_fields['alrv_blk_faq_hash_id'] : null;
?>
<?php if ( $alrv_blk_faq_hash_id ) { ?>
<div id="<?php echo sanitize_title( $alrv_blk_faq_hash_id ); ?>" class="block-hash-scroll"></div>
<?Php } ?>
<div id="<?php echo $id; ?>" class="<?php echo $align_class . ' ' . $class_name . ' ' . $name; ?> glide-block-<?php echo $block_glide_name; ?>">
	<div class="faqs-section">
		<?php if ( $alrv_blk_faq_title ) { ?>
			<div class="section-head center-align">
				<h2><?php echo $alrv_blk_faq_title; ?></h2>
			</div>
		<?php } ?>
		<?php if ( $alrv_blk_faq_faqs ) { ?>
			<div class="faqs-area">
				<?php
				foreach ( $alrv_blk_faq_faqs as $faq ) {
					$faq_question = $faq['question'];
					$faq_answer   = $faq['answer'];
					if ( $faq_question ) {
						?>
				<div class="faq">
					<h3 class="medium-text d-flex justify-content-between heading-6">
						<?php echo $faq_question; ?> <span class="close-icon"></span>
					</h3>
					<div class="faq-content" style="display: none">
						<?php echo html_entity_decode( $faq_answer ); ?>

					</div>
				</div>
			<?php } }	?>
		</div>
		<?php } ?>
	</div>
</div>
