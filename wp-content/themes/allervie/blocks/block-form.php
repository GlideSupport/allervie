<?php
/**
 * Block Name: Form
 *
 * The template for displaying the custom gutenberg block named Form.
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

$alrv_blk_form_title   = $block_fields['alrv_blk_form_title'];
$alrv_blk_form_text    = $block_fields['alrv_blk_form_text'];
$alrv_blk_form_design  = $block_fields['alrv_blk_form_design'];
$alrv_blk_form_gform   = $block_fields['alrv_blk_form_gform'];
$alrv_blk_form_hash_id = ( isset( $block_fields['alrv_blk_form_hash_id'] ) ) ? $block_fields['alrv_blk_form_hash_id'] : null;
?>
<?php if ( $alrv_blk_form_hash_id ) { ?>
<div id="<?php echo sanitize_title( $alrv_blk_form_hash_id ); ?>" class="block-hash-scroll"></div>
<?Php } ?>
<div id="<?php echo $id; ?>"
	class="<?php echo $align_class . ' ' . $class_name . ' ' . $name; ?> glide-block-<?php echo $block_glide_name; ?>">
<?php if($alrv_blk_form_title){ ?>
	<?php if ( $alrv_blk_form_design == 'simple' ) { ?>
		<div class="contect-form">
			<div class="section-head center-align">
				<?php if ( $alrv_blk_form_title ) { ?>
				<h2 class="med-heading center-align"><?php echo $alrv_blk_form_title; ?></h2>
					<?php if ( $alrv_blk_form_text ) { ?>
				<p><?php echo $alrv_blk_form_text; ?></p>
				<?php } ?>
			</div>
			<?php } ?>
			<?php
			if ( $alrv_blk_form_gform ) {
				echo do_shortcode( '[gravityform id="' . $alrv_blk_form_gform . '" title=false description=false ajax=true]' );
			}
			?>
		</div>
	<?php } else { ?>
		<div class="contect-form-variation d-flex justify-content-between flex-wrap">
			<div class="form-left">
				<?php if ( $alrv_blk_form_title ) { ?>
				<h2 class="med-heading">
					<?php echo $alrv_blk_form_title; ?>
				</h2>
				<?php } ?>
				<?php if ( $alrv_blk_form_text ) { ?>
				<p><?php echo $alrv_blk_form_text; ?></p>
				<?php } ?>
			</div>
			<div class="form-right">
				<?php
				if ( $alrv_blk_form_gform ) {
					echo do_shortcode( '[gravityform id="' . $alrv_blk_form_gform . '" title=false description=false ajax=true]' );
				}
				?>
			</div>
		</div>
	<?php } ?>
<?php } ?>

</div>
<?php if($alrv_blk_form_gform==5){ ?>
<script>
	jQuery(document).ready(function(){
		setTimeout(() => {
			var location_id=jQuery('.populate-location').find('select option:selected').attr('data-id');
			var trackingCode= jQuery('.populate-location').find('select:first').find('option:selected').attr('data-tracking-code');
			console.log(location_id);
			if(typeof location_id !=='undefined' && location_id!==''){
				jQuery.ajax({
					url: localVars.ajax_url,
					type: 'post',
					data: {
						action: 'populate_provider_by_location',
						location: location_id,
					},
					success(response) {
						jQuery('.populate-provider').find('select').html(response);
						jQuery('html, body').animate({
							scrollTop: jQuery(".form-jump-to").offset().top-130
						}, 0);
						if(trackingCode!='' || typeof trackingCode!="undefined"){
							loadjscssfile_block('https://scripts.iconnode.com/'+trackingCode+'.js','js')
						}
					},
				});
			}
		}, 1000);
		var ARR=['app-location','app-fname','app-lname','app-phone','app-date','app-type','app-rfname','app-rlname','app-fax','app-fphone','app-remail','app-rsubf','app-rsubl','app-tt','app-bio','app-rphone'];
		var newURL = location.href.split("?")[0];
			var para_new=getParams_block('string',ARR);
			if(para_new==''){
				newURL=newURL+getParams_block('string',ARR);
			}else{
				newURL=newURL+'?'+getParams_block('string',ARR);
			}
			window.history.pushState('object', document.title, newURL);
	});

	function loadjscssfile_block(filename, filetype){
		if (filetype=="js"){ //if filename is a external JavaScript file
		var fileref=document.createElement('script')
		fileref.setAttribute("type","text/javascript");
		fileref.setAttribute("src", filename);
		}
		else if (filetype=="css"){ //if filename is an external CSS file
		var fileref=document.createElement("link")
		fileref.setAttribute("rel", "stylesheet");
		fileref.setAttribute("type", "text/css");
		fileref.setAttribute("href", filename);
		}
		if (typeof fileref!="undefined")
		document.getElementsByTagName("head")[0].appendChild(fileref)
	}
	gform.addAction('gform_input_change', function(elem, formId, fieldId) {
		var parent = jQuery(elem).parent().parent();
		var location_id = jQuery(elem).find('option:selected').attr('data-id');
		if (jQuery(parent).hasClass('populate-location')) {
			if (history.pushState) {

			var oldurl= window.location.protocol + "//" + window.location.host + window.location.pathname ;
				oldurl+='?app-location='+jQuery('.populate-location').find('select option:selected').attr('data-id');
				oldurl+='&app-fname='+jQuery('.populate-fname').find('input').val();
				oldurl+='&app-lname='+jQuery('.populate-lname').find('input').val();
				oldurl+='&app-date='+jQuery('.populate-date').find('input').val();
				oldurl+='&app-phone='+jQuery('.populate-phone').find('input').val();
				oldurl+='&app-type='+jQuery('.populate-type').find('input').val();
				oldurl+='&app-rfname='+jQuery('.populate-rfname').find('input').val();
				oldurl+='&app-rlname='+jQuery('.populate-rlname').find('input').val();
				oldurl+='&app-fax='+jQuery('.populate-fax').find('input').val();
				oldurl+='&app-rphone='+jQuery('.populate-rphone').find('input').val();
				oldurl+='&app-remail='+jQuery('.populate-remail').find('input').val();
				oldurl+='&app-rsubf='+jQuery('.populate-rsubf').find('input').val();
				oldurl+='&app-rsubl='+jQuery('.populate-rsubl').find('input').val();
				var populate_tt='';
				jQuery('.populate-tt').find('.gfield-choice-input').each(function(){
					if(jQuery(this).is(":checked")){
						populate_tt=populate_tt+','+jQuery(this).val()
					}

				})
				var populate_bio='';
				jQuery('.populate-bio').find('.gfield-choice-input').each(function(){
					if(jQuery(this).is(":checked")){
						populate_bio=populate_bio+','+jQuery(this).val()
					}
				})
				oldurl+='&app-tt='+populate_tt;
				oldurl+='&app-bio='+populate_bio;
				if(getParams_block('string')!=''){
					oldurl+='&'+getParams_block('string');
				}
				window.history.pushState({path:oldurl},'',oldurl);
			}
			window.location = window.location
		}
	});
	function getParams_block (type='arr',exclude=[],url = window.location) {

	// Create a params object
	let params = {};

	new URL(url).searchParams.forEach(function (val, key) {
		if(exclude){
			if(jQuery.inArray(key,exclude)!==-1){
				return;
			}
		}
		if (params[key] !== undefined) {
			if (!Array.isArray(params[key])) {
				params[key] = [params[key]];
			}
			params[key].push(val);
		} else {
			params[key] = val;
		}
	});
	if(type=='arr'){
		return params;
	}else{
		var params_string='';
		var i=0;
		for (const key in params) {
			const element = params[key];
			if(i==0){
				params_string+=key+'='+element;
			}else{
				params_string+='&'+key+'='+element;
			}
			i++;
		}
		return params_string;
	}

}
</script>
<?php } ?>

