<?php
if (!defined('ABSPATH')) exit;

$q = new WP_Query([
  'post_type'           => 'post',
  'post_status'         => 'publish',
  'posts_per_page'      => 3,
  'ignore_sticky_posts' => true,
  'no_found_rows'       => true,
]);

if (!$q->have_posts()) {
  return;
}
?>

<section class="recent-posts">
    <div class="container" data-aos="fade-up">
        <div class="section-header">
            <h2>Derniers articles</h2>
            <p>Mon actualité, mes points de vues, mes projets</p>
        </div>
        <div class="row gy-4">
            <?php while ($q->have_posts()) : $q->the_post(); ?>
                <div class="col-lg-4">
                    <article>
                        <div class="post-img"><?php the_post_thumbnail('medium_large', ['class' => 'img-fluid']); ?></div>
                        <p class="post-category">Domain &amp; Hosting</p>
                        <h2 class="title">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h2>
                        <div class="d-flex align-items-center">
                            <div class="post-meta">
                                <p class="post-author">William Bla</p>
                                <p class="post-date">
                                    <time datetime="2022-01-01"><?php echo esc_html(get_the_date()); ?></time>
                                </p>
                            </div>
                        </div>
                    </article>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
</section>
<?php
wp_reset_postdata();
?>