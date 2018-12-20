<!doctype html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

    <?php
    wp_nav_menu([
        'menu_class' => 'main-menu',
        'container' => FALSE,
        'items_wrap' => '<ul id="%1$s" class="%2$s" tabindex="0">%3$s</ul>',
      ]);
    ?>

    <main id="main" class="site-main">
    <?php
    if (have_posts()) {
        while (have_posts()) {
            the_post();
            get_template_part( 'partials/post' );
        }
    }
    ?>
    </main>

    <?php echo file_get_contents(get_template_directory() . '/illustration.svg'); ?>

    <?php wp_footer(); ?>

</body>
</html>
