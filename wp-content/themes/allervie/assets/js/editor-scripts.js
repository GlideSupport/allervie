

jQuery(document).on('click','#working-data-progress-btn',function(){
	var birdeye=JSON.parse(jQuery(this).attr('data-birdeye'));
	jQuery('#notification-response').html('<div id="message" class="updated notice is-dismissible" style="border-left-color: red;width: 1500px;"><p>Caution! Do not leave this page until fetch is complete.</p></div>');
	jQuery('#working-data-progress').find('ol').html('');
	jQuery('#working-data-progress').show();
	jQuery.ajax( {
		url: localVars.ajax_url,
		type: 'post',
		data:{
			action: 'fetch_data_from_birdeye_before',
		},
		success( response ) {
			makeRequest(birdeye,0);
		},
	} );
});
function makeRequest(birdeye, index) {
	var element=birdeye[index];
	jQuery.ajax( {
		url: localVars.ajax_url,
		type: 'post',
		data:{
			action: 'fetch_data_from_birdeye',
			element:element,
		},
		success( response ) {
			if (birdeye.length!=index) {
				// console.log(element);
				jQuery('#working-data-progress').find('ol').append(response);
				makeRequest(birdeye, ++index);
			} else {
				jQuery('#notification-response').html('<div id="message" class="updated notice is-dismissible" style="width: 1500px;"><p>All BirdEye locations have been fetched successfully.</p></div>');
			}
		},
	} );
}

/**
 * Single Location fecthing brideyeid location data
 */
jQuery(document).on('click','.single-fetch-loc', function() {
	const loc_button = jQuery(this);
	jQuery('#single-loc-notifi-res').html('<div id="message" class="updated notice is-dismissible" style="border-left-color: red;"><p>Caution! Do not leave this page until fetch is complete.</p></div>');
	jQuery('.location-single-fetch .spinner').css('visibility', 'visible');
    loc_button.attr('disabled','disabled');
	let BirdEyeLocationID = jQuery('input[name="acf[field_63071e6b9e48f]"]').val();
	let locationPostID = jQuery(this).data('locaid');
	// console.log(BirdEyeLocationID);
	
	if(BirdEyeLocationID){
		jQuery.ajax({
			url: localVars.ajax_url,
			type: 'post',
			data:{
				action: 'fetch_single_loc',
				'birdeye_location_id': BirdEyeLocationID,
				'location_postid': locationPostID
			},
			success(response) {
				if(response.success === false && response.data){
					jQuery('#single-loc-notifi-res').html('<div id="message" class="updated notice is-dismissible" style="border-left-color: red;"><p>'+response.data+'</p></div>');
				}else{
					jQuery('.data-content').html(response.data.result);
					jQuery('#single-loc-notifi-res').html('<div id="message" class="updated notice is-dismissible"><p>BirdEye locations have been fetched successfully.</p></div>');
				}
				jQuery('.location-single-fetch .spinner').css('visibility', 'hidden');
				loc_button.removeAttr('disabled');

			},error: function(xhr, status, error) {
				console.error("Location Fsetch Error:", status, error);
			}
		});
    }
});

/**
 * Custom Script for confirmation prior trash any post
 */

jQuery( function($) {
	$('.edit-php a.submitdelete, .post-php a.submitdelete').click( function( event ) {
		if( ! confirm( 'Are you sure you want to move the post to trash?' ) ) {
			event.preventDefault();
		}
	});
});

( function() {
    if (typeof document.querySelectorAll === 'undefined') {
        console.warn('Browser support for querySelectorAll is required for Trash Fail Safe');
        return;
    }

    const postForm = document.getElementById('posts-filter');
    if (typeof postForm === 'undefined' || !postForm) {
        return;
    }

    //Media list has native confirmation, so we don't need to double up on it.
    function isMediaListTable(eventTarget) {
        return jQuery(eventTarget).closest('table.media').length === 1
        || jQuery(eventTarget).find('table.media').length === 1;
    }

    //Allow normal click handling for elements other than span.delete a.submitdelete
    postForm.addEventListener('click', function(ev) {

        if (ev.target.matches('input#delete_all') && !confirm('Are you sure you want to empty trash and delete all trashed items?')) {
            ev.preventDefault();
            return;
        }

        if (!ev.target.matches('a.submitdelete') || !ev.target.parentElement.matches('span.delete') || isMediaListTable(ev.target)) {
            return;
        }

        if (!confirm('Are you sure you want to permanently delete this item?')) {
            ev.preventDefault();
        }
    });

    //Confirm before bulk delete action
    postForm.addEventListener('submit', function(ev) {
        if (isMediaListTable(ev.target)) {
            return;
        }

        const bulkAction = document.getElementById('bulk-action-selector-top');
        if (!bulkAction || bulkAction.value !== 'delete') {
            return;
        }
        
        if (!confirm('Are you sure you want to permanently delete all selected items?')) {
            ev.preventDefault();
        }
    });

} )();
