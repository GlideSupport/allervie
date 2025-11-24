<?php
/**
 * Template Name: Appointment
 * Template Post Type: page
 *
 * This template is for displaying blog page.
 *
 * @link https://developer.wordpress.org/themes/template-files-section/page-template-files/
 *
 * @package Allervie
 * @since 1.0.0
 */

// Include header
get_header( 'app' );

// Global variables
global $option_fields;
global $pID;
global $fields;
$alrv_tmp_app_title = ( isset( $fields['alrv_tmp_app_title'] ) ) ? $fields['alrv_tmp_app_title'] : null;
if ( ! $alrv_tmp_app_title ) {
	$alrv_tmp_app_title = get_the_title();
}
?>
<section id="hero-section" class="hero-section">
	<!-- Content Start -->

	<div class="appointment-form-ctn">
		<?php
		if(isset($_GET['form']) && $_GET['form']=='custom' ){
			if(isset($_GET['app-location'])){
				$post_fields=get_fields($_GET['app-location']);
				$alrv_slo_external_form = ( isset( $post_fields['alrv_slo_external_form'] ) ) ? $post_fields['alrv_slo_external_form'] : null;
				echo $alrv_slo_external_form;
			}
		}else{
			while ( have_posts() ) {
				the_post();
				// Include specific template for the content.
				get_template_part( 'partials/content', 'page' );
			}
		}
		?>
		<div class="clear"></div>
		<!-- Content End -->
	</div>
</section>
<script>
var location_va = '';
var location_va_id = '';
var bk_a = '';
var old_trackingCode='';
jQuery(document).ready(function() {

	populate_location(100);
	setTimeout(() => {
		var trackingCode= jQuery('.populate-location').find('select:first').find('option:selected').attr('data-tracking-code');
		if(trackingCode!='' || typeof trackingCode!="undefined"){
			if(old_trackingCode!=''){
				replacejscssfile('https://scripts.iconnode.com/'+old_trackingCode+'.js','https://scripts.iconnode.com/'+trackingCode+'.js','js');
			}else{
				loadjscssfile('https://scripts.iconnode.com/'+trackingCode+'.js','js')
			}
			old_trackingCode=trackingCode;
		}
		location_va = jQuery('.populate-location').find('select:first').val();
		location_va_id = jQuery('.populate-location').find('select:first').find('option:selected').attr('data-id');
	}, 2000);

});

gform.addAction('gform_input_change', function(elem, formId, fieldId) {
	var parent = jQuery(elem).parent().parent();
	if (jQuery(parent).hasClass('populate-state')) {
		var value = jQuery(elem).val().toLowerCase();
		var par_location = getUrlParameter('app-location');
		if (jQuery('.populate-state').length > 0) {
			jQuery.ajax({
				url: localVars.ajax_url,
				type: 'post',
				data: {
					action: 'populate_location_by_state',
					slug: value,
					location: par_location
				},
				success(response) {
					jQuery('.populate-location').find('select').html(response);
				},
			});

		}
	} else if (jQuery(parent).hasClass('populate-location')) {
		var button = jQuery('.populate-location').find('select:first').find('option:selected').attr('data-button');
		var button_title = jQuery('.populate-location').find('select:first').find('option:selected').attr('data-button-title');
		if (button != undefined) {
			if (button != '') {
				var a_next = '<a class="button next-external-version" target="_blank" href="' + button +
				'">Next</a>';
				bk_a = jQuery('.gform_next_button').parent().html();
				jQuery('.gform_next_button').parent().html(a_next);
			} else {
				jQuery('.next-external-version').parent().html(bk_a);
			}
		} else {
			jQuery('.next-external-version').parent().html(bk_a);
		}
		var trackingCode= jQuery('.populate-location').find('select:first').find('option:selected').attr('data-tracking-code');
		if(trackingCode!=''){
			if(old_trackingCode!=''){
				replacejscssfile('https://scripts.iconnode.com/'+old_trackingCode+'.js','https://scripts.iconnode.com/'+trackingCode+'.js','js');
			}else{
				loadjscssfile('https://scripts.iconnode.com/'+trackingCode+'.js','js')
			}
			old_trackingCode=trackingCode;
		}
		if (history.pushState) {
		var oldurl= window.location.protocol + "//" + window.location.host + window.location.pathname ;
			oldurl+='?app-state='+jQuery('.populate-state').find('select option:selected').attr('data-id');
			oldurl+='&app-location='+jQuery('.populate-location').find('select option:selected').attr('data-id');
			oldurl+='&'+getParams('string');
			window.history.pushState({path:oldurl},'',oldurl);
		}
		window.location = window.location
		location_va = jQuery('.populate-location').find('select:first').val();
		location_va_id = jQuery('.populate-location').find('select:first').find('option:selected').attr(
			'data-id');
	}
}, 10, 3);

jQuery(document).on('gform_page_loaded', function(event, form_id, current_page) {
	console.log(location_va);
	console.log(location_va_id);
	if (current_page == 1) {
		populate_location(100, location_va_id);
		// jQuery('.populate-location').find('select:first').val(location_va);
	} else if (current_page == 2) {

		jQuery('.next-page-location').find('select:first').val(location_va);
		jQuery('.next-page-location').find('select:first').attr('disabled', 'disabled');
		if (location_va_id != '') {
			jQuery.ajax({
				url: localVars.ajax_url,
				type: 'post',
				data: {
					action: 'populate_provider_by_location',
					location: location_va_id,
				},
				success(response) {
					jQuery('.populate-provider').find('select').html(response);
					populate_location(100, location_va_id);
				},
			});
		}
	}
});
var getUrlParameter = function getUrlParameter(sParam) {
	var sPageURL = window.location.search.substring(1),
		sURLVariables = sPageURL.split('&'),
		sParameterName,
		i;

	for (i = 0; i < sURLVariables.length; i++) {
		sParameterName = sURLVariables[i].split('=');

		if (sParameterName[0] === sParam) {
			return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
		}
	}
	return false;
};
function getParams (type='arr',exclude=[],url = window.location) {

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
jQuery(document).on('click', '.next-page-location', function() {
	jQuery('.gform_previous_button').click();
});

function populate_location(time, location_va = null) {
	setTimeout(() => {
		if (jQuery('.populate-state').length > 0) {
			var value = jQuery('.populate-state').find('select:first').val().toLowerCase();
			if (location_va) {
				var par_location = location_va;
			} else {
				var par_location = getUrlParameter('app-location');
			}
			if (value != '') {
				jQuery.ajax({
					url: localVars.ajax_url,
					type: 'post',
					data: {
						action: 'populate_location_by_state',
						slug: value,
						location: par_location
					},
					success(response) {
						// console.log(response);
						jQuery('.populate-location').find('select').html(response);
						var newURL = location.href.split("?")[0];
						var para_new=getParams('string',['app-state','app-location']);
						if(para_new==''){
							newURL=newURL+getParams('string',['app-state','app-location']);
						}else{
							newURL=newURL+'?'+getParams('string',['app-state','app-location']);
						}
						window.history.pushState('object', document.title, newURL);
						location_va = jQuery('.populate-location').find('select:first').val();
						location_va_id = jQuery('.populate-location').find('select:first').find(
							'option:selected').attr('data-id');
					},
				});
			}
		}
	}, time);
}
function createjscssfile(filename, filetype){
    if (filetype=="js"){ //if filename is a external JavaScript file
        var fileref=document.createElement('script')
        fileref.setAttribute("type","text/javascript")
        fileref.setAttribute("src", filename)
    }
    else if (filetype=="css"){ //if filename is an external CSS file
        var fileref=document.createElement("link")
        fileref.setAttribute("rel", "stylesheet")
        fileref.setAttribute("type", "text/css")
        fileref.setAttribute("href", filename)
    }
    return fileref
}

function replacejscssfile(oldfilename, newfilename, filetype){
    var targetelement=(filetype=="js")? "script" : (filetype=="css")? "link" : "none" //determine element type to create nodelist using
    var targetattr=(filetype=="js")? "src" : (filetype=="css")? "href" : "none" //determine corresponding attribute to test for
    var allsuspects=document.getElementsByTagName(targetelement)
    for (var i=allsuspects.length; i>=0; i--){ //search backwards within nodelist for matching elements to remove
        if (allsuspects[i] && allsuspects[i].getAttribute(targetattr)!=null && allsuspects[i].getAttribute(targetattr).indexOf(oldfilename)!=-1){
            var newelement=createjscssfile(newfilename, filetype)
            allsuspects[i].parentNode.replaceChild(newelement, allsuspects[i])
        }
    }
}
function loadjscssfile(filename, filetype){
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
function removejscssfile(filename, filetype){
    var targetelement=(filetype=="js")? "script" : (filetype=="css")? "link" : "none" //determine element type to create nodelist from
    var targetattr=(filetype=="js")? "src" : (filetype=="css")? "href" : "none" //determine corresponding attribute to test for
    var allsuspects=document.getElementsByTagName(targetelement)
    for (var i=allsuspects.length; i>=0; i--){ //search backwards within nodelist for matching elements to remove
    if (allsuspects[i] && allsuspects[i].getAttribute(targetattr)!=null && allsuspects[i].getAttribute(targetattr).indexOf(filename)!=-1)
        allsuspects[i].parentNode.removeChild(allsuspects[i]) //remove element by calling parentNode.removeChild()
    }
}
</script>
<?php
get_footer( 'app' );
