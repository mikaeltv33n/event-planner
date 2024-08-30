<?php
function event_overview_shortcode() {
    ob_start(); 

    $args = array(
        'post_type' => 'event', 
        'posts_per_page' => -1, 
    );

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        echo '<div class="event-archive">';
        echo '<div class="event-list">';

        while ($query->have_posts()) {
            $query->the_post();

            $background_image = get_field('background_image'); 

            if (!$background_image) {
                $background_image = get_template_directory_uri() . '/path/to/default-image.jpg'; 
            }

            $button_title = get_field('title_over_button'); 

            echo '<div class="event-item" style="background-image: url(' . esc_url($background_image) . ');">';
            echo '<div class="event-content">';
            echo '<h2 class="event-title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h2>';
            echo '<div class="event-excerpt">' . get_the_excerpt() . '</div>';
            if ($button_title) {
                echo '<div class="event-button-title">' . esc_html($button_title) . '</div>';
            }
            echo '<a class="event-read-more" href="' . get_permalink() . '">Læs mere</a>';
            echo '</div>'; // .event-content
            echo '</div>'; // .event-item
        }

        echo '</div>'; // .event-list
        echo '</div>'; // .event-archive

        wp_reset_postdata(); 
    } else {
        echo '<p>Ingen events fundet</p>';
    }

    return ob_get_clean(); 
}
add_shortcode('event_overview', 'event_overview_shortcode');
?>
