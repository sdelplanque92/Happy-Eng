<?php
if (!defined('ABSPATH')) exit;

$title = $attributes['title'] ?? '';
$text  = $attributes['text'] ?? '';
$classes   = get_block_wrapper_attributes();

if (!$title && !$text) return;
?>
<section class="he-title-text" id="<?php print(sanitize_title($title)); ?>">
    <div class="container he-title-text__container">
        <div class="section-header" style="text-align: left; padding-bottom: 0;">
            <?php if ($title) : ?>
                <h2 <?php print($classes); ?>>
                    <?php echo esc_html($title); ?>
                </h2>
            <?php endif; ?>

            <?php if ($text) : ?>
                <p class="he-title-text__text">
                    <?php echo wp_kses_post($text); ?>
                </p>
            <?php endif; ?>
        </div>
    </div>
</section>
