let map, infoWindow, marker,
	pos = null,
	pageURLElem = jQuery( '#pageURL' ),
	locationMapElem = document.getElementById( 'locationMap' ),
	zipcodesElem = jQuery( '#zipcodes' ),

	windowWidth = jQuery( window ).width();
console.log("56 line location");
const sameHeightDiv = function( $containerClass, $columnClass ) {
	// Select and loop the container element of the elements you want to equalise
	jQuery( $containerClass ).each( function() {
		// Cache the highest
		let highestBox = 0;

		// Select and loop the elements you want to equalise
		jQuery( $columnClass, this ).each( function() {
			// If this box is higher than the cached highest then store it
			if ( jQuery( this ).height() > highestBox ) {
				highestBox = jQuery( this ).height();
			}
		} );
		// Set the height of all those children to whichever was highest
		jQuery( $columnClass, this ).height( highestBox );
	} );
};

jQuery( function() {
	jQuery( document ).ready( function() {

		zipcodesElem.autocomplete( {
			source: locationVars.zipcodes,
			minLength: 2,
			focus( event, ui ) {
				zipcodesElem.val( ui.item.label );
				return false;
			},
			select( event, ui ) {
				zipcodesElem.val( ui.item.label );
				return false;
			},
			messages: {
		        noResults: '',
		        results: function() {}
		    }
		} );

		if ( locationVars.stateParam ) {
			window.scrollTo( 0, jQuery( '.intro-block' ).offset().top );
		}
	} ); //End document.reday function.
} ); //End jQuery function.

/**
 * Initialize Map
 */

function initMap() {
	var style=[
		{
			"featureType": "water",
			"elementType": "geometry.fill",
			"stylers": [
				{
					"color": "#409FD7"
				}
			]
		}
	];
     
	if ((locationMapElem.classList.contains('ppc-map-non-interactive')) && locationVars.is_singular == 'yes'){
		var zoomControl = false;
    	var zoom = 10;
    }
    else {
    	if (locationVars.is_singular == 'yes') {
	        var zoomControl = true;
// 	        if (locationMapElem.parentElement.classList.contains('ppc-location-map')){
// 				var zoom = (windowWidth > 768) ? 4 : 3;
// 			}else{
				 var zoom = 14;
// 			}
	    } else {
	        var zoomControl = true;
	        // var zoom = (locationVars.zipcodeParam) ? 9 : ((windowWidth > 768) ? 8 : 7);
	        var zoom = (locationVars.zipcodeParam) ? ((windowWidth > 768) ? 4 : 3) : ((windowWidth > 768) ? 4 : 3);
// 	         var zoom = (locationVars.zipcodeParam) ? 4 : ((windowWidth > 768) ? 8 : 7);
	    }
    }

	map = new google.maps.Map( locationMapElem, {
		center: { lat: parseFloat( locationVars.alat ), lng: parseFloat( locationVars.alng ) },
		zoom: zoom,
		// zoom: ( locationVars.zipcodeParam ) ? 8 : ( ( windowWidth > 768 ) ? 5 : 4 ),
		scrollwheel: false,
		streetViewControl: false,
		fullscreenControl: false,
		draggable: true,
		zoomControl: zoomControl,
		zoomControlOptions: {
			position: google.maps.ControlPosition.TOP_RIGHT,
		},
		mapTypeControl: false,
		mapTypeId: google.maps.MapTypeId.ROADMAP,
		gestureHandling: 'greedy',
		styles:style,
	} );
	infoWindow = new google.maps.InfoWindow( { map } );

	const locationsLoop = locationVars.results;
	const isSingularLocation = locationVars.is_singular;
	// console.log('Number of locations:', locationsLoop.length);

	// Create a LatLngBounds object to include all markers
    var bounds = new google.maps.LatLngBounds();

	const markers = new Array();
	const locationIDs = new Array();
	const infowindow = new google.maps.InfoWindow( {
		content: '',
	} );

	for ( let i = 0; i < locationsLoop.length; i++ ) {

		if ( locationsLoop[ i ].hasOwnProperty( 'lat' ) && locationsLoop[ i ].lat && locationsLoop[ i ].hasOwnProperty( 'long' ) && locationsLoop[ i ].long ) {

			marker = new google.maps.Marker( {
				position: new google.maps.LatLng( locationsLoop[ i ].lat, locationsLoop[ i ].long ),
				map,
				icon: locationVars.markerImage,
			} );
			// Extend the bounds to include this marker
            bounds.extend(marker.getPosition());
            // Store the location ID with the marker
    		marker.locationID = locationsLoop[i].location_id;
    		
    		markers.push( marker );
			locationIDs.push(locationsLoop[i].location_id);

			if(locationVars.is_tooltip=='yes'){
				google.maps.event.addListener( marker, 'click', ( function( marker, i, locationsLoop ) {
					return function() {
						let infoContent = `
						<div class="banner-loc-text" id="` + locationsLoop[ i ].location_id + `">
							<h2 class="med-heading">` + locationsLoop[ i ].title + `</h2>
							` + locationsLoop[ i ].clinical + `
							<div class="loc-address">
								<p><a href="`+locationsLoop[ i ].googleUrl+`" target="_blank">` + locationsLoop[ i ].address + `</a></p>
							</div>
							<div class="phone d-flex align-items-center">
								<img src="` + locationVars.assets_url + `/assets/img/phone-icon.svg" alt="">
								<p>Phone: <a href="tel:` + locationsLoop[ i ].phone_numbers + `">` + locationsLoop[ i ].phone_numbers + `</a></p>
							</div>
							<div class="fax d-flex align-items-center">
								<img src="` + locationVars.assets_url + `/assets/img/fax-icon.svg" alt="">
								<p>Fax: <a href="tel:` + locationsLoop[ i ].fax + `">` + locationsLoop[ i ].fax + `</a></p>
							</div>
								<a href="` + locationsLoop[ i ].URL + `" class="button" target="` + locationsLoop[ i ].target + `">LEARN MORE</a>
							</div>`;

						infowindow.setContent( infoContent );
						infowindow.open( map, marker );
						for ( let j = 0; j < markers.length; j++ ) {
							markers[ j ].setIcon( locationVars.markerImage );
						}
						marker.setIcon( locationVars.markerActiveImage );
					};
				}( marker, i, locationsLoop ) ) );
			}else{
				google.maps.event.addListener( marker, 'click', ( function( marker, i, locationsLoop ) {
					return function() {
						for ( let j = 0; j < markers.length; j++ ) {
							markers[ j ].setIcon( locationVars.markerImage );
						}
						marker.setIcon( locationVars.markerActiveImage );
						var html='<span class="ppc-locations active" id="location-'+locationsLoop[ i ].location_id+'">'+jQuery('#location-'+locationsLoop[ i ].location_id ).html()+'</span>';
						// console.log(html);
						if (typeof jQuery('#location-'+locationsLoop[ i ].location_id ).html() !== 'undefined'){
							jQuery('#location-'+locationsLoop[ i ].location_id ).remove();
							jQuery('.ppc-locations').removeClass('active');
							jQuery('#location-'+locationsLoop[ i ].location_id ).addClass('active');
							jQuery('.ppc-location-box').prepend(html);
							map.setCenter({lat:parseFloat(locationsLoop[ i ].lat),lng:parseFloat(locationsLoop[ i ].long)});
							map.setZoom(15);
						}

					};
				}( marker, i, locationsLoop ) ) );
				jQuery(document).on('click','.ppc-locations',function(){
					if(jQuery(this).attr('id')=='location-'+locationsLoop[ i ].location_id ){
						map.setCenter({lat:parseFloat(locationsLoop[ i ].lat),lng:parseFloat(locationsLoop[ i ].long)});
						map.setZoom(15);
						for ( let j = 0; j < markers.length; j++ ) {
							var marker=markers[ j ];
							var lat = marker.getPosition().lat();
							var lng = marker.getPosition().lng();

							if(lat==parseFloat(locationsLoop[ i ].lat) && lng==parseFloat(locationsLoop[ i ].long)){
								marker.setIcon( locationVars.markerActiveImage );
							}else{
								marker.setIcon( locationVars.markerImage );
							}
						}
						jQuery('.ppc-locations').removeClass('active');
						jQuery(this).addClass('active');
						// var html='<span class="ppc-locations active" id="location-'+locationsLoop[ i ].location_id+'">'+jQuery(this).html()+'</span>';
						// if (typeof jQuery(this).html() !== 'undefined'){
						// 	jQuery('.ppc-location-box').prepend(html);
						// 	jQuery(this).remove();
						// 	// jQuery('.ppc-location-inner').scrollTop(0);
						// 	jQuery('.ppc-location-inner').animate({
						// 		scrollTop:0
						// 	}, 500);
						// }
					}
				});
			}

			// markers.push( marker );
			// locationIDs.push(locationsLoop[i].location_id);
			if(locationMapElem.classList.contains('ppc-map-non-interactive') && isSingularLocation == 'yes'){
				map.setZoom(zoom);
			}
			else{
				if(locationsLoop.length < 30 && isSingularLocation == 'no'){
// 					if (locationMapElem.parentElement.classList.contains('ppc-location-map')){
// 						map.setZoom(zoom);
// 					}else{
						map.fitBounds(bounds);
// 					}
				}
			}
			
			google.maps.event.addListener( map, 'click', function( event ) {
				infowindow.close();
			} );

		}
	}
	jQuery(document).on('mouseenter', '.ppc-location-box .location-list-data', function() {
	    // Extract location ID from the ID attribute of the list item
	    const locationID = jQuery(this).attr('id').replace('location-', '');

	    let index = -1;
	    for (let i = 0; i < locationIDs.length; i++) {
	        if (locationIDs[i] == locationID) {
	            index = i;
	            break;
	        }
	    }

	    // Change the marker icon for the hovered location
	    if (index !== -1 && markers[index]) {
	        markers[index].setIcon(locationVars.markerActiveImage);
	    }
	});

	jQuery(document).on('mouseleave', '.ppc-location-box .location-list-data', function () {
	    // Extract location ID from the ID attribute of the list item
	    const locationID = jQuery(this).attr('id').replace('location-', '');

	    // Find the index of the location ID in the locationIDs array using a loop
	    let index = -1;
	    for (let i = 0; i < locationIDs.length; i++) {
	        if (locationIDs[i] == locationID) {
	            index = i;
	            break;
	        }
	    }

	    // Reset the marker icon
	    if (index !== -1 && markers[index]) {
	        markers[index].setIcon(locationVars.markerImage);
	    }
	});
}
