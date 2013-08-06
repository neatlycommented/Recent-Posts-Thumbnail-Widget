<?php
/*
Plugin Name: Recent Posts with Thumbnails Widget
Plugin URI: https://github.com/zoerooney/Recent-Posts-Thumbnail-Widget
Description: Creates a widget that displays recent posts in a nice, easy to style layout.
Version: 0.5
Author: Zoe Rooney
Author URI: http://zoerooney.com
License: GPL2

Copyright 2013 Zoe Rooney (hello@zoerooney.com)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as 
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

/* Adds our widget
=============================================*/

class neatly_recent_posts_thumbnail extends WP_Widget {

    public function neatly_recent_posts_thumbnail() {
        $widget_ops = array(
            'classname'=>'neatly-recent', // class that will be added to li element in widgeted area ul
            'description'=> __('Display recent posts with thumbnails') // description displayed in admin
            );
        $control_ops = array( 'id_base' => 'neatly-recent-posts' );
        $this->WP_Widget('neatly_recent_posts_thumbnail', __('Recent Posts with Thumbnails'), $widget_ops, $control_ops); // Name in  the control panel
    }
	
	/* Our arguments
	=============================================*/
		
    public function widget($args, $instance) {
            extract($args);
			
			$title = $instance['title']; 
			$number = $instance['number'];
			$thumbsize = $instance['thumbsize'];
			$show_title = isset($instance['show_title']) ? $instance['show_title'] : true;
			$show_date = isset($instance['show_date']) ? $instance['show_date'] : true;
		
			/* Outputting our widget on the front end
			=============================================*/
			echo '<style>
					.neatly-recent ul, .neatly-recent li { list-style:none; margin:0; }
					.neatly-recent li { margin-bottom: 1em; }
				  </style>';
				  
            echo $before_widget . $before_title . $title . $after_title; // widget title
  			
  			$args = array (
  				'posts_per_page' => $number,
  			);
  			$neatly_posts = new WP_Query($args);
  			if( $neatly_posts->have_posts() ) {
  				echo '<ul>';
  				while( $neatly_posts->have_posts() ) : $neatly_posts->the_post(); ?>
  					<li><a href="<?php the_permalink(); ?>">
  						<?php if ( has_post_thumbnail() ) : the_post_thumbnail($thumbsize); endif; ?>
  						<?php if ( $show_title == true ) : ?><h4><?php the_title(); ?></h4><?php endif; ?>
  						<?php if ( $show_date == true ) : ?><span><?php the_date(); ?></span><?php endif; ?>
  						</a>
  					</li>
  				<?php endwhile;
  			}
  			
  			// Restore original Post Data
  			wp_reset_postdata();
            
            echo $after_widget; // ends the widget
        }
        	         
	
	/* The widget configuration form
	=============================================*/
	
    public function form( $instance ) {
       $instance = wp_parse_args( (array) $instance, array( 'title' => '' ) ); 
        $title = strip_tags($instance['title']);
        $number = strip_tags($instance['number']);
        $thumbsize = strip_tags($instance['thumbsize']);
		?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
		<p><em>Use the following options to customize the display.</em></p>
		
		<p style="border-bottom:4px double #eee;padding: 0 0 10px;">
			<label for="<?php echo $this->get_field_id( 'number' ); ?>">Number of Posts Displayed</label>
			<input id="<?php echo $this->get_field_id( 'number'); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" value="<?php echo esc_attr($number); ?>" type="number" style="width:100%;" /><br>
			<label for="<?php echo $this->get_field_id( 'thumbsize' ); ?>">Thumbnail Size</label>
			<input id="<?php echo $this->get_field_id( 'thumbsize'); ?>" name="<?php echo $this->get_field_name( 'thumbsize' ); ?>" value="<?php echo esc_attr($thumbsize); ?>"  style="width:100%;" /><br><br>
			<label for="<?php echo $this->get_field_id( 'show_title' ); ?>">Show the post titles?
			<input id="<?php echo $this->get_field_id( 'show_title'); ?>" name="<?php echo $this->get_field_name( 'show_title' ); ?>" <?php checked($instance['show_title'], true) ?>  type="checkbox" /></label><br><br>
			<label for="<?php echo $this->get_field_id( 'show_date' ); ?>">Show the post dates?
			<input id="<?php echo $this->get_field_id( 'show_date'); ?>" name="<?php echo $this->get_field_name( 'show_date' ); ?>" <?php checked($instance['show_date'], true) ?>  type="checkbox" /></label>
		</p>	    
	 
		<?php
		}
	
	/* Saving updated information
	=============================================*/
	
	public function update( $new_instance, $old_instance ) {
	    $instance = $old_instance;
	    
	    $instance['title'] = strip_tags($new_instance['title']);
	    $instance['number'] = strip_tags($new_instance['number']);
	    $instance['thumbsize'] = strip_tags($new_instance['thumbsize']);
	    $instance['show_title'] = $new_instance['show_title'] ? 1 : 0;
	    $instance['show_date'] = $new_instance['show_date'] ? 1 : 0; 
	      
	    return $instance;
	}
	
}

// register widget
function register_neatly_recent_posts_thumbnail() {
    register_widget( 'Recent Posts with Thumbnails' );
}
add_action( 'widgets_init', 'register_neatly_recent_posts_thumbnail' );


/* Create a shortcode version
=============================================*/
// [neatly_recent]
// See documentation: https://github.com/zoerooney/Recent-Posts-Thumbnail-Widget
function neatly_recent_shortcode( $atts ) {
	extract( shortcode_atts( array(
		'title_text' => 'Recent Posts',
		'number_posts' => '3',
		'hide_title' => 'false',
		'hide_date' => 'false',
		'thumb_size' => 'thumbnail'
	), $atts ) );
	
	ob_start();
	
	$neatly_loop = new WP_Query( array(
		'posts_per_page' => $number_posts
	));
	echo '<div class="neatly-recent neatly-recent-shortcode"><h3>' . $title_text . '</h3>';
	 if ( $neatly_loop->have_posts() ) : ?>
		<ul>
		<?php while ( $neatly_loop->have_posts() ) : $neatly_loop->the_post(); ?>
			<li><a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail($thumb_size); ?>
				<?php if ( $hide_title == 'false' ) { ?><h4><?php the_title(); ?></h4><?php } else {} ?>
				<?php if ( $hide_date == 'false' ) { ?><span><?php echo get_the_date(); ?></span><?php } else {}  ?>
			</a></li>
		<?php endwhile; ?>
		</ul>
	<?php else : ?>
	 	No posts found.
	<?php endif; 
	echo '</div>';
	wp_reset_postdata();
	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}	
add_shortcode( 'neatly_recent', 'neatly_recent_shortcode' );

?>