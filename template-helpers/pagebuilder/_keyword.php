<?php
/*--------------------------------------------------------------------------------------------------
	KEYWORDS ELEMENT
--------------------------------------------------------------------------------------------------*/
 
	function _keyword( $options )
	{
	
		
		$element_size = mefe_get_size( $options['_sizer'] );

		if ( !empty ( $options['kw_content'] ) ) {
			echo '<div class="'.$element_size['sizer'].'">';
			echo '<div class="keywordbox">'.$options['kw_content'].'</div>';
			echo '</div>';
		}

	}
?>