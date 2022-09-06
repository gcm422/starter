<?php get_header(); ?>
<!-- fine header -->
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
$immagine_copertina_parte1 = $dati[10];
$immagine_copertina_parte2 = maybe_unserialize($dati[10])[0];
$immagine2_rappresentativa_parte1 = $dati[9];
$immagine2_rappresentativa_parte2 = maybe_unserialize($dati[9])[0];
$foto_copertina = pods_field_display( 'category', $id, 'immagine_di_copertina' );
$foto1 = pods_field_display( 'category', $id, 'immagine_in_evidenza' );
$foto_copertina = str_replace("https://www.tenox.it/foto/","", $foto_copertina);
$foto_copertina = str_replace("-120x68","",$foto_copertina);
$foto_copertina = str_replace(".jpg","",$foto_copertina);
$foto1 = str_replace("https://www.tenox.it/foto/","", $foto1);
$foto1 = str_replace("-120x68","",$foto1);
$foto1 = str_replace(".jpg","",$foto1);
$descrizione_breve = $dati[13];
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
$img_copertina = wp_get_attachment_image_src( $immagine_copertina_parte2 );
$img_rappresentativa = wp_get_attachment_image_src( $immagine2_rappresentativa_parte2 );
if($img_copertina){
$cover_img = $img_copertina[0];
$cover_image = $cover_img;
$cover_image = str_replace("https://www.tenox.it/foto/","", $cover_image);
$cover_image = str_replace("-120x68","",$cover_image);
$cover_image = str_replace(".jpg","",$cover_image);
}
if($img_rappresentativa){
$rap_rappresentativa_src = $img_rappresentativa[0];
$rap_image = $rap_rappresentativa_src;
$rap_image = str_replace("https://www.tenox.it/foto/","", $rap_image);
$rap_image = str_replace("-120x68","",$rap_image);
$rap_image = str_replace(".jpg","",$rap_image);
}
?>
<section class="section-featured-image">
	<?php
	if($foto_copertina){
	?>
	<figure class="figure-featured-image">
	<img src="/foto/<?=$foto_copertina?>.jpg" class="img-featured-image" alt="<?=$h1?>" title="<?=$h1?>"
	srcset="/foto/<?=$foto_copertina?>-320x106.jpg 320w,
	/foto/<?=$foto_copertina?>-1024-342.jpg 1024w,
	/foto/<?=$foto_copertina?>-1920x640.jpg 1920w"
	sizes="(max-width: 321px) 320px,
	(max-width: 1024px) 1	024px,
	1920px" />
	<div class="columns is-mobile is-centered is-vcentered overlay-title">
	<div class="column is-narrow">
	<h1 class="is-size-4-mobile"><?=$h1?></h1>
	</div>
	</div>
	</figure>
	<?php
	}
	?>
</section>
<?php briciola_di_pane($oggetto_id,$h1,$ancora_testuale); ?>
<section class="container container-prodotti-sub1 is-fluid">
<div class="columns is-vcentered is-multiline">
<div class="column">
<h2 class="has-text-centered"><?=$ancora_testuale?></h2>
<div class="has-text-centered"><?=$descrizione_breve?></div>
</div>
<?php
if($foto1){
?>
<div class="column">
<figure class="figure-post-img">
<img src="/foto/<?=$foto1?>.jpg" alt="<?=$foto1?>" title="<?=$foto1?>"
srcset="/foto/<?=$foto1?>-240x135.jpg 240w,
/foto/<?=$foto1?>-640x360.jpg 640w,
/foto/<?=$foto1?>.jpg 1024w"
sizes="(max-width: 319px) 240px,
(max-width: 1023px) 640px,
1024px"/>
</figure>
</div>
<?php } ?>
</div>
<?php
/*
fine parte pagina di categoria
*/
?>

<?php if(count($categorie_inferiori) > 0){ //in pratica se ci sono delle sottocategorie, quanto segue permette di estrarre solo l'elenco di queste al posto dell'elenco di tutti i prodotti
	?>
	<ul class="columns">
		<?php
foreach($categorie_inferiori as $thiscat){
$thiscat_padre = get_category( $thiscat );
$thiscat_parent[0] = esc_html( $thiscat_padre->category_parent );
$thiscat_padre = $thiscat_parent[0];
if($thiscat_padre == $oggetto_id){
$thiscat_dati = dati_archive($thiscat);
if(isset($thiscat_dati)){
$thiscat_id = $thiscat_dati[0];
$thiscat_h1 = $thiscat_dati[1];
$thiscat_slug = $thiscat_dati[2];
$thiscat_la_ancora_testuale = $thiscat_dati[7];
$thiscat_ancora_testuale = $thiscat_la_ancora_testuale;
$thiscat_descrizione_estesa = do_shortcode($thiscat_dati[3]);
$thiscat_immagine_parte1 = $thiscat_dati[9];
$thiscat_immagine_parte2 = maybe_unserialize($thiscat_dati[9])[0];
$thiscat_descrizione_breve = $thiscat_dati[11];
$thiscat_img_atts = wp_get_attachment_image_src( $immagine_parte2 );
if($thiscat_img_atts){
$thiscat_img = $img_atts[0];
$thiscat_img = str_replace("https://www.tenox.it/foto/","", $thiscat_img);
$thiscat_img = str_replace("-120x68","",$thiscat_img);
$thiscat_img = str_replace(".jpg","",$thiscat_img);
}
?>
<li class="column"><figure>
<img src="/foto/<?=$thiscat_img?>.jpg" class="" alt="<?=$h1?>" title="<?=$thiscat_h1?>"
srcset="/foto/<?=$thiscat_img?>-240x240.jpg 240w"
sizes="240px" />
<div class="overlay"></div>
</figure><a href="/<?=$slug?>/<?=$thiscat_slug?>/" title="<?=$thiscat_h1?>"><?=$thiscat_ancora_testuale?></a></li>
<?php
}
}
}//fine foreach categoria
?>
</ul>
<?php
} //fine ha sottocategorie e quindi mostrale
?>
<div class="container">
<div class="columns">
<?php
/*
Parte relativa all'estrazione dei sottoprodotti
*/
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
$src = get_the_post_thumbnail_url();
$src = str_replace("https://www.tenox.it/foto/","",$src);
$src = str_replace(".jpg","",$src);
$src = str_replace("-120x68","",$src);
$p = get_the_ID();
$t = get_the_title();
$ancoraseo = get_post_meta(get_the_ID(), 'ancora_testuale', true);
$perma = get_the_permalink(); $perma = str_replace("https://www.tenox.it","",$perma);
$excerpt = get_the_excerpt();
$visibilita = get_post_meta(get_the_ID(), 'visibile_in_categoria', true);
if($visibilita != "NO"){
echo ("
<div class=\"column is-3 prodotti-sub1-sub2\">
	<div class=\"card\">	
		<figure>
			<img src=\"/foto/$src.jpg\" title=\"$ancoraseo\"
			srcset=\"/foto/$src-240x240.jpg 240w\" sizes=\"240px\" />
		</figure>
		<a href=\"$perma\" title=\"$t\">
			<div class=\"content\">
				<div class=\"btn-parallelogram\">
					<span class=\"skew-fix\">$ancoraseo</span>
				</div>
			</div>
		</a>                  
	</div>



	
</div>
");
$num++;
if($num %4 == 0){
?>
</div><div class="columns">
<?php
}
}
}
}
?>
</div>
</section>
<section class="section-prodotti">
<div class="container">
<?php echo do_shortcode("[livello2 questa_categoria=$dati[0]]"); ?>
</div>
</section>
<section class="section-contattaci">
<?php echo do_shortcode("[contattaci]"); ?>
</section>
<?php if(isset($descrizione_estesa))
{
	echo "	<section class=\"section-long-des\">
				<div class=\"container\">
					$descrizione_estesa
				</div>
			</section>";
}?>
<?php get_footer(); ?>
