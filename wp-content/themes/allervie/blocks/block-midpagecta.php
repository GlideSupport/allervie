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

$alrv_blk_mcta_title   = $block_fields['alrv_blk_mcta_title'];
$alrv_blk_mcta_text    = html_entity_decode( $block_fields['alrv_blk_mcta_text'] );
$alrv_blk_mcta_btn     = $block_fields['alrv_blk_mcta_btn'];
$alrv_blk_mcta_hash_id = ( isset( $block_fields['alrv_blk_mcta_hash_id'] ) ) ? $block_fields['alrv_blk_mcta_hash_id'] : null;
$alrv_blk_mcta_select_design_variation = ( isset( $block_fields['alrv_blk_mcta_select_design_variation'] ) ) ? $block_fields['alrv_blk_mcta_select_design_variation'] : "center_align";
$alrv_blk_mcta_icons = ( isset( $block_fields['alrv_blk_mcta_icons'] ) ) ? $block_fields['alrv_blk_mcta_icons'] : 'apt-btn';

if(get_post_type(get_the_ID())=='location'){
	$state_term     = get_the_terms( get_the_ID(), 'location-state' );
	$state_id       = ( isset( $state_term[0]->term_id ) ) ? $state_term[0]->term_id : null;
}
?>

<?php if ( $alrv_blk_mcta_hash_id ) { ?>
<div id="<?php echo sanitize_title( $alrv_blk_mcta_hash_id ); ?>" class="block-hash-scroll"></div>
<?Php } ?>

<?php if ($alrv_blk_mcta_select_design_variation == "center_align") { ?> 
	<div id="<?php echo $id; ?>"
		class="<?php echo $align_class . ' ' . $class_name . ' ' . $name; ?> glide-block-<?php echo $block_glide_name; ?>">

		<div class="midpage-cta-section">
			<?php if ( $alrv_blk_mcta_title ) { ?>
			<div class="midpage-cta-content center-align">
				<h2 class="med-heading">
					<?php echo $alrv_blk_mcta_title; ?>
				</h2>
				<?php } ?>
				<?php if ( $alrv_blk_mcta_text ) { ?>
					<?php echo $alrv_blk_mcta_text; ?>
				<?php } ?>
				<?php
				$mcta_apt_btn = basename($alrv_blk_mcta_btn['url']);
				if(get_post_type(get_the_ID())=='location' && $mcta_apt_btn == 'make-an-appointment'){
					if($alrv_blk_mcta_icons=='apt-btn'){
						if ( $state_id ) {
							$alrv_blk_mcta_btn['url'] = $alrv_blk_mcta_btn['url'] . '?app-state=' . $state_id . '&app-location=' . get_the_ID();
						} else {
							$alrv_blk_mcta_btn['url'] = $alrv_blk_mcta_btn['url'] . '?app-location=' . get_the_ID();
						}
						if(isset($_GET['gclid'])){
							$alrv_blk_mcta_btn['url'] = $alrv_blk_mcta_btn['url'] . '&gclid='.$_GET['gclid'];
						}
						if(isset($_GET['wc_clear'])){
							$alrv_blk_mcta_btn['url'] = $alrv_blk_mcta_btn['url'] . '&wc_clear='.$_GET['wc_clear'];
						}
					}
				}
				if($alrv_blk_mcta_btn && $mcta_apt_btn !== 'make-an-appointment' && get_post_type(get_the_ID()) =='location' && $alrv_blk_mcta_icons=='apt-btn'){
					echo glide_acf_button( $alrv_blk_mcta_btn, 'button no-apt-link small-btn' );
				}else {
					echo glide_acf_button( $alrv_blk_mcta_btn, 'button '.$alrv_blk_mcta_icons.' small-btn' );
				}
				?>
			</div>
		</div>
	</div>
<?php } else { ?>

	<section id="<?php echo $id; ?>" class=" <?php echo $align_class . ' ' . $class_name . ' ' . $name; ?>  glide-block-<?php echo $block_glide_name; ?> tc-shape tc-shape tc-shape-variation-two tr-shape lblue-container container-1180">
		<div class="wrapper">
			<div class="alignwide  block-acf-midpagecta glide-block-midpagecta">
				<div class="midpage-cta-section">
						<?php if (!empty( $alrv_blk_mcta_text ) || !empty($alrv_blk_mcta_icons) || !empty( $alrv_blk_mcta_title ) ) { ?>
						<div class="midpage-cta-content">
							<?php if (!empty( $alrv_blk_mcta_title )) { ?>
								<div class="cl-left">
									<h2 class="med-heading block-title"><?php echo $alrv_blk_mcta_title; ?> </h2>
								</div>				
							<?php } ?>	
							<?php if (!empty( $alrv_blk_mcta_text ) || !empty($alrv_blk_mcta_icons)) { ?>
							<div class="cl-right">
								<?php if (!empty( $alrv_blk_mcta_text )) { ?>
									<div class="block-content">
										<?php echo $alrv_blk_mcta_text; ?>
									</div>
								<?php } ?>
									<div class="block-btn">
										<?php
										    $mcta_apt_btn = basename($alrv_blk_mcta_btn['url']);
											if(get_post_type(get_the_ID())=='location'  && $mcta_apt_btn == 'make-an-appointment'){
												if($alrv_blk_mcta_icons=='apt-btn'){
													if ( $state_id ) {
														$alrv_blk_mcta_btn['url'] = $alrv_blk_mcta_btn['url'] . '?app-state=' . $state_id . '&app-location=' . get_the_ID();
													} else {
														$alrv_blk_mcta_btn['url'] = $alrv_blk_mcta_btn['url'] . '?app-location=' . get_the_ID();
													}
													if(isset($_GET['gclid'])){
														$alrv_blk_mcta_btn['url'] = $alrv_blk_mcta_btn['url'] . '&gclid='.$_GET['gclid'];
													}
													if(isset($_GET['wc_clear'])){
														$alrv_blk_mcta_btn['url'] = $alrv_blk_mcta_btn['url'] . '&wc_clear='.$_GET['wc_clear'];
													}
												}
											}
											if ($alrv_blk_mcta_btn && $mcta_apt_btn !== 'make-an-appointment' && get_post_type(get_the_ID()) =='location' && $alrv_blk_mcta_icons == 'apt-btn') {
												echo glide_acf_button( $alrv_blk_mcta_btn, 'button no-apt-link small-btn' );
											}else {
												echo glide_acf_button( $alrv_blk_mcta_btn, 'button '.$alrv_blk_mcta_icons.' small-btn' );
											}
										?>
									</div>
								</div>
							</div>
							<?php } ?>
						</div>
					<?php } ?>
				</div>
			</div>
			<div class="block-hash-scroll"></div>
		</div>
	</section>

<?php } ?>
