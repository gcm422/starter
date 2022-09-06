<?php
//Pagina singolo prodotto
get_header();
?>
<!-- fine header -->
<?php
if ( have_posts() ) {
while ( have_posts() ) {
the_post();
$LAcategory = get_the_category();
$LAcategory = $LAcategory[0]->slug;
$hero_image = get_the_post_thumbnail_url();
$hero_image = str_replace("https://www.tenox.it/foto/","", $hero_image);
$hero_image = str_replace("-120x68","",$hero_image);
$hero_image = str_replace(".jpg","",$hero_image);
$pod = pods();
$videos = $pod->display( 'filmati' );
$galleria_immagine = $pod->display( 'galleria_immagine' );
$tabella_specifiche = $pod->display( 'tabella_con_specifiche' );
$tabella_specifiche = str_replace("<table>","<table class=\"table caratteristichetecniche\">",$tabella_specifiche);
$documentazione = $pod->display( 'documentazione_pdf' );
$ip_drodotto = get_the_ID();
?>
<?php
$pid = get_the_id();
//serve per le briciole di pane
?>
<?php $cats = get_the_category($pid);
$catgy = array();
foreach($cats as $catg){
	$catgy[0] = $catg->cat_ID;
	$cpid = $catgy[0];
	$cat_refs = dati_archive($cpid);
	$catgy[1] = $cat_refs[1];
	$catgy[2] = $cat_refs[7];
}
	$catgid = $catgy[0];
	$catgh1 = $catgy[1];
	$catglink = $catgy[2];
	unset($catgy);
?>
<?php briciola_di_pane($catgid,$catgh1,$catglink); ?>
<section class="section-prodotto">
<div class="container">
<div class="columns is-multiline">
<div class="column is-10">
<h1 class="title is-2"><?php echo get_the_title(); ?></h1>
<?php the_excerpt(); ?>
<figure class="figure-post-img">
<img src="/foto/<?=$hero_image?>.jpg" alt="<?=$hero_image?>" title="<?=$hero_image?>"
srcset="/foto/<?=$hero_image?>-240x240.jpg 240w,
/foto/<?=$hero_image?>-275x275.jpg 275w,
/foto/<?=$hero_image?>-375x375.jpg 375w,
/foto/<?=$hero_image?>-500x500.jpg 500w"
sizes="(max-width: 274px) 240px,
(max-width: 374px) 275px,
(max-width: 499px) 375px,
500px"/>
</figure>
</div>
<div class="columns col-sidebar">
<!--Sidebar -->
</div>
</div>
</div>
</section>
<section class="container">
<div id="tabs-prodotto">
<div class="tabs is-toggle is-fullwidth is-large">
<ul>
<li id="prima" class="is-active">
<a>
<div class="svg">
<svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M39.5827 45.8332H10.416C8.75841 45.8332 7.1687 45.1747 5.9966 44.0026C4.8245 42.8305 4.16602 41.2408 4.16602 39.5832V6.24984C4.16602 5.6973 4.38551 5.1674 4.77621 4.7767C5.16691 4.386 5.69681 4.1665 6.24935 4.1665H35.416C35.9685 4.1665 36.4985 4.386 36.8892 4.7767C37.2799 5.1674 37.4993 5.6973 37.4993 6.24984V31.2498H45.8327V39.5832C45.8327 41.2408 45.1742 42.8305 44.0021 44.0026C42.83 45.1747 41.2403 45.8332 39.5827 45.8332ZM37.4993 35.4165V39.5832C37.4993 40.1357 37.7188 40.6656 38.1095 41.0563C38.5002 41.447 39.0301 41.6665 39.5827 41.6665C40.1352 41.6665 40.6651 41.447 41.0558 41.0563C41.4465 40.6656 41.666 40.1357 41.666 39.5832V35.4165H37.4993ZM33.3327 41.6665V8.33317H8.33268V39.5832C8.33268 40.1357 8.55218 40.6656 8.94288 41.0563C9.33358 41.447 9.86348 41.6665 10.416 41.6665H33.3327ZM12.4993 14.5832H29.166V18.7498H12.4993V14.5832ZM12.4993 22.9165H29.166V27.0832H12.4993V22.9165ZM12.4993 31.2498H22.916V35.4165H12.4993V31.2498Z" fill="#09121F"/>
</svg>
</div>
<span>Informazioni</span>
</a>
</li>
<li>
<a>
<div class="svg">
<svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M27.0833 20.8333V29.1667H39.5833V20.8333H27.0833ZM22.9167 20.8333H10.4167V29.1667H22.9167V20.8333ZM27.0833 39.5833H39.5833V33.3333H27.0833V39.5833ZM22.9167 39.5833V33.3333H10.4167V39.5833H22.9167ZM27.0833 10.4167V16.6667H39.5833V10.4167H27.0833ZM22.9167 10.4167H10.4167V16.6667H22.9167V10.4167ZM8.33333 6.25H41.6667C42.2192 6.25 42.7491 6.46949 43.1398 6.86019C43.5305 7.25089 43.75 7.7808 43.75 8.33333V41.6667C43.75 42.2192 43.5305 42.7491 43.1398 43.1398C42.7491 43.5305 42.2192 43.75 41.6667 43.75H8.33333C7.7808 43.75 7.25089 43.5305 6.86019 43.1398C6.46949 42.7491 6.25 42.2192 6.25 41.6667V8.33333C6.25 7.7808 6.46949 7.25089 6.86019 6.86019C7.25089 6.46949 7.7808 6.25 8.33333 6.25V6.25Z" fill="#09121F"/>
</svg>
</div>
<span>Specifiche Tecniche</span>
</a>
</li>
<li>
<a>
<div class="svg">
<svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M24.8966 11.7616L13.1132 23.547C12.9143 23.7392 12.7556 23.9691 12.6464 24.2232C12.5372 24.4774 12.4797 24.7508 12.4773 25.0274C12.4749 25.304 12.5276 25.5784 12.6324 25.8344C12.7371 26.0904 12.8918 26.323 13.0874 26.5187C13.283 26.7143 13.5156 26.869 13.7717 26.9737C14.0277 27.0785 14.302 27.1312 14.5787 27.1288C14.8553 27.1264 15.1287 27.0689 15.3828 26.9597C15.637 26.8505 15.8669 26.6918 16.0591 26.4928L27.8445 14.7095C29.0167 13.5373 29.6752 11.9474 29.6752 10.2897C29.6752 8.63196 29.0167 7.04212 27.8445 5.86991C26.6723 4.69771 25.0824 4.03918 23.4247 4.03918C21.767 4.03918 20.1771 4.69771 19.0049 5.86991L7.21949 17.6553C6.23215 18.6181 5.44581 19.7673 4.90607 21.0364C4.36634 22.3054 4.08396 23.669 4.07532 25.048C4.06668 26.427 4.33195 27.794 4.85574 29.0697C5.37953 30.3454 6.15141 31.5044 7.12661 32.4795C8.10181 33.4545 9.26092 34.2263 10.5367 34.7499C11.8125 35.2735 13.1795 35.5386 14.5585 35.5297C15.9375 35.5209 17.3011 35.2383 18.57 34.6984C19.839 34.1585 20.9881 33.372 21.9507 32.3845L33.7362 20.6012L36.682 23.547L24.8966 35.3324C23.5423 36.6867 21.9346 37.7609 20.1652 38.4938C18.3957 39.2268 16.4993 39.604 14.5841 39.604C12.6689 39.604 10.7724 39.2268 9.00299 38.4938C7.23357 37.7609 5.62583 36.6867 4.27158 35.3324C2.91732 33.9782 1.84307 32.3704 1.11015 30.601C0.377228 28.8316 -1.42694e-08 26.9351 0 25.0199C1.42694e-08 23.1047 0.377228 21.2083 1.11015 19.4388C1.84307 17.6694 2.91732 16.0617 4.27158 14.7074L16.0591 2.92408C18.0237 1.0266 20.655 -0.0233398 23.3862 0.000393777C26.1174 0.0241273 28.73 1.11964 30.6614 3.05097C32.5927 4.98231 33.6882 7.59494 33.7119 10.3262C33.7357 13.0574 32.6857 15.6886 30.7882 17.6532L19.0049 29.4428C18.4244 30.0232 17.7352 30.4836 16.9767 30.7977C16.2182 31.1118 15.4053 31.2734 14.5844 31.2733C13.7635 31.2732 12.9506 31.1114 12.1922 30.7971C11.4338 30.4829 10.7447 30.0223 10.1643 29.4418C9.58387 28.8612 9.12349 28.172 8.80942 27.4136C8.49535 26.6551 8.33376 25.8422 8.33385 25.0213C8.33395 24.2003 8.49574 23.3875 8.80998 22.6291C9.12423 21.8707 9.58478 21.1816 10.1653 20.6012L21.9507 8.81575L24.8966 11.7616Z" fill="#09121F"/>
</svg>
</div>
<span>Documentazione</span>
</a>
</li>
</ul>
</div>
<div>
<section class="tab-content">
<div class="columns is-multiline is-variable is-8 col-informazioni">
<div class="column">
<?php the_content(); ?>
</div>
<div class="column is-4">
<?php
if(isset($videos)){
$video_links = explode(";", $videos);
foreach($video_links as $link){ ?>
<figure class="image is-16by9 video-prodotto">
<iframe class="has-ratio" width="640" height="360" src="<?=$link?>" frameborder="0" allowfullscreen></iframe>
</figure>
<?php   }
}

?>
</div>
</div>
</section>
<section class="tab-content">
<?=$tabella_specifiche?>
</section>
<section class="tab-content section-doc">
<?php
if(isset($documentazione)){
$titolo = str_replace("https://www.tenox.it/foto/documenti","", $documentazione);
$titolo = str_replace(".pdf","",$titolo);
echo "<a class=\"btn-parallelogram\" href=\"$documentazione\" target=\"_blank\"><span class=\"skew-fix\">scarica la documentazione</span></a>";
}
?>
</section>
<div class="divider no-space"></div>
<?php
if(isset($galleria_immagine)){
echo "<div class=\"columns is-multiline col-galleria-immagini\">";
$immagini = explode(" ", $galleria_immagine);
foreach($immagini as $immagine){
$immagine = str_replace("https://www.tenox.it/foto/","", $immagine);
$immagine = str_replace(".jpg","",$immagine);
?>
<div class="column">
<figure class="image is-square">
<a href="/foto/<?=$immagine?>.jpg" class="luminescente" data-gallery="luminescente">
<img src="/foto/<?=$immagine?>.jpg" alt="<?=$immagine?>" title="<?=$immagine?>"
srcset="/foto/<?=$immagine?>-240x240.jpg 240w,
/foto/<?=$immagine?>-275x275.jpg 275w,
/foto/<?=$immagine?>-375x375.jpg 375w"
sizes="(max-width: 274px) 240px,
(max-width: 375px) 275px,
375px"/>
</a>
</figure>
</div>
<?php
}
echo "</div><script>var lightbox = GLightbox(); var lightboxInlineIframe = GLightbox({'selector': 'luminescente'});</script>";
}
?>
</div>
</div>
</section>
<section class="section-contattaci">
<?php echo do_shortcode('[contattaci]'); ?>
</section>
<section class="section-prodotti-sub1">
<div class="container">
<?php
echo do_shortcode('[prodotti_correlati slug_categoria='.$LAcategory.' id_prodotto='.$ip_drodotto.']');
?>
</div>
</section>
<?php  }
}
?>
<?php
get_footer();
?>
