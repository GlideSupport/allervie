<?php
/**
 * Block Name: Tabbed Content
 *
 * The template for displaying the custom gutenberg block named tabbed content.
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

$alrv_blk_tc_title   = $block_fields['alrv_blk_tc_title'];
$alrv_blk_tc_design  = $block_fields['alrv_blk_tc_design'];
$alrv_blk_tc_tabs    = $block_fields['alrv_blk_tc_tabs'];
$alrv_blk_tc_hash_id = ( isset( $block_fields['alrv_blk_tc_hash_id'] ) ) ? $block_fields['alrv_blk_tc_hash_id'] : null;
?>
<?php if ( $alrv_blk_tc_hash_id ) { ?>
<div id="<?php echo sanitize_title( $alrv_blk_tc_hash_id ); ?>" class="block-hash-scroll"></div>
<?Php } ?>
<div id="<?php echo $id; ?>"
	class="<?php echo $align_class . ' ' . $class_name . ' ' . $name; ?> glide-block-<?php echo $block_glide_name; ?>">

	<?php if ( $alrv_blk_tc_design == 'twocol' ) { ?>
		<div class="tabs-section ext-lnks-two-col two-col-tabs">
			<?php if ( $alrv_blk_tc_title ) { ?>
			<div class="section-head center-align">
				<h2><?php echo $alrv_blk_tc_title; ?></h2>
			</div>
			<?php } ?>
			<?php
			if ( $alrv_blk_tc_tabs ) {
				$tab_counter = 0;
				?>
			<div class="tabs">
				<!-- Tabs Head End -->

				<ul class="tabs-nav d-flex flex-wrap justify-content-center align-items-stretch">
					<?php
					foreach ( $alrv_blk_tc_tabs as $tab ) {
						$tab_counter++;
						$tab_active_class = null;
						if ( $tab_counter == 1 ) {
							$tab_active_class = ' active ';
						}
						$tab_title = $tab['title'];
						$tab_icon  = $tab['icon'];
						?>
					<li class="<?php echo $tab_active_class; ?>">
						<a href="#alrv-tab-frm<?php echo $tab_counter; ?>" class="center-align">
							<?php if ( $tab_icon ) { ?>
								<div class="tab-icon">
									<?php echo wp_get_attachment_image( $tab_icon, 'thumb_100' ); ?>
								</div>
							<?php } ?>
							<div class="tab-title">
								<p class="medium-text heading-6">
									<?php echo $tab_title; ?>
								</p>
							</div>
						</a>
					</li>
					<?php } ?>
				</ul>
				<!-- Tabs Head End -->
				<!-- Tabs Content start -->
				<div id="tabs-content">
					<?php
					$tab_counter = 0;
					foreach ( $alrv_blk_tc_tabs as $tab ) {
						$tab_counter++;
						$links = $tab['links'];
						?>
					<div id="alrv-tab-frm<?php echo $tab_counter; ?>" class="tab-content">
						<?php
						foreach ( $links as $link ) {
							$link_name = $link['name'];
							$link_link = $link['link'];
							?>
							<?php if ( $link_name ) { ?>
						<div class="section-head center-align">
							<p class="heading-6"><?php echo $link_name; ?></p>
						</div>
						<?php } ?>
							<?php if ( $link_link ) { ?>
						<div class="ext-form-links d-flex flex-wrap">
								<?php
								foreach ( $link_link as $extlink ) {
									$extlink_heading = $extlink['heading'];
									$extlink_text    = $extlink['text'];
									$open_in_new_tab = $extlink['open_in_new_tab'];
									$extlink_link    = $extlink['link'];
									if ( $open_in_new_tab ) {
										$open_in_new_tab = 'target="_blank"';
									}

									if ( $extlink_heading || $extlink_text || $extlink_link ) {
										?>
							<a
										<?php
										if ( $extlink_link ) {
											?>
											 href="<?php echo $extlink_link; ?>" <?php echo $open_in_new_tab; ?> <?php } ?> class="pt-frm-lnk d-flex">
								<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/form-icon.svg"
									alt="External Link Icon">
								<div class="ext-frm-desc">
									<p class="heading-6"><?php echo $extlink_heading; ?></p>
										<?php if ( $extlink_text ) { ?>
									<p><?php echo $extlink_text; ?></p>
									<?php } ?>
								</div>
							</a>
							<?php } ?>
							<?php } ?>
						</div>
						<?php } ?>
						<?php } ?>
					</div>
					<?php } ?>
				</div>
				<!-- Tabs Content End -->
			</div>
			<?php } ?>
		</div>
	<?php } else if($alrv_blk_tc_design == 'threecol') { ?>
		<div class="tabs-section ext-lnks-two-col two-col-tabs">
			<?php if ( $alrv_blk_tc_title ) { ?>
			<div class="section-head center-align">
				<h2><?php echo $alrv_blk_tc_title; ?></h2>
			</div>
			<?php } ?>
			<?php
			if ( $alrv_blk_tc_tabs ) {
				$tab_counter = 0;
				?>
			<div class="tabs">
				<!-- Tabs Head End -->

				<ul class="tabs-nav d-flex flex-wrap justify-content-center align-items-stretch">
					<?php
					foreach ( $alrv_blk_tc_tabs as $tab ) {
						$tab_counter++;
						$tab_active_class = null;
						if ( $tab_counter == 1 ) {
							$tab_active_class = ' active ';
						}
						$tab_title = $tab['title'];
						$tab_icon  = $tab['icon'];
						?>
					<li class="<?php echo $tab_active_class; ?>">
						<a href="#alrv-tab-frm<?php echo $tab_counter; ?>" class="center-align">
							<?php if ( $tab_icon ) { ?>
								<div class="tab-icon">
									<?php echo wp_get_attachment_image( $tab_icon, 'thumb_100' ); ?>
								</div>
							<?php } ?>
							<div class="tab-title">
								<p class="medium-text heading-6">
									<?php echo $tab_title; ?>
								</p>
							</div>
						</a>
					</li>
					<?php } ?>
				</ul>
				<!-- Tabs Head End -->
				<!-- Tabs Content start -->
				<div id="tabs-content">
					<?php
					$tab_counter = 0;
					foreach ( $alrv_blk_tc_tabs as $tab ) {
						$tab_counter++;
						$links = $tab['links'];
						?>
					<div id="alrv-tab-frm<?php echo $tab_counter; ?>" class="tab-content">
						<?php
						foreach ( $links as $link ) {
							$link_name = $link['name'];
							$link_link = $link['link'];
							?>
							<?php if ( $link_name ) { ?>
						<div class="section-head center-align">
							<p class="heading-6"><?php echo $link_name; ?></p>
						</div>
						<?php } ?>
							<?php if ( $link_link ) { ?>
						<div class="ext-form-links threecol d-flex flex-wrap">
								<?php
								foreach ( $link_link as $extlink ) {
									$extlink_heading = $extlink['heading'];
									$extlink_text    = $extlink['text'];
									$open_in_new_tab = $extlink['open_in_new_tab'];
									$extlink_link    = $extlink['link'];
									if ( $open_in_new_tab ) {
										$open_in_new_tab = 'target="_blank"';
									}

									if ( $extlink_heading || $extlink_text || $extlink_link ) {
										?>
							<a
										<?php
										if ( $extlink_link ) {
											?>
											 href="<?php echo $extlink_link; ?>" <?php echo $open_in_new_tab; ?> <?php } ?> class="pt-frm-lnk d-flex">
								<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/form-icon.svg"
									alt="External Link Icon">
								<div class="ext-frm-desc">
									<p class="heading-6"><?php echo $extlink_heading; ?></p>
										<?php if ( $extlink_text ) { ?>
									<p><?php echo $extlink_text; ?></p>
									<?php } ?>
								</div>
							</a>
							<?php } ?>
							<?php } ?>
						</div>
						<?php } ?>
						<?php } ?>
					</div>
					<?php } ?>
				</div>
				<!-- Tabs Content End -->
			</div>
			<?php } ?>
		</div>
	<?php } else if($alrv_blk_tc_design == 'fourcol') { ?>
		<div class="tabs-section ext-lnks-two-col two-col-tabs">
			<?php if ( $alrv_blk_tc_title ) { ?>
			<div class="section-head center-align">
				<h2><?php echo $alrv_blk_tc_title; ?></h2>
			</div>
			<?php } ?>
			<?php
			if ( $alrv_blk_tc_tabs ) {
				$tab_counter = 0;
				?>
			<div class="tabs">
				<!-- Tabs Head End -->

				<ul class="tabs-nav d-flex flex-wrap justify-content-center align-items-stretch">
					<?php
					foreach ( $alrv_blk_tc_tabs as $tab ) {
						$tab_counter++;
						$tab_active_class = null;
						if ( $tab_counter == 1 ) {
							$tab_active_class = ' active ';
						}
						$tab_title = $tab['title'];
						$tab_icon  = $tab['icon'];
						?>
					<li class="<?php echo $tab_active_class; ?>">
						<a href="#alrv-tab-frm<?php echo $tab_counter; ?>" class="center-align">
							<?php if ( $tab_icon ) { ?>
								<div class="tab-icon">
									<?php echo wp_get_attachment_image( $tab_icon, 'thumb_100' ); ?>
								</div>
							<?php } ?>
							<div class="tab-title">
								<p class="medium-text heading-6">
									<?php echo $tab_title; ?>
								</p>
							</div>
						</a>
					</li>
					<?php } ?>
				</ul>
				<!-- Tabs Head End -->
				<!-- Tabs Content start -->
				<div id="tabs-content">
					<?php
					$tab_counter = 0;
					foreach ( $alrv_blk_tc_tabs as $tab ) {
						$tab_counter++;
						$links = $tab['links'];
						?>
					<div id="alrv-tab-frm<?php echo $tab_counter; ?>" class="tab-content">
						<?php
						foreach ( $links as $link ) {
							$link_name = $link['name'];
							$link_link = $link['link'];
							?>
							<?php if ( $link_name ) { ?>
						<div class="section-head center-align">
							<p class="heading-6"><?php echo $link_name; ?></p>
						</div>
						<?php } ?>
							<?php if ( $link_link ) { ?>
						<div class="ext-form-links fourcol d-flex flex-wrap">
								<?php
								foreach ( $link_link as $extlink ) {
									$extlink_heading = $extlink['heading'];
									$extlink_text    = $extlink['text'];
									$open_in_new_tab = $extlink['open_in_new_tab'];
									$extlink_link    = $extlink['link'];
									if ( $open_in_new_tab ) {
										$open_in_new_tab = 'target="_blank"';
									}

									if ( $extlink_heading || $extlink_text || $extlink_link ) {
										?>
							<a
										<?php
										if ( $extlink_link ) {
											?>
											 href="<?php echo $extlink_link; ?>" <?php echo $open_in_new_tab; ?> <?php } ?> class="pt-frm-lnk d-flex">
								<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/form-icon.svg"
									alt="External Link Icon">
								<div class="ext-frm-desc">
									<p class="heading-6"><?php echo $extlink_heading; ?></p>
										<?php if ( $extlink_text ) { ?>
									<p><?php echo $extlink_text; ?></p>
									<?php } ?>
								</div>
							</a>
							<?php } ?>
							<?php } ?>
						</div>
						<?php } ?>
						<?php } ?>
					</div>
					<?php } ?>
				</div>
				<!-- Tabs Content End -->
			</div>
			<?php } ?>
		</div>
	<?php } else { ?>
		<div class="tabs-section ext-lnks-sngl-col single-col-tabs">
			<?php if ( $alrv_blk_tc_title ) { ?>
			<div class="section-head center-align">
				<h2><?php echo $alrv_blk_tc_title; ?></h2>
			</div>
			<?php } ?>
			<?php if ( $alrv_blk_tc_tabs ) { ?>
			<div class="tabs">
				<!-- Tabs Head start -->
				<ul class="tabs-nav d-flex flex-wrap justify-content-center align-items-stretch" id="tabs-nav2">
					<?php
					$tab_counter = 0;
					foreach ( $alrv_blk_tc_tabs as $tab ) {
						$tab_title = $tab['title'];
						$tab_icon  = $tab['icon'];
						$tab_counter++;
						$tab_active_class = null;
						if ( $tab_counter == 1 ) {
							$tab_active_class = ' active ';
						}
						?>
					<li class="<?php echo $tab_active_class; ?>"><a href="#alrv-tab-ex<?php echo $tab_counter; ?>"
							class="center-align">
							<?php if ( $tab_icon ) { ?>
								<div class="tab-icon">
									<?php echo wp_get_attachment_image( $tab_icon, 'thumb_100' ); ?>
								</div>
							<?php } ?>
							<div class="tab-title">
								<p class="medium-text heading-6">
									<?php echo $tab_title; ?>
								</p>
							</div>
						</a>
					</li>
					<?php } ?>
				</ul>
				<!-- Tabs Head End -->
				<!-- Tabs Content start -->
				<div id="tabs-content">
					<?php
					$tab_counter = 0;
					foreach ( $alrv_blk_tc_tabs as $tab ) {
						$tab_links = $tab['links'];
						foreach ( $tab_links as $link ) {
							$link_link = $link['link'];
							$link_name = $link['name'];
							$tab_counter++;
							?>
					<div id="alrv-tab-ex<?php echo $tab_counter; ?>" class="tab-content">
							<?php if ( $link_name ) { ?>
						<div class="section-head center-align">
							<h2><?php echo $link_name; ?></h2>
						</div>
						<?php } ?>
							<?php
							foreach ( $link_link as $extlink ) {

								$extlink_heading = $extlink['heading'];
								$extlink_text    = $extlink['text'];
								$extlink_link    = $extlink['link'];
								$open_in_new_tab = $extlink['open_in_new_tab'];
								if ( $open_in_new_tab ) {
									$open_in_new_tab = 'target="_blank"';
								}
								if($extlink_heading || $extlink_text || $extlink_link){
								?>

								<div class="ext-form-links d-flex flex-wrap">
									<a <?php if ( $extlink_link ) {?> href="<?php echo $extlink_link; ?>" <?php } echo $open_in_new_tab; ?> class="pt-frm-lnk d-flex justify-content-between">
										<div class="ext-frm-desc">
											<p class="medium-text heading-6"><?php echo $extlink_heading; ?></p>
										</div>
										<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/external-link-icon.svg" alt="External Link Icon">
									</a>
								</div>
						<?php
								}
					       } ?>
					</div>
					<?php } ?>
					<?php } ?>
				</div>
				<!-- Tabs Content End -->
			</div>
			<?php } ?>
		</div>
	<?php }; ?>
</div>
