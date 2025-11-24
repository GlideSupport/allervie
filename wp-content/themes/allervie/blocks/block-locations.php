<?php
/**
 * Block Name: Locations
 *
 * The template for displaying the custom gutenberg block named locations.
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

$alrv_srvc_title  = $block_fields['alrv_srvc_title'];
$alrv_srvc_text   = html_entity_decode( $block_fields['alrv_srvc_text'] );
$alrv_srvc_button = $block_fields['alrv_srvc_button'];

$alrv_srvc_state = ( isset( $block_fields['alrv_srvc_state']) ) ? $block_fields['alrv_srvc_state'] : null;
$alrv_srvc_city = ( isset( $block_fields['alrv_srvc_city']) ) ? $block_fields['alrv_srvc_city'] : null;

    $taxonomies = [
        $alrv_srvc_state,
        $alrv_srvc_city,
    ];

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
        'post_type'      => 'location', // Use the provided post type or default to 'location'
        'posts_per_page' => -1, // Fetch all matching posts
        'tax_query'      => $tax_query,
    ];

    // Return the query
    $query = new WP_Query($query_args);

// global $post;
// $lp_select_posts   = array();
// $lp_select_posts   = $block_fields['alrv_srvc_services'];
$alrv_srvc_hash_id = ( isset( $block_fields['alrv_srvc_hash_id'] ) ) ? $block_fields['alrv_srvc_hash_id'] : null;


?>

<?php if ($alrv_srvc_hash_id) { ?>
    <div id="<?php echo sanitize_title($alrv_srvc_hash_id); ?>" class="block-hash-scroll"></div>
<?php } ?>
<?php if ($alrv_srvc_state || $alrv_srvc_city) { ?>
<div id="<?php echo $id; ?>" class="<?php echo $align_class . ' ' . $class_name . ' ' . $name; ?> glide-block-services glide-block-<?php echo $block_glide_name; ?> glide-block-locations-main">
    <?php if (!empty($alrv_srvc_title) || !empty($alrv_srvc_text)) { ?>
            <div class="section-head center-align">
                <?php if ($alrv_srvc_title) { ?>
                    <h2><?php echo $alrv_srvc_title; ?></h2>
                <?php } ?>
                <?php if ($alrv_srvc_text) { ?>
                    <?php echo $alrv_srvc_text; ?>
                <?php } ?>
            </div>
        <?php } ?>
    <div class="servies-section">    	
        <?php if ($query->have_posts()) { 
            $owl_class = '';            
            if( $query->found_posts > 4 ){
                $owl_class = 'service-teaser owl-carousel owl-theme';
            }
            ?>
            <div class="location-items-cards">
                <div class="srv-cards d-flex align-items-stretch flex-wrap <?php echo $owl_class; ?>">           
                        <?php while ($query->have_posts()) {
                            $query->the_post();
                            // $post = $lp_posts;
                            // setup_postdata($post);
                            $pID             = get_the_ID();
                            $post_fields     = get_fields($pID);
                            $post_excerpt    = get_the_excerpt($pID);                   
                            $image = wp_get_attachment_image(get_post_thumbnail_id($pID), '', false);
                            if (!$image) {
                                $image = '<img width="500" height="354" src="' . get_template_directory_uri() . '/assets/img/defaults/default-image.webp" alt="' . get_the_title($pID) . '" >';
                            }
                            $address1      = ( get_post_meta( $pID, 'birdeye_address1', true ) ) ? get_post_meta( $pID, 'birdeye_address1', true ): null;
                            $address2      = ( get_post_meta( $pID, 'birdeye_address2', true ) ) ?  ', '. get_post_meta( $pID, 'birdeye_address2', true )  : null;
                            $city          = ( get_post_meta( $pID, 'birdeye_city', true ) ) ? '<br>' . get_post_meta( $pID, 'birdeye_city', true ) . ',' : null;
                            $state         = ( get_post_meta( $pID, 'birdeye_state', true ) ) ? get_post_meta( $pID, 'birdeye_state', true ) . ',' : null;
                            $zip           = ( get_post_meta( $pID, 'birdeye_zip', true ) ) ? get_post_meta( $pID, 'birdeye_zip', true ) : null;
                            $countryCode   = ( get_post_meta( $pID, 'birdeye_countryCode', true ) ) ? get_post_meta( $pID, 'birdeye_countryCode', true ) : null;
                            $coverImageUrl = ( get_post_meta( $pID, 'birdeye_coverImageUrl', true ) ) ? get_post_meta( $pID, 'birdeye_coverImageUrl', true ) : null;
                            $googleUrl      = ( get_post_meta( $pID, 'birdeye_googleUrl', true ) ) ? get_post_meta( $pID, 'birdeye_googleUrl', true ) : null;
                            $alrv_slo_fax      = ( get_post_meta( $pID, 'alrv_slo_fax', true ) ) ? get_post_meta( $pID, 'alrv_slo_fax', true ) : null;
                            ?>                        
                            <div class="srv-sngl-card" id="post-<?php the_ID(); ?>">
                                <div class="srv-sngl-img">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php
                                        if ( has_post_thumbnail() ) {
                                            the_post_thumbnail( 'thumb_800' );
                                        } elseif ( $coverImageUrl ) {
                                            ?>
                                        <img src="<?php echo $coverImageUrl; ?>" alt="<?php the_title(); ?>" />
                                        <?php } else { ?>
                                        <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/defaults/default-image.webp"
                                            alt="<?php the_title(); ?>" />
                                        <?php } ?>
                                        <?php
                                        // Check if it is Clinical Research Type - To display it's logo below.
                                        $cli_yes        = false;
                                        $condition_term = get_the_terms( $pID, 'location-type' );
                                        if ( $condition_term ) {
                                            foreach ( $condition_term as $condition ) {
                                                $current_location_type = $condition->slug;
                                                if ( $current_location_type == 'clinical-research' ) {
                                                    $cli_yes = true;
                                                    ?>
                                        <div class="services-catagories">
                                            <span class="cat-btn with-gdt <?php if ( $cli_yes ) { echo 'cr-cat'; } ?>" style=""><?php echo $condition->name; ?></span>
                                        </div>
                                                    <?php
                                                }
                                            }
                                        }
                                        ?>
                                    </a>
                                </div>

                                <div class="srv-sngl-text <?php if ( ! $cli_yes ) { echo 'not-loc-tag'; } ?> ">
                                    <p class="heading-5"><a href="<?php the_permalink(); ?>">
                                            <?php
                                            if ( $alrv_slo_title ) {
                                                echo $alrv_slo_title;
                                            } elseif ( get_post_meta( $pID, 'birdeye_alias', true ) ) {
                                                echo get_post_meta( $pID, 'birdeye_alias', true );
                                            } else {
                                                echo get_post_meta( $pID, 'birdeye_name', true ); }
                                            ?>
                                        </a></p>
                                    <p><a href="<?php echo $googleUrl; ?>" target="_blank"><?php echo $address1 . '' . $address2 . ' ' . $city . ' ' . $state . ' ' . $zip; ?></a></p>

                                    <div class="phone d-flex align-items-center">
                                        <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/phone-icon.svg" alt="">
                                        <p>Phone: <a href="tel:<?php echo get_post_meta( $pID, 'birdeye_phone', true ); ?>"><?php echo get_post_meta( $pID, 'birdeye_phone', true ); ?></a></p>
                                    </div>
                                    <?php if ( $alrv_slo_fax ) { ?>
                                    <div class="fax d-flex align-items-center">
                                        <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/fax-icon.svg" alt="">
                                        <p>Fax: <a href="tel:<?php echo $alrv_slo_fax; ?>"><?php echo $alrv_slo_fax; ?></a></p>
                                    </div>
                                    <?php } ?>

                                    <a href="<?php the_permalink(); ?>" class="button small-btn hide-on-mobile">learn
                                        more</a>
                                    <a href="<?php the_permalink(); ?>" class="learn-more show-on-mobile">learn
                                        more</a>
                                </div>
                            </div>                        
                        <?php } ?>
                </div>                        
            </div>                        
        <?php } ?>
        <?php wp_reset_query();
        wp_reset_postdata(); ?>
      
    </div>
      <?php if ($alrv_srvc_button) { ?>
            <div class="center-align">
                <?php echo glide_acf_button($alrv_srvc_button, 'loadmore-btn'); ?>
            </div>
        <?php } ?>
</div>
<?php } ?>


