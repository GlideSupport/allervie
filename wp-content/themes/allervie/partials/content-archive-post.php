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
$categories=get_the_terms( $pID, 'category' );
$terms_string = join(', ', wp_list_pluck($categories, 'name'));
$author_id = get_post_field( 'post_author', $pID );
$post_date=get_the_date();
if ( get_the_author_meta( 'first_name', $author_id ) || get_the_author_meta( 'last_name', $author_id ) ) {
	$author_name = get_the_author_meta( 'first_name', $author_id ) . ' ' . get_the_author_meta( 'last_name', $author_id );
} elseif ( get_the_author_meta( 'display_name', $author_id ) ) {
	$author_name = get_the_author_meta( 'display_name', $author_id );
}
$alrv_author_designation = get_field( 'alrv_author_designation', 'user_' . $author_id );
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'post-box' ); ?>>
	<a href="<?php the_permalink(); ?>">
		<div class="post-img-inner">
			<div class="post-img" style="background-image: url(<?php echo $src; ?>);">
			</div>
		</div>
		<div class="post-content-area">
			<?php if($terms_string){  ?>
				<div class="prdr-type xs-text blue-text"> <?php echo $terms_string; ?> </div>
			<?php } ?>
			<div class="post-tilte">
				<h4><?php the_title(); ?></h4>
			</div>

			<div class="post-excerpt">
				<?php if(has_excerpt()){
					the_excerpt();
				} ?>
			</div>

			<div class="post-extras">
				<?php echo $post_date; ?>
				<?php if(!empty($author_name)){ ?>
				<div class="author-meta">
					<div class="author-name">
						<?php echo $author_name; ?>

						<?php if($alrv_author_designation){ 
								echo ', '.$alrv_author_designation; 
							} ?> </div>
				</div>
				<?php } ?>
			</div>
			
			<span class="button small-btn"><?php _e( 'read more', 'alrv_td' ); ?></span>
		</div>
	</a>
</article>
<!-- #post-<?php the_ID(); ?> -->
