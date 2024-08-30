<!DOCTYPE html>
<html lang="<?php bloginfo("language"); ?>">
<?php
    get_template_part("parts/head");
?>
<body>
    <div class="theme-wrapper">
        <?php
            get_template_part("parts/header");
        ?>
        <main class="theme-main">

            <?php 
                if ( have_posts() ) {
                    while ( have_posts() ) {
                        the_post();
                        
                        the_title("<h1 class='event-heading'>", "</h1>");
                        the_content();
                    } // end while
                }
                else{
                            
                    echo "Page not found";
                }
            ?>

            
              <div class="custom-icons-widget-area">
                <?php if ( is_active_sidebar( 'custom-icons' ) ) : ?>
                    <?php dynamic_sidebar( 'custom-icons' ); ?>
                <?php endif; ?>
            </div>
        </main>
        <?php
            get_template_part("parts/footer");
        ?>
    </div>    
    <?php wp_footer(); ?>

</body>
</html>