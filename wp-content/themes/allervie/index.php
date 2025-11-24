<?php
/**
 * Template Name: Blog
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
$alrv_tnho_ftpost = $fields['alrv_tnho_ftpost'];



$categories=get_categories(array(
'hide_empty'    => false,
'exclude' => array( 35 )
));

$alrv_post_catagories = get_categories( $pID );
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
		<?php if ( $alrv_tnho_ftpost ) { ?>
	<div class="wrapper">
		<?php
		global $post;

			foreach ( $alrv_tnho_ftpost as $key => $feature_post ) {
					$post = $feature_post;
					setup_postdata( $post );
					$pID           = $post->ID;
					$post_title    = get_the_title( $pID );
					$post_excerpt  = get_the_excerpt( $pID );
					$post_date     = get_the_date( 'M d Y', $pID );
					$parmalink     = get_the_permalink( $pID );
					$post_tags     = get_the_tags( $feature_post->ID );
					$author_name   = get_the_author( $pID );
					$author_avatar = ( $alrv_author_avatar ) ? $alrv_author_avatar : get_avatar_url( $pID );
					// var_dump($author_avatar);

					$image = get_the_post_thumbnail_url( $feature_post->ID, 'full' );
				if ( ! $image ) {
					$image = get_template_directory_uri() . '/assets/img/admin/defaults/default-image.webp';
				}
				?>
					<div class="blog-post-box featured-post mobile-hide">
						<div class="blog-ft-inner d-flex flex-wrap align-items-center justify-content-between">
							<?php if ( $image ) { ?>
								<div class="blog-post-img post-image rs-view-100">
									<a href="<?php echo $parmalink; ?>"><img src="<?php echo $image; ?>"></a>
								</div>
							<?php } ?>
							<div class="post-content rs-view-100">
								<!-- Post Title  -->
								<?php if ( $post_tags ) { ?>
									<div class="news-tags">
										<?php
										foreach ( $post_tags as $key => $post_tag ) {
											$post_cat_name = $post_tag->name;
											$post_cat_link = get_category_link( $post_tag->term_id );
											?>
											<a href="<?php echo $post_cat_link; ?>" class="cat-btn"><?php echo $post_cat_name; ?></a>
										<?php } ?>
									</div>
								<?php } ?>
								<!-- Post Title -->
								<?php if ( $post_title ) { ?>
									<div class="post-box-title">
										<h2><a href="<?php echo $parmalink; ?>"><?php echo $post_title; ?></a></h2>
									</div>
								<?php } ?>
								<!-- Post Exerpt -->
								<?php if ( $post_excerpt ) { ?>
									<div class="post-box-excerpt">
										<p>
												<?php echo $post_excerpt; ?>
										</p>
									</div>
								<?php } ?>
								<!-- Post Meta -->
								<div class="post-box-meta">
									<div class="post-author-ctn d-flex">
												<?php if ( $author_avatar ) { ?>
											<div class="post-author-img"
												style="background-image: url(<?php echo $author_avatar; ?>); width:50px; height:50px; background-size:cover">
											</div>
										<?php } ?>
										<div class="author-meta">
											<?php if ( $author_name ) { ?>
												<div class="post-author-name"><?php echo $author_name; ?></div>
											<?php } ?>
											<?php if ( $post_date ) { ?>
												<div class="post-meta-date"><?php echo $post_date; ?></div>
											<?php } ?>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<article id="post-<?php echo $pID; ?>" <?php post_class( 'srv-sngl-card desktop-hide' ); ?>>
						<a href="<?php echo $parmalink; ?>" class="news-inner-card">
							<?php if ( $image ) { ?>
								<div class="srv-sngl-img">
									<img src="<?php echo $image; ?>">
								</div>
							<?php } ?>

							<div class="srv-sngl-text">
								<?php if ( $post_title ) { ?>
									<h2 class="medium-text">
										<?php echo $post_title; ?>
									</h2>
								<?php } ?>
								<?php if ( $post_excerpt ) { ?>
										<p>
												<?php echo $post_excerpt; ?>
										</p>
								<?php } ?>
								<span class="button small-btn hide-on-mobile"><?php _e( 'learn more', 'alrv_td' ); ?></span>
								<span class="learn-more show-on-mobile"><?php _e( 'learn more', 'alrv_td' ); ?></span>
							</div>
						</a>
					</article><!-- #post-<?php the_ID(); ?> -->
				<?php
			}

		?>
	</div>
		<?php
			}

		?>
	<!-- Hero End -->
</section>
<section id="page-section" class="page-section">


	<div class="categories-ctn">
			<a href="/blog" title="Blog" target="" class="loadmore-btn small active">All</a>
			<?php
			foreach ($categories as $key => $category) {
				if($category->slug=='uncategorized'){
					continue;
				}
			?>
				<a href="<?php echo get_category_link($category); ?>" title="<?php echo $category->name; ?>" target="" class="loadmore-btn small"><?php echo $category->name; ?></a>
			<?php } ?>
	</div>

	<!-- Content Start -->
	<div class="wrapper">
		<div class="post-box-container">
			<?php
				// WP_Query arguments
				$args = array(
					'post_type'      => array( 'post' ),
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
						get_template_part( 'partials/content', 'archive-post' );
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
		<?php if ( $query->have_posts() ) { if ( function_exists( 'glide_pagination' ) ) { ?>
		<div class="ts-40"></div>
		<div class="center-align"> <?php glide_pagination( $query->max_num_pages ); ?></div>
		<div class="ts-80"></div>
		<?php } } ?>
		<!-- Content End -->
	</div>
</section>
<?php
wp_reset_postdata();
wp_reset_query();
?>
<?php
get_footer();
