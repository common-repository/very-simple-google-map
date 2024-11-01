<?php
/**
 * @package Very simple Google map
 * @version 1.0
 */
/*
Plugin Name: Very simple Google map
Plugin URI: http://wordpress.org/plugins/very-simple-google-map
Description: This is s very simple plugin for Google map. This plugin will show your location image.You can use this plugin very easily.
Author: Masum Billah
Version: 1.0
Author URI: http://getmasum.com
*/

// WIDGET: Google Maps

	class gmaps extends WP_Widget {
		function gmaps() {
			$widget_ops = array('classname' => 'widget_gmaps', 'description' => 'Embed any location from the Google Maps service');
			$this->WP_Widget('gmaps', 'Very simple Google Map', $widget_ops);
		}
	function widget($args, $instance) {
		global $post;
		$post_old = $post; 
		extract( $args );
		if( !$instance["title"] ) {
			$category_info = get_category($instance["cat"]);
			$instance["title"] = $category_info->name;
		}
		echo $before_widget;
		echo $before_title;
		if( $instance["title"] ) 
			echo '' . $instance["title"] . '';
		else
			echo '' . $instance["title"] . '';
		echo $after_title;
?>
<img src="http://maps.googleapis.com/maps/api/staticmap?sensor=false&size=<?php echo $instance["width"]; ?>x<?php echo $instance["height"]; ?>&zoom=12&amp;center=<?php echo $instance["latitude"]; ?>&format=png&style=feature:road.highway%7Celement:geometry%7Cvisibility:simplified%7Ccolor:0xc280e9&style=feature:transit.line%7Cvisibility:simplified%7Ccolor:0xbababa&style=feature:road.highway%7Celement:labels.text.stroke%7Cvisibility:on%7Ccolor:0xb06eba&style=feature:road.highway%7Celement:labels.text.fill%7Cvisibility:on%7Ccolor:0xffffff" alt="" />
<?php
	echo $after_widget;
	$post = $post_old; 
	}
	function update($new_instance, $old_instance) {
		return $new_instance;
	}
	function form($instance) {
?>
	<p>
		<label for="<?php echo $this->get_field_id("title"); ?>">
			<?php echo( 'Title:' ); ?>
			<input class="widefat" id="<?php echo $this->get_field_id("title"); ?>" name="<?php echo $this->get_field_name("title"); ?>" type="text" value="<?php echo esc_attr($instance["title"]); ?>" />
		</label>
	</p>
	<p><?php echo( 'Give this widget a title, or leave blank to display the category name.' ); ?></p>
	<hr />
<p><?php echo( 'Enter the location you wish to display.' ); ?></p>	
<p>
	<label for="<?php echo $this->get_field_id("latitude"); ?>">
		<b><?php echo( 'Location: &nbsp;' ); ?></b>
		<input class="widefat" id="<?php echo $this->get_field_id("latitude"); ?>" name="<?php echo $this->get_field_name("latitude"); ?>" type="text" value="<?php echo esc_attr($instance["latitude"]); ?>" />
	</label>
</p>
<p><?php echo( 'Please enter your map\'s Width without "px" ' ); ?></p>
<p>
	<label for="<?php echo $this->get_field_id("width"); ?>">
		<b><?php echo( 'Width: &nbsp;' ); ?></b>
		<input class="widefat" id="<?php echo $this->get_field_id("width"); ?>" name="<?php echo $this->get_field_name("width"); ?>" type="text" value="<?php echo esc_attr($instance["width"]); ?>" />
	</label>
</p>
<p><?php echo( 'Please enter your map\'s Height without "px" ' ); ?></p>
<p>
	<label for="<?php echo $this->get_field_id("height"); ?>">
		<b><?php echo( 'height: &nbsp;' ); ?></b>
		<input class="widefat" id="<?php echo $this->get_field_id("height"); ?>" name="<?php echo $this->get_field_name("height"); ?>" type="text" value="<?php echo esc_attr($instance["height"]); ?>" />
	</label>
</p>


<hr />
<p>This plugin Develop by <a href="http://getmasum.com" target="_blank">Masum Billah</a></p>
<?php
	}
	}
	add_action( 'widgets_init', create_function('', 'return register_widget("gmaps");') );