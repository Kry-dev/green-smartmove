<?php
/**
 * The default template for displaying page content
 *
 *
 * @package gsmtheme
 * @since gsmtheme 1.0.0
 */

?>

<script>
	var placeSearch, autocomplete,
	componentForm = {
		/*street_number: 'short_name',
		route: 'long_name',
		locality: 'long_name',
		administrative_area_level_1: 'short_name',
		country: 'long_name',*/
		//your_zip: 'short_name'
	};
	
	function initAutocomplete() {
		// Create the autocomplete object, restricting the search to geographical
		// location types.
		var input = document.getElementById('autocomplete');
		var options = {
			types: ['geocode'],
			componentRestrictions: {country: ['fr','be']}
		};
		autocomplete = new google.maps.places.Autocomplete(input, options);
		// When the user selects an address from the dropdown, populate the address
		// fields in the form.
		autocomplete.addListener('place_changed', fillInAddress);
	}
	
	function fillInAddress() {
		// Get the place details from the autocomplete object.
		var place = autocomplete.getPlace();
		
		for (var component in componentForm) {
			document.getElementById(component).value = '';
			document.getElementById(component).disabled = false;
		}
		
		// Get each component of the address from the place details
		// and fill the corresponding field on the form.
		for (var i = 0; i < place.address_components.length; i++) {
			var addressType = place.address_components[i].types[0];
			if (componentForm[addressType]) {
				var val = place.address_components[i][componentForm[addressType]];
				document.getElementById(addressType).value = val;
			}
		}
	}
	
	// Bias the autocomplete object to the user's geographical location,
	// as supplied by the browser's 'navigator.geolocation' object.
	function geolocate() {
		if (navigator.geolocation) {
			navigator.geolocation.getCurrentPosition(function(position) {
				var geolocation = {
					lat: position.coords.latitude,
					lng: position.coords.longitude
				};
				var circle = new google.maps.Circle({
					center: geolocation,
					radius: position.coords.accuracy
				});
				autocomplete.setBounds(circle.getBounds());
			});
		}
	}
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB-qVaDwa3wJbBtBwap6-GXUd2AZiBhHuI&libraries&libraries=places&callback=initAutocomplete" async defer></script>
<article class="contact-container">
	<?php $post_object = get_field('field_for_shortcode_of_cf7');
	if( $post_object ):
		echo do_shortcode( '[contact-form-7 id="'. $post_object .'" title="'. get_the_title() .'" acceptance_as_validation: on]' ); ?>
		<?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
	<?php endif; ?>
</article>

<div class="main-container">
	<div class="main-grid">
		
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="entry-content">
				<?php the_content(); ?>
			</div>
		</article>
	
	</div>
</div>