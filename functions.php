<?php

add_theme_support('custom-logo');

add_theme_support('post-thumbnails');

function my_theme_enqueue_styles() {
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200', false);
    wp_enqueue_style('main-style', get_stylesheet_uri());
}
add_action('wp_enqueue_scripts', 'my_theme_enqueue_styles');

function my_widgets() {
    register_sidebar([
        'name' => 'Custom Icons',
        'id' => 'custom-icons',
        'before_widget' => '<div class="widget custom-icon-widget">',
        'after_widget' => '</div>',
        'show_in_rest' => true
    ]);
}
add_action('widgets_init', 'my_widgets');

class Custom_Icon_Widget extends WP_Widget {
    public function __construct() {
        parent::__construct(
            'custom_icon_widget',
            __('Custom Icon Widget', 'my_theme'),
            array('description' => __('A widget to display custom icons with text', 'my_theme'))
        );
    }

    public function widget($args, $instance) {
        echo $args['before_widget'];
        if (!empty($instance['title'])) {
            echo $args['before_title'] . apply_filters('widget_title', $instance['title']) . $args['after_title'];
        }
        
        echo '<div class="custom-icons">';
        for ($i = 1; $i <= 4; $i++) {
            if (!empty($instance["icon{$i}_content"]) && !empty($instance["additional_text{$i}"])) {
                echo '<div class="custom-icon-item">';
                echo '<span class="custom-icon' . $i . '"></span>';
                echo '<h5 class="icon-text">' . esc_html($instance["icon{$i}_content"]) . '</h5>';
                echo '<p class="additional-text">' . esc_html($instance["additional_text{$i}"]) . '</p>';
                if (!empty($instance["button{$i}_url"])) {
                    echo '<a class="custom-icon-button" href="' . esc_url($instance["button{$i}_url"]) . '">Klik Her</a>';
                }
                echo '</div>';
            }
        }
        echo '</div>';
        
        echo $args['after_widget'];
    }

    public function form($instance) {
        $title = !empty($instance['title']) ? $instance['title'] : '';
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e('Title:', 'my_theme'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>">
        </p>
        <?php for ($i = 1; $i <= 4; $i++) : ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id("icon{$i}_content")); ?>"><?php _e("Icon {$i} Text:", 'my_theme'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id("icon{$i}_content")); ?>" name="<?php echo esc_attr($this->get_field_name("icon{$i}_content")); ?>" type="text" value="<?php echo esc_attr($instance["icon{$i}_content"] ?? ''); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id("additional_text{$i}")); ?>"><?php _e("Icon {$i} Additional Text:", 'my_theme'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id("additional_text{$i}")); ?>" name="<?php echo esc_attr($this->get_field_name("additional_text{$i}")); ?>" type="text" value="<?php echo esc_attr($instance["additional_text{$i}"] ?? ''); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id("button{$i}_url")); ?>"><?php _e("Button {$i} URL:", 'my_theme'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id("button{$i}_url")); ?>" name="<?php echo esc_attr($this->get_field_name("button{$i}_url")); ?>" type="text" value="<?php echo esc_attr($instance["button{$i}_url"] ?? ''); ?>">
        </p>
        <?php endfor;
    }

    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
        for ($i = 1; $i <= 4; $i++) {
            $instance["icon{$i}_content"] = (!empty($new_instance["icon{$i}_content"])) ? strip_tags($new_instance["icon{$i}_content"]) : '';
            $instance["additional_text{$i}"] = (!empty($new_instance["additional_text{$i}"])) ? strip_tags($new_instance["additional_text{$i}"]) : '';
            $instance["button{$i}_url"] = (!empty($new_instance["button{$i}_url"])) ? strip_tags($new_instance["button{$i}_url"]) : '';
        }
        return $instance;
    }
}



function register_custom_icon_widget() {
    register_widget('Custom_Icon_Widget');
}
add_action('widgets_init', 'register_custom_icon_widget');


require get_template_directory() . '/events-functions.php';

require get_template_directory() . '/shortcodes.php';

?>
