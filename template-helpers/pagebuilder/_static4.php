<?php
/*--------------------------------------------------------------------------------------------------
	STATIC CONTENT - Maps
--------------------------------------------------------------------------------------------------*/
 
	function _static4($options)
	{

		if ( isset ( $options['ww_header_style'] ) && !empty ( $options['ww_header_style'] ) ) { 
			$style = 'uh_'.$options['ww_header_style'];
		} else { 
			$style = '';
		}

	?>
        <div id="slideshow" class="<?php echo $style; ?>">
	        
			<div class="bgback"></div>
			<div data-images="<?php echo IMAGES_URL; ?>/" id="sparkles"></div>

            <div class="static-content maps-style">
				<div id="google_map" style="width:100%; height:<?php echo $options['sc_map_height'];?>px;"></div><!-- map container -->
				<ul id="map_controls">
					<li><a id="zoom_in"><span class="icon-plus icon-white"></span></a></li>
					<li><a id="zoom_out"><span class="icon-minus icon-white"></span></a></li>
					<li><a id="reset"><span class="icon-refresh icon-white"></span></a></li>
	            </ul>
				<?php
						// BUTTON
						if ( $options['ww_slide_m_button'] || $options['ww_slide_l_text'] ) {
							echo '<div class="info_pop" data-arrow="top">';
								
								if ( $options['ww_slide_l_text'] && isset ( $options['ww_slide_link']['url'] ) && !empty ( $options['ww_slide_link']['url'] ) ) {
									echo '<a class="buyit" href="'.$options['ww_slide_link']['url'].'" target="'.$options['ww_slide_link']['target'].'">'.$options['ww_slide_l_text'].'</a>';
								}
							
								// BUTTON LEFT TEXT
								if ( isset ( $options['ww_slide_m_button'] ) && !empty ( $options['ww_slide_m_button'] ) ) {
									echo '<h5 class="text">'.$options['ww_slide_m_button'].'</h5>';
								}
								
								echo '<div class="clear"></div>';
							echo '</div>';
						}
				?>
 
			</div>
           
			
    <script type="text/javascript">
	(function($){
		$(document).ready(function() {
		<?php if ( !empty ( $options['sc_map_icon'] ) ) { ?>
			var myMarkers = {
				"markers": [
					{
						"latitude": "<?php echo $options['sc_map_latitude'];?>",		// latitude
						"longitude":"<?php echo $options['sc_map_longitude'];?>",		// longitude
						"icon": "<?php echo $options['sc_map_icon'];?>"	// Pin icon
					}
				]
			};
		<?php } ?>

			
			
			$("#google_map").mapmarker({
				zoom : <?php echo $options['sc_map_zoom'];?>,							// Zoom
				center: "<?php echo $options['sc_map_latitude'];?>,<?php echo $options['sc_map_longitude'];?>",		// Center of map
				type: "<?php echo $options['sc_map_type'];?>",					// Map Type
				controls: "HORIZONTAL_BAR",			// Controls style
				dragging:<?php if ( !empty($options['sc_map_dragg']) ) { echo $options['sc_map_dragg']; } else { echo '0';}?>,							// Allow dragging?
				mousewheel:<?php if ( !empty($options['sc_map_zooming_mousewheel']) ) { echo $options['sc_map_zooming_mousewheel']; } else { echo '0';}?>,	// Allow zooming with mousewheel
				<?php if ( !empty ( $options['sc_map_icon'] ) ) { echo 'markers: myMarkers,';} ?>		
				styling: 0,							// Bool - do you want to style the map?
				featureType:"all",
				visibility: "on",
				elementType:"geometry",
				hue:"#00AAFF",
				saturation:-100,
				lightness:0,
				gamma:1,
				navigation_control:0
				/*
				To play with the map colors and styles you can try this tool right here http://gmaps-samples-v3.googlecode.com/svn/trunk/styledmaps/wizard/index.html
				*/
			});
		});
	})(jQuery);
	</script>
			<div class="mefe_header_bottom_style"></div><!-- header bottom style -->
        </div><!-- end slideshow -->
	<?php
	}
?>