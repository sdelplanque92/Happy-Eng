<?php
if (!defined('ABSPATH')) exit;

$heading   = $attributes['heading'] ?? '';
$paragraph = $attributes['paragraph'] ?? '';
$items     = $attributes['items'] ?? [];
if (!is_array($items)) $items = [];

?>

<section class="about">
    <div class="container" data-aos="fade-up">
        <div class="section-header" style="text-align: left;">
            <?php if ($heading) : ?>
                <h2 class="he-tiles__title"><?php echo esc_html($heading); ?></h2>
            <?php endif; ?>

            <?php if ($paragraph) : ?>
                <p class="he-tiles__paragraph"><?php echo wp_kses_post($paragraph); ?></p>
            <?php endif; ?>
        </div>
        <div class="top-icon-box position-relative">
            <div class="container position-relative">
                <div class="row gy-4">
                    <?php foreach ($items as $item):
                        $url   = $item['url'] ?? '';
                        $icon  = $item['icon'] ?? '';
                        $title = $item['title'] ?? '';
                        $text  = $item['text'] ?? '';

                        if (!$url) $url = '';
                        ?>
                        <div class="col-xl-4 col-md-4">
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
</section>