<?php
/**
 * Template Name: News
 * Template Post Type: page
 *
 * This template is for displaying blog page.
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

$alrv_pagetitle   = glide_page_title( 'alrv_tnho_title' );
$categories = get_terms([
    'taxonomy' => 'news-cat',
    'hide_empty' => false,
]);
?>
<section id="hero-section" class="hero-section">
	<!-- hero start -->
	<div class="hero-blog ">
		<div class="wrapper">
			<div class="d-flex justify-content-center align-items-start">
				<div class="banner-text center-align">
					<h1 class="heading"><?php echo $alrv_pagetitle; ?></h1>
				</div>
			</div>
		</div>
	</div>
	<!-- Hero End -->
</section>
<section id="page-section" class="page-section">
	<div class="categories-ctn">
			<a href="/news" title="News" target="" class="loadmore-btn small active">All</a>
			<?php
			foreach ($categories as $key => $category) {
			?>
				<a href="<?php echo get_category_link($category); ?>" title="<?php echo $category->name; ?>" target="" class="loadmore-btn small"><?php echo $category->name; ?></a>
			<?php } ?>
	</div>
	<!-- Content Start -->
	<div class="wrapper">
		<div class="post-archive blog-posts three-columns">
			<?php
				// WP_Query arguments
				$args = array(
					'post_type'      => array( 'news' ),
					'posts_per_page' => get_option( 'posts_per_page' ), // how many posts you need
					'paged'          => ( get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1 ),
				);
				// The Query
				$query = new WP_Query( $args );
				// The Loop
				if ( $query->have_posts() ) {
					while ( $query->have_posts() ) {
						$query->the_post();
						// Include specific template for the content.
						get_template_part( 'partials/content', 'archive-news' );
					}
					?>
			<div class="clear"></div>
					<?php
				} else {
					// If no content, include the "No posts found" template.
					get_template_part( 'partials/content', 'none' );
				} wp_reset_postdata(); wp_reset_query();
				?>
		</div>
		<?php if ( $query->have_posts() ) { if ( function_exists( 'glide_pagination' ) ) { ?>
		<div class="ts-40"></div>
		<div class="center-align"> <?php glide_pagination( $query->max_num_pages ); ?></div>
		<div class="ts-80"></div>
		<?php } } ?>
		<!-- Content End -->
	</div>

	<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<?php
		if(have_posts()){
			while (have_posts()) {
				the_post();

				get_template_part( 'partials/content' );
			}
		}
		?>
	</div>

	<div class="clear"></div>
</section>
<?php
wp_reset_postdata();
wp_reset_query();
?>
<?php
get_footer();
