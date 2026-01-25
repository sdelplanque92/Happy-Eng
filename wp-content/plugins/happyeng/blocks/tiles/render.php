<?php
if (!defined('ABSPATH')) exit;

$items = $attributes['items'] ?? [];
if (!is_array($items)) $items = [];

?>
<section class="he-tiles">
    <div class="he-tiles__container">
        <div class="he-tiles__grid">
            <?php foreach ($items as $item):
                $url   = $item['url'] ?? '';
                $icon  = $item['icon'] ?? '';
                $title = $item['title'] ?? '';
                $text  = $item['text'] ?? '';

                if (!$url) continue;

                // Nettoyage "machine name" pour éviter d'injecter des classes bizarres
                $icon_slug = strtolower(preg_replace('/[^a-z0-9_-]/i', '', $icon));
                ?>
                <a class="he-tile" href="<?php echo esc_url($url); ?>">
          <span class="he-tile__icon <?php echo $icon_slug ? 'he-icon--' . esc_attr($icon_slug) : ''; ?>"
                aria-hidden="true"></span>

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
