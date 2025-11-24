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

$alrv_blk_main_list = ( $block_fields['alrv_blk_main_list'] );
?>

<div id="<?php echo $id; ?>"
	class="<?php echo $align_class . ' ' . $class_name . ' ' . $name; ?> glide-block-<?php echo $block_glide_name; ?>">

	<?php if ( $alrv_blk_main_list ) { ?>
	<div class="list-section">
		<ol>
			<?php
				// main list
			foreach ( $alrv_blk_main_list as $list ) {

				$heading       = $list ['main_list_heading'];
				$text          = $list ['main_list_text'];
				$main_sub_list = $list ['main_sub_list'];
				?>
			<li>
				<?php if ( $heading ) { ?>
				<h3><?php echo $heading; ?></h3>
				<?php } ?>
				<?php if ( $text ) { ?>
				<p><?php echo $text; ?></p>
				<?php } ?>

				<!-- main sub list -->
				<?php if ( $main_sub_list ) { ?>
				<ol>
					<?php
					foreach ( $main_sub_list as $sub_list ) {
						$main_sub_list_heading     = $sub_list ['main_sub_list_heading'];
						$main_sub_list_text        = $sub_list ['main_sub_list_text'];
						$main_list_second_sub_list = $sub_list ['main_list_second_sub_list'];
						?>
					<li>
						<?php if ( $main_sub_list_heading ) { ?>
						<h4><?php echo $main_sub_list_heading; ?></h4>
						<?php } ?>
						<?php if ( $main_sub_list_text ) { ?>
						<p><?php echo $main_sub_list_text; ?></p>
						<?php } ?>
						<!-- second sublist -->
						<?php if ( $main_list_second_sub_list ) { ?>
						<ol>
							<?php
							foreach ( $main_list_second_sub_list as $second_sub_list ) {
								$second_sub_list_heading = $second_sub_list['second_sub_list_heading'];
								$second_sub_list_text    = $second_sub_list['second_sub_list_text'];
								?>
							<li>
								<?php if ( $second_sub_list_heading ) { ?>
								<h4><?php echo $second_sub_list_heading; ?></h4>
								<?php } ?>
								<?php if ( $second_sub_list_text ) { ?>
								<p><?php echo $second_sub_list_text; ?></p>
								<?php } ?>
							</li>
							<?php } ?>
						</ol>
						<?php } ?>
					</li>
					<?php } ?>
				</ol>
				<?php } ?>
			</li>

			<?php } ?>
		</ol>
	</div>
	<?php } ?>
</div>
