<?php
/**
 * Block Name: Custom Quote
 *
 * The template for displaying the custom gutenberg block named custom quote.
 *
 * @link https://www.advancedcustomfields.com/resources/blocks/
 *
 * @package Allervie
 * @since 1.0.0
 */

// Get all the fields from ACF for this block ID
// $block_fields = get_fields( $block['id'] );
//$block_fields = get_fields_escaped( $block['id'] );
$block_fields = get_fields_escaped( $block['id'] ,'sanitize_text_field' ); // if want to remove all html

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

$alrv_blk_cq_design_variation = $block_fields['alrv_blk_cq_design_variation'];
$alrv_blk_cq_add_info = $block_fields['alrv_blk_cq_add_info'];
$alrv_blk_cq_hash_id  = ( isset( $block_fields['alrv_blk_cq_hash_id'] ) ) ? $block_fields['alrv_blk_cq_hash_id'] : null;
$count = count($alrv_blk_cq_add_info);
?>
<?php if ( $alrv_blk_cq_hash_id ) { ?>
	<div id="<?php echo sanitize_title( $alrv_blk_cq_hash_id ); ?>" class="block-hash-scroll"></div>
<?php } ?>
<div id="<?php echo $id; ?>" class="<?php echo $align_class . ' ' . $class_name . ' ' . $name; ?> glide-block-<?php echo $block_glide_name; ?>">
	<div class="wrapper">
		<?php 
		if ( $alrv_blk_cq_design_variation == 'with-image' ){ ?>
			<?php if ( $alrv_blk_cq_add_info ) { ?>
				<div class="custom-quote-section">
					<?php if ($count > 1) { ?>
						<div class="custom-quote-slider owl-carousel owl-theme">
							<?php
							foreach ( $alrv_blk_cq_add_info as $info ) {
								$image = $info['alrv_blk_cq_headshot_image'];
								$title = $info['alrv_blk_cq_title'];
								$description = $info['alrv_blk_cq_description'];

								// To set the Initials of the name in the default image.
								$expr      = '/(?<=\s|^)\w/iu';
								preg_match_all( $expr, $title, $matches );
								$get_letter = implode( '', $matches[0] );
								$get_letter = mb_strtoupper( $get_letter );
								$get_letter = substr( $get_letter, 0, 2 );

								if ( !$image ) {
									$img = '<div class="prdr-image  d-flex justify-content-center align-items-center"><h3>'. $get_letter .'</h3></div>';
								} else {
									$img = '<img src="' . $image['url'] . '" alt="' . $image['alt'] . '">';
								}
								?>
								<div class="item">
						
										<?php if($img) { ?>
											<div class="left-col">
												<div class="quote-icon"></div>
											<div class="left-image">
															
												<?php echo $img; ?>
											</div></div>
										<?php } ?>
								
									<div class="right-content">
										<?php if ( $title ) { ?>
											<h5 class="author">
												<?php echo $title; ?>
											</h5>
										<?php } ?>
										<?php if ( $description ) { ?>
											<?php echo $description; ?>
										<?php } ?>
									</div>
								</div>
							<?php } ?>
						</div>
					<?php }else { ?>
						<div class="custom-quote-single">
							<?php
							foreach ( $alrv_blk_cq_add_info as $info ) {
								$image = $info['alrv_blk_cq_headshot_image'];
								$title = $info['alrv_blk_cq_title'];
								$description = $info['alrv_blk_cq_description'];

								// To set the Initials of the name in the default image.
								$expr      = '/(?<=\s|^)\w/iu';
								preg_match_all( $expr, $title, $matches );
								$get_letter = implode( '', $matches[0] );
								$get_letter = mb_strtoupper( $get_letter );
								$get_letter = substr( $get_letter, 0, 2 );

								if ( !$image ) {
									$img = '<div class="prdr-image  d-flex justify-content-center align-items-center"><h3>'. $get_letter .'</h3></div>';
								} else {
									$img = '<img src="' . $image['url'] . '" alt="' . $image['alt'] . '">';
								}
								?>
								<div class="item">
						
										<?php if($img) { ?>
											<div class="left-col">
												<div class="quote-icon"></div>
											<div class="left-image">
															
												<?php echo $img; ?>
											</div></div>
										<?php } ?>
								
									<div class="right-content">
										<?php if ( $title ) { ?>
											<h5 class="author">
												<?php echo $title; ?>
											</h5>
										<?php } ?>
										<?php if ( $description ) { ?>
											<?php echo $description; ?>
										<?php } ?>
									</div>
								</div>
							<?php } ?>
						</div>
					<?php } ?>
				</div>
			<?php } 
		}else{
			if ( $alrv_blk_cq_add_info ) { ?>
				<div class="custom-quote-section without-image">
					<?php if ($count > 1) { ?>
						<div class="custom-quote-slider owl-carousel owl-theme">
							<?php
							foreach ( $alrv_blk_cq_add_info as $info ) {
								$image = $info['alrv_blk_cq_headshot_image'];
								$title = $info['alrv_blk_cq_title'];
								$description = $info['alrv_blk_cq_description'];
								if ( !$image ) {
									$img = '<img src='.get_template_directory_uri() . '/assets/img/defaults/default-avatar.webp>';
								} else {
									$img = '<img src="' . $image['url'] . '" alt="' . $image['alt'] . '">';
								}
								?>
								<div class="item">
									<div class="right-content">
										<div class="quote-icon"></div>
										<?php if ( $title ) { ?>
											<h5 class="author">
												<?php echo $title; ?>
											</h5>
										<?php } ?>
										<?php if ( $description ) { ?>
											<?php echo $description; ?>
										<?php } ?>
									</div>
								</div>
							<?php } ?>
						</div>
					<?php }else { ?>
						<div class="custom-quote-single">
							<?php
							foreach ( $alrv_blk_cq_add_info as $info ) {
								$image = $info['alrv_blk_cq_headshot_image'];
								$title = $info['alrv_blk_cq_title'];
								$description = $info['alrv_blk_cq_description'];
								if ( !$image ) {
									$img = '<img src='.get_template_directory_uri() . '/assets/img/defaults/default-avatar.webp>';
								} else {
									$img = '<img src="' . $image['url'] . '" alt="' . $image['alt'] . '">';
								}
								?>
								<div class="item">
									<div class="right-content">
										<div class="quote-icon"></div>
										<?php if ( $title ) { ?>
											<h5 class="author">
												<?php echo $title; ?>
											</h5>
										<?php } ?>
										<?php if ( $description ) { ?>
											<?php echo $description; ?>
										<?php } ?>
									</div>
								</div>
							<?php } ?>
						</div>
					<?php } ?>
				</div>
				<?php 
			}
		} ?>
	</div>
</div>
