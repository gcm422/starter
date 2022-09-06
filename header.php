<!DOCTYPE html>
<html lang="it" class="has-navbar-fixed-top">
<head>
<script>
window.dataLayer = window.dataLayer || [];

dataLayer.push({
 'tipoUtente': 'Privato'
});
</script>
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-WLKN66Z');</script>
<!-- End Google Tag Manager -->
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="icon" href="/favicon.ico" /><?php wp_head(); ?>
<?php
if(!is_archive()){
//se non è una categoria o un CPT pesca i valori dei post e valorizza i parametri seo
$oggetto_id = get_the_id();
$metatitolo = get_post_meta($oggetto_id, 'metatitolo', true);
$metadescrizione = get_post_meta($oggetto_id, 'metadescrizione', true);
$metarobots = get_post_meta($oggetto_id, 'metarobots', true);
if($metarobots == 1){ $metarobots = "index,follow"; }else{ $metarobots = "noindex,follow"; }
$canonical = get_post_meta($oggetto_id, 'canonical', true);
$ancora_testuale = get_post_meta($oggetto_id, 'ancora_testuale', true);
}else{ //is category
$uri = $_SERVER["REQUEST_URI"];
$porzioni = parse_url($uri);
$percorso = explode("/", $porzioni["path"]);
$GLOBALS['percorso'] = $percorso;
$livelli = count($percorso) - 2;
$slug = $percorso[$livelli];
 //ogni pezzo è comprensivo di slash avanti e dietro
$oggetto = get_queried_object();
$oggetto_id = $oggetto->term_id;
$GLOBALS['oggetto_id'] = $oggetto_id;
if($oggetto->parent){ //se c'è un genitore
$id_genitore = $oggetto->parent;
}
$dati = dati_archive($oggetto_id);
if(isset($dati)){
dati_archive($oggetto_id);
$id = $dati[0];
$h1 = $dati[1];
$slug = $dati[2];
$metatitolo = $dati[4];
$metadescrizione = $dati[5];
$robots = $dati[6];
if($robots == 1){$metarobots = "index,follow";}else{$metarobots = "noindex,follow";}
$la_ancora_testuale = $dati[7];
$ancora_testuale = $la_ancora_testuale;
$il_canonical = $dati[8];
$canonical = $il_canonical;
$descrizione_estesa = do_shortcode($dati[3]);
$immagine_parte1 = $dati[9];
$immagine_parte2 = maybe_unserialize($dati[9])[0];
$descrizione_breve = $dati[11];
$categorie_superiori = array('parent' => $oggetto_id);
$capegorie_superiori = get_categories($categorie_superiori);
$categorie_da_escludere = array();
foreach($capegorie_superiori as $categoria_su){
$categorie_da_escludere[] = $categoria_su->cat_ID;
}
}
?><?php } //fine is get_category
?>
<meta name="robots" content="<?php echo $metarobots; ?>" />
<link rel="canonical" href="<?php if(isset($canonical)){echo $canonical; } ?>" />
<meta name="description" content="<?php if(isset($metadescrizione)){echo $metadescrizione; } ?>" />
<title><?php if(isset($metatitolo)){ echo $metatitolo; } ?></title>
<?php tenox_hook_testata(); ?>
</head>
<body>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WLKN66Z"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
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
<a class="navbar-item btn-parallelogram is-hidden-touch" href="#form">
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
