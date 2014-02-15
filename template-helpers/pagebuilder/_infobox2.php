<?php
/*--------------------------------------------------------------------------------------------------
	Stats Box
--------------------------------------------------------------------------------------------------*/
 
	function _infobox2 ( $options )
	{
	
		
		$element_size = mefe_get_size( $options['_sizer'] );
		
		echo '<div class="'.$element_size['sizer'].'">';
		
			echo '<div class="info-text">';
				echo $options['ib2_title'];
			echo '</div>';
			
		echo '</div>';

	}
?>