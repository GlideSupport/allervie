<?php
/**
 * Block Name: Icon With Description
 *
 * The template for displaying the custom gutenberg block named icon with description.
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
$design_class='';
$alrv_blk_iwd_title  = $block_fields['alrv_blk_iwd_title'];
$alrv_blk_iwd_design = $block_fields['alrv_blk_iwd_design'];
$alrv_blk_iwd_description = $block_fields['alrv_blk_iwd_description'];

if ( $alrv_blk_iwd_design == 'Boxed' ) {
	$design_class = ' boxed-layout ';
}
elseif ( $alrv_blk_iwd_design == 'boxed_without_bgcolor' ) {
	$design_class = 'boxed-layout stp-cards-boxed-color ';
}

$alrv_blk_iwd_noofcolumns = $block_fields['alrv_blk_iwd_noofcolumns'];
// $alrv_blk_iwd_boxed_card_bg_color = $block_fields['alrv_blk_iwd_boxed_card_bg_color'];

// if ($alrv_blk_iwd_boxed_card_bg_color == 'no_color') {
// 	$alrv_blk_iwd_boxed_card_bg_color = '';
// } else {
// 	$alrv_blk_iwd_boxed_card_bg_color = 'stp-cards-boxed-color';
// }

if ( $alrv_blk_iwd_noofcolumns == 'Three' ) {
	$columns_count_class = ' three-columns ';
} else {
	$columns_count_class = ' four-columns ';
}
$alrv_blk_iwd_icon_design = $block_fields['alrv_blk_iwd_icon_design'];
$icon_design_class        = '';
if ( $alrv_blk_iwd_icon_design == 'simple' ) {
	$icon_design_class = '';
} elseif ( $alrv_blk_iwd_icon_design == 'spikes' ) {
	$icon_design_class = ' spike-icon ';
} elseif ( $alrv_blk_iwd_icon_design == 'circular' ) {
	$icon_design_class = ' dotted-icon ';
} elseif ( $alrv_blk_iwd_icon_design == 'whitecircular' ) {
	$icon_design_class = ' white-icons dotted-icon ';
}
$alrv_blk_iwd_columns = $block_fields['alrv_blk_iwd_columns'];
$alrv_blk_iwd_hash_id = ( isset( $block_fields['alrv_blk_iwd_hash_id'] ) ) ? $block_fields['alrv_blk_iwd_hash_id'] : null;
?>
<?php if ( $alrv_blk_iwd_hash_id ) { ?>
<div id="<?php echo sanitize_title( $alrv_blk_iwd_hash_id ); ?>" class="block-hash-scroll"></div>
<?php } ?>
<div id="<?php echo $id; ?>"
	class="<?php echo $align_class . ' ' . $class_name . ' ' . $name; ?> glide-block-<?php echo $block_glide_name; ?>">



	<div class="steps-section">
		<?php if ( $alrv_blk_iwd_title ) { ?>
		<div class="section-head center-align">
			<h2><?php echo $alrv_blk_iwd_title; ?></h2>
			<p><?php echo $alrv_blk_iwd_description; ?></p>
		</div>
		<?php } ?>
		<?php
		if ( $alrv_blk_iwd_columns ) {

				$columns_counter     = 0;

			?>
		<div class="stp-cards <?php echo $alrv_blk_iwd_design; ?> <?php echo $columns_count_class; ?> <?php echo $icon_design_class; ?> <?php echo $design_class; ?> d-flex flex-wrap">
			<?php
			foreach ( $alrv_blk_iwd_columns as $iwd ) {
				$columns_counter++;
				$iwd_icon    = $iwd['icon'];
				$iwd_heading = html_entity_decode( $iwd['heading'] );
				$iwd_text    = $iwd['text'];
				$iwd_button  = $iwd['button'];
				?>
			<div class="stp-sngl-card center-align">
				<?php if ( ($alrv_blk_iwd_design != 'Boxed') &&   ($alrv_blk_iwd_design != 'boxed_without_bgcolor')) { ?>
					<div class="animation-line">
						<svg class="c-dashed-line" width="880" height="240" xmlns="http://www.w3.org/2000/svg">
							<defs>
								<path id="c-dashed-line" d="M400  120-435 120-435 0"/>
							</defs>
							<!-- A solid green line that we'll animate -->
							<use class="c-dashed-line__path" xlink:href="#c-dashed-line"/>
							<!-- A dashed white line that sits on top of the solid green line -->
							<use class="c-dashed-line__dash" xlink:href="#c-dashed-line"/>
						</svg>

					</div>
					<?php
				}


				if ( $alrv_blk_iwd_design == 'Numbered' ) {
					$alrv_blk_iwd_icon_design = $block_fields['alrv_blk_iwd_icon_design'];
					$icon_design_class        = '';
					if ( $alrv_blk_iwd_icon_design == 'simple' ) {
						$icon_design_class = '';
					} elseif ( $alrv_blk_iwd_icon_design == 'spikes' ) {
						$icon_design_class = ' spike-icon ';
					} elseif ( $alrv_blk_iwd_icon_design == 'circular' ) {
						$icon_design_class = ' dotted-icon ';
					} elseif ( $alrv_blk_iwd_icon_design == 'whitecircular' ) {
						$icon_design_class = ' white-icons dotted-icon ';
					}

					?>
				<div class="stp-shape">
					<div class="stp-sngl-circle stp-sngl-number med-heading">
						<?php echo $columns_counter; ?>
					</div>

				</div>
				<?php } else { ?>
				<div class="stp-shape">
					<div class="stp-sngl-circle med-heading">
						<?php echo wp_get_attachment_image( $iwd_icon, 'thumb_100' ); ?>
					</div>
				</div>
				<?php } ?>
				<div class="stp-sngl-card-text">
					<p class="heading-6"><?php echo $iwd_heading; ?></p>
					<?php if ( $iwd_text ) { ?>
					<p class="iwd-text"><?php echo $iwd_text; ?></p>
						<?php if ( $alrv_blk_iwd_design == 'Numbered' ) { ?>
						<div class="desktop-hide show-btn">READ MORE</div>
					<?php } ?>
					<?php } ?>
					<?php
					if ( $iwd_button ) :
						echo glide_acf_button( $iwd_button, 'loadmore-btn' );
						endif;
					?>
				</div>
			</div>
			<?php } ?>
		</div>
		<?php } ?>
	</div>
</div>
