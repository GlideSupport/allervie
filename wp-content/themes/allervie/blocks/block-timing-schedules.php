<?php
/**
 * Block Name: Timing Schedules
 *
 * The template for displaying the custom gutenberg block named timing Schedules.
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
// $custom_field_of_block = html_entity_decode($block_fields['custom_field_of_block']); // for keeping html from input
// $custom_field_of_block = html_entity_remove($block_fields['custom_field_of_block']); // for removing html from input
$alrv_blk_ts_columns = $block_fields['alrv_blk_ts_columns'];
if ( $alrv_blk_ts_columns == 'onecol' ) {
	$schedule_column_class = ' schdl-single-col ';
} elseif ( $alrv_blk_ts_columns == 'twocol' ) {
	$schedule_column_class = ' two-columns ';
}
$alrv_blk_ts_schedules = $block_fields['alrv_blk_ts_schedules'];
$alrv_blk_ts_hash_id   = ( isset( $block_fields['alrv_blk_ts_hash_id'] ) ) ? $block_fields['alrv_blk_ts_hash_id'] : null;
?>
<?php if ( $alrv_blk_ts_hash_id ) { ?>
<div id="<?php echo sanitize_title( $alrv_blk_ts_hash_id ); ?>" class="block-hash-scroll"></div>
<?php } ?>
<div id="<?php echo $id; ?>"
	class="<?php echo $align_class . ' ' . $class_name . ' ' . $name; ?> glide-block-<?php echo $block_glide_name; ?>">

	<?php if ( $alrv_blk_ts_schedules ) { ?>
	<div class="schedule-section">
		<div class="schdl-cards justify-content-between flex-wrap <?php echo $schedule_column_class; ?>">
			<?php
			foreach ( $alrv_blk_ts_schedules as $schedule ) {
				$schedule_title  = $schedule['title'];
				$schedule_values = $schedule['values'];
				?>
			<div class="schdl-sngl-card column">
				<h5><?php echo $schedule_title; ?></h5>
				<?php if ( $schedule_values ) { ?>
				<ul class="schdl-list">
					<?php
					foreach ( $schedule_values as $value ) {
						$value_value = $value['value'];
						if ( $value_value ) {
							?>
					<li>
							<?php echo $value_value; ?>
					</li>
							<?php
						}
					}
					?>
				</ul>
				<?php } ?>
			</div>
			<?php } ?>
		</div>
	</div>
	<?php } ?>

</div>
