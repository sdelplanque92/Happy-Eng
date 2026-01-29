<?php
if (!defined('ABSPATH')) exit;

$title    = $attributes['title'] ?? '';
$text     = $attributes['text'] ?? '';
$items    = $attributes['items'] ?? [];

$mediaUrl = $attributes['mediaUrl'] ?? '';
$mediaAlt = $attributes['mediaAlt'] ?? '';

if (!is_array($items)) $items = [];
?>

<section class="skills">
        <div class="container" data-aos="fade-up">
            <div class="section-header">
                <?php if ($title) : ?>
                    <h2 class="he-tbi__title"><?php echo esc_html($title); ?></h2>
                <?php endif; ?>
                <?php if ($text) : ?>
                    <p class="he-tbi__text"><?php echo wp_kses_post($text); ?></p>
                <?php endif; ?>
            </div>
            <div class="row gy-4">
                <div class="col-lg-6">
                    <div class="content ps-0"  data-aos="fade-left">
                        <?php echo $content; ?>
                    </div>
                </div>
                <div class="col-lg-6 justify-items-center" style="text-align: center;">
                    <?php if ($mediaUrl): ?>
                        <img src="<?php echo esc_url($mediaUrl); ?>" class="img-fluid rounded-4 mb-4" alt="<?php echo esc_attr($mediaAlt); ?>">
                    <?php endif; ?>
                </div>
            </div>
        </div>
</section>
