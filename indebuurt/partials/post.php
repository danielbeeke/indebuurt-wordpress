<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <h1><?= get_the_title(); ?></h1>
    <div class="content">
      <?php $meta = get_post_meta($post->ID); ?>

      <?php if (isset($meta['custom_event_date'][0])): ?>
          <div class="event-date">
            <label>Datum: </label><span><?= $meta['custom_event_date'][0] ?></span>
          </div>
      <?php endif; ?>

      <?php if (isset($meta['custom_event_time'][0])): ?>
          <div class="event-time">
              <label>Tijd: </label><span><?= $meta['custom_event_time'][0] ?></span>
          </div>
      <?php endif; ?>

      <?php if (isset($meta['custom_event_location'][0])): ?>
          <div class="event-location">
              <label>Locatie: </label><span><?= $meta['custom_event_location'][0] ?></span>
          </div>

          <br>
      <?php endif; ?>


      <?php the_content('<i>(Lees verder)</i>'); ?>
    </div>
</article>
