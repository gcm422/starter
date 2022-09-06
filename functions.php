<?php
//creo un nuovo hook in testata per caricare plugin personalizzati --->
function fogli(){
//Cascading Style Sheets
wp_enqueue_style('framework', get_template_directory_uri() . '/framework.css');
wp_enqueue_style('glightbox_s', get_template_directory_uri() . '/includes/glightbox/glightbox.min.css');
wp_enqueue_script('glightbox_j', get_template_directory_uri() . '/includes/glightbox/glightbox.min.js', '', '', false);
wp_enqueue_style('stile', get_template_directory_uri() . '/style.css');
//javascript
wp_enqueue_script('openscripts', get_template_directory_uri() . '/client.js', '', '', false);
wp_dequeue_script('jquery');
wp_deregister_script('jquery');
}
add_action('wp_enqueue_scripts','fogli');
/* carica template di sottocategoria se esiste */
// Different template for subcategories
function template_subcategory( $template ) {
	$uri = $_SERVER["REQUEST_URI"];
	$porzioni = parse_url($uri);
	$percorso = explode("/", $porzioni["path"]);
	if(in_array('prodotti',$percorso)){
    $cat        = get_queried_object();
		   $children   = get_terms( $cat->taxonomy, array(
        'parent'     => $cat->term_id,
        'hide_empty' => false
    ) );

    if( ! $children ) {
        $template = locate_template( 'category-prodotti-sub1-sub2.php' );
    } elseif( 0 < $cat->category_parent ) {
        $template = locate_template( 'category-prodotti-sub1.php' );
    }

}
return $template;
}
add_filter( 'category_template', 'template_subcategory' );
require_once('includes/bulma-navwalker.php');
function tenox_hook_testata(){ do_action('tenox_hook');}
//creo un nuovo hook prima del piedipagina per caricare plugin personalizzati dopo tutto il contenuto ma prima del footer --->
function tenox_hook_prefooter(){do_action('tenox_hook_prefooter');}
//creo un nuovo hook dopo il piedipagina per caricare plugin personalizzati dopo tutto il contenuto --->
function tenox_hook_postfooter(){do_action('tenox_hook_postfooter');}
/*Menu personalizzati */
function CreaMenu(){
register_nav_menus(array(
	'menu-testata' => 'Menu principale'
));
}
add_action( 'init', 'CreaMenu' );
/*FINE Menu personalizzati */

/*Blocchi footer*/
function widget_reg($name, $id)
{
		register_sidebar(array(
		'name' => $name,
		'id' => $id,
		'before_widget' => '<div class="column has-text-centered"><div class="content">',
		'after_widget' => '</div></div>',
		'before_title' => '<h4>',
		'after_title' => '</h4>'
	));
}
function multi_widget_init(){
	widget_reg('Footer widget 1', 'footer-widget-1');
	widget_reg('Footer widget 2', 'footer-widget-2');
	widget_reg('Footer widget 3', 'footer-widget-3');
	widget_reg('Footer widget 4', 'footer-widget-4');
}

add_action('widgets_init', 'multi_widget_init');
/*FINE Blocchi footer*/
/* aumento il limite larghezza immagini */
function disabilita_default_SRCSET(){ return 1921; }
add_filter('max_srcset_image_width', 'disabilita_default_SRCSET');
/*FINE aumento il limite larghezza immagini*/
/* Cambia directory per i PDF - seo /foto/documenti/ */
add_filter('wp_handle_upload_prefilter', 'wppdfdir_pre_upload');
add_filter('wp_handle_upload', 'wppdfdir_post_upload');
function wppdfdir_pre_upload($file){
 add_filter('upload_dir', 'wppdfdir_custom_upload_dir');
 return $file;
}
function wppdfdir_post_upload($fileinfo){
 remove_filter('upload_dir', 'wppdfdir_custom_upload_dir');
 return $fileinfo;
}
function wpb_disable_pdf_previews() {
$fallbacksizes = array();
return $fallbacksizes;
}
add_filter('fallback_intermediate_image_sizes', 'wpb_disable_pdf_previews');
function wppdfdir_custom_upload_dir($path){
 $extension = substr(strrchr($_POST['name'],'.'),1);
 if(!empty($path['error']) ||  $extension != 'pdf') { return $path; } //error or other filetype; do nothing.
 $customdir = '/documenti';
 $path['path'] = str_replace($path['subdir'], '', $path['path']); //remove default subdir (year/month)
 $path['url']  = str_replace($path['subdir'], '', $path['url']);
 $path['subdir']  = $customdir;
 $path['path'].= $customdir;
 $path['url'] .= $customdir;
 return $path;
}
/* FINE Cambia directory per i PDF - seo /foto/documenti/ */
/* Rimozione schifezze da WP-HEAD */
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'parent_post_rel_link', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);
remove_action('wp_head', 'no_robots',1); //per wp 5.9.2+
remove_action('wp_head', 'noindex',1); //per wp 5.9.2+
remove_action( 'wp_head', 'rel_canonical' );
remove_action( 'wp_head', 'rest_output_link_wp_head' );
remove_action('wp_head', 'emoji',1);
remove_action('wp_head', 'wp_resource_hints', 2, 99 ); //disattiva i pre-fetching di default
add_filter( 'emoji_svg_url', '__return_false');
remove_filter('comment_text', 'convert_smilies', 20);
remove_filter('the_excerpt', 'convert_smilies');
remove_filter('the_content', 'convert_smilies');
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('admin_print_styles', 'print_emoji_styles');
remove_action('init', 'smilies_init', 5);
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10);
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'wp_shortlink_wp_head', 10);
remove_action('wp_head', 'wp_oembed_add_discovery_links');
remove_action( 'wp_head', 'rest_output_link_wp_head' );
remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
remove_action( 'template_redirect', 'rest_output_link_header', 11 );
remove_action( 'wp_head', 'wp_oembed_add_host_js' );
remove_action( 'wp_head', 'rel_canonical' );
remove_action( 'wp_head', 'robots' );
/*FINE rimozione schifezze da wp-head */
//Disabilito Gutenberg
function remove_wp_block_library_css(){
    wp_dequeue_style( 'wp-block-library' );
		 wp_dequeue_style( 'global-styles' );
    wp_dequeue_style( 'wp-block-library-theme' );
    wp_dequeue_style( 'wc-block-style' ); //disabilito i blocchi predefiniti di WooCommerce
}
add_action( 'wp_enqueue_scripts', 'remove_wp_block_library_css', 100 );
/*rimuovere da 5.9.2 */
// Remove Global Styles and SVG Filters from WP 5.9.1 - 2022-02-27
function remove_global_styles_and_svg_filters() {
	remove_action( 'wp_enqueue_scripts', 'wp_enqueue_global_styles' );
	remove_action( 'wp_body_open', 'wp_global_styles_render_svg_filters' );
}
add_action('init', 'remove_global_styles_and_svg_filters');

// This snippet removes the Global Styles and SVG Filters that are mostly if not only used in Full Site Editing in WordPress 5.9.1+
// Detailed discussion at: https://github.com/WordPress/gutenberg/issues/36834
// WP default filters: https://github.com/WordPress/WordPress/blob/7d139785ea0cc4b1e9aef21a5632351d0d2ae053/wp-includes/default-filters.php
// remove wp version number from scripts and styles
function remove_css_js_version( $src ) {
    if( strpos( $src, '?ver=' ) )
        $src = remove_query_arg( 'ver', $src );
    return $src;
}
add_filter( 'style_loader_src', 'remove_css_js_version', 9999 );
add_filter( 'script_loader_src', 'remove_css_js_version', 9999 );
/*fine rimuovere da 5.9.2 */
/* Rimozione "commenti" dal menu admin */
add_action( 'admin_init', 'my_remove_admin_menus' );
function my_remove_admin_menus() {
    remove_menu_page( 'edit-comments.php' );
}

/* Fine rimozione commenti dal menu admin */
//wordpre di default rimuove i tag p e br che tu aggiungi se scrivi da -visualizzazione html- nel suo editor, con le due seguenti impostazion evitiamo che esso modifichi ciò che scriviamo noi.
remove_filter('the_content', 'wpautop');
remove_filter('the_excerpt', 'wpautop');
//togliamo il box tag in redazione articoli
add_action( 'admin_menu', 'remove_backend_meta_box');
function remove_backend_meta_box() {
    remove_meta_box ( 'tagsdiv-post_tag', 'post', 'side');
}
/*usare html nei riassunti*/
function custom_tptn_trim_excerpt( $text, $id ) {
	$raw_excerpt = $text;

	$text = get_the_content( null, false, $id );

	$text = strip_shortcodes( $text );

	$text = apply_filters( 'the_content', $text );
	$text = str_replace( ']]>', ']]>', $text );

	/***Add the allowed HTML tags separated by a comma.*/
	$allowed_tags = '<br>,<li>,<p>,<strong>';
	$text = strip_tags( $text, $allowed_tags );

	/***Change the excerpt word count.*/
	$excerpt_length = 60;
	$excerpt_length = apply_filters( 'excerpt_length', $excerpt_length );

	/*** Change the excerpt ending.*/
	$excerpt_end  = ' <a href="' . get_permalink( $id ) . '">&raquo; Continue Reading.</a>';
	$excerpt_more = apply_filters( 'excerpt_more', ' ' . $excerpt_end );

	$words = preg_split( "/[\n\r\t ]+/", $text, $excerpt_length + 1, PREG_SPLIT_NO_EMPTY );
	if ( count( $words ) > $excerpt_length ) {
		array_pop( $words );
		$text = implode( ' ', $words );
		$text = $text . $excerpt_more;
	}
	return apply_filters( 'wp_trim_excerpt', $text, $raw_excerpt );
}
remove_filter( 'wp_robots', 'wp_robots_max_image_preview_large' );
remove_filter( 'wp_robots', 'wp_robots_noindex_nofollow' );
add_action( 'init', 'remove_wc_page_noindex' );
function remove_wc_page_noindex() {
    remove_action( 'wp_head', 'wc_page_noindex' );
}
/* ABILITARE LE IMMAGINI PREDEFINITE */
add_theme_support( 'post-thumbnails' );
set_post_thumbnail_size( 120, 68, true );
function rimuove_formati_standard($sizes) { unset($sizes['thumbnail']); unset($sizes['medium']); unset($sizes['medium_large']); unset($sizes['large']); return $sizes; }
add_filter('intermediate_image_sizes_advanced', 'rimuove_formati_standard');
/* FINE ABILITARE LE IMMAGINI PREDEFINITE */
/* INIZIO DEFINIZIONE MULTIFORMATO */
add_image_size( '1x1_240', 240, 240, array('center','center') ); #quadrata mobile
add_image_size( '1x1_275', 275, 275, array('center','center') ); #quadrata mobile
add_image_size( '1x1_375', 375, 375, array('center','center') ); #quadrata mobile
add_image_size( '1x1_500', 500, 500, array('center','center') ); #quadrata
add_image_size( '1x1_640', 640, 640, array('center','center') ); #quadrata
add_image_size( '16x9_240', 240, 135, false ); #post mobile
add_image_size( '16x9_360', 640, 360, false ); #post tablet
add_image_size( '16x9_576', 1024, 576, false ); #post
add_image_size( '27x9_640', 1920, 640, array('center','center') ); #banner
add_image_size( '27x9_342', 1024, 342, array('center','center')  ); #banner tablet
add_image_size( '27x9_106', 320, 106, array('center','center')  ); #banner mobile
add_image_size( '16x9_1920-default', 1920, 1080, true ); #versione 16x9
add_image_size( '1x1_1080-default', 1080, 1080, true ); #versione 1x1
add_image_size( '4x3_1280-default', 1280, 960, true ); #versione 4x3

/* INIZIO disabilitare default nell'editor */
/*function custom_wp_image_editors($editors) { array_unshift($editors, "custom_WP_Image_Editor"); return $editors; }
add_filter('wp_image_editors', 'custom_wp_image_editors');*/
/* FINE disabilitare default nell'editor*/
/* MODIFICA SCRIPT IMMAGINI NELL'EDITOR */
/* Modificare script di caricamento delle immagini inserendo SRCSET e SIZES del tema */
// define the image_send_to_editor callback
function img_srcset_and_sizes_for_classic_editor( $html, $id, $caption, $title, $align, $url, $size, $alt ) {
 list( $img_src, $width, $height ) = image_downsize($id, $size);
 //	$hwstring = image_hwstring($width, $height);
 $image_thumb = wp_get_attachment_image_src( $id, $size );
 $gcm_url = site_url('', 'https');
 $src = str_replace($gcm_url,"",$image_thumb[0]);
 $src = str_replace(".jpg","",$src);
 $src = str_replace($gcm_url,"",$src);
 $html = "<figure class=\"\">"; //circondo l'img con figure
$html .= "
<img src=\"$src.jpg\" alt=\"$alt\" title=\"$alt\" class=\"\"
srcset=\"{$src}-240x135.jpg 240w,
{$src}-640x360.jpg 640w,
{$src}.jpg 1024w\"
sizes=\"(max-width: 319px) 240px,
(max-width: 1023px) 640px,
1024px\" />";
$html .= '<figcaption>'. $caption .'</figcaption>
</figure>';
return $html;
};
add_filter( 'image_send_to_editor', 'img_srcset_and_sizes_for_classic_editor', 10, 8 );
/* FINE MODIFICA SCRIPT IMMAGINI NELL'EDITOR */
/* FINE DEFINIZIONE MULTIFORMATO */

/* INIZIO estrazione valori da categoria */
function dati_archive($id){
$dati = get_category($id);
$array = array();
if ( ! empty( $dati ) ) {
$array[0] = esc_html( $dati->term_id );
$array[1] = esc_html( $dati->name );
$array[2] = esc_html( $dati->slug );
$desc = esc_html( $dati->description );
$termeta = get_term_meta($array[0]);
$meta = array();
foreach($termeta as $key=>$val){ $meta[] = $val[0]; }
$array = implode("|||||",$array);
$meta = implode("|||||",$meta);
$array = "{$array}|||||{$meta}";
$array = "{$array}|||||{$desc}";
$array = explode("|||||",$array);
return $array;
}
}
/*	FINE estrazione valori da categoria */

/* INIZIO SHORTCODE SECTION */
// estrai categorie di primo livello
function estrai_categorie_livello1_shortcode() {
$parte1 = "<div class=\"container container-prodotti\"><h2>Sfoglia il catalogo TENOX</h2>
            <div class=\"columns is-multiline is-centered is-variable is-8\">";
						$parte3 = "</div></div>";
						$parte2 = array();
						$oggetto_id = 6; //genitore di queste categorie è la categoria "prodotti/"
						$dati = dati_archive($oggetto_id);
						dati_archive($oggetto_id);
						$id = $dati[0];
						$cats = array('child_of' => $id);
						$categorie_inferiori = get_categories( $cats );
						if(count($categorie_inferiori) > 0){
						foreach($categorie_inferiori as $CAT_LIV1){
							$C = get_category( $CAT_LIV1 ); //IL PADRE deve esssere solo 'prodotti/'
							$padre = esc_html( $C->category_parent );
							if($padre == $oggetto_id){
						$valori = dati_archive($CAT_LIV1);
						if(isset($valori)){
							$id = $valori[0];
							$h1 = $valori[1];
							$slug = $valori[2];
							$ancora_testuale = $valori[7];
							$descrizione_breve = $valori[11];
}
							$foto_copertina = pods_field_display( 'category', $id, 'immagine_di_copertina' );
								$foto1 = pods_field_display( 'category', $id, 'immagine_in_evidenza' );
								$foto_copertina = str_replace("https://www.tenox.it/foto/","", $foto_copertina);
								$foto_copertina = str_replace("-120x68","",$foto_copertina);
								$foto_copertina = str_replace(".jpg","",$foto_copertina);
								$foto1 = str_replace("https://www.tenox.it/foto/","", $foto1);
								$foto1 = str_replace("-120x68","",$foto1);
								$foto1 = str_replace(".jpg","",$foto1);


							/*$parte2[] = "<div class=\"column is-3\">
											<div class=\"card\">
												<div class=\"card-image\">
													<figure>
														<img src=\"/foto/$foto1.jpg\" alt=\"$h1\" title=\"$ancora_testuale\"
															srcset=\"/foto/$foto1-240x240.jpg 240w,
																	/foto/$foto1-275x275.jpg 275w,
																	/foto/$foto1-375x375.jpg 375w,
																	/foto/$foto1-500x500.jpg 500w\"
															sizes=\"(max-width: 274px) 240px,
																	(max-width: 374px) 275px,
																	(max-width: 499px) 375px,
																	500px\" />
													</figure>
												</div>
												<div class=\"card-content\">
													<div class=\"content has-text-centered\">
														<a href=\"/prodotti/$slug/\" class=\"is-3 is-uppercase\">
															$ancora_testuale
														</a>
													</div>
												</div>                        
											</div>
										</div>";*/

										$parte2[] = "<div class=\"column is-3\">
											<div class=\"card\">	
												<figure>
													<img src=\"/foto/$foto1.jpg\" alt=\"$h1\" title=\"$ancora_testuale\"
														srcset=\"/foto/$foto1-240x240.jpg 240w,
																/foto/$foto1-275x275.jpg 275w,
																/foto/$foto1-375x375.jpg 375w,
																/foto/$foto1-500x500.jpg 500w\"
														sizes=\"(max-width: 274px) 240px,
																(max-width: 374px) 275px,
																(max-width: 499px) 375px,
																500px\" />
												</figure>   
												<div class=\"content\">
													<a href=\"/prodotti/$slug/\" class=\"is-3 is-uppercase\">
														$ancora_testuale
													</a>
												</div>                   
											</div>
										</div>";
}
}
}
$parte2 = implode("",$parte2);
// Things that you want to do.
$message = "$parte1
$parte2
$parte3";
// Output needs to be return
return $message;
}
add_shortcode('livello1', 'estrai_categorie_livello1_shortcode');
// fine estrai categorie primo livello

// estrai settori
function estrai_settori_shortcode(){
	$loop = new WP_Query(array(
	'post_type'      => 'post',
	'orderby'        => 'meta_value',
	'category_name' => 'macchinari-pulizia',
	'order' => 'ASC',
	'post_status' => 'publish',
	'meta_key'       => 'ordinamento',
	'posts_per_page' => 7
	));
	if($loop->have_posts()){
		$message = array();
		$message[] = "<section class=\"sectionthree\"><div class=\"columns is-multiline is-centered\">";
	while ($loop->have_posts()){
	$loop->the_post();
	$ord = get_post_meta(get_the_ID(), 'ordinamento', true);
	$src = get_the_post_thumbnail_url();
	$src = str_replace("https://www.tenox.it/foto/","",$src);
	$src = str_replace(".jpg","",$src);
	$src = str_replace("-120x68","",$src);
	$p = get_the_ID();
	$h1 = get_the_title();
	$ancoraseo = get_post_meta(get_the_ID(), 'ancora_testuale', true);
	$perma = get_the_permalink(); $perma = str_replace("https://www.tenox.it","",$perma);
	$excerpt = get_the_excerpt();
	$visibilita = get_post_meta(get_the_ID(), 'visibile_in_categoria', true);
	if($visibilita != "NO"){
		if($h1 != "Imprese di pulizia") {

			$message[] =	"<div class=\"column is-one-third\">
								<section class=\"box box-1\">
									<figure class=\"image is-square\">
										<img src=\"/foto/$src.jpg\" alt=\"$ancoraseo\" title=\"$excerpt\" srcset=\"/foto/$src-240x240.jpg 240w, /foto/$src-275x275.jpg 275w, /foto/$src-375x375.jpg 375w, /foto/$src-500x500.jpg 500w\"
										sizes=\"(max-width: 274px) 240px,
										(max-width: 374px) 275px,
										(max-width: 499px) 375px,
										500px\"
										/>
									</figure>
									<div class=\"trapezoid\">
										<div class=\"trapezoid-text\">
											<h3><a href=\"$perma\" title=\"$h1\">$ancoraseo</a></h3>
											<p><a href=\"$perma\" title=\"$h1\">$excerpt</a></p>
										</div>
										<a href=\"$perma\" title=\"$h1\">
										<div class=\"arrow\">
											<div class=\"arrow-top\"></div>
											<div class=\"arrow-bottom\"></div>
										</div>
										</a>
									</div>
								</section>
							</div>";
		} else {
			$message[] =	"<div class=\"column is-full col-imprese-pulizia\">
								<h2>$h1</h2>
								<p>$excerpt</p>
								<a class=\"btn-parallelogram\" href=\"$perma\" rel=\"nofollow\">
                    				<span class=\"skew-fix\">richiedi preventivo</span>
                				</a>
							</div>";

		}
	}
	}
		$message[] = "</div></section>";
		$message = implode("",$message);

		return $message;
	}
		}
add_shortcode('settori', 'estrai_settori_shortcode');
// fine estrai settori
// estrai servizi
function estrai_servizi_shortcode() {
	$loop = new WP_Query(array(
	'post_type'      => 'post',
	'orderby'        => 'meta_value',
	'category_name' => 'servizi',
	'order' => 'ASC',
	'post_status' => 'publish',
	'meta_key'       => 'ordinamento',
	'posts_per_page' => -1
	));
	$parte1 = "<section class=\"sectionfour\">
	<div class=\"container has-text-centered\">
						<h2 class=\"title\">Ti guidiamo nell'acquisto</h2>
				</div>
				<div class=\"container container-guida-acquisto\">
			            <div class=\"columns is-multiline is-centered\">
				";
			if($loop->have_posts()){
		$message = array();
		$n = 1;
	while ($loop->have_posts()){
	$loop->the_post();
	$ord = get_post_meta(get_the_ID(), 'ordinamento', true);
	$promuovere = get_post_meta(get_the_ID(), 'in_evidenza', true);
	$src = get_the_post_thumbnail_url();
	$src = str_replace("https://www.tenox.it/foto/","",$src);
	$src = str_replace(".jpg","",$src);
	$src = str_replace("-120x68","",$src);
	$p = get_the_ID();
	$t = get_the_title();
	$ancoraseo = get_post_meta(get_the_ID(), 'ancora_testuale', true);
	$perma = get_the_permalink(); $perma = str_replace("https://www.tenox.it","",$perma);
	$excerpt = get_the_excerpt();
	if($n == 1){$pic = "star";}
	if($n == 2){$pic = "gear";}
	if($n == 3){$pic = "phone";}
if($promuovere == 1){ //Yes promuovi SI
	$message[] =	"<div class=\"column is-one-third has-text-centered\">
                    <figure class=\"img-icon\">
<img alt=\"icona $pic\" src=\"/foto/$pic.png\"/>
                    </figure>
                    <div class=\"content\">
						<h3>$ancoraseo</h3>
		<p>$excerpt</p>
		</div>
	                    <a class=\"btn-parallelogram\" href=\"$perma\">
	                        <span class=\"skew-fix\">scopri di più</span>
	                    </a>
	                </div>




	";
$n++;
}//end se promuovi == SI
}
}
$message = implode("",$message);
$message = "$parte1 $message </div></div></section>";
return $message;
}
add_shortcode('servizi', 'estrai_servizi_shortcode');
// fine estrai servizi


// estrai servizi
function contattaci_shortcode() {
		$message =	"<section class=\"sectiontwo\">
        <div class=\"container\">
            <div class=\"columns is-vcentered is-multiline\">
                <div class=\"column is-three-quarters\">
                    <h2 class=\"title\">Contattaci e richiedi una <span class=\"upper\">consulenza gratuita</span></h2>
                    <p class=\"subtitle\">
                        Ti guideremo con professionalità verso l’acquisto del prodotto più adatto alle tue esigenze
                    </p>
                </div>
                <div class=\"column phone\">
                    <a href=\"tel:+39072125001\">
                        <svg class=\"svg\" xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 512 512\">
                                    <path d=\"M511.2 387l-23.25 100.8c-3.266 14.25-15.79 24.22-30.46 24.22C205.2 512 0 306.8 0 54.5c0-14.66 9.969-27.2 24.22-30.45l100.8-23.25C139.7-2.602 154.7 5.018 160.8 18.92l46.52 108.5c5.438 12.78 1.77 27.67-8.98 36.45L144.5 207.1c33.98 69.22 90.26 125.5 159.5 159.5l44.08-53.8c8.688-10.78 23.69-14.51 36.47-8.975l108.5 46.51C506.1 357.2 514.6 372.4 511.2 387z\"></path>
                                </svg>
                        <span>0721 25001</span>
                    </a>
                </div>
            </div>
        </div>
    </section>";
return $message;
}
add_shortcode('contattaci', 'contattaci_shortcode');
function presentazione_aziendale_shortcode(){
$msg = "<section class=\"sectionfive\"><div class=\"container container-azienda\">
<div class=\"columns is-multiline is-vcentered is-centered is-variable is-6\">
<div class=\"column col-text is-6\">
<h2 class=\"title\">Costruzioni Tenox</h2>
<p>Da sempre ci occupiamo di macchine per la pulizia industriale e professionale ad alta pressione e di installazione di impianti fissi per aziende alimentari e manifatturiere e di impianti di autolavaggio (portali e box self service).<br /><br /></p>
<a class=\"btn-parallelogram\" href=\"/azienda/\"><span class=\"skew-fix\">Scopri di più</span></a>
</div>
<div class=\"column col-img is-5\">
<figure class=\"\">
<img src=\"/foto/tenox-1950.jpg\" alt=\"\" title=\"\" class=\"\"
srcset=\"/foto/tenox-1950-240x135.jpg 240w,
/foto/tenox-1950-640x360.jpg 640w,
/foto/tenox-1950.jpg 1024w\"
sizes=\"(max-width: 319px) 240px,
(max-width: 1023px) 640px,
1024px\" />
</figure>
</div>
<div class=\"columns is-multiline is-vcentered is-centered is-variable is-6 reverse-columns\">
<div class=\"column col-img is-5\">
<figure class=\"\">
<img src=\"/foto/tenox-pulizia-industrie.jpg\" alt=\"\" title=\"\" class=\"\"
srcset=\"/foto/tenox-pulizia-industrie-240x135.jpg 240w,
/foto/tenox-pulizia-industrie-640x360.jpg 640w,
/foto/tenox-pulizia-industrie.jpg 1024w\"
sizes=\"(max-width: 319px) 240px,
(max-width: 1023px) 640px,
1024px\" />
</figure>
</div>
<div class=\"column col-text is-6\">
<h2 class=\"title\">Hai Un'impresa Di Pulizia?</h2>
Dal 1980 siamo inoltre specializzati anche nel settore delle macchine per la pulizia industriale professionale, riferendosi non solo ad aziende e privati ma anche ad imprese di pulizie per lavori di pulizia professionale. <br /><br />
<a class=\"btn-parallelogram\" href=\"/macchinari-pulizia/imprese-di-pulizia.html\">
<span class=\"skew-fix\">scopri di più</span>
</a>
</div>
</div></section>";
return $msg;
}
add_shortcode('presentazione-aziendale','presentazione_aziendale_shortcode');



// estrai categorie di secondo livello
function estrai_categorie_livello2_shortcode( $questa ) {
	$questa = shortcode_atts(
	array(
		'questa_categoria' => '6'
), $questa, 'livello2');
	$questa_categoria = $questa['questa_categoria'];
$parte1 = "<div class=\"container container-prodotti\"><h2>Altre tipologie di prodotto</h2>
            <div class=\"columns is-multiline is-centered is-variable is-8\">";
						$parte3 = "</div></div>";
						$parte2 = array();
						$categorie_da_escludere = array();
						$parent = get_category($questa_categoria); $parent = $parent->parent;
						$cats = array('child_of' => $parent);
						$altre_cat_lvl2 = get_categories( $cats );
						$livs = array();
						foreach($altre_cat_lvl2 as $catl2){
						if(!in_array($catl2->term_id,$livs)){
						$livs[] = $catl2->term_id;
						}
						}
						foreach($livs as $oggetto_id){
						$dati = dati_archive($oggetto_id);
						$valori = dati_archive($oggetto_id);
						$id = $dati[0];
						$id = $valori[0];
							$h1 = $valori[1];
							$slug = $valori[2];
							$category_link = get_category_link($id);
								$category_link = str_replace("https://www.tenox.it/./","/", $category_link);
							$ancora_testuale = $valori[7];
							$descrizione_breve = $valori[11];
							$foto_copertina = pods_field_display( 'category', $id, 'immagine_di_copertina' );
								$foto1 = pods_field_display( 'category', $id, 'immagine_in_evidenza' );
								$foto_copertina = str_replace("https://www.tenox.it/foto/","", $foto_copertina);
								$foto_copertina = str_replace("-120x68","",$foto_copertina);
								$foto_copertina = str_replace(".jpg","",$foto_copertina);
								$foto1 = str_replace("https://www.tenox.it/foto/","", $foto1);
								$foto1 = str_replace("-120x68","",$foto1);
								$foto1 = str_replace(".jpg","",$foto1);


							$parte2[] = 
							"<div class=\"column is-3\">
                    			<div class=\"card\">
                        			<figure>
											<img src=\"/foto/$foto1.jpg\" alt=\"$h1\" title=\"$ancora_testuale\"
												srcset=\"/foto/$foto1-240x240.jpg 240w,
													/foto/$foto1-275x275.jpg 275w,
													/foto/$foto1-375x375.jpg 375w,
													/foto/$foto1-500x500.jpg 500w\"
												sizes=\"(max-width: 274px) 240px,
													(max-width: 374px) 275px,
													(max-width: 499px) 375px,
													500px\" />
									</figure>
									<div class=\"content\">
                        				<a href=\"$category_link\" class=\"is-3 is-uppercase\">
                                    		$ancora_testuale
										</a>
									</div>
								</div>
							</div>";
}

$parte2 = implode("",$parte2);
$message = "$parte1
$parte2
$parte3";
return $message;
}
add_shortcode('livello2', 'estrai_categorie_livello2_shortcode');

// estrai prodotti_correlati
function estrai_prodotti_correlati_shortcode( $questa ) {
	$questa = shortcode_atts(
	array(
		'slug_categoria' => 'prodotti',
		'id_prodotto' => 'null'
), $questa, 'prodotti_correlati');
	$slug_categoria = $questa['slug_categoria'];
	$id_prodotto = $questa['id_prodotto'];
$parte1 = "<div class=\"container\">
	<div class=\"columns is-multiline\">";
						$parte3 = "</div></div>";
						$parte2 = array();
$loop = new WP_Query(array(
						'post_type'      => 'post',
						'orderby'        => 'meta_value',
						'category_name' => $slug_categoria,
						/*'category__not_in' => $categorie_da_escludere,*/
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
						if($p != $id_prodotto){
						$t = get_the_title();
						$ancoraseo = get_post_meta(get_the_ID(), 'ancora_testuale', true);
						$perma = get_the_permalink(); $perma = str_replace("https://www.tenox.it","",$perma);
						$excerpt = get_the_excerpt();
						$visibilita = get_post_meta(get_the_ID(), 'visibile_in_categoria', true);
						$parte2[] = "<div class=\"column is-3\">
						<figure>
							<img src=\"/foto/$src.jpg\" title=\"$ancoraseo\"
							srcset=\"/foto/$src-240x240.jpg 240w\" sizes=\"240px\" />
						</figure>
						<a rel=\"nofollow\" href=\"$perma\" title=\"$t\">
							<div class=\"content\">
								<h2 class=\"h2-minor btn-parallelogram\">
									<span class=\"skew-fix\">
										$ancoraseo
									</span>
								</h2>
							</div>
						</a>
						
						</div>";
						}else{$parte2[] = "";}
}
}
$parte2 = implode("",$parte2);
// Things that you want to do.
$message = "$parte1
$parte2
$parte3";
// Output needs to be return
return $message;
}
add_shortcode('prodotti_correlati', 'estrai_prodotti_correlati_shortcode');

































function briciola_di_pane($id_categoria,$h1,$ancora_testuale){
$path = array();
$path = get_category($id_categoria);
$gen = $path->parent;
$child_path = array('child_of' => $id_categoria);
$parentela = array();
$gene = $gen;
while($gene != 0){
$parente_di_gene = get_category($gene);
$gene = $parente_di_gene->parent;
$parentela[] = $gene;
$n = count($parentela)-1;
$gene = $parentela[$n];
}
$parentela[] = $gen;
$children = get_categories( $child_path );
$percorso = array();
$percorso[] = "<section class=\"section-breadcrumb\"><div class=\"container\"><nav class=\"breadcrumb\" aria-label=\"breadcrumb\"><ol><li><a href=\"/\" title=\"Macchinari industriali per la pulizia\">Homepage di Tenox</a></li>";
if($gen != 0){
foreach($parentela AS $parente){
	if($parente != 0){
$d = dati_archive($parente);
if(isset($d)){
$parola = $d[7];
$link = $d[2];
$link = get_category_link($parente);
$titolo = $d[1];
$percorso[] = "<li><a href=\"$link\" title=\"$titolo\">$parola</a></li>";
}
}
}
}
$link = get_category_link($id_categoria);
$percorso[] = "<li class=\"current-crumb\"><a href=\"$link\" title=\"$ancora_testuale\">$h1</a></li>";
if(is_singular()){
	$pid_ = get_the_id();
	$plink = get_the_permalink();
	$ph1 = get_the_title();
	$percorso[] = "<li class=\"current-crumb\"><a href=\"$plink\" title=\"$ph1\">$ph1</a></li>";
}
$percorso[] = "</ol></nav></div></section>";
$percorso = implode("", $percorso);
echo $percorso;
}














//BRICIOLE DI Pane
function briciole_di_pane(){echo("");}
//FINE BRICIOLE DI Pane
/* FINE SHORTCODE SECTION */
