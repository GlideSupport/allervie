<?php
/**
 * Block Name: Testimonial
 *
 * The template for displaying the custom gutenberg block named testimonial.
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

global $post;
$lp_select_posts      = array();
$lp_select_posts      = $block_fields['alrv_blk_tst_testimonial'];
$alrv_blk_tst_hash_id = ( isset( $block_fields['alrv_blk_tst_hash_id'] ) ) ? $block_fields['alrv_blk_tst_hash_id'] : null;
?>
<?php if ( $alrv_blk_tst_hash_id ) { ?>
<div id="<?php echo sanitize_title( $alrv_blk_tst_hash_id ); ?>" class="block-hash-scroll"></div>
<?php } ?>
<div id="<?php echo $id; ?>"
	class="<?php echo $align_class . ' ' . $class_name . ' ' . $name; ?> glide-block-<?php echo $block_glide_name; ?>">
	<div class="testimonial-icon"></div>
	<?php if ( $lp_select_posts ) { ?>
	<div class="testimonial-section">
		<div class="testimonials-slider owl-carousel owl-theme">
			<?php
			foreach ( $lp_select_posts as $lp_posts ) {
				$post = $lp_posts;
				setup_postdata( $post );
				$pID                  = $post->ID;
				$post_fields          = get_fields( $pID );
				$alrv_sto_designation = $post_fields['alrv_sto_designation'];
				$src                  = wp_get_attachment_image_src( get_post_thumbnail_id( $pID ), 'full', false );
				if ( ! $src ) {
					$src = get_template_directory_uri() . '/assets/img/default-project-image.jpg';
				} else {
					$src = $src[0];
				}
				?>
			<div class="item">
				<div class="testimonial-single center-align">
					<h5><?php echo html_entity_remove( get_the_content() ); ?></h5>
					<h6 class="author medium-text">
						<?php the_title(); ?>
					</h6>
					<?php if ( $alrv_sto_designation ) { ?>
					<p><?php echo $alrv_sto_designation; ?></p>
					<?php } ?>
				</div>
			</div>
			<?php } ?>
		</div>
	</div>
		<?php
	} wp_reset_query();
	wp_reset_postdata();
	?>

</div>
