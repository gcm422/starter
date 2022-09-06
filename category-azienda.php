<?php
get_header();
?>
<?php
$oggetto_id = $GLOBALS['oggetto_id'];
$dati = dati_archive($oggetto_id);
if(isset($dati)){
dati_archive($oggetto_id);
$id = $dati[0];
$h1 = $dati[1];
$slug = $dati[2];
$la_ancora_testuale = $dati[7];
$ancora_testuale = $la_ancora_testuale;
$descrizione_estesa = do_shortcode($dati[3]);
$immagine_parte1 = $dati[9];
$immagine_parte2 = maybe_unserialize($dati[9])[0];
if(isset($dati[13])){
$descrizione_breve = $dati[13];
$immagine_cop1 = $dati[11];
$immagine_cop2 = maybe_unserialize($dati[11])[0];
$img_cop = wp_get_attachment_image_src( $immagine_cop2 );
if($img_cop){
$img_cop_src = $img_cop[0];
$copertina = $img_cop_src;
$copertina = str_replace("https://www.tenox.it/foto/","", $copertina);
$copertina = str_replace("-120x68","",$copertina);
$copertina = str_replace(".jpg","",$copertina);
}
}else{
$descrizione_breve = $dati[11];
}
/*WP estrarrebbe anche i valori dei prodotti delle categorie sup e inf... non vogliamo che ciò accada per motivi SEO, quindi le escludiamo */
$categorie_da_escludere = array();
$categorie_superiori = array('parent' => $oggetto_id);
$capegorie_superiori = get_categories($categorie_superiori);
foreach ($capegorie_superiori as $categoria_su){
$categorie_da_escludere[] = $categoria_su->cat_ID;
}
$cats = array('child_of' => $id);
$categorie_inferiori = get_categories( $cats );
foreach($categorie_inferiori as $categoria_inferiore){
if(!in_array($categoria_inferiore->term_id,$categorie_da_escludere)){
$categorie_da_escludere[] = $categoria_inferiore->term_id;
}
}
}
$img_atts = wp_get_attachment_image_src( $immagine_parte2 );
if($img_atts){
$img_src = $img_atts[0];
$hero_image = $img_src;
$hero_image = str_replace("https://www.tenox.it/foto/","", $hero_image);
$hero_image = str_replace("-120x68","",$hero_image);
$hero_image = str_replace(".jpg","",$hero_image);
}
?>
<div class="section-featured-image">
<?php
if($img_atts){
?>
<figure class="figure-featured-image">
<img src="/foto/<?=$hero_image?>.jpg" class="img-featured-image" alt="<?=$h1?>" title="<?=$h1?>"
srcset="/foto/<?=$hero_image?>-320x106.jpg 320w,
/foto/<?=$hero_image?>-1024-342.jpg 1024w,
/foto/<?=$hero_image?>-1920x640.jpg 1920w"
sizes="(max-width: 321px) 320px,
(max-width: 1024px) 1024px,
1920px" />
<div class="columns is-mobile is-centered is-vcentered overlay-title">
<div class="column is-narrow">
<h1 class="is-size-4-mobile"><?=$la_ancora_testuale?></h1>
</div>
</div>
</figure>
<?php
}
?>
</div>
<?php briciola_di_pane($oggetto_id,$h1,$ancora_testuale); ?>
<section>
<div class="container">
<?=$descrizione_estesa?>
</div>
</section>
<section>
<?php echo do_shortcode("[contattaci]"); ?>
</section>
<section class="section-vantaggi">
<div class="container">
<h2>I vantaggi concorrenziali di Tenox</h2>
<div class="columns is-multiline is-centered is-vcentered">
<div class="column">
<figure>
<img src="/foto/tenox-sas-logo.svg" alt="logo Tenox" title="logo Tenox"/>
</figure>
</div>
<div class="column">
<?=$descrizione_breve?>
</div>
</div>
</div>
</section>
<?php
echo do_shortcode("[servizi]");
?>
<?php
echo do_shortcode("[presentazione-aziendale]");
?>
<?php get_footer(); ?>
