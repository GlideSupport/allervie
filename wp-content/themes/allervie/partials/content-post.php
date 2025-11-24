<?php
/**
 * Template part for displaying single post
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Allervie
 * @since 1.0.0
 */


$post_data = get_queried_object();
$pID       = get_the_ID();
$pID=get_the_ID();
$src = wp_get_attachment_image_url( get_post_thumbnail_id(  $pID ), 'thumb_900');
if ( ! has_post_thumbnail() ) {
	$src = esc_url( get_template_directory_uri() ) . '/assets/img/admin/defaults/default-image.webp';
} else {
	$src = $src;
}

$author_id = get_post_field( 'post_author', $pID );
$post_fields=get_fields_escaped($pID);
$alrv_dfo_posttitle=(isset($post_fields['alrv_dfo_posttitle']) || $post_fields['alrv_dfo_posttitle']!='') ? $post_fields['alrv_dfo_posttitle'] : get_the_title();
$categories=get_the_terms( $pID, 'category' );
$terms_string = join(', ', wp_list_pluck($categories, 'name'));
$post_date=get_the_date();
if ( get_the_author_meta( 'first_name', $author_id ) || get_the_author_meta( 'last_name', $author_id ) ) {
	$author_name = get_the_author_meta( 'first_name', $author_id ) . ' ' . get_the_author_meta( 'last_name', $author_id );
} elseif ( get_the_author_meta( 'display_name', $author_id ) ) {
	$author_name = get_the_author_meta( 'display_name', $author_id );
}
$alrv_author_designation = get_field( 'alrv_author_designation', 'user_' . $author_id );
$description = get_the_author_meta( 'description', $author_id );
?>

<section id="hero-section" class="hero-section">
	<!-- hero start -->
	<div class="container-780">
		<div class="wrapper">
			<div class="single-post-hero">
				<div class="hero-content">
					<a href="/blog/" id="go-back" class="post-back button white-btn" style="margin-bottom:10px;">
                        <span><img src="/wp-content/themes/allervie/assets/img/arrow-left.svg" alt=""></span> go back</a>
					<h1><?php echo $alrv_dfo_posttitle; ?></h1>
					<div class="date-meta">
						<span class="mtext-li"><?php echo $post_date; ?></span>
					</div>

				</div>
				<div class="post-feature-ctn">
					<div class="ftr-img" style="background-image: url(<?php echo $src; ?>);">
					</div>
					<div class="author-meta">
						<div class="author-name">
							by <a href="<?php echo get_author_posts_url($author_id); ?>"> <?php echo $author_name; if($alrv_author_designation){ echo ', '.$alrv_author_designation; } ?> </a> </div>
						<?php if($description){  ?>
							<div class="abt-author">
								<p><?php echo $description; ?></p>
							</div>
						<?php } ?>
					</div>
					<!-- .post-image -->
				</div>
			</div>
		</div>
	</div>
	<!-- hero end -->
</section>

<section id="page-section" class="page-section">
	<!-- Content Start -->

	<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<?php get_template_part( 'partials/content' ); ?>
	</div>

	<div class="clear"></div>
	<!-- Content End -->
</section>
