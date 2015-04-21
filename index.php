<?php get_template_part('templates/page', 'header'); ?>

<?php if (!have_posts()) : ?>
  <div class="alert alert-warning">
    <?php _e('Sorry, no results were found.', 'roots'); ?>
  </div>
  <?php get_search_form(); ?>
<?php endif; ?>

<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/content', get_post_format()); ?>
<?php endwhile; ?>

<?php if ($wp_query->max_num_pages > 1) : ?>
  <nav class="post-nav">
    <ul class="pager">
      <li class="previous"><?php next_posts_link(__('&larr; Older posts', 'roots')); ?></li>
      <li class="next"><?php previous_posts_link(__('Newer posts &rarr;', 'roots')); ?></li>
    </ul>
  </nav>
<?php endif; ?>

<?php do_shortcode('[startr_slider id="home" post_type="page,post"]') ?>
<?php do_shortcode('[startr_social id="home" social="facebook"]') ?>
<?php do_shortcode('[startr_endereco id="1"]') ?>
<?php do_shortcode('[startr_tel id="tel" qtd="2"]') ?>
<?php do_shortcode('[startr_email id="email" qtd="2"]') ?>