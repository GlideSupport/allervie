<?php
/**
 * Block Name: Image Alongside text Regional Hub Landing 
 *
 * The template for displaying the custom gutenberg block named image alongside text.
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
// $custom_field_of_block = html_entity_decode( $block_fields['custom_field_of_block'] ); // for keeping html from input
// $custom_field_of_block = html_entity_remove($block_fields['custom_field_of_block']); // for removing html from input

$alrv_blk_iat_title          = $block_fields['alrv_blk_iat_title'];
$alrv_font_size 			= $block_fields['alrv_font_size'];
$alrv_blk_iat_variation      = $block_fields['alrv_blk_iat_variation'];
$alrv_blk_iat_image_location = $block_fields['alrv_blk_iat_image_location'];
$alrv_blk_iat_description_second = $block_fields['alrv_blk_iat_description_second'];

$image_location_class        = ' ';
if ( $alrv_blk_iat_image_location == 'right' ) {
	$image_location_class = ' image-at-right ';
}
else
{
	$image_location_class = ' image-at-left';
}
$alrv_blk_iat_text   = html_entity_decode( $block_fields['alrv_blk_iat_text'] ); // for keeping html from input
$alrv_blk_iat_image  = $block_fields['alrv_blk_iat_image'];
$alrv_blk_iat_button = $block_fields['alrv_blk_iat_button'];


$alrv_blk_iat_hash_id         = ( isset( $block_fields['alrv_blk_iat_hash_id'] ) ) ? $block_fields['alrv_blk_iat_hash_id'] : null;

if($alrv_font_size == 'h2'){
	$head_class = 'heading-2';
} elseif($alrv_font_size == 'h3'){
	$head_class = 'heading-3';
} elseif($alrv_font_size == 'h4'){
	$head_class = 'heading-4';
} else{
	$head_class = 'heading-3';
}
?>


<?php if ( $alrv_blk_iat_hash_id ) { ?>
<div id="<?php echo sanitize_title( $alrv_blk_iat_hash_id ); ?>" class="block-hash-scroll"></div>
<?Php } ?>
<?php if ( $alrv_blk_iat_variation == 'bottombg_read_more_btn' ) { ?>
	<div id="<?php echo $id; ?>"
	   class="<?php echo $align_class . ' ' . $class_name . ' ' . $name; ?> glide-block-image-alongside-text glide-block-<?php echo $block_glide_name; ?>">
		<div
			class="iat-section bottom-bg-shape d-flex justify-content-between flex-wrap <?php echo $image_location_class; ?> iat-read-more-content ">		
		
				<?php if ( $alrv_blk_iat_title ) { ?>
					<h2 class="heading-block desktop-hidden <?php echo $head_class;?>"><?php echo $alrv_blk_iat_title; ?></h2>
					<?php } ?>
				<?php if ( $alrv_blk_iat_image ) { ?>	
				<div class="iat-image column">					
					<?php echo wp_get_attachment_image( $alrv_blk_iat_image, 'thumb_800' ); ?>
				</div>
				<?php } ?>
				<div class="iat-text column">
					<?php if ( $alrv_blk_iat_title ) { ?>
					<h2 class="heading-block <?php echo $head_class;?>"><?php echo $alrv_blk_iat_title; ?></h2>
					<?php } ?>
					<div class="paragraph-container">
						    <div class="read-more-content">
							  	<?php if ( $alrv_blk_iat_text ) {
									echo html_entity_decode($alrv_blk_iat_text);
								} ?>
							</div>
					
							<div class="read-more-content-two" style="display: none;">
							  	<?php if ( $alrv_blk_iat_description_second ) {
										echo esc_html($alrv_blk_iat_description_second);
									} ?>
							</div>
					  	<div class="read-more read-more-btn">
						    <a href="#premier-allergist" class=" loadmore-btn icon-btn">
							    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
									<path fill-rule="evenodd" clip-rule="evenodd" d="M5.83464 1.6665C3.53345 1.6665 1.66797 3.53199 1.66797 5.83317V14.1665C1.66797 16.4677 3.53345 18.3332 5.83464 18.3332H14.168C16.4691 18.3332 18.3346 16.4677 18.3346 14.1665V5.83317C18.3346 3.53199 16.4691 1.6665 14.168 1.6665H5.83464ZM10.0013 5.83317C10.4616 5.83317 10.8346 6.20627 10.8346 6.66651V9.16651H13.3346C13.7949 9.16651 14.168 9.53959 14.168 9.99984C14.168 10.4601 13.7949 10.8332 13.3346 10.8332H10.8346V13.3332C10.8346 13.7934 10.4616 14.1665 10.0013 14.1665C9.54106 14.1665 9.16797 13.7934 9.16797 13.3332V10.8332H6.66797C6.20774 10.8332 5.83464 10.4601 5.83464 9.99984C5.83464 9.53959 6.20774 9.16651 6.66797 9.16651H9.16797V6.66651C9.16797 6.20627 9.54106 5.83317 10.0013 5.83317Z" fill="url(#paint0_linear_226_1845)"></path>
									<defs>
										<linearGradient id="paint0_linear_226_1845" x1="5.71671" y1="18.9237" x2="16.8683" y2="4.74865" gradientUnits="userSpaceOnUse">
											<stop stop-color="#088D8D"></stop>
											<stop offset="1" stop-color="#3BBFC0"></stop>
										</linearGradient>
									</defs>
								</svg>
								Read More
							</a>
						 </div>
					</div>
				</div>
		</div>
	</div>
<?php } else { ?>

	<?php if (!empty($alrv_blk_iat_title) || !empty( $alrv_blk_iat_text ) || !empty( $alrv_blk_iat_button ) || !empty($alrv_blk_iat_image )) { ?> 
		<div id="<?php echo $id; ?>" class="alignwide <?php echo $align_class . ' ' . $class_name . ' ' . $name; ?> glide-block-image-alongside-text glide-<?php echo $block_glide_name; ?>">
			<div class="iat-section iat-boxed-variation-two iat-boxed d-flex justify-content-between <?php echo $image_location_class; ?> ">
				<?php if (!empty($alrv_blk_iat_image )) { ?>
					<div class="iat-image column">
						<?php echo wp_get_attachment_image( $alrv_blk_iat_image, 'thumb_600' ); ?>
					</div>
				<?php } ?>
				<?php if (!empty($alrv_blk_iat_title) || !empty( $alrv_blk_iat_text ) || !empty( $alrv_blk_iat_button )) { ?> 
					<div class="iat-text column">
						<?php if (!empty($alrv_blk_iat_title )) { ?>
							<h2 class="heading-block <?php echo $head_class;?>">
								<?php echo $alrv_blk_iat_title; ?>
							</h2>
						<?php } ?>
						<?php if (!empty( $alrv_blk_iat_text )) { ?>
						<div class="block-content">
							<?php echo $alrv_blk_iat_text; ?>
						</div>
						<?php } ?>
						<?php if (!empty( $alrv_blk_iat_button )) { ?>
							<div class="block-btn">						
								<?php echo glide_acf_button( $alrv_blk_iat_button, 'loadmore-btn' ); ?>
								
							</div>
						<?php } ?>
					</div>
				<?php } ?>
			</div>
		</div>
	<?php } ?>		
<?php } ?>
	