<?php
/**
 * Template part for footer cta
 *
 * @link https://developer.wordpress.org/themes/template-files-section/partial-and-miscellaneous-template-files/
 *
 * @package Allervie
 * @since 1.0.0
 */

 // Global variables
global $option_fields;
global $pID;
global $fields;

$alrv_fco_visibility                    = ( isset( $fields['alrv_fco_visibility'] ) ) ? $fields['alrv_fco_visibility'] : null;
$alrv_fco_override_theme_options_design = ( isset( $fields['alrv_fco_override_theme_options_design'] ) ) ? $fields['alrv_fco_override_theme_options_design'] : null;

if ( $alrv_fco_override_theme_options_design == true ) {
	$alrv_fco_design_variation = $fields['alrv_fco_design_variation'];

	if ( isset($fields['alrv_fco_title']) ) {		
		$alrv_fco_title = $fields['alrv_fco_title'];
	}
	if ( isset( $fields['alrv_fco_first_button']['icon'] ) || isset( $fields['alrv_fco_first_button']['button'] ) ) {
		$alrv_fco_first_button = $fields['alrv_fco_first_button'];
	}
	if ( isset( $fields['alrv_fco_second_button']['icon'] ) || isset( $fields['alrv_fco_second_button']['button'] ) ) {
		$alrv_fco_second_button = $fields['alrv_fco_second_button'];
	}
}else{	
	$alrv_fco_design_variation = $option_fields['alrv_to_fcta_variation'];
	$alrv_fco_title = $option_fields['alrv_to_fcta_title'];
	$alrv_fco_first_button = $option_fields['alrv_to_fcta_first_button'];
	$alrv_fco_second_button = $option_fields['alrv_to_fcta_second_button'];
}

$alrv_fco_fbutton_icon   = $alrv_fco_first_button['icon'];
$alrv_fco_fbutton_button = $alrv_fco_first_button['button'];

$alrv_fco_sbutton_icon   = $alrv_fco_second_button['icon'];
$alrv_fco_sbutton_button = $alrv_fco_second_button['button'];

if ( $alrv_fco_override_theme_options_design ) {
	$alrv_fco_design_variation = $fields['alrv_fco_design_variation'];
} else {
	$alrv_fco_design_variation = $option_fields['alrv_to_fcta_variation'];
}

if ( $alrv_fco_visibility ) {
	if(get_post_type(get_the_ID())=='location'){
		$state_term     = get_the_terms( get_the_ID(), 'location-state' );
		$state_id       = ( isset( $state_term[0]->term_id ) ) ? $state_term[0]->term_id : null;
	}
	?>
	<?php //if ( $alrv_fco_design_variation == 'singlebtn' ) { 
		if ( $alrv_fco_override_theme_options_design == true ) { 
			if ( $alrv_fco_design_variation == 'singlebtn' ) { ?>
				<section class="footer-cta cta-variation">
					<div class="wrapper">
						<div class="footer-cta-inner d-flex flex-wrap justify-content-between ">
							<div class="cta-left">
								<?php if ( $alrv_fco_title ) { ?>
								<h2 class="heading-1">
									<?php echo $alrv_fco_title; ?>
								</h2>
								<?php } ?>
							</div>
							<div class="cta-right">
								<?php
								if(get_post_type(get_the_ID())=='location'){
									if($alrv_fco_fbutton_button){

										if($alrv_fco_fbutton_button['title']=='Make an Appointment'){
											if ( $state_id ) {
												$alrv_fco_fbutton_button['url'] = $alrv_fco_fbutton_button['url'] . '?app-state=' . $state_id . '&app-location=' . get_the_ID();
											} else {
												$alrv_fco_fbutton_button['url'] = $alrv_fco_fbutton_button['url'] . '?app-location=' . get_the_ID();
											}
											if(isset($_GET['gclid'])){
												$alrv_fco_fbutton_button['url'] = $alrv_fco_fbutton_button['url'] . '&gclid='.$_GET['gclid'];
											}
											if(isset($_GET['wc_clear'])){
												$alrv_fco_fbutton_button['url'] = $alrv_fco_fbutton_button['url'] . '&wc_clear='.$_GET['wc_clear'];
											}
										}
									}
								}
								?>
								<?php if ( $alrv_fco_fbutton_icon || $alrv_fco_fbutton_button ) { ?>
									<a href="<?php echo $alrv_fco_fbutton_button['url']; ?>" class="cta-card-sngl d-flex align-items-center <?php if($alrv_fco_fbutton_button['title']=='Make an Appointment'){ echo 'apt-btn'; } ?> ">
										<div class="circle-shape d-flex justify-content-center  align-items-center center-align">
											<?php echo wp_get_attachment_image( $alrv_fco_fbutton_icon, 'thumb_100' ); ?>
										</div>
										<p class="heading-6">
											<?php echo $alrv_fco_fbutton_button['title']; ?>
										</p>
									</a>
								<?php } ?>
							</div>
						</div>
					</div>
				</section>
			<?php } else { ?>
				<section class="footer-cta ft-cta-section cta-aqua-bg">
					<div class="wrapper">
						<div class="footer-cta-inner d-flex flex-wrap justify-content-between ">
							<div class="cta-left">
									<?php if ( $alrv_fco_title ) { ?>
								<h2 class="heading-1">
										<?php echo $alrv_fco_title; ?>
								</h2>
								<?php } ?>
							</div>
							<div class="cta-right">
								<div class="cta-cards d-flex justify-content-between center-align">
									<?php
										if(get_post_type(get_the_ID())=='location'){
											if($alrv_fco_fbutton_button){

												if($alrv_fco_fbutton_button['title']=='Make an Appointment'){
													if ( $state_id ) {
														$alrv_fco_fbutton_button['url'] = $alrv_fco_fbutton_button['url'] . '?app-state=' . $state_id . '&app-location=' . get_the_ID();
													} else {
														$alrv_fco_fbutton_button['url'] = $alrv_fco_fbutton_button['url'] . '?app-location=' . get_the_ID();
													}
													if(isset($_GET['gclid'])){
														$alrv_fco_fbutton_button['url'] = $alrv_fco_fbutton_button['url'] . '&gclid='.$_GET['gclid'];
													}
													if(isset($_GET['wc_clear'])){
														$alrv_fco_fbutton_button['url'] = $alrv_fco_fbutton_button['url'] . '&wc_clear='.$_GET['wc_clear'];
													}
												}
											}
										}
										if(get_post_type(get_the_ID())=='location'){
											if($alrv_fco_sbutton_button){

												if($alrv_fco_sbutton_button['title']=='Make an Appointment'){
													if ( $state_id ) {
														$alrv_fco_sbutton_button['url'] = $alrv_fco_sbutton_button['url'] . '?app-state=' . $state_id . '&app-location=' . get_the_ID();
													} else {
														$alrv_fco_sbutton_button['url'] = $alrv_fco_sbutton_button['url'] . '?app-location=' . get_the_ID();
													}
													if(isset($_GET['gclid'])){
														$alrv_fco_sbutton_button['url'] = $alrv_fco_sbutton_button['url'] . '&gclid='.$_GET['gclid'];
													}
													if(isset($_GET['wc_clear'])){
														$alrv_fco_sbutton_button['url'] = $alrv_fco_sbutton_button['url'] . '&wc_clear='.$_GET['wc_clear'];
													}
												}
											}
										}
									?>
									<?php if ( $alrv_fco_fbutton_icon || $alrv_fco_fbutton_button ) { ?>
										<a href="<?php echo $alrv_fco_fbutton_button['url']; ?>" class="cta-card-sngl <?php if($alrv_fco_fbutton_button['title']=='Make an Appointment'){ echo 'apt-btn'; } ?>">
											<div class="circle-shape d-flex justify-content-center align-items-center">
												<?php echo wp_get_attachment_image( $alrv_fco_fbutton_icon, 'thumb_100' ); ?>
											</div>
											<p class="heading-6">
												<?php echo $alrv_fco_fbutton_button['title']; ?>
											</p>
										</a>
									<?php } ?>
									<?php if ( $alrv_fco_sbutton_icon || $alrv_fco_sbutton_button ) { ?>
										<a href="<?php echo $alrv_fco_sbutton_button['url']; ?>" class="cta-card-sngl <?php if($alrv_fco_sbutton_button['title']=='Make an Appointment'){ echo 'apt-btn'; } ?>">
											<div class="circle-shape d-flex justify-content-center  align-items-center center-align">
												<?php echo wp_get_attachment_image( $alrv_fco_sbutton_icon, 'thumb_100' ); ?>
											</div>
											<p class="heading-6">
												<?php echo $alrv_fco_sbutton_button['title']; ?>
											</p>
										</a>
									<?php } ?>

								</div>
							</div>
						</div>

					</div>
				</section>
			<?php } ?>
		<?php } else { ?>
			<section class="footer-cta ft-cta-section cta-aqua-bg">
				<div class="wrapper">
					<div class="footer-cta-inner d-flex flex-wrap justify-content-between ">
						<div class="cta-left">
								<?php if ( $alrv_fco_title ) { ?>
							<h2 class="heading-1">
									<?php echo $alrv_fco_title; ?>
							</h2>
							<?php } ?>
						</div>
						<div class="cta-right">
							<div class="cta-cards d-flex justify-content-between center-align">
								<?php
									if(get_post_type(get_the_ID())=='location'){
										if($alrv_fco_fbutton_button){

											if($alrv_fco_fbutton_button['title']=='Make an Appointment'){
												if ( $state_id ) {
													$alrv_fco_fbutton_button['url'] = $alrv_fco_fbutton_button['url'] . '?app-state=' . $state_id . '&app-location=' . get_the_ID();
												} else {
													$alrv_fco_fbutton_button['url'] = $alrv_fco_fbutton_button['url'] . '?app-location=' . get_the_ID();
												}
												if(isset($_GET['gclid'])){
													$alrv_fco_fbutton_button['url'] = $alrv_fco_fbutton_button['url'] . '&gclid='.$_GET['gclid'];
												}
												if(isset($_GET['wc_clear'])){
													$alrv_fco_fbutton_button['url'] = $alrv_fco_fbutton_button['url'] . '&wc_clear='.$_GET['wc_clear'];
												}
											}
										}
									}
									if(get_post_type(get_the_ID())=='location'){
										if($alrv_fco_sbutton_button){

											if($alrv_fco_sbutton_button['title']=='Make an Appointment'){
												if ( $state_id ) {
													$alrv_fco_sbutton_button['url'] = $alrv_fco_sbutton_button['url'] . '?app-state=' . $state_id . '&app-location=' . get_the_ID();
												} else {
													$alrv_fco_sbutton_button['url'] = $alrv_fco_sbutton_button['url'] . '?app-location=' . get_the_ID();
												}
												if(isset($_GET['gclid'])){
													$alrv_fco_sbutton_button['url'] = $alrv_fco_sbutton_button['url'] . '&gclid='.$_GET['gclid'];
												}
												if(isset($_GET['wc_clear'])){
													$alrv_fco_sbutton_button['url'] = $alrv_fco_sbutton_button['url'] . '&wc_clear='.$_GET['wc_clear'];
												}
											}
										}
									}
								?>
								<?php if ( $alrv_fco_fbutton_icon || $alrv_fco_fbutton_button ) { ?>
									<a href="<?php echo $alrv_fco_fbutton_button['url']; ?>" class="cta-card-sngl <?php if($alrv_fco_fbutton_button['title']=='Make an Appointment'){ echo 'apt-btn'; } ?>">
										<div class="circle-shape d-flex justify-content-center align-items-center">
											<?php echo wp_get_attachment_image( $alrv_fco_fbutton_icon, 'thumb_100' ); ?>
										</div>
										<p class="heading-6">
											<?php echo $alrv_fco_fbutton_button['title']; ?>
										</p>
									</a>
								<?php } ?>
								<?php if ( $alrv_fco_sbutton_icon || $alrv_fco_sbutton_button ) { ?>
									<a href="<?php echo $alrv_fco_sbutton_button['url']; ?>" class="cta-card-sngl <?php if($alrv_fco_sbutton_button['title']=='Make an Appointment'){ echo 'apt-btn'; } ?>">
										<div class="circle-shape d-flex justify-content-center  align-items-center center-align">
											<?php echo wp_get_attachment_image( $alrv_fco_sbutton_icon, 'thumb_100' ); ?>
										</div>
										<p class="heading-6">
											<?php echo $alrv_fco_sbutton_button['title']; ?>
										</p>
									</a>
								<?php } ?>

							</div>
						</div>
					</div>	
				</div>
			</section>
		<?php } ?>
<?php } ?>
