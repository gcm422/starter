<?php header("HTTP/1.0 410 Gone"); ?>
<!DOCTYPE html>
<html lang="it" class="has-navbar-fixed-top">
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="icon" href="/favicon.ico" /><?php wp_head(); ?>
<meta name="robots" content="noindex,nofollow" />
<meta name="description" content="Contenuto non più disponibile" />
<title>Errore 410 | Tenox S.a.S</title>
<?php tenox_hook_testata(); ?>
</head>
<body>
<header>
<nav class="navbar is-fixed-top" role="navigation" aria-label="main navigation">
<div class="navbar-brand navbar-secondary">
<div class="navbar-item is-hidden-touch">
<a class="navbar-phone" href="tel:+39072125001" target="_blank">
<span class="icon-text">
<span class="icon">
<svg class="svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
<path d="M511.2 387l-23.25 100.8c-3.266 14.25-15.79 24.22-30.46 24.22C205.2 512 0 306.8 0 54.5c0-14.66 9.969-27.2 24.22-30.45l100.8-23.25C139.7-2.602 154.7 5.018 160.8 18.92l46.52 108.5c5.438 12.78 1.77 27.67-8.98 36.45L144.5 207.1c33.98 69.22 90.26 125.5 159.5 159.5l44.08-53.8c8.688-10.78 23.69-14.51 36.47-8.975l108.5 46.51C506.1 357.2 514.6 372.4 511.2 387z"/>
</svg>
</span>
<span>0721 25001</span>
</span>
</a>
<a class="navbar-mail" href="mailto:info@tenox.it" target="_blank">
<span class="icon-text">
<span class="icon">
<svg class="svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
<path d="M464 64C490.5 64 512 85.49 512 112C512 127.1 504.9 141.3 492.8 150.4L275.2 313.6C263.8 322.1 248.2 322.1 236.8 313.6L19.2 150.4C7.113 141.3 0 127.1 0 112C0 85.49 21.49 64 48 64H464zM217.6 339.2C240.4 356.3 271.6 356.3 294.4 339.2L512 176V384C512 419.3 483.3 448 448 448H64C28.65 448 0 419.3 0 384V176L217.6 339.2z"/>
</svg>
</span>
<span>info@tenox.it</span>
</span>
</a>
</div>
<a class="navbar-item btn-parallelogram is-hidden-touch" href="#">
<span class="skew-fix">richiedi preventivo</span>
</a>
<a class="navbar-item is-hidden-desktop" href="/">
<img src="<?php echo get_site_url(); ?>/foto/tenox-sas-logo.svg" alt="logo tenox" width="112" height="28"/>
</a>
<a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="menu-testata">
<span aria-hidden="true"></span>
<span aria-hidden="true"></span>
<span aria-hidden="true"></span>
</a>
</div>
<div class="navbar-menu" id="menu-testata" name="menu-testata">
<div class="navbar-start">
<a class="navbar-item is-hidden-touch" href="/">
<img class="navbar-logo" src="<?php echo get_site_url(); ?>/foto/tenox-sas-logo.svg" alt="logo tenox" width="145px" height="52px"/>
</a>
</div>
<ul id="" class="navbar-end">
<?php
wp_nav_menu(array(
'theme_location' => 'menu-testata',
'menu' => 'NewNav',
'menu_id' => '',
'container' => '',
'menu_class' => '',
'items_wrap' => '%3$s',
'walker' => new Bulma_NavWalker(),
'fallback_cb' => 'Bulma_NavWalker::fallback',
'depth' => 4
));
?>
</ul><!-- end navbar end -->
</div>
</nav>
</header>
<section class="section-featured-image">
<figure class="figure-featured-image">
<img src="/foto/tenox-1950.jpg" class="img-featured-image" alt="Tenox" title="Tenox" srcset="/foto/tenox-1950-320x106.jpg 320w,/foto/tenox-1950-1024-342.jpg 1024w,/foto/tenox-1950-1920x640.jpg 1920w" \sizes="(max-width: 321px) 320px,(max-width: 1024px) 1024px,1920px" />
<div class="columns is-mobile is-centered is-vcentered overlay-title">
<div class="column is-narrow">
<h1 class="is-size-4-mobile">Contenuto non più disponibile</h1>
</div>
</div>
</figure>
</section>
<section class="section-contenuto">
<div class="container">
<h2>Errore 410</h2>
<p>Siamo spiacenti, questo contenuto non è più disponibile</p>
</div>
</section>
<?php echo do_shortcode('[servizi]'); ?>
<div class="container container-settori"><?php echo do_shortcode('[settori]'); ?></div>
<?php
get_footer();
?>
