<?php
/**
 * Block Name: Articles
 *
 * The template for displaying the custom gutenberg block named conditions list.
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

$alrv_blk_news_title        = $block_fields['alrv_blk_news_title'];
$alrv_blk_news_text         = html_entity_decode( $block_fields['alrv_blk_news_text'] );
$alrv_blk_news_button       = $block_fields['alrv_blk_news_button'];
$alrv_blk_news = $block_fields['alrv_blk_news'];
?>
<div id="<?php echo $id; ?>" class="<?php echo $align_class . ' ' . $class_name . ' ' . $name; ?> glide-block-<?php echo $block_glide_name; ?>">
		<div class="servies-section">
			<?php if ( $alrv_blk_news_title ) { ?>
			<div class="section-head center-align">
				<h2><?php echo $alrv_blk_news_title; ?></h2>
			</div>
			<?php } ?>
			<?php if($alrv_blk_news_text){ ?>
				<div class="blog-content">
					<?php echo html_entity_decode($alrv_blk_news_text); ?>
				</div>
			<?php } ?>
			<?php if ( $alrv_blk_news ) { ?>
			<div class="srv-cards d-flex align-items-stretch flex-wrap">
				<?php
				global $post;
				foreach ( $alrv_blk_news as $news_post ) {
					$post = $news_post;
					setup_postdata( $post );
					$pID          = get_the_ID();
					$post_fields  = get_fields( $pID );
					$post_excerpt = get_the_excerpt( $pID );
					$src          = wp_get_attachment_image_url( get_post_thumbnail_id( $pID ), 'full', false );
					if ( ! $src ) {
						$src = get_template_directory_uri() . '/assets/img/defaults/default-image.webp';
					} else {
						$src = $src;
					}
					$categories=get_the_terms( $pID, 'category' );
					$terms_string = join(', ', wp_list_pluck($categories, 'name'));
					$alrv_news_content=(isset($post_fields['alrv_news_content'])) ? $post_fields['alrv_news_content'] : null ;
					?>
				<div class="srv-sngl-card">
					<a href="<?php the_permalink(); ?>" class="cdn-inner-card">
						<div class="srv-sngl-img">
							<img src="<?php echo $src; ?>" alt="<?php the_title(); ?>" />
							<div class="services-catagories">
								<span class="cat-btn" style="background-color: #6E7CF5;"><?php echo $terms_string; ?></span>
							</div>
						</div>
						<div class="srv-sngl-text">
							<p class="heading-5">
								<?php the_title(); ?>
							</p>
							<?php
								if ( $alrv_news_content ) {
									echo $alrv_news_content;
								}else{
									echo '<p>'.$post_excerpt.'</p>';
								}
							?>
							<span class="button small-btn hide-on-mobile">learn more</span>
							<span class="learn-more show-on-mobile">learn more</span>
						</div>
					</a>
				</div>
				<?php } ?>
			</div>
			<div class="s-60"></div>
			<?php } ?>
			<?php if ( $alrv_blk_news_button ) { ?>
			<div class="center-align">
				<?php echo glide_acf_button( $alrv_blk_news_button, 'loadmore-btn' ); ?>
			</div>
			<?php } ?>

		</div>

	</div>
