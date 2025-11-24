<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
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


$categories=get_categories(array(
'hide_empty'    => false,
'exclude' => array( 35 )
));
$queried_object=get_queried_object();
$term_id=$queried_object->term_id;

?>

<section id="hero-section" class="hero-section container-780 hero-default">
	<!-- hero start -->
	<div class="s-100"></div>
	<div class="hero-event ">
		<div class="wrapper">
			<div class="d-flex justify-content-center align-items-start">
				<div class="banner-text center-align">
					<h1 class="heading"><?php the_archive_title(); ?></h1>
				</div>
			</div>
		</div>
	</div>
	<!-- Hero End -->
	<div class="s-100"></div>
</section>

<section id="page-section" class="page-section">
	<!-- Content Start -->
	
	<div class="categories-ctn">
		<a href="/blog" title="Blog" target="" class="loadmore-btn small">All</a>
		<?php
		foreach ($categories as $key => $category) {
			if($category->slug=='uncategorized'){
				continue;
			}
		?>
			<a href="<?php echo get_category_link($category); ?>" title="<?php echo $category->name; ?>" target="" class="loadmore-btn small <?php if($term_id==$category->term_id){ echo 'active'; }  ?>">
				<?php echo $category->name; ?></a>
		<?php } ?>
	</div>

	<div class="wrapper">
		<div class="post-archive three-columns">
			<?php
			if ( have_posts() ) {
				while ( have_posts() ) {
					the_post();
					// Include specific template for the content
					get_template_part( 'partials/content-archive', get_post_type() );
				}
				?>
			<div class="clear"></div>
				<?php
			} else {
				// If no content, include the "No posts found" template.
				get_template_part( 'partials/content', 'none' );
			}
			?>
		</div>
		<div class="ts-40"></div>
		<?php
		if ( function_exists( 'glide_pagination' ) ) {
			?>
		<div class="center-align"> <?php glide_pagination( $query->max_num_pages ); ?></div>
		<?php } ?>
		<div class="ts-80"></div>
	</div>
	<!-- Content End -->
</section> <?php get_footer(); ?>
