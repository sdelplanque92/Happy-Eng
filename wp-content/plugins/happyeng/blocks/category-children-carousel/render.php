<?php
if (!defined('ABSPATH')) exit;

$title       = $attributes['title'] ?? '';
$parentTermId= (int)($attributes['parentTermId'] ?? 0);
$hideEmpty   = !empty($attributes['hideEmpty']);
$classes   = get_block_wrapper_attributes();

if ($parentTermId <= 0) {
    // Rien à afficher si pas de parent choisi
    return;
}

$children = get_terms([
    'taxonomy'   => 'category',
    'parent'     => $parentTermId,
    'hide_empty' => $hideEmpty,
    'orderby'    => 'name',
    'order'      => 'ASC',
]);

if (is_wp_error($children) || empty($children)) {
    return;
}

// Un id unique par instance (utile pour le JS)
$uid = 'he-catcar-' . wp_unique_id();
?>

<section id="team" class="team sections-bg">
    <div class="container" data-aos="fade-up">
        <div class="section-header">
            <?php if (!empty($title)) : ?>
                <h2 <?php print($classes); ?>><?php echo esc_html($title); ?></h2>
            <?php endif; ?>
        </div>
        <div class="row gy-4">
            <?php foreach ($children as $term) :
            $link = get_term_link($term);
            if (is_wp_error($link)) continue;
            ?>
                <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="300">
                    <div class="member">
                        <?php
                        $image = get_template_directory().'/assets/images/clients/'.$term->term_id.'.png';
                        if (!file_exists($image)) {
                            $image = get_template_directory_uri().'/assets/images/clients/0.png';
                        }
                        else {
                            $image = get_template_directory_uri().'/assets/images/clients/'.$term->term_id.'.png';
                        }
                        ?>
                        <img src="<?php print($image); ?>" class="img-fluid" alt="">
                        <h4><?php echo esc_html($term->name); ?></h4>
                        <span><?php echo esc_html(wp_strip_all_tags($term->description)); ?></span>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>