<?php
/**
 * Block Name: Conditions List
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

$alrv_blk_cl_title        = $block_fields['alrv_blk_cl_title'];
$alrv_blk_cl_text         = html_entity_decode( $block_fields['alrv_blk_cl_text'] );
$alrv_blk_cl_button       = $block_fields['alrv_blk_cl_button'];
$alrv_blk_cl_design       = $block_fields['alrv_blk_cl_design'];
$alrv_blk_cl_hash_id_cl_1 = ( isset( $block_fields['alrv_blk_cl_hash_id'] ) ) ? $block_fields['alrv_blk_cl_hash_id'] : null;


?>

<?php if ( $alrv_blk_cl_hash_id_cl_1 ) { ?>
<div id="<?php echo sanitize_title( $alrv_blk_cl_hash_id_cl_1 ); ?>" class="block-hash-scroll"></div>
<?php } ?>

<div id="<?php echo $id; ?>"
	class="<?php echo $align_class . ' ' . $class_name . ' ' . $name; ?> glide-block-<?php echo $block_glide_name; ?> glide-block-services-we-provide">

	<?php if ( $alrv_blk_cl_design == 'simple' ) {
		global $post;
$cl_select_posts = array();
$cl_select_posts = $block_fields['alrv_blk_cl_conditions'];
		?>
	<div class="condition-list-section">
		<?php if ( $alrv_blk_cl_title || $alrv_blk_cl_text ) { ?>
		<div class="section-head center-align">
			<?php if ( $alrv_blk_cl_title ) { ?>
			<h2><?php echo $alrv_blk_cl_title; ?></h2>
			<?php } ?>
			<?php if ( $alrv_blk_cl_text ) { ?>
				<?php echo $alrv_blk_cl_text; ?>
			<?php } ?>
		</div>
		<?php } ?>
		<?php if ( $cl_select_posts ) { ?>
		<div class="cnd-lst d-flex align-items-stretch flex-wrap">
			<?php
			foreach ( $cl_select_posts as $cl_post ) {
				$post = $cl_post;
				setup_postdata( $post );
				$pID         = $post->ID;
				$post_fields = get_fields( $pID );
				$src         = wp_get_attachment_image_src( get_post_thumbnail_id( $pID ), 'full', false );
				if ( ! $src ) {
					$src = get_template_directory_uri() . '/assets/img/default-project-image.jpg';
				} else {
					$src = $src[0];
				}
				?>
			<div class="cnd-lst-sngl">
				<div class="cnd-lst-inner">
					<a href="<?php the_permalink(); ?>">
						<p><?php the_title(); ?></p>
						<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/arrow-long.svg"
							alt="">
					</a>
				</div>
			</div>
			<?php } ?>
		</div>
			<?php
		} wp_reset_query();
		wp_reset_postdata();
		?>

		<div class="s-60"></div>

		<?php if ( $alrv_blk_cl_button ) : ?>
		<div class="center-align">
			<?php echo glide_acf_button( $alrv_blk_cl_button, 'loadmore-btn' ); ?>
		</div>
		<?php endif; ?>

		<?php } elseif ( $alrv_blk_cl_design == 'image' ) {
			global $post;
$cl_select_posts = array();
$cl_select_posts = $block_fields['alrv_blk_cl_conditions'];
			?>
		<div class="servies-section">
			<?php if ( $alrv_blk_cl_title || $alrv_blk_cl_text ) { ?>
				<div class="section-head center-align">
					<?php if ( $alrv_blk_cl_title ) { ?>
						<h2><?php echo $alrv_blk_cl_title; ?></h2>
					<?php } ?>
					<?php if ( $alrv_blk_cl_text ) { ?>
						<?php echo $alrv_blk_cl_text; ?>
					<?php } ?>
				</div>
			<?php } ?>			
			<?php if ( $cl_select_posts ) { ?>
			<div class="srv-cards d-flex align-items-stretch flex-wrap">
				<?php
				foreach ( $cl_select_posts as $cl_post ) {
					$post = $cl_post;
					setup_postdata( $post );
					$pID          = $post->ID;
					$post_fields  = get_fields( $pID );
					$post_excerpt = get_the_excerpt( $pID );
					$src          = wp_get_attachment_image_src( get_post_thumbnail_id( $pID ), 'full', false );
					if ( ! $src ) {
						$src = get_template_directory_uri() . '/assets/img/defaults/default-image.webp';
					} else {
						$src = $src[0];
					}
					$serviceCategory = get_the_terms( $pID, 'conditions' );
					foreach ( $serviceCategory as $category ) {
						$current_category = $category;
						$currentColor     = get_field( 'alrv_tax_cco_color', $category->taxonomy . '_' . $category->term_id );
						break;
					}

					?>
				<div class="srv-sngl-card">
					<a href="<?php the_permalink(); ?>" class="cdn-inner-card">
						<div class="srv-sngl-img">
							<img src="<?php echo $src; ?>" alt="<?php the_title(); ?>" />
							<div class="services-catagories">
								<span class="cat-btn"
									style="background-color: <?php echo $currentColor; ?>;"><?php echo $current_category->name; ?></span>
							</div>
						</div>
						<div class="srv-sngl-text hide-text-on-mobile">
							<p class="heading-5">
								<?php the_title(); ?>
							</p>
							<?php if ( $post_excerpt ) { ?>
							<p >
								<?php echo $post_excerpt; ?>
							</p>
							<?php } ?>
							<span class="button small-btn hide-on-mobile">learn more</span>
							<span class="learn-more show-on-mobile">learn more</span>
						</div>
					</a>
				</div>
				<?php } ?>
			</div>
			<div class="s-60"></div>
			<?php } ?>
			<?php if ( $alrv_blk_cl_button ) : ?>
			<div class="center-align">
				<?php echo glide_acf_button( $alrv_blk_cl_button, 'loadmore-btn' ); ?>
			</div>
			<?php endif; ?>

		</div>
		<?php }else{ $alrv_blk_cl_con = (isset($block_fields['alrv_blk_cl_con'])) ? $block_fields['alrv_blk_cl_con'] : null; ?>

			<div class="condition-block-ctn">
					<?php if ( $alrv_blk_cl_title ) { ?>
						<div class="section-head center-align">
							<h2><?php echo $alrv_blk_cl_title; ?></h2>
						</div>
					<?php } ?>
					<?php if ( $alrv_blk_cl_text ) { ?>
						<?php echo $alrv_blk_cl_text; ?>
					<?php } ?>
				<?php if ( $alrv_blk_cl_con ) { ?>
				<div class="condition-block-inner four-columns">
					<?php
				foreach ( $alrv_blk_cl_con as $cl_post ) {
					$title=$cl_post['title'];
					$icon=$cl_post['icon'];
					$icon = wp_get_attachment_image( $icon, 'thumb_200' );

					?>
					<div class="condition-card-box column">

						<div class="condition-card-icon">
							<?php if($icon){  ?>
								<div class="cd-icon">
									 <?php echo $icon; ?>
								</div>
							<?php } ?>
						</div>
						<?php if($title){  ?>
							<div class="condition-card-title"> <?php echo $title; ?></div>
						<?php } ?>
					</div>
				<?php } ?>
				</div>
				<?php } ?>
				<?php if ( $alrv_blk_cl_button ) { ?>
				<div class="condition-block-btn">
					<?php echo glide_acf_button( $alrv_blk_cl_button, 'button' ); ?>
				</div>
				<?php } ?>
			</div>
		<?php } ?>

	</div>
