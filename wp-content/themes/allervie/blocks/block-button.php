<?php
/**
 * Block Name: Buttons
 *
 * The template for displaying the custom gutenberg block named Buttons.
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
$alrv_blk_btn_variation = $block_fields['alrv_blk_btn_variation'];
$alrv_blk_btn_alignment = $block_fields['alrv_blk_btn_alignment'];
if ( $alrv_blk_btn_alignment == 'center' ) {
	$button_alignment = ' center-align-btn ';
} elseif ( $alrv_blk_btn_alignment == 'right' ) {
	$button_alignment = ' right-align-btn ';
} else {
	$button_alignment = ' left-align-btn ';
}
?>
<div id="<?php echo $id; ?>"
	class="<?php echo $align_class . ' ' . $class_name . ' ' . $name; ?> glide-block-<?php echo $block_glide_name; ?>">
	<div class="glide-button-ctn <?php echo $button_alignment; ?>">
		<?php
		if ( $alrv_blk_btn_variation == 'single' ) {
			$alrv_blk_button        = $block_fields['alrv_blk_button'];
			$alrv_blk_btn_style     = $block_fields['alrv_blk_btn_style'];


			if ( $alrv_blk_btn_style == 'default' ) {
				$block_btn_class = ' button ';
			} elseif ( $alrv_blk_btn_style == 'default-small' ) {
				$block_btn_class = ' button small-btn ';
			} elseif ( $alrv_blk_btn_style == 'white-button' ) {
				$block_btn_class = ' button white-btn ';
			} elseif ( $alrv_blk_btn_style == 'white-button-location' ) {
				$block_btn_class = ' button white-btn loc-btn ';
			} elseif ( $alrv_blk_btn_style == 'green-button-grdnt' ) {
				$block_btn_class = ' button aqua-btn ';
			} elseif ( $alrv_blk_btn_style == 'trp-button' ) {
				$block_btn_class = 'trp-btn loc-btn small-btn';
			} elseif ( $alrv_blk_btn_style == 'loadmore' ) {
				$block_btn_class = ' loadmore-btn ';
			}
			if ( $alrv_blk_button ) :
						echo glide_acf_button( $alrv_blk_button, $block_btn_class );
					endif;
		} else {
			$alrv_blk_buttons       = $block_fields['alrv_blk_buttons'];
			if ( $alrv_blk_buttons ) {
				foreach ( $alrv_blk_buttons as $button ) {
					$button_link  = $button['button'];
					$button_style = $button['style'];
					if ( $button_style == 'default' ) {
						$block_btn_class = ' button ';
					} elseif ( $button_style == 'default-small' ) {
						$block_btn_class = ' button small-btn ';
					} elseif ( $button_style == 'white-button' ) {
						$block_btn_class = ' button white-btn ';
					} elseif ( $button_style == 'white-button-location' ) {
						$block_btn_class = ' button white-btn loc-btn ';
					} elseif ( $button_style == 'green-button-grdnt' ) {
						$block_btn_class = ' button aqua-btn ';
					} elseif ( $button_style == 'trp-button' ) {
						$block_btn_class = 'trp-btn loc-btn small-btn';
					} elseif ( $button_style == 'loadmore' ) {
						$block_btn_class = ' loadmore-btn ';
					}
					if ( $button_link ) :
						echo glide_acf_button( $button_link, $block_btn_class );
					endif;
				}
			}
		}
		?>
	</div>


</div>
