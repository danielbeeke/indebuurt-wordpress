<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <h1><?= get_the_title(); ?></h1>
    <?php the_content(); ?>
</article>
