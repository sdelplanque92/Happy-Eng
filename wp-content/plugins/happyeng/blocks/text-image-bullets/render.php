<?php
if (!defined('ABSPATH')) exit;

$title    = $attributes['title'] ?? '';
$text     = $attributes['text'] ?? '';
$mediaUrl = $attributes['mediaUrl'] ?? '';
$mediaAlt = $attributes['mediaAlt'] ?? '';

// $content = rendu des InnerBlocks (la bullet list)
$content = $content ?? '';

?>
<section class="he-tib" id="<?php print(sanitize_title($title)); ?>">
    <div class="he-tib__container">

        <?php if ($title) : ?>
            <h2 class="he-tib__title"><?php echo esc_html($title); ?></h2>
        <?php endif; ?>

        <?php if ($text) : ?>
            <p class="he-tib__text"><?php echo wp_kses_post($text); ?></p>
        <?php endif; ?>

        <div class="he-tib__row">
            <div class="he-tib__left">
                <?php if ($mediaUrl) : ?>
                    <img
                        class="he-tib__img"
                        src="<?php echo esc_url($mediaUrl); ?>"
                        alt="<?php echo esc_attr($mediaAlt); ?>"
                        loading="lazy"
                    />
                <?php else : ?>
                    <div class="he-tib__placeholder">Choisis une image</div>
                <?php endif; ?>
            </div>

            <div class="he-tib__right">
                <?php echo $content; ?>
            </div>
        </div>

    </div>
</section>
