<?php get_header(); ?>
<!-- fine header -->
<?php
$oggetto_id = $GLOBALS['oggetto_id'];
$parole_descrittive = array();
$parole_descrittive_n = 0;
$foto_descrittive = array();
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
<section class="container container-prodotti-sub1">
<div class="columns is-vcentered is-multiline">
<div class="column col-descr">
<h2><?=$h1?></h2>
<?=$descrizione_breve?>
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
</section>
<section class="section-subcat1">
<div class="container">
<div class="columns">
<div class="column is-5">
<h2>Tipologie di <?=$h1?></h2>
<div class="column">
<?php if(count($categorie_inferiori) > 0){ //in pratica se ci sono delle sottocategorie, quanto segue permette di estrarre solo l'elenco di queste al posto dell'elenco di tutti i prodotti
?>
<ul class="columns col-img-subcat1">
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
$thiscat_immagine_copertina_parte1 = $thiscat_dati[9];
$thiscat_immagine_copertina_parte2 = maybe_unserialize($thiscat_dati[9])[0];
$thiscat_descrizione_breve = $thiscat_dati[13];
$parole_descrittive[] = $thiscat_descrizione_breve;
$thiscat_immagine2_rappresentativa_parte1 = $thiscat_dati[9];
$thiscat_immagine2_rappresentativa_parte2 = maybe_unserialize($thiscat_dati[9])[0];
$thiscat_immagine_copertina_parte1 = $thiscat_dati[10];
$thiscat_immagine_copertina_parte2 = maybe_unserialize($thiscat_dati[10])[0];
$thiscat_immagine_rappresentativa = wp_get_attachment_image_src($thiscat_immagine2_rappresentativa_parte2);
if($thiscat_immagine_rappresentativa){
$thiscat_immagine_rappresentativa = $thiscat_immagine_rappresentativa[0];
$thiscat_immagine_rappresentativa = str_replace("https://www.tenox.it/foto/","", $thiscat_immagine_rappresentativa);
$thiscat_immagine_rappresentativa = str_replace("-120x68","",$thiscat_immagine_rappresentativa);
$thiscat_immagine_rappresentativa = str_replace(".jpg","",$thiscat_immagine_rappresentativa);
}
$foto_descrittive[] = "<li class=\"column\">
<figure class=\"image is-1by1\">
<img src=\"/foto/$thiscat_immagine_rappresentativa.jpg\" class=\"\" alt=\"$h1\" title=\"$thiscat_h1\"
srcset=\"/foto/$thiscat_immagine_rappresentativa-240x240.jpg 240w\"	sizes=\"240px\" />
<div class=\"overlay\">
<a class=\"btn-parallelogram\" href=\"/prodotti/$slug/$thiscat_slug/\" title=\"$thiscat_h1\"><span class=\"skew-fix\">	$thiscat_ancora_testuale
</span>
</a>
</div>
</figure>
</li>";
}
}
$parole_descrittive_n++; }//fine foreach categoria
?>
<div class="columns">
	<div class="column"><?php for($a = 0; $a < $parole_descrittive_n; $a++){echo $parole_descrittive[$a]; echo "<br><br><br>"; }?></div>

	</div>
</ul>
<?php
} //fine ha sottocategorie e quindi mostrale
?>
</div>
</div>
<div class="column">
	<div class="columns is-multiline is-v-centered">

			<?php
				for($b = 0; $b < $parole_descrittive_n; $b++){
					echo "<div class=\"column is-6\">$foto_descrittive[$b]</div>";
				}
				if($parole_descrittive_n%2 != 0){
					echo "<div class=\"column is-6 box-contatto\">
						<li class=\"column\">
							<figure class=\"image is-1by1\">
								<img src=\"/foto/box-contatto.jpg\" class=\"\" alt=\"$h1\" title=\"$thiscat_h1\"
									srcset=\"/foto/box-contatto-240x240.jpg 240w\"	sizes=\"240px\" />
								<div class=\"overlay\">
									<a href=\"/azienda/contatti.html\" title=\"contattaci\">
										<span class=\"box-contatto-1\">Contattaci<br></span>
										<span class=\"box-contatto-2\">per richiedere un<br></span>
										<span class=\"box-contatto-3\">preventivo gratuito</span>
									</a>
								</div>
							</figure>
						</li></div>";
				}
			?>


	</div>
</div>
</div>
</section>
<?php
	if($parole_descrittive_n % 2 == 0){
		echo "<section class=\"section-contattaci\">";
		echo do_shortcode("[contattaci]");
		echo "</section>";
	}
?>
<section class="section-prodotti-sub1">
<div class="container">
<?php
//echo do_shortcode("[livello2]");
?>
<?php echo do_shortcode("[livello1]"); ?>
</div>
</section>
<?php
	if($descrizione_estesa != "")
	{
		echo "
		<section class=\"section-long-desc\">
			<div class=\"container\">
				<h2>Informazioni aggiuntive</h2>
				$descrizione_estesa
			</div>
		</section>
		";
	}
?>
<?php get_footer(); ?>
