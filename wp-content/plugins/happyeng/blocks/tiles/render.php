<?php
if (!defined('ABSPATH')) exit;

$heading   = $attributes['heading'] ?? '';
$paragraph = $attributes['paragraph'] ?? '';
$items     = $attributes['items'] ?? [];
if (!is_array($items)) $items = [];

?>

<div class="section">
    <div class="container aos-init aos-animate" data-aos="fade-up">
        <div class="section-header" style="text-align: left;">
            <?php if ($heading) : ?>
                <h2 class="he-tiles__title"><?php echo esc_html($heading); ?></h2>
            <?php endif; ?>

            <?php if ($paragraph) : ?>
                <p class="he-tiles__paragraph"><?php echo wp_kses_post($paragraph); ?></p>
            <?php endif; ?>
        </div>
    </div>
    <div class="top-icon-box position-relative">
        <div class="container position-relative">
            <div class="row gy-4">
                <?php foreach ($items as $item):
                    $url   = $item['url'] ?? '';
                    $icon  = $item['icon'] ?? '';
                    $title = $item['title'] ?? '';
                    $text  = $item['text'] ?? '';

                    if (!$url) continue;
                ?>
                <div class="col-xl-4 col-md-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="icon-box">
                        <div class="icon"><i class="<?php print($icon); ?>"></i></div>
                        <h4 class="title"><a href="<?php print($url); ?>" class="stretched-link"><?php print($title); ?></a></h4>
                        <p><?php print($text); ?></p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

<section class="he-tiles">
    <div class="he-tiles__container">

        <div class="he-tiles__grid">
            <?php foreach ($items as $item):
                $url   = $item['url'] ?? '';
                $icon  = $item['icon'] ?? '';
                $title = $item['title'] ?? '';
                $text  = $item['text'] ?? '';

                if (!$url) continue;

                $icon_slug = strtolower(preg_replace('/[^a-z0-9_-]/i', '', $icon));
                ?>
                <a class="he-tile" href="<?php echo esc_url($url); ?>">
          <span
                  class="he-tile__icon <?php echo $icon_slug ? 'he-icon--' . esc_attr($icon_slug) : ''; ?>"
                  aria-hidden="true"
          ></span>

                    <?php if ($title): ?>
                        <span class="he-tile__title"><?php echo esc_html($title); ?></span>
                    <?php endif; ?>

                    <?php if ($text): ?>
                        <span class="he-tile__text"><?php echo esc_html($text); ?></span>
                    <?php endif; ?>
                </a>
            <?php endforeach; ?>
        </div>

    </div>
</section>
