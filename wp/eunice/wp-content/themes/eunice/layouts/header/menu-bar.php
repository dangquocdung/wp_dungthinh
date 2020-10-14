<!-- Navigation & Search -->
<nav class="navbar main-menu">
  <?php
    /**
    * Displays a navigation menu
    * @param array $args Arguments
    */
    wp_nav_menu(
      array(
        'menu'              => 'primary',
        'theme_location'    => 'primary',
        'container'         => 'ul',
        'container_class'   => '',
        'container_id'      => '',
        'menu_class'        => '',
        'menu_id'           => 'mainnavmenu',
        'depth'             => 2,
      )
    );
  ?>
</nav> <!-- ence-navigation -->
<?php
