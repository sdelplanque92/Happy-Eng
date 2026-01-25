<?php
if (!defined('ABSPATH')) exit;

$title = $attributes['title'] ?? '';
$items = $attributes['items'] ?? [];

?>
<section class="he-bullets about">
    <div class="he-bullets__container content container">

        <?php if (!empty($title)) : ?>
            <h2 class="he-bullets__title"><?php echo esc_html($title); ?></h2>
        <?php endif; ?>

        <?php if (!empty($items) && is_array($items)) : ?>
            <ul class="he-bullets__list">
                <?php foreach ($items as $item) :
                    $text = $item['text'] ?? '';
                    // Si jamais ça arrive encodé (&lt;br&gt;), tu peux décommenter :
                    // $text = html_entity_decode($text, ENT_QUOTES, get_bloginfo('charset'));
                    ?>
                    <?php if (trim($text) !== '') : ?>
                    <li class="he-bullets__item"><i class="bi bi-arrow-right-circle-fill" style="margin-right: 10px;"></i><?php echo wp_kses_post($text); ?></li>
                <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>

    </div>
</section>
