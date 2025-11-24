<?php
/**
 * Template part for displaying posts in an archive
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Allervie
 * @since 1.0.0
 */


// Global variables
global $option_fields;
global $pID;
global $fields;
$pID=get_the_ID();
$src = wp_get_attachment_image_url( get_post_thumbnail_id(  $pID ), 'thumb_900');
if ( ! has_post_thumbnail() ) {
	$src = esc_url( get_template_directory_uri() ) . '/assets/img/admin/defaults/default-image.webp';
} else {
	$src = $src;
}
$post_fields=get_fields_escaped($pID);
$alrv_pagetitle_news=(isset($post_fields['alrv_pagetitle_news']) && $post_fields['alrv_pagetitle_news']!='') ? $post_fields['alrv_pagetitle_news'] : get_the_title();
$categories=get_the_terms( $pID, 'news-cat' );
$terms_string = join(', ', wp_list_pluck($categories, 'name'));
$post_date = get_the_date();
$post_excerpt = get_the_excerpt( $pID );
$alrv_news_content=(isset($post_fields['alrv_news_content'])) ? $post_fields['alrv_news_content'] : null ;
$theme_block_fields = get_fields( $block['id'] );
$image_variations = $theme_block_fields['image_variations'] ? $theme_block_fields['image_variations'] : 'logo';

$custom_class = '';
if($image_variations == 'logo'){
    $custom_class = 'logo-class';
}else{
    $custom_class = 'full-width';
}

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'srv-sngl-card' ); ?>>
	<a href="<?php the_permalink(); ?>" class="news-inner-card">
		<div class="srv-sngl-img <?php echo $custom_class; ?>">
			<?php
			if ( has_post_thumbnail() ) { 

					the_post_thumbnail(
					    'thumb_600',
					    array(
					        'alt'   => get_the_title(),
					        'title' => get_the_title(),
					    )
					);
			} else {
				?>
			<img src="<?php echo get_template_directory_uri(); ?>/assets/img/admin/defaults/default-image2.png" class=""
				alt="<?php get_the_title(); ?>" title="<?php get_the_title(); ?>"> <?php } ?>
		</div>
		<div class="srv-sngl-text">
			<h2 class="medium-text">
			<?php echo $alrv_pagetitle_news; ?>
			</h2>
			<?php
				if ( $alrv_news_content ) {
					echo $alrv_news_content;
				}else{
					echo '<p>'.$post_excerpt.'</p>';
				}
			?>
			<div class="srv-sngl-date">
				<span class=""><?php echo $post_date; ?></span>
			</div>
			<span class="button small-btn hide-on-mobile"><?php _e( 'learn more', 'alrv_td' ); ?></span>
			<span class="learn-more show-on-mobile"><?php _e( 'learn more', 'alrv_td' ); ?></span>
		</div>
	</a>
</article><!-- #post-<?php the_ID(); ?> -->
