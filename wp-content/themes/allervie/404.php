<?php
/**
 * The template  displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Allervie
 * @since   1.0.0
 */

// Include header
get_header();

// Global variables
global $option_fields;
global $pID;
global $fields;

// 404 Page - Advanced custom fields variables
$alrv_error_headline         = html_entity_decode( $option_fields['alrv_error_headline'] );
$alrv_error_sub_headline     = html_entity_decode( $option_fields['alrv_error_sub_headline'] );
$alrv_error_text             = html_entity_decode( $option_fields['alrv_error_text'] );
$alrv_error_menu             = html_entity_decode( $option_fields['alrv_error_menu'] );
$alrv_error_menu_bottom_text = html_entity_decode( $option_fields['alrv_error_menu_bottom_text'] );
$alrv_error_search           = html_entity_decode( $option_fields['alrv_error_search'] );

?>


<section id="hero-section" class="hero-section container-780 hero-default">
	<!-- hero start -->
	<div class="s-100"></div>
	<div class="hero-404">
		<div class="wrapper">
			<div class="d-flex justify-content-center align-items-start">
				<div class="banner-text center-align">
					<h1 class="heading"><?php echo $alrv_error_headline; ?></h1>
					<p><?php echo $alrv_error_sub_headline; ?></p>
				</div>
			</div>
		</div>
	</div>
	<!-- Hero End -->
	<div class="s-50"></div>
</section>

<section id="page-section" class="page-section container-780">
	<!-- Page Content Start -->
	<div class="m-section">
		<div class="wrapper">
			<section class="error-404 not-found">
				<div class="page-content">
					<?php
					if ( $alrv_error_text ) {
						echo $alrv_error_text;
					}
					if ( $alrv_error_menu ) {
						?>
					<div class="error">
						<?php echo $alrv_error_menu; ?> </div>
						<?php
					}
					?>
					<div class="clear"></div>
					<div class="form-404">
						<?php
						if ( $alrv_error_menu_bottom_text ) {
							echo $alrv_error_menu_bottom_text;
						}
						if ( 1 !== $alrv_error_search ) {
							get_search_form();
						}
						?>
					</div>
					<!--404-form-->
				</div><!-- .page-content -->
			</section><!-- .error-404 -->
			<div class="ts-80"></div>
		</div>
	</div>
</section>
<?php
get_footer();
