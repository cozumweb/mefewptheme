<?php

/**

 * Text widget class

 *

 * @since 2.8.0

 */

class mefe_Widget_Text extends WP_Widget {



	function __construct() { 

		$widget_ops = array('classname' => 'widget_text_contact', 'description' => __('This widget will display your content with a "Say Hello" image on the top right.',THEMENAME));

		$control_ops = array('width' => 400, 'height' => 350);

		parent::__construct('text_contact', __('['.THEMENAME.'] Contact Widget',THEMENAME), $widget_ops, $control_ops);

	}



	function widget( $args, $instance ) {

		extract($args);

		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

		$text = apply_filters( 'widget_text', empty( $instance['text'] ) ? '' : $instance['text'], $instance );

		echo $before_widget;

		if ( !empty( $title ) ) { echo $before_title . $title . $after_title; } ?>

			<div class="textwidget contact-details"><?php echo !empty( $instance['filter'] ) ? wpautop( $text ) : $text; ?></div>

		<?php

		echo $after_widget;

	}



	function update( $new_instance, $old_instance ) {

		$instance = $old_instance;

		$instance['title'] = strip_tags($new_instance['title']);

		if ( current_user_can('unfiltered_html') )

			$instance['text'] =  $new_instance['text'];

		else

			$instance['text'] = stripslashes( wp_filter_post_kses( addslashes($new_instance['text']) ) ); // wp_filter_post_kses() expects slashed

		$instance['filter'] = isset($new_instance['filter']);

		return $instance;

	}



	function form( $instance ) {

		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'text' => '' ) );

		$title = strip_tags($instance['title']);

		$text = esc_textarea($instance['text']);

?>

		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:',THEMENAME); ?></label>

		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>



		<textarea class="widefat" rows="16" cols="20" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>"><?php echo $text; ?></textarea>



		<p><input id="<?php echo $this->get_field_id('filter'); ?>" name="<?php echo $this->get_field_name('filter'); ?>" type="checkbox" <?php checked(isset($instance['filter']) ? $instance['filter'] : 0); ?> />&nbsp;<label for="<?php echo $this->get_field_id('filter'); ?>"><?php _e('Automatically add paragraphs',THEMENAME); ?></label></p>

<?php

	}

}





add_action( 'widgets_init', create_function( '', 'register_widget( "mefe_Widget_Text" );' ) );



?>