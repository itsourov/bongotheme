<?php

/**
 * Register our sidebars and widgetized areas.
 *
 */
function arphabet_widgets_init() {

    register_sidebar(array(
        'name' => ' right sidebar',
        'id' => 'right_1',
        'before_widget' => ' <div class="posts-card shadow-sm  p-3 mt-3">',
        'after_widget' => '</div>',
        'before_title' => '<h5 class="text-center">',
        'after_title' => '</h5>',
    ));

}

add_action('widgets_init', 'arphabet_widgets_init');

/**
 * Adds Foo_Widget widget.
 */
class BT_widget_about_box extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    public function __construct() {
        parent::__construct(
            'bt_widget_about_box', // Base ID
            'BongoTheme About box', // Name
            array('description' => __('BongoTheme About box', 'bongotheme')) // Args
        );
    }

    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget($args, $instance) {
        extract($args);
        $title = apply_filters('widget_title', $instance['title']);
        $about_desc = apply_filters('widget_about_desc', $instance['about_desc']);
        $widget_call = apply_filters('widget_call', $instance['widget_call']);

        echo $before_widget . '<div class="text-center">';
        if (!empty($title)) {
            echo $before_title . $title . $after_title;
        }
        ?>
            <img class='logo' src="<?php echo bongotheme_getLogo(); ?>" alt="">
        <?php
        if (!empty($about_desc)) {
            echo __('<p>' . $about_desc . '</p>', 'bongotheme');
        }

        if (!empty($widget_call)) {
            $buttonCss = '<a href="' . $widget_call . '"> <button type="button" class="btn btn-danger shadow-none" effect="ripple">
			<i class="fa fa-phone" aria-hidden="true"></i> Contact Us
		</button>
	</a>';
            echo __($buttonCss, 'bongotheme');
        }

        echo '</div>' . $after_widget;
    }

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     */
    public function form($instance) {
        if (isset($instance['title'])) {
            $title = $instance['title'];
        } else {
            $title = __('আমাদের সম্পর্কে', 'bongotheme');
        }

        if (isset($instance['about_desc'])) {
            $about_desc = $instance['about_desc'];
        } else {
            $about_desc = __('আমরা বাংলাদেশ ডাক বিভাগের বা নগদ এর সাথে সরাসরি সম্পর্কিত না, আমাদের ব্লগের মাধ্যমে শুধুমাত্র নগদের অফার, টিপস-এন্ড-ট্রিকস সম্পর্কে জানা যাবে।', 'bongotheme');
        }

        if (isset($instance['widget_call'])) {
            $widget_call = $instance['widget_call'];
        } else {
            $widget_call = __('/newlink', 'bongotheme');
        }
        ?>
<p>
    <label for="<?php echo $this->get_field_name('title'); ?>"><?php _e('Title:');?></label>
    <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>"
        name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
</p>
<p>
    <label for="<?php echo $this->get_field_name('about_desc'); ?>"><?php _e('about_desc:');?></label>
    <input class="widefat" id="<?php echo $this->get_field_id('about_desc'); ?>"
        name="<?php echo $this->get_field_name('about_desc'); ?>" type="text"
        value="<?php echo esc_attr($about_desc); ?>" />
</p>
<p>
    <label for="<?php echo $this->get_field_name('widget_call'); ?>"><?php _e('widget_call:');?></label>
    <input class="widefat" id="<?php echo $this->get_field_id('widget_call'); ?>"
        name="<?php echo $this->get_field_name('widget_call'); ?>" type="text"
        value="<?php echo esc_attr($widget_call); ?>" />
</p>
<?php
}

    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param array $new_instance Values just sent to be saved.
     * @param array $old_instance Previously saved values from database.
     *
     * @return array Updated safe values to be saved.
     */
    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
        $instance['about_desc'] = (!empty($new_instance['about_desc'])) ? strip_tags($new_instance['about_desc']) : '';
        $instance['widget_call'] = (!empty($new_instance['widget_call'])) ? strip_tags($new_instance['widget_call']) : '';

        return $instance;
    }

} // class Foo_Widget

// Register Foo_Widget widget
add_action('widgets_init', 'register_aboutbox_widget');

function register_aboutbox_widget() {
    register_widget('BT_widget_about_box');
}







/**
 * Adds Foo_Widget widget.
 */
class BT_widget_popular_posts extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    public function __construct() {
        parent::__construct(
            'bt_widget_popular_posts', // Base ID
            'BongoTheme Popular Posts', // Name
            array('description' => __('BongoTheme Popular Posts', 'bongotheme')) // Args
        );
    }

    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget($args, $instance) {
        extract($args);
        $title = apply_filters('widget_title', $instance['title']);
        $numOfPosts = apply_filters('widget_numOfPosts', $instance['numOfPosts']);
       

        echo $before_widget . '<div id="most-viewed-posts">';
        if (!empty($title)) {
            echo $before_title . $title . $after_title;
        }
        if (empty($numOfPosts)) {
            $numOfPosts = 4;
        }
        ?>
        <ul>
        
            <?php
        $popularpost = getPouparPosts($numOfPosts);
        
                while ($popularpost->have_posts()) {
                    $popularpost->the_post();
        
                    ?>
        
            <li effect="ripple"><a href="<?php the_permalink();?>"><?php the_title();?></a></li>
        
            <?php
        }
                ?>
        
        </ul>
        
        <?php
        echo '</div>' . $after_widget;
    }

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     */
    public function form($instance) {
        if (isset($instance['title'])) {
            $title = $instance['title'];
        } else {
            $title = __('জনপ্রিয় পোস্টসমূহ', 'bongotheme');
        }

    

        if (isset($instance['numOfPosts'])) {
            $numOfPosts = $instance['numOfPosts'];
        } else {
            $numOfPosts = __('3', 'bongotheme');
        }
        ?>
<p>
    <label for="<?php echo $this->get_field_name('title'); ?>"><?php _e('Title:');?></label>
    <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>"
        name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
</p>
<p>
    <label for="<?php echo $this->get_field_name('numOfPosts'); ?>"><?php _e('numOfPosts:');?></label>
    <input class="widefat" id="<?php echo $this->get_field_id('numOfPosts'); ?>"
        name="<?php echo $this->get_field_name('numOfPosts'); ?>" type="number"
        value="<?php echo esc_attr($numOfPosts); ?>" />
</p>

<?php
}

    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param array $new_instance Values just sent to be saved.
     * @param array $old_instance Previously saved values from database.
     *
     * @return array Updated safe values to be saved.
     */
    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
        $instance['numOfPosts'] = (!empty($new_instance['numOfPosts'])) ? strip_tags($new_instance['numOfPosts']) : '';
      
        return $instance;
    }

} // class Foo_Widget

// Register Foo_Widget widget
add_action('widgets_init', 'register_numOfPosts');

function register_numOfPosts() {
    register_widget('BT_widget_popular_posts');
}







?>