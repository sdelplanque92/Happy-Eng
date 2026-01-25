<?php
if (!defined('ABSPATH')) exit;

$h2 = $attributes['heading2'] ?? '';
$h3 = $attributes['heading3'] ?? '';
$text = $attributes['text'] ?? '';
$buttons = $attributes['buttons'] ?? [];

?>
<section id="hero" class="he-hero hero sticked-header-offset">
    <div class="container position-relative">
        <div class="row gy-5 aos-init aos-animate" data-aos="fade-in">
            <div class="col-lg-7 d-flex flex-column align-items-start justify-content-center text-left caption">


                    <?php if ($h2) : ?>
                        <h2 data-aos="fade-left" data-aos-delay="100" class="aos-init aos-animate"><?php echo esc_html($h2); ?></h2>
                    <?php endif; ?>

                    <?php if ($h3) : ?>
                        <h3 data-aos="zoom-out" data-aos-delay="500" class="aos-init aos-animate"><?php echo esc_html($h3); ?></h3>
                    <?php endif; ?>

                    <?php if ($text) : ?>
                        <p data-aos="fade-left" data-aos-delay="1000" class="aos-init aos-animate"><?php echo wp_kses_post($text); ?></p>
                    <?php endif; ?>

                    <?php if (is_array($buttons) && !empty($buttons)) : ?>
                        <div class="d-flex aos-init aos-animate" data-aos-delay="2000" data-aos="zoom-out">
                            <?php foreach ($buttons as $btn) :
                                $label = $btn['label'] ?? '';
                                $url   = $btn['url'] ?? '';
                                if (!$label || !$url) continue;
                                ?>
                                <a class="he-btn btn-get-started" href="<?php echo esc_url($url); ?>">
                                    <?php echo esc_html($label); ?>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
            </div>
        </div>
    </div>
</section>
