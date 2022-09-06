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
<section class="container">
<div class="columns">
<?php
	$num = 0;
		$loop = new WP_Query(array(
	'post_type'      => 'post',
	'orderby'        => 'meta_value',
	'category_name' => $slug,
	'category__not_in' => $categorie_da_escludere,
	'order' => 'ASC',
	'post_status' => 'publish',
	'meta_key'       => 'ordinamento',
	'posts_per_page' => -1
	));
	if($loop->have_posts()){
	while ($loop->have_posts()){
	$loop->the_post();
	$ord = get_post_meta(get_the_ID(), 'ordinamento', true);
	$p = get_the_ID();
	$t = get_the_title();
	$ancoraseo = get_post_meta(get_the_ID(), 'ancora_testuale', true);
	$perma = get_the_permalink(); $perma = str_replace("https://www.tenox.it","",$perma);
	$excerpt = get_the_excerpt();
	$visibilita = get_post_meta(get_the_ID(), 'visibile_in_categoria', true);
	if($visibilita != "NO"){
		echo ("<div class=\"container-servizi\">
				<div class=\"column\">
					<div class=\"content\">
						<h3>
							<a href=\"$perma\" title=\"$t\">
								$ancoraseo
							</a>
						</h3>
						<p class=\"div-descr-estesa\">$excerpt</p>
					</div>
					<a class=\"btn-parallelogram\" href=\"$perma\">
						<span class=\"skew-fix\">scopri di piu</span>
					</a>
				</div>
			</div>
	");
	$num++;
	if($num % 3 == 0){
echo("</div>
<div class=\"columns\">
");
}
}
}
}
?>
</section>
<?php get_footer(); ?>
