<?php
/**
 * Theme functions.
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

add_action( 'after_setup_theme', function () {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'html5', [ 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ] );

    register_nav_menus( [
        'primary' => __( 'Primary Menu', 'freelancer-tech-it' ),
        'footer'  => __( 'Footer Menu', 'freelancer-tech-it' ),
    ] );
} );

add_action( 'wp_enqueue_scripts', function () {
    $uri = get_template_directory_uri();

    // Google Fonts (from template)
    wp_enqueue_style( 'fti-google-fonts-open-sans', 'https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@300;400;500;600;700;1,300;1,400;1,500;1,600;1,700&display=swap', [], null );
    wp_enqueue_style( 'fti-google-fonts-comfortaa', 'https://fonts.googleapis.com/css2?family=Comfortaa:wght@700&display=swap', [], null );
    wp_enqueue_style( 'fti-google-fonts-poppins', 'https://fonts.googleapis.com/css2?family=Poppins:wght@300;400&display=swap', [], null );

    // Vendor CSS
    wp_enqueue_style( 'fti-aos',          $uri . '/assets/vendor/aos/aos.css', [], null );
    wp_enqueue_style( 'fti-glightbox',    $uri . '/assets/vendor/glightbox/css/glightbox.min.css', [], null );
    wp_enqueue_style( 'fti-swiper',       $uri . '/assets/vendor/swiper/swiper-bundle.min.css', [], null );
    wp_enqueue_style( 'fti-fontawesome',  $uri . '/assets/stylesheets/font-awesome.min.css', [], null );
    wp_enqueue_style( 'fti-bootstrapicons',$uri . '/assets/vendor/bootstrap-icons/bootstrap-icons.css', [], null );
    wp_enqueue_style( 'fti-bootstrap',    $uri . '/assets/vendor/bootstrap/css/bootstrap.min.css', [], null );

    // Theme CSS
    wp_enqueue_style( 'fti-theme',        $uri . '/assets/stylesheets/styles.css', [ 'fti-bootstrap' ], null );
    wp_enqueue_style( 'theme-custom-css',        $uri . '/custom/css/he-custom.css', [], null );

    // Scripts (keep template order)
    wp_enqueue_script( 'fti-jquery',      $uri . '/assets/javascripts/jquery.min.js', [], null, true );
    wp_enqueue_script( 'fti-glightbox',   $uri . '/assets/vendor/glightbox/js/glightbox.min.js', [ 'fti-jquery' ], null, true );
    wp_enqueue_script( 'fti-bootstrap',   $uri . '/assets/vendor/bootstrap/js/bootstrap.bundle.min.js', [ 'fti-jquery' ], null, true );
    wp_enqueue_script( 'fti-aos',         $uri . '/assets/vendor/aos/aos.js', [ 'fti-jquery' ], null, true );
    wp_enqueue_script( 'fti-swiper',      $uri . '/assets/vendor/swiper/swiper-bundle.min.js', [ 'fti-jquery' ], null, true );
    wp_enqueue_script( 'fti-plugins',     $uri . '/assets/javascripts/plugins.js', [ 'fti-jquery' ], null, true );
    wp_enqueue_script( 'fti-validator',   $uri . '/assets/javascripts/validator.min.js', [ 'fti-jquery' ], null, true );
    wp_enqueue_script( 'fti-contactform', $uri . '/assets/javascripts/contactform.js', [ 'fti-jquery' ], null, true );
    wp_enqueue_script( 'fti-main',        $uri . '/assets/javascripts/main.js', [ 'fti-jquery' ], null, true );

    // Custom Menu
    wp_enqueue_script( 'theme-custom-menu',        $uri . '/custom/js/menu.js', [], null, true );
} );

/**
 * Helper: render a saved static "main" fragment for pages converted from HTML.
 */
function fti_render_static_main( string $template_slug ): void {
    $file = get_template_directory() . '/template-parts/static/' . $template_slug . '.php';
    if ( file_exists( $file ) ) {
        include $file;
    } else {
        echo '<main id="main" class="container py-5"><p>Static template part not found: ' . esc_html( $template_slug ) . '</p></main>';
    }
}

/**
 * Register custom menu.
 */
function he_custom_menu() {
    add_theme_support('menus');

    register_nav_menus([
        'primary' => __('Primary Menu', 'happyeng'),
        'footer'  => __('Footer Menu', 'happyeng'),
    ]);
}

add_action('after_setup_theme', 'he_custom_menu');