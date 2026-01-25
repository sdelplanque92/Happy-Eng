<section id="topbar" class="topbar d-flex align-items-center">
    <div class="container d-flex justify-content-end">
        <div class="social-links d-none d-md-flex align-items-center">
            <div class="contact-info d-flex align-items-center">
                <i class="bi bi-envelope d-flex align-items-center"><a href="mailto:contact@example.com">contact@example.com</a></i>
                <i class="bi bi-phone d-flex align-items-center ms-4"><span>+1 1234 56 789</span></i>
            </div>
            <span> | </span>
            <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
            <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
            <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
            <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
        </div>
    </div>
</section>
<header id="header" class="header d-flex align-items-center">
    <div class="container container-xl d-flex align-items-center justify-content-between">
        <a href="<?php print get_bloginfo('url'); ?>" class="logo d-flex align-items-center">
            <h1 class="--bs-light"><?php print get_bloginfo('name'); ?><span>.</span></h1>
        </a>
        <?php wp_nav_menu([
                'menu_id' => 10,
                'container' => 'nav',
                'container_id' => 'navbar',
                'container_class' => 'navbar',
                'depth' => 2
        ]); ?>
        <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
        <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>
    </div>
</header>