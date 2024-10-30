<?php
/*
Plugin Name: ChatMe Login Widget
Plugin URI: http://chatme.im
Description: Displays the ChatMe User Status.
Author: camaran 
Version: 1.1.0
Author URI: http://chatme.im
*/
class chatme_login_Widget extends WP_Widget {

	//
	//	Constructor
	//
	function __construct() {

		//	'widget_chatme_login' is the CSS class name assigned to the widget
		//	'description' is the widget description that appears in the 'Available Widgets' list in the backend
		$widget_ops = array('classname' => 'widget_chatme_login', 'description' => __('Chatme Login Widget') );
		
		parent::__construct('logn-form-widget', __('ChatMe Login Form'), $widget_ops);
		
	}
	
	//
	//	widget() - outputs the content of the widget, in our case: a random picture. 
	//
	function widget($args,$instance) {
	
		extract($args);

		//	Get the title of the widget and the specified width of the image
		$title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
			
		//	Outputs the widget in its standard ul li format.
		echo $before_widget;
		if (!empty( $title )) { 
			echo $before_title . 'ChatMe.im Login' . $after_title; 
		};
		echo '<ul style="list-style:none;margin-left:0px;">';
		
		//	Let's display the image(s)

			//	Outputs the image
		echo '  <form method="get" action="https://webchat.chatme.im" target="_blank">';
			echo '  <li>Username <input type="email" name="u" placeholder="user@host" required="" /></li>';
			echo '  <li>Password <input type="password" name="q" required="" placeholder="Password" /><input type="hidden" name="h" value="1"></li>';
			echo '  <li><button type="submit" formtarget="_blank">Entra in chat</button></li>';
		echo '  </form>';
		
		echo '</ul>';
		echo $after_widget;
		//	Done
	}
	
	//
	//	update() - processes widget options to be saved.
	//
	function update($new_instance, $old_instance) {
		
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);

		return $instance;
		
	}
	
	//
	//	form() - outputs the options form on admin in Appearance => Widgets (backend). 
	//
	function form($instance) {

		//	Assigns values
		$instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
		$title = strip_tags($instance['title']);
		?>
			<p>Not more option for this widget</p>
		<?php
		
	}

}

//
//	Register the chatme_status_Widget widget class
//
add_action('widgets_init', create_function('', 'return register_widget("chatme_login_Widget");'));

?>