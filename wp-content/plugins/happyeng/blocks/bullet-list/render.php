<?php
if (!defined('ABSPATH')) exit;

$title = $attributes['title'] ?? '';
$items = $attributes['items'] ?? [];
$classes   = get_block_wrapper_attributes();

?>
<section class="he-bullets about" id="<?php print(sanitize_title($title)); ?>">
    <div class="he-bullets__container content container">
        <div class="section-header" style="padding-bottom: 0; text-align: left;">
            <?php if (!empty($title)) : ?>
                <h2 <?php print($classes); ?>><?php echo esc_html($title); ?></h2>
            <?php endif; ?>
        </div>

        <?php if (!empty($items) && is_array($items)) : ?>
            <ul class="he-bullets__list">
                <?php foreach ($items as $item) :
                    $text = $item['text'] ?? '';
                    ?>
                    <?php if (trim($text) !== '') : ?>
                    <li class="he-bullets__item"><i class="bi bi-arrow-right-circle-fill" style="margin-right: 10px;"></i><?php echo wp_kses_post($text); ?></li>
                <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>

    </div>
</section>
