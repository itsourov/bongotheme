<?php

/**
 * Register our sidebars and widgetized areas.
 *
 */
function arphabet_widgets_init()
{

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
class BT_widget_about_box extends WP_Widget
{

    /**
     * Register widget with WordPress.
     */
    public function __construct()
    {
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
    public function widget($args, $instance)
    {
        extract($args);
        $title = apply_filters('widget_title', $instance['title']);
        $about_desc = apply_filters('widget_about_desc', $instance['about_desc']);
        $widget_call = apply_filters('widget_call', $instance['widget_call']);

        echo $before_widget . '<div class="text-center">';
        if (!empty($title)) {
            echo $before_title . $title . $after_title;
        }
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
    public function form($instance)
    {
        if (isset($instance['title'])) {
            $title = $instance['title'];
        } else {
            $title = __('New title', 'bongotheme');
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
    public function update($new_instance, $old_instance)
    {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
        $instance['about_desc'] = (!empty($new_instance['about_desc'])) ? strip_tags($new_instance['about_desc']) : '';
        $instance['widget_call'] = (!empty($new_instance['widget_call'])) ? strip_tags($new_instance['widget_call']) : '';

        return $instance;
    }

} // class Foo_Widget

// Register Foo_Widget widget
add_action('widgets_init', 'register_aboutbox_widget');

function register_aboutbox_widget()
{
    register_widget('BT_widget_about_box');
}








// Creating the widget
class wpb_widget extends WP_Widget
{

    public function __construct()
    {
        parent::__construct(

            // Base ID of your widget
            'wpb_widget',

            // Widget name will appear in UI
            __('WPBeginner Widget', 'wpb_widget_domain'),

            // Widget description
            array('description' => __('Sample widget based on WPBeginner Tutorial', 'wpb_widget_domain'))
        );
    }

    // Creating widget front-end

    public function widget($args, $instance)
    {
        $title = apply_filters('widget_title', $instance['title']);

        // before and after widget arguments are defined by themes
        echo $args['before_widget']. '<div id="most-viewed-posts">';
        if (!empty($title)) {
            echo $args['before_title'] . $title . $args['after_title'];
        }

        // This is where you run the code and display the output

        ?>
<ul>

    <?php
$popularpost = new WP_Query(array('posts_per_page' => 4, 'meta_key' => 'wpb_post_views_count', 'orderby' => 'meta_value_num', 'order' => 'DESC'));

        while ($popularpost->have_posts()) {
            $popularpost->the_post();

            ?>

    <li effect="ripple"><a href="<?php the_permalink();?>"><?php the_title();?></a></li>

    <?php
}
        ?>

</ul>

<?php
//    echo __( 'Hello, World!', 'wpb_widget_domain' );
        echo $args['after_widget'].'</div>';
    }

    // Widget Backend
    public function form($instance)
    {
        if (isset($instance['title'])) {
            $title = $instance['title'];
        } else {
            $title = __('New title', 'wpb_widget_domain');
        }
        // Widget admin form
         ?>
<p>
    <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:');?></label>
    <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>"
        name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
</p>
<?php
}

    // Updating widget replacing old instances with new
    public function update($new_instance, $old_instance)
    {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
        return $instance;
    }

    // Class wpb_widget ends here
}

// Register and load the widget
function wpb_load_widget()
{
    register_widget('wpb_widget');
}
add_action('widgets_init', 'wpb_load_widget');

?>