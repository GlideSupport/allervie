<?php
/**
 * Block Name: Statistics
 *
 * The template for displaying the custom gutenberg block named statistics.
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

$alrv_blk_stst_title      = $block_fields['alrv_blk_stst_title'];
$alrv_blk_stst_statistics = $block_fields['alrv_blk_stst_statistics'];
$footnote                 = $block_fields['footnote'];
$alrv_blk_stst_hash_id    = ( isset( $block_fields['alrv_blk_stst_hash_id'] ) ) ? $block_fields['alrv_blk_stst_hash_id'] : null;
?>
<?php if ( $alrv_blk_stst_hash_id ) { ?>
<div id="<?php echo sanitize_title( $alrv_blk_stst_hash_id ); ?>" class="block-hash-scroll"></div>
<?Php } ?>
<div id="<?php echo $id; ?>"
	class="<?php echo $align_class . ' ' . $class_name . ' ' . $name; ?> glide-block-<?php echo $block_glide_name; ?>">



	<div class="stats-section d-flex justify-content-between flex-wrap">
		<div class="st-title">
			<?php if ( $alrv_blk_stst_title ) { ?>
			<h2 class="med-heading"><?php echo $alrv_blk_stst_title; ?></h2>
			<?php } ?>
		</div>
		<div class="st-cards center-align">
			<?php if ( $alrv_blk_stst_statistics ) { ?>
			<div class="st-cards-inner d-flex flex-wrap justify-content-center">
				<?php
				foreach ( $alrv_blk_stst_statistics as $stat ) {
					$stat_prefix  = $stat['prefix'];
					$stat_number  = $stat['number'];
					$stat_postfix = $stat['postfix'];
					$stat_text    = $stat['text'];
					?>
				<div class="st-sngl center-align">
					<h2 class="gray-text">
						<?php echo $stat_prefix; ?><span class="fig_number"><?php echo $stat_number; ?></span><?php echo $stat_postfix; ?>
					</h2>
					<?php if ( $stat_text ) { ?>
					<p><?php echo $stat_text; ?></p>
					<?php } ?>
				</div>
				<?php } ?>
			</div>
			<?php } ?>
			<?php if ( $footnote ) { ?>
			<span class="mobile-hide button white-btn r-5"><?php echo $footnote; ?></a>
				<?php } ?>
		</div>
	</div>


</div>
