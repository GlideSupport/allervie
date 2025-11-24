<?php
/**
 * Block Name: Providers
 *
 * The template for displaying the custom gutenberg block named providers.
 *
 * @link https://www.advancedcustomfields.com/resources/blocks/
 *
 * @package Allervie
 * @since 1.0.0
 */

if ( get_queried_object()->post_type == 'location' ) {
	$current_location_id = get_queried_object()->ID;
} else {
	$current_location_id = 0;
}

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

$alrv_blk_prvdr_title     = $block_fields['alrv_blk_prvdr_title'];
$alrv_blk_prvdr_design_var = $block_fields['alrv_blk_prvdr_design_var'];
$alrv_blk_prvdr_providers = $block_fields['alrv_blk_prvdr_providers'];
$alrv_blk_prvdr_button    = $block_fields['alrv_blk_prvdr_button'];
global $post;
$lp_select_posts = array();
$lp_select_posts = $block_fields['alrv_blk_prvdr_providers'];
if ( $lp_select_posts ) {
	wp_reset_query();
}
$alrv_blk_prvdr_hash_id             = ( isset( $block_fields['alrv_blk_prvdr_hash_id'] ) ) ? $block_fields['alrv_blk_prvdr_hash_id'] : null;
$alrv_blk_prvdr_selection_crieteria = ( isset( $block_fields['alrv_blk_prvdr_selection_crieteria'] ) ) ? $block_fields['alrv_blk_prvdr_selection_crieteria'] : null;
$alrv_blk_prvdr_providers_type      = ( isset( $block_fields['alrv_blk_prvdr_providers_type'] ) ) ? $block_fields['alrv_blk_prvdr_providers_type'] : null;

// Auto-manual mode
$alrv_blk_prvdr_auto_manual_var = ( isset( $block_fields['alrv_blk_prvdr_auto_manual_var']) ) ? $block_fields['alrv_blk_prvdr_auto_manual_var'] : null;
$alrv_blk_prvdr_state = ( isset( $block_fields['alrv_blk_prvdr_state']) ) ? $block_fields['alrv_blk_prvdr_state'] : null;
$alrv_blk_prvdr_city = ( isset( $block_fields['alrv_blk_prvdr_city']) ) ? $block_fields['alrv_blk_prvdr_city'] : null;

	$taxonomies = [
	    $alrv_blk_prvdr_state,
	    $alrv_blk_prvdr_city,
	];
if (!function_exists('get_posts_by_taxonomies')) {
	function get_posts_by_taxonomies($taxonomies, $post_type = 'location') {
	    // Initialize the tax query
	    $tax_query = [
	        'relation' => 'OR', // This makes the query match any of the conditions below.
	    ];

	    // Build the tax query from the taxonomy groups
	    foreach ($taxonomies as $taxonomy_group) {
	        if (!empty($taxonomy_group)) {
	            foreach ($taxonomy_group as $term) {
	                $tax_query[] = [
	                    'taxonomy' => $term->taxonomy,
	                    'field'    => 'term_id',
	                    'terms'    => $term->term_id,
	                    'operator' => 'IN',
	                ];
	            }
	        }
	    }

	    // Finalize query arguments
	    $query_args = [
	        'post_type'      => $post_type, // Use the provided post type or default to 'location'
	        'posts_per_page' => -1, // Fetch all matching posts
	        'tax_query'      => $tax_query,
	    ];

	    // Return the query
	    return new WP_Query($query_args);
	}
}
?>
<?php if ( $alrv_blk_prvdr_hash_id ) { ?>
<div id="<?php echo sanitize_title( $alrv_blk_prvdr_hash_id ); ?>" class="block-hash-scroll"></div>
<?Php } ?>
<?php if(!empty($lp_select_posts) || !empty($alrv_blk_prvdr_state) || !empty($alrv_blk_prvdr_city)) { ?>
<div id="<?php echo $id; ?>" class="<?php echo $align_class . ' ' . $class_name . ' ' . $name; ?> glide-block-<?php echo $block_glide_name; ?>">
		<?php if($alrv_blk_prvdr_design_var=='slider'){ ?>
			<div class="providers-section">
				<?php if ( $alrv_blk_prvdr_title ) { ?>
					<div class="section-head center-align">
						<h2><?php echo $alrv_blk_prvdr_title; ?></h2>
					</div>
				<?php } ?>
				<?php // Auto mode start
					if( $alrv_blk_prvdr_auto_manual_var == 'auto' ){						
						if (!empty($alrv_blk_prvdr_state) || !empty($alrv_blk_prvdr_city)){

							$query = get_posts_by_taxonomies($taxonomies);

							?>
							<div class="providers-section">
								<div class="provider-teaser center-provider owl-carousel owl-theme">
									<?php
									if ($query->have_posts()) {

										$unique_providers = [];
										// foreach ( $lp_select_posts as $lp_posts ) {
									 	while ($query->have_posts()) { 
											$query->the_post();
											$locID = get_the_ID();
									 		
											 // new acf provider backend relationship 'alrv_spo_location_on_providers'
											 $providers = get_provider_by_location_id($locID);

									 		// If providers is an array, merge it into the unique_providers array
										    // if (is_array($providers)) {
										    //     $unique_providers = array_merge($unique_providers, $providers);
										    // } elseif (!empty($providers)) {
										    //     // If it's a single value, add it directly
										    //     $unique_providers[] = $providers;
										    // }
											if (!empty($providers) && is_array($providers)) {
												$unique_providers = array_merge($unique_providers, $providers);
											}
											
									 	}
									 	// Filter out duplicates
										$unique_providers = array_unique($unique_providers);
									
										foreach ( $unique_providers as $lp_posts ) {
											
											// $post = $lp_posts;
											// setup_postdata( $post );
											if ( get_post_status( $lp_posts ) === 'draft' || get_post_status( $lp_posts ) === 'archive' ) {
							                	continue;
							            	}
											$post_fields = get_fields( $lp_posts );
											$src         = wp_get_attachment_image_src( get_post_thumbnail_id( $lp_posts ), 'thumb_400', false );
											
											if ( $src ) {
												$src = $src[0];
											}
											$providerType   = null;
											$providersTypes = get_the_terms( $lp_posts, 'providers-type' );
											if ( $providersTypes ) {
												foreach ( $providersTypes as $type ) {
													$providerType = $type;
													break;
												}
											}
											$the_title = get_the_title( $lp_posts );
											$expr      = '/(?<=\s|^)\w/iu';
											preg_match_all( $expr, $the_title, $matches );
											$result                 = implode( '', $matches[0] );
											$result                 = mb_strtoupper( $result );
											$result                 = substr( $result, 0, 2 );
											$providerLocation       = get_provider_location( $lp_posts );
											$get_clinical_providers = get_clinical_providers( $lp_posts );
											?>
											<a href="<?php echo get_the_permalink( $lp_posts ); ?>" class="item">
											<div class="prdr-sngl center-align">
												<?php if ( $src ) { ?>
													<div class="prdr-image">
														<div class="prder-image-inner" style="background-image: url(<?php echo $src; ?>);"></div>
													</div>
												<?php } else { ?>
													<div class="prdr-image d-flex justify-content-center align-items-center">
														<h3><?php echo $result; ?></h3>
													</div>
												<?php } ?>

												<h4 class="prdr-title blue-text"><?php echo $the_title; ?></h4>
											</div>
											</a>
										<?php }
									} ?>
								</div>
							</div>
							<?php
						}
					}
					// Auto mode end				
					else { ?>
						<?php if ( $lp_select_posts ) { ?>
						<div class="providers-section">
							<div class="provider-teaser center-provider owl-carousel owl-theme">
								<?php
								global $post;
								foreach ( $lp_select_posts as $lp_posts ) {
									$post = $lp_posts;
									setup_postdata( $post );
									$pID         = get_the_ID();
									if ( get_post_status( $pID ) === 'draft' || get_post_status( $pID ) === 'archive' ) {
					                	continue;
					            	}
									$post_fields = get_fields( $pID );
									$src         = wp_get_attachment_image_src( get_post_thumbnail_id( $pID ), 'thumb_400', false );
									if ( $src ) {
										$src = $src[0];
									}
									$providerType   = null;
									$providersTypes = get_the_terms( $pID, 'providers-type' );
									if ( $providersTypes ) {
										foreach ( $providersTypes as $type ) {
											$providerType = $type;
											break;
										}
									}
									$the_title = get_the_title( $pID );
									$expr      = '/(?<=\s|^)\w/iu';
									preg_match_all( $expr, $the_title, $matches );
									$result                 = implode( '', $matches[0] );
									$result                 = mb_strtoupper( $result );
									$result                 = substr( $result, 0, 2 );
									$providerLocation       = get_provider_location( $pID );
									$get_clinical_providers = get_clinical_providers( $pID );
									?>
								<a href="<?php echo get_the_permalink( $pID ); ?>" class="item">
									<div class="prdr-sngl center-align">
										<div class="prdr-image">
											<div class="prder-image-inner" style="background-image: url(<?php echo $src; ?>);"></div>
										</div>

										<h4 class="prdr-title blue-text"><?php echo $the_title; ?></h4>
									</div>
								</a>
								<?php } ?>
							</div>
						</div>
						<?php } ?>
					<?php } ?>
			</div>
		<?php }else{ ?>

			<div class="providers-section">
				<?php if ( $alrv_blk_prvdr_title ) { ?>
				<div class="section-head center-align">
					<h2><?php echo $alrv_blk_prvdr_title; ?></h2>
				</div>
				<?php } ?>
				<!-- Auto mode start -->
				<?php if( $alrv_blk_prvdr_auto_manual_var == 'auto' ) { 
					if (!empty($alrv_blk_prvdr_state) || !empty($alrv_blk_prvdr_city)){ 
						$query = get_posts_by_taxonomies($taxonomies);
						?>
						<div class="providers-section d-flex flex-wrap">
							<?php
							if ($query->have_posts()) {

								$unique_providers = [];
								// foreach ( $lp_select_posts as $lp_posts ) {
							 	while ($query->have_posts()) { $query->the_post();
									$locID = get_the_ID();

							 		// new acf provider backend relationship 'alrv_spo_location_on_providers'
									$providers = get_provider_by_location_id($locID);

							 		// If providers is an array, merge it into the unique_providers array
								    // if (is_array($providers)) {
								    //     $unique_providers = array_merge($unique_providers, $providers);
								    // } elseif (!empty($providers)) {
								    //     // If it's a single value, add it directly
								    //     $unique_providers[] = $providers;
								    // }
									if (!empty($providers) && is_array($providers)) {
										$unique_providers = array_merge($unique_providers, $providers);
									}
									
							 	}
							 	// Filter out duplicates
								$unique_providers = array_unique($unique_providers);
								foreach ( $unique_providers as $lp_posts ) {
											
									// $post = $lp_posts;
									// setup_postdata( $post );
									if ( get_post_status( $lp_posts ) === 'draft' || get_post_status( $pID ) === 'archive'  ) {
					                	continue;
					            	}
							
									// global $post;
									// foreach ( $lp_select_posts as $lp_posts ) {
									// $post = $lp_posts;
									// setup_postdata( $post );
									// $pID         = get_the_ID();
									// if ( get_post_status( $pID ) === 'draft' ) {
									// continue;
									// }
									$post_fields = get_fields( $lp_posts );
									$src         = wp_get_attachment_image_src( get_post_thumbnail_id( $lp_posts ), 'thumb_400', false );
									if ( $src ) {
										$src = $src[0];
									}
									$providerType   = null;
									$providersTypes = get_the_terms( $lp_posts, 'providers-type' );
									if ( $providersTypes ) {
										foreach ( $providersTypes as $type ) {
											$providerType = $type;
											break;
										}
									}
									$the_title = get_the_title( $lp_posts );
									$expr      = '/(?<=\s|^)\w/iu';
									preg_match_all( $expr, $the_title, $matches );
									$result                 = implode( '', $matches[0] );
									$result                 = mb_strtoupper( $result );
									$result                 = substr( $result, 0, 2 );
									$providerLocation       = get_provider_location( $lp_posts );
									$get_clinical_providers = get_clinical_providers( $lp_posts );
									?>
									<a href="<?php echo get_the_permalink( $lp_posts ); ?>" class="prdr-sngl center-align">
										<?php if ( $src ) { ?>
										<div class="prdr-image">
										<div class="prder-image-inner" style="background-image: url(<?php echo $src; ?>);"></div>
										</div>
										<?php } else { ?>
										<div class="prdr-image d-flex justify-content-center align-items-center">
											<h3><?php echo $result; ?></h3>
										</div>
										<?php } ?>
										<div class="prdr-content">


											<p class="prdr-title blue-text heading-6">
												<?php echo $the_title; ?>
											</p>
											<?php if ( $providerType ) { ?>
											<div class="mobile-hide prdr-type xs-text blue-text">
												<?php _e( 'Provider Type', 'alrv_td' ); ?>
											</div>
											<p class="mobile-hide"><?php echo $providerType->name; ?></p>
											<?php } ?>
											<?php if ( $providerLocation ) { ?>
											<div class="prdr-location xs-text blue-text">
												<?php _e( 'Location', 'alrv_td' ); ?>
											</div>
											<p><?php echo $providerLocation; ?></p>
											<?php } ?>
											<span class="desktop-hide learn-more"><?php _e( 'learn more', 'alrv_td' ); ?></span>

										</div>
									</a>
									<!-- single provider -->
								<?php } ?>
							<?php } ?>
						</div>
					<?php } ?>
					<!-- Auto mode end -->
				<?php } else{
					if ( $lp_select_posts ) { ?>
						<div class="providers-section d-flex flex-wrap">
							<?php
							global $post;
							foreach ( $lp_select_posts as $lp_posts ) {
								$post = $lp_posts;
								setup_postdata( $post );
								$pID         = get_the_ID();
								if ( get_post_status( $pID ) === 'draft' || get_post_status( $pID ) === 'archive' ) {
						            continue;
						        }
								$post_fields = get_fields( $pID );
								$src         = wp_get_attachment_image_src( get_post_thumbnail_id( $pID ), 'thumb_400', false );
								if ( $src ) {
									$src = $src[0];
								}
								$providerType   = null;
								$providersTypes = get_the_terms( $pID, 'providers-type' );
								if ( $providersTypes ) {
									foreach ( $providersTypes as $type ) {
										$providerType = $type;
										break;
									}
								}
								$the_title = get_the_title( $pID );
								$expr      = '/(?<=\s|^)\w/iu';
								preg_match_all( $expr, $the_title, $matches );
								$result                 = implode( '', $matches[0] );
								$result                 = mb_strtoupper( $result );
								$result                 = substr( $result, 0, 2 );
								$providerLocation       = get_provider_location( $pID );
								$get_clinical_providers = get_clinical_providers( $pID );
								?>
							<a href="<?php echo get_the_permalink( $pID ); ?>" class="prdr-sngl center-align">
								<?php if ( $src ) { ?>
								<div class="prdr-image">
								<div class="prder-image-inner" style="background-image: url(<?php echo $src; ?>);"></div>
								</div>
								<?php } else { ?>
								<div class="prdr-image d-flex justify-content-center align-items-center">
									<h3><?php echo $result; ?></h3>
								</div>
								<?php } ?>
								<div class="prdr-content">


									<p class="prdr-title blue-text heading-6">
										<?php echo $the_title; ?>
									</p>
									<?php if ( $providerType ) { ?>
									<div class="mobile-hide prdr-type xs-text blue-text">
										<?php _e( 'Provider Type', 'alrv_td' ); ?>
									</div>
									<p class="mobile-hide"><?php echo $providerType->name; ?></p>
									<?php } ?>
									<?php if ( $providerLocation ) { ?>
									<div class="prdr-location xs-text blue-text">
										<?php _e( 'Location', 'alrv_td' ); ?>
									</div>
									<p><?php echo $providerLocation; ?></p>
									<?php } ?>
									<span class="desktop-hide learn-more"><?php _e( 'learn more', 'alrv_td' ); ?></span>

								</div>
							</a>
							<!-- single provider -->
							<?php } ?>
						</div>
					<?php } 
				}?>
				<?php if ( $alrv_blk_prvdr_button ) { ?>
				<div class="center-align">
					<?php echo glide_acf_button( $alrv_blk_prvdr_button, 'loadmore-btn' ); ?>
				</div>
				<?php } ?>
			</div>

	<?php
	 wp_reset_postdata();
	wp_reset_query();
	?>
	<?php } ?>
</div>
<?php } ?>
