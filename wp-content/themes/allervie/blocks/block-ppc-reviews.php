<?php
/**
 * Block Name: PPC Reviews
 *
 * The template for displaying the custom gutenberg block named providers.
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
$alrv_blk_ppc_rev_title = (isset($block_fields['alrv_blk_ppc_rev_title'])) ? $block_fields['alrv_blk_ppc_rev_title'] : null;
$alrv_blk_ppc_rev_code = (isset($block_fields['alrv_blk_ppc_rev_code'])) ? $block_fields['alrv_blk_ppc_rev_code'] : null;
$alrv_blk_ppc_rev_birdeye_location_id = (isset($block_fields['alrv_blk_ppc_rev_birdeye_location_id'])) ? $block_fields['alrv_blk_ppc_rev_birdeye_location_id'] : null;
// Block variables
$ratings=array();
if($alrv_blk_ppc_rev_birdeye_location_id){
	$curl = curl_init();

	curl_setopt_array($curl, array(
			CURLOPT_URL => 'https://api.birdeye.com/resources/v1/review/businessId/163293149676967?sindex=0&count=25&api_key=XZEFID5efK1ieD6xWQpn2g8f8fe4qYYX',
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'POST',
			CURLOPT_POSTFIELDS =>'{"subBusinessIds":['.$alrv_blk_ppc_rev_birdeye_location_id.']}',
			CURLOPT_HTTPHEADER => array(
					'content-type: application/json',
					'accept: application/json'
			),
	));

	$response = curl_exec($curl);
	$ratings_all=json_decode($response);
	// dump(json_decode($ratings));

	foreach($ratings_all as $key => $rating){
		if($rating->rating<4){
			continue;
		}
		if($rating->comments==null){
			continue;
		}
		$ratings[]=$rating;
	}
}
?>

<div id="<?php echo $id; ?>" class="<?php echo $align_class . ' ' . $class_name . ' ' . $name; ?> glide-block-<?php echo $block_glide_name; ?>">
<div class="location-rating-block">
	<?php if($alrv_blk_ppc_rev_title){  ?>
		<h2 class="section-head center-align"> <?php echo $alrv_blk_ppc_rev_title; ?>  </h2>
	<?php } ?>
	<?php if($alrv_blk_ppc_rev_code){  ?>
		<div class="rating-api-box"> <?php echo html_entity_decode($alrv_blk_ppc_rev_code); ?>  </div>
	<?php } ?>
	<div class="rating-api-ctn four-columns">
		<?php
			if($ratings){

				foreach($ratings as $key => $rating){
					if($key>3){
						continue;
					}
					// dump($rating);
					$review_comment = $rating->comments;
					$full_comment 	= $review_comment;
					$short_comment 	= substr($full_comment,0,200);
					$is_long_text 	= (strlen($full_comment) > 200) ? 1 : 0;
			?>
					<div class="rating-box column">
						<div class="loc-rating-stars">
							<?php for($i=1;$i<=$rating->rating;$i++){ ?>
							<div class="loc-raing-star"><img src="<?php echo esc_url( get_template_directory_uri() )  ?>/assets/img/rating-star.svg" alt=""></div>
							<?php } ?>
						</div>
						<div class="rating-review">
							<?php
								$short_comment_style = ($is_long_text == 0) ? 'style="display:none;"' : '';
								$full_comment_style = ($is_long_text == 1) ? 'style="display:none;"' : '';
							?>
							<p class="short-desc" <?php echo $short_comment_style; ?>><?php echo "\"".$short_comment."...\""; ?></p>
  							<p class="full-desc" <?php echo $full_comment_style; ?>><?php echo "\"".$full_comment."\""; ?></p>
							<?php 
								if($is_long_text == 1) {
									?><a href="#" class="read-more-link">Read More</a><?php
								}
							?>
						</div>
					</div>
			<?php }	} ?>
	</div>
</div>
</div>
<script>
jQuery(document).ready(function() {
	jQuery('#<?php echo $id; ?> .read-more-link').click(function(e) {
		e.preventDefault();
		jQuery(this).siblings().filter(".short-desc,.full-desc").toggle();		
		jQuery(this).text(function(i, text) {
			return text === 'Read More' ? 'Read Less' : 'Read More';
		});
	});
});
</script>
