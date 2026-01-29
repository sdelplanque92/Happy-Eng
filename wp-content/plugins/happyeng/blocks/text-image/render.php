<?php
if (!defined('ABSPATH')) exit;

$title    = $attributes['title']    ?? '';
$mediaUrl = $attributes['mediaUrl'] ?? '';
$mediaAlt = $attributes['mediaAlt'] ?? '';
$text     = $attributes['text']     ?? '';

?>
<section class="about">
    <div class="container" data-aos="fade-up">
        <?php if ($title) : ?>
            <div class="section-header">
                <h2><?php echo esc_html($title); ?></h2>
            </div>
        <?php endif; ?>

        <div class="row gy-4">
            <div class="col-lg-9  ps-lg-5">
                <div class="content ps-0" data-aos="fade-right">
                    <?php
                    $render_text = $text;

                    // Si le contenu ne contient pas déjà des <p>, on laisse WordPress en créer
                    if (stripos($render_text, '<p') === false) {
                        $render_text = wpautop($render_text);
                    }

                    echo wp_kses_post($render_text);
                    ?>
                </div>
            </div>
            <div class="col-lg-3">
                <?php if ($mediaUrl) : ?>
                    <img
                            src="<?php echo esc_url($mediaUrl); ?>"
                            alt="<?php echo esc_attr($mediaAlt); ?>"
                            class="img-fluid rounded-4 mb-4"
                            loading="lazy"
                    />
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>