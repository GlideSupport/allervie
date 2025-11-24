<?php
/**
 * Block Name:  Providers (Single Location)
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

$pID = get_the_ID();
if ( function_exists( 'get_fields' ) && function_exists( 'get_fields_escaped' ) ) {
	$post_fields = get_fields_escaped( $pID );
}
// $alrv_slo_providers_on_location      = ( isset( $post_fields['alrv_slo_providers_on_location'] ) ) ? $post_fields['alrv_slo_providers_on_location'] : null;

// New featured title
$alrv_blk_psl_title = $block_fields['alrv_blk_psl_title'] ?? null;

?>
<div id="<?php echo $id; ?>"
	class="<?php echo $align_class . ' ' . $class_name . ' ' . $name; ?> glide-block-<?php echo $block_glide_name; ?>">

	<div class="providers-section">
	    <?php if(!empty($alrv_blk_psl_title)){ ?>
		<div class="section-head center-align">
			<h2><?php echo $alrv_blk_psl_title; ?></h2>
		</div>
		<?php } ?>
		<div class="providers-section">
		<div class="provider-teaser center-provider owl-carousel owl-theme">
				<?php
				// Query perform to fetch providers are physicians.
				$args = array(
					'post_type'   => 'provider',
					'post_status' => 'publish',
					'orderby'        => 'menu_order',
				    'order'          => 'ASC',
					'meta_query'  => array(
						array(
							'key'     => 'alrv_spo_location_on_providers',
							'value'   => '"' . $pID . '"',
							'compare' => 'LIKE',
						),
					),
				);
				$args['tax_query'] = array(
					array(
						'taxonomy' => 'providers-type',
						'field'    => 'slug',
						'terms'    => array( 'physician' ),
						'operator' => 'IN',
					)
				);
				
				$get_provider  =  new WP_Query($args);
				if($get_provider->have_posts()) {
					while($get_provider->have_posts()) {
						$get_provider->the_post();
						$pID         = get_the_ID();

						$providersTypes = get_the_terms( $pID, 'providers-type' );
						$providers      = join( ', ', wp_list_pluck( $providersTypes, 'name' ) );
						$providers      = explode( ',', $providers );
						$get_clinical_providers = get_clinical_providers( $pID );
						$the_title              = get_the_title( $pID );
						$the_content            = get_the_excerpt( $pID );
						$expr                   = '/(?<=\s|^)\w/iu';
						preg_match_all( $expr, $the_title, $matches );
						$result = implode( '', $matches[0] );
						$result = mb_strtoupper( $result );
						$result = substr( $result, 0, 2 );
						$src = wp_get_attachment_image_src( get_post_thumbnail_id( $pID ), 'thumb_400', false );
						if ( $src ) {
							$src = $src[0];
						}
						?>
						<!-- single provider -->
						<div class="item">
							<div class="prdr-sngl center-align">
								<?php if ( $src ) { ?>
								<div class="prdr-image">
									<div class="prder-image-inner" style="background-image: url(<?php echo $src; ?>);"></div>
								</div>
								<?php } else { ?>
								<div class="prdr-image  d-flex justify-content-center align-items-center">
									<h3><?php echo $result; ?></h3>
								</div>
								<?php } ?>

								<p class="prdr-title blue-text heading-4">
									<?php echo html_entity_remove( $the_title ); ?>
								</p>

								<a href="<?php echo get_the_permalink( $pID ); ?>" class="loadmore-btn small-btn">view
									provider</a>

							</div>
						</div>
						<?php
					}
				}
				wp_reset_postdata();

				// Query perform to fetch providers are not physicians.
				$args['tax_query'] = array(
					array(
						'taxonomy' => 'providers-type',
						'field'    => 'slug',
						'terms'    => array( 'physician' ),
						'operator' => 'NOT IN',
					)
				);
				
				$get_provider  =  new WP_Query($args);
				if($get_provider->have_posts()) {
					while($get_provider->have_posts()) {
						$get_provider->the_post();
						$pID         = get_the_ID();
					
						$providersTypes = get_the_terms( $pID, 'providers-type' );
						$providers      = join( ', ', wp_list_pluck( $providersTypes, 'name' ) );
						$providers      = explode( ',', $providers );
						$get_clinical_providers = get_clinical_providers( $pID );
						$the_title              = get_the_title( $pID );
						$the_content            = get_the_excerpt( $pID );
						$expr                   = '/(?<=\s|^)\w/iu';
						preg_match_all( $expr, $the_title, $matches );
						$result = implode( '', $matches[0] );
						$result = mb_strtoupper( $result );
						$result = substr( $result, 0, 2 );

						$src = wp_get_attachment_image_src( get_post_thumbnail_id( $pID ), 'thumb_400', false );
						if ( $src ) {
							$src = $src[0];
						}
						?>
						<!-- single provider -->
						<div class="item">
							<div class="prdr-sngl center-align">
								<?php if ( $src ) { ?>
								<div class="prdr-image">
									<div class="prder-image-inner" style="background-image: url(<?php echo $src; ?>);"></div>
								</div>
								<?php } else { ?>
								<div class="prdr-image  d-flex justify-content-center align-items-center">
									<h3><?php echo $result; ?></h3>
								</div>
								<?php } ?>

								<p class="prdr-title blue-text heading-4">
									<?php echo html_entity_remove( $the_title ); ?>
								</p>

								<a href="<?php echo get_the_permalink( $pID ); ?>" class="loadmore-btn small-btn">view
									provider</a>

							</div>
						</div>
						<?php
					}
				}
				wp_reset_postdata();
                
				?>
			</div>
		</div>
	</div>
</div>
