<header class="theme-header">
            <?php
            
            the_custom_logo();

            wp_nav_menu([
                "menu"              => "Main Menu",
                "container"         => "nav",
                "container_class"   => "theme-main-menu"
            ]);

            ?>
</header>