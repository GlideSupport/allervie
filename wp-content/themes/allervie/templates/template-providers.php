<?php
/**
 * Template Name: Providers
 * Template Post Type: page
 *
 * This template is for displaying home page.
 *
 * @link https://developer.wordpress.org/themes/template-files-section/page-template-files/
 *
 * @package Allervie
 * @since 1.0.0
 */

// Include header
get_header();

// Global variables
global $option_fields;
global $pID;
global $fields;
global $paged;

$provider_type = ( isset( $_GET['provider-type'] ) ) ? $_GET['provider-type'] : null;
$provider_location = ( isset( $_GET['provider-location'] ) ) ? $_GET['provider-location'] : null;
$provider_brand = ( isset( $_GET['provider-brand'] ) ) ? $_GET['provider-brand'] : null;
$search = ( isset( $_GET['search'] ) ) ? $_GET['search'] : '';

$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;

// Initialize tax query array
$tax_query = array();

// Append tax query for provider type if it has value
if ( $provider_type && $provider_type != '*' ) {
    $tax_query[] = array(
        'taxonomy' => 'providers-type',
        'field'    => 'slug',
        'terms'    => $provider_type,
    );
}

// Append tax query for provider brand if it has value
if ( $provider_brand && $provider_brand != '*' ) {
    $tax_query[] = array(
        'taxonomy' => 'providers-brand',
        'field'    => 'slug',
        'terms'    => $provider_brand,
    );
}

// Query posts
$args = array(
    'post_type' => 'provider',
	'post_status' => 'publish',
    's'         => $search,
    'meta_key'  => 'alrv_spo_lastname',
    'orderby'   => 'meta_value',
    'order'     => 'ASC',
    'paged'     => $paged,
);

// If tax query has values, add it to the arguments
if ( !empty( $tax_query ) ) {
    $args['tax_query'] = array(
        'relation' => 'AND',
        $tax_query,
    );
}

// If provider location has value, add it to the meta query
if ( $provider_location && $provider_location != '*' ) {
    $alrv_slo_providers_on_location = get_provider_by_city( $provider_location );
    if ( empty( $alrv_slo_providers_on_location ) ) {
        $alrv_slo_providers_on_location = array( 0 );
    }
    $args['post__in'] = $alrv_slo_providers_on_location;
}

// Query posts
$all_providers_posts = new WP_Query( $args );

// Get providers type
$providers_type = get_terms(
    array(
        'taxonomy'   => 'providers-type',
        'hide_empty' => false,
    )
);

// Get providers brand
$providers_brand = get_terms(
    array(
        'taxonomy'   => 'providers-brand',
        'hide_empty' => false,
    )
);

// Get all locations
$all_locations_query = array(
    'post_type'      => array( 'location' ),
    'post_status'    => array( 'publish' ),
    'posts_per_page' => -1,
    'meta_key'       => 'meta_location_state',
    'orderby'        => 'meta_value',
    'order'          => 'ASC'
);

$all_locations_posts = new WP_Query( $all_locations_query );

?>
<section id="hero-section" class="hero-section">
    <!-- Hero Start -->
    <div class="hero-single">
        <div class="wrapper">
            <div class="prdr-hero-inner">
                <div class="banner-text center-align">
                    <h1><?php echo glide_page_title( 'alrv_tpo_title' ); ?></h1>
                </div>
                <div class="s-40"></div>
                <div class="provider-filter d-flex justify-content-center flex-wrap <?php if($_GET || $paged>1){ echo 'has-filter-btn'; } ?>">

                    <select name="providers-type" id="providers-type" class="prdr-filter">
                        <option value="*"> <?php _e( 'Select Type', 'alrv_td' ); ?></option>
                        <?php foreach ( $providers_type as $type ) { ?>
                            <option <?php if(isset($_GET['provider-type'])){ if($_GET['provider-type']== $type->slug){echo 'selected="selected"';}} ?> value="<?php echo $type->slug; ?>">
                                <?php echo $type->name; ?>
                            </option> <?php } ?>
                    </select>

                    <?php if ( $all_locations_posts->have_posts() ) { ?>
                        <select name="providers-location" id="providers-location" class="prdr-filter">
                            <option value="*"> <?php _e( 'Select Location', 'alrv_td' ); ?></option>
                            <?php
                            $buffer = array();
                            while ( $all_locations_posts->have_posts() ) {
                                $all_locations_posts->the_post();
                                $pID=get_the_ID();
                                if ( isset( get_the_terms( get_the_ID(), 'location-city' )[0] ) ) {
                                    $city = get_the_terms( get_the_ID(), 'location-city' )[0];

                                    if ( in_array( $city->name, $buffer ) ) {
                                        continue;
                                    }
                                    $buffer[] = $city->name;
                                    $state = get_the_terms( $pID, 'location-state' );
                                    $alrv_loc_state_short_name='';
                                    if(isset($state[0])){
                                        $state=$state[0];
                                        $alrv_loc_state_short_name=(get_field('alrv_loc_state_short_name', $state)) ? get_field('alrv_loc_state_short_name', $state) : null;
                                    }
                                    ?>
                                    <option <?php if(isset($_GET['provider-location'])){ if($_GET['provider-location']== $city->term_id){echo 'selected="selected"';}} ?> value="<?php echo $city->term_id; ?>">
                                        <?php echo $alrv_loc_state_short_name .'-'. $city->name; ?>
                                    </option>
                                <?php
                                }
                            }
                            ?>

                        </select>
                    <?php
                    } wp_reset_postdata();
                    wp_reset_query();
                    ?>

                    <select name="providers-brand" id="providers-brand" class="prdr-filter">
                        <option value="*"> <?php _e( 'Select Brand', 'alrv_td' ); ?></option>
                        <?php foreach ( $providers_brand as $brand ) { ?>
                            <option <?php if(isset($_GET['provider-brand'])){ if($_GET['provider-brand']== $brand->slug){echo 'selected="selected"';}} ?> value="<?php echo $brand->slug; ?>">
                                <?php echo $brand->name; ?>
                            </option> <?php } ?>
                    </select>

                    <div class="search-form-new prdr-filter">

                        <div id="search-top">
                            <input type="search" class="search-field"
                                   placeholder="<?php echo esc_attr_x( 'Search …', 'placeholder' ); ?>"
                                   value="<?php echo $search; ?>" name="s"
                                   title="<?php echo esc_attr_x( 'Search for:', 'label' ); ?>" />
                            <input type="hidden" name="post_type" value="provider" />
                            <div class="prdr-serach-btn">
                                <input type="submit" class="search-button prdr-filter2" value="" />
                            </div>
                        </div>


                    </div>
                    <button type="button" id="clear-all" class="button pro-clear-btn"><?php _e( 'Clear All', 'alrv_td' ); ?></button>
                </div>
            </div>
        </div>
    </div>
    <!-- Hero End -->
</section>
<section id="page-section" class="page-section">
    <div class="wrapper">
        <div class="providers-section prdrs-temp-ctn">
            <div
                class="providers-section
                <?php if ( $all_providers_posts->have_posts() ) { ?>  d-flex flex-wrap <?php } ?>">
                <!-- Content Start -->
                <?php
                // The Loop
                if ( $all_providers_posts->have_posts() ) {
                    while ( $all_providers_posts->have_posts() ) {
                        $all_providers_posts->the_post();
                        // Include specific template for the content.
                        get_template_part( 'partials/content', 'archive-providers' );
                    }
                } else {
                    // If no content, include the "No posts found" template.
                    get_template_part( 'partials/content', 'none-simple' );
                }
                ?>
            </div>
            <?php
            if ( $all_providers_posts->have_posts() ) {
                if ( function_exists( 'glide_pagination' ) ) {
                    ?>
                    <div class="s-100"></div>
                    <div class="center-align">
                        <?php glide_pagination( $all_providers_posts->max_num_pages ); ?>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
    </div>
    <div class="clear"></div>
    <div class="ts-80"></div>
    <!-- Content End -->
</section>
<?php get_footer(); ?>
