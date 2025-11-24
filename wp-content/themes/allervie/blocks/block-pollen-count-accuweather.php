<?php
/**
 * Block Name: Pollen Count
 *
 * The template for displaying the custom gutenberg block named pollen count.
 *
 * @link https://www.advancedcustomfields.com/resources/blocks/
 *
 * @package BaseTheme Package
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
$id                                   = 'block-' . $block_glide_name . '-' . $block['id'];
$alrv_blk_accuweather_location_number = ( isset( $block_fields['alrv_blk_accuweather_location_number'] ) ) ? $block_fields['alrv_blk_accuweather_location_number'] : null;
// Making the unique ID for the block.
if ( $block['name'] ) {
	$block_name = $block['name'];
	$block_name = str_replace( '/', '-', $block_name );
	$name       = 'block-' . $block_name;
}
$curl = curl_init();
curl_setopt_array(
	$curl,
	array(
		CURLOPT_URL            => 'https://dataservice.accuweather.com/forecasts/v1/daily/1day/' . $alrv_blk_accuweather_location_number . '?apikey=EnJxXyWPzQy5o48YWdhRQ0AfSIZmqp99&details=true',
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING       => '',
		CURLOPT_MAXREDIRS      => -1,
		CURLOPT_TIMEOUT        => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST  => 'GET',
	)
);

$response = curl_exec( $curl );

curl_close( $curl );
$response     = json_decode( $response );
$AirAndPollen = ( isset( $response->DailyForecasts[0]->AirAndPollen ) ) ? $response->DailyForecasts[0]->AirAndPollen : null;
$Code = ( isset( $response->Code ) ) ? $response->Code : null;
$Message = ( isset( $response->Message ) ) ? $response->Message : null;
$Reference = ( isset( $response->Reference ) ) ? $response->Reference : null;
?>
<div id="<?php echo $id; ?>"
	class="<?php echo $align_class . ' ' . $class_name . ' ' . $name; ?> glide-block-<?php echo $block_glide_name; ?>">

	<div class="pollen-count-ctn">
		<div class="pollen-content">
			<?php if($AirAndPollen){ foreach ( $AirAndPollen as $pollen ) { ?>
			<div class="item">
				<div class="pollen-circles">
					<div class="pollen-value-top">
						<span><?php echo $pollen->Value; ?></span>
					</div>
				</div>
				<div class="pollen-name">
					<span><?php echo $pollen->Name; ?></span>
				</div>
				<div class="pollen-value">
					<span class="
						<?php
						if ( $pollen->CategoryValue == 1 ) {
							echo 'low-btn';
						} elseif ( $pollen->CategoryValue == 2 ) {
							echo 'good-btn';
						} elseif ( $pollen->CategoryValue == 3 ) {
							echo 'moderate-btn';
						} elseif ( $pollen->CategoryValue == 4 ) {
							echo 'high-btn';
						} elseif ( $pollen->CategoryValue == 5 ) {
							echo 'unhealthy-btn';
						} elseif ( $pollen->CategoryValue == 6 ) {
							echo 'hazardous-btn';
						} else {
							echo 'low-btn'; }
						?>
						"><?php echo $pollen->Category; ?></span>
				</div>
			</div>
			<?php } }else{
				echo '<p><strong>'.$Code.':</strong> '.$Message.'</p>';
			} ?>
		</div>
	</div>
</div>
