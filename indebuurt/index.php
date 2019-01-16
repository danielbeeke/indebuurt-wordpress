<!doctype html>
<html <?php language_attributes(); ?>>

<?php
$sun_file = get_template_directory() . '/sun.json';
$cache = file_exists($sun_file) ? file_get_contents($sun_file) : FALSE;

if (!$cache || filemtime($sun_file) < strtotime('- 24 hours')) {
    $cache = file_get_contents('https://api.sunrise-sunset.org/json?lat=52.1834375&lng=5.1991249');
    file_put_contents($sun_file, $cache);
}

$sun_data = json_decode($cache, TRUE);

$day = time() > strtotime($sun_data['results']['sunrise']) && time() < strtotime($sun_data['results']['sunset']);
?>

<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <?php wp_head(); ?>
</head>

<body class="<?= $day ? 'day' : 'night' ?>">

    <div class="menu-toggle">
        <div class="bar"></div>
        <div class="bar"></div>
        <div class="bar"></div>
    </div>

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

    <div class="illustration-wrapper">
      <?php echo file_get_contents(get_template_directory() . '/illustration.svg'); ?>
    </div>

    <?php wp_footer(); ?>

</body>
</html>
