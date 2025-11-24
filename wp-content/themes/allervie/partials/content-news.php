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
$alrv_pagetitle_news=(isset($post_fields['alrv_pagetitle_news']) || $post_fields['alrv_pagetitle_news']!='') ? $post_fields['alrv_pagetitle_news'] : get_the_title();
$categories=get_the_terms( $pID, 'news-cat' );
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
<section id="hero-section" class="hero-section hero-default single-post-hero">
	<!-- hero start -->
	<div class="wrapper">
		<div class="s-100"></div>
		<div class="d-flex justify-content-between align-items-center">
			<div class="banner-text">
				<a href="/news/" id="go-back" class="button white-btn" style="margin-bottom:10px;">
					<span><img src="<?php echo esc_url(get_template_directory_uri()) ?>/assets/img/arrow-left.svg" alt=""></span><?php _e( ' go back', 'alrv_td' ); ?></a>
				<h1 class="heading"><?php echo $alrv_pagetitle_news; ?></h1>
				<div class="date-meta">
					<span class="mtext-li"><?php echo $post_date; ?></span>
				</div>
				<?php if ( $description ) { ?>
					<?php echo html_entity_decode( $description ); ?>
				<?php } ?>
				<?php if ( $terms_string ) { echo $terms_string; } ?>
			</div>
			<div class="banner-image full-width">
				<?php
				if (has_post_thumbnail()) {
					the_post_thumbnail(
						'thumb_800',
						array(
							'alt' => get_the_title(),
							'title' => get_the_title(),
						)
					);
				} else {
					?>
				<img src="<?php echo get_template_directory_uri(); ?>/assets/img/admin/defaults/default-image.webp"
					class="" alt="<?php get_the_title();?>" title="<?php get_the_title();?>"> <?php }?>
			</div>
		</div>
		<!-- <div class="s-100">
		</div> -->
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
