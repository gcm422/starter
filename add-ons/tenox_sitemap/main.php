<?php
/*
   Plugin Name: 2 - Tenox Sitemap XML
   Plugin URI: https://www.tenox.it
   Description: Questo plugin genera una sitemap ad ogni nuova pubblicazione, salvataggio, modifica o creazione di post, pagina o tipo di post personalizzato
   Author: tenox.it
 */
?>
<?php
/*
   Questo plugin ricrea una sitemap ad ogni evento associato a questi hooks
   save_post
   edit_post
   deleted_post
   post_updated
   trashed_post
   untrashed_post
   edit_post_link
   updated_postmeta
 */
function echame_mapa(){
    $MAPA = "/home/pzeuiqce/public_html/sito/add-ons/tenox_sitemap/mapa.xml";
    chmod($MAPA,0755);
    unlink($MAPA);
    $oggi = date("Y-m-d");
    $testo_iniziale_parte1 = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>
<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\"
xmlns:image=\"http://www.google.com/schemas/sitemap-image/1.1\"
xmlns:video=\"http://www.google.com/schemas/sitemap-video/1.1\">
<url>
<loc>https://www.tenox.it/</loc>
<lastmod>$oggi</lastmod>
</url>";
  file_put_contents($MAPA,$testo_iniziale_parte1,FILE_APPEND);
  $loop = new WP_Query(array(
	'post_type'      => 'post',
	'orderby'        => 'meta_value',
	'posts_per_page' => -1
  ));
  if($loop->have_posts()){
	while ($loop->have_posts()){
	    $loop->the_post();
	    $i = get_the_ID();
	    $t = get_the_title();
	    $p = get_the_permalink();
	    $c = get_the_content();
	    $r = get_post_meta(get_the_ID(), 'metarobots', true);
	    if($r == 1){
	    $u_time = get_the_time('Y-m-d'); $u_modified_time = get_the_modified_time('U'); if($u_modified_time >= $u_time + 86400) { $d = get_the_modified_time('Y-m-d'); }else{ $d = $u_time; }
	    $immagini = array();
	    preg_match_all('/<img[^>]+\/>/i', $c, $corrispondenze);
	    foreach($corrispondenze[0] as $img){
	    if($img != ""){
	    preg_match('/src="[^"]+\"/s',$img, $src);
	    $loc = $src[0];
	    $loc = str_replace("src=","https://www.tenox.it",$loc);
	    $imgurl = $loc;
	    $imgurl = str_replace("\"","",$imgurl);
	    $loc = $imgurl;
	    preg_match('/alt="[^"]+\"/s',$img, $alt);
	    $caption = $alt[0];
	    $caption = str_replace("&","and",$caption);
	    $caption = str_replace("\"","",$caption);
	    $caption = str_replace("alt=","",$caption);
	    $immagini[] = "<image:image>
      <image:loc>$loc</image:loc>
      <image:caption>$caption</image:caption>
      </image:image>";
	    }
	    }
	    $immagine = implode("",$immagini);
	    $single_post = "
<url>
<loc>$p</loc>
<lastmod>$d</lastmod>$immagine
</url>
";
file_put_contents($MAPA,$single_post,FILE_APPEND);
}//if robots è ok
$testo_iniziale_parte3 = "</urlset>";
file_put_contents($MAPA,$testo_iniziale_parte3,FILE_APPEND);
}
add_action( 'save_post','echame_mapa');
add_action( 'deleted_post','echame_mapa');
add_action( 'edit_post','echame_mapa');
add_action( 'post_updated','echame_mapa');
add_action( 'trashed_post','echame_mapa');
add_action( 'untrashed_post','echame_mapa');
add_action( 'edit_post_link','echame_mapa');
add_action( 'updated_postmeta','echame_mapa');
}
?>
