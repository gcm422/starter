<?php
/* Template Name: Istituzionale */
/* Template Post Type: post */
get_header();
?>
<!-- fine header -->
<?php
if ( have_posts() ) {
while ( have_posts() ) {
the_post();
$hero_image = get_the_post_thumbnail_url();
$hero_image = str_replace("https://www.tenox.it/foto/","", $hero_image);
$hero_image = str_replace("-120x68","",$hero_image);
$hero_image = str_replace(".jpg","",$hero_image);
?>
<section class="section-featured-image">
<figure class="figure-featured-image">
<img src="/foto/<?=$hero_image?>.jpg" class="img-featured-image" alt="<?=get_the_title();?>" title="<?=get_the_title();?>" srcset="/foto/<?=$hero_image?>-320x106.jpg 320w,
/foto/<?=$hero_image?>-1024-342.jpg 1024w,
/foto/<?=$hero_image?>-1920x640.jpg 1920w"
sizes="(max-width: 321px) 320px,
(max-width: 1024px) 1024px,
1920px" />
<div class="columns is-mobile is-centered is-vcentered overlay-title">
<div class="column is-narrow">
<h1 class="is-size-4-mobile"><?php echo get_the_title(); ?></h1>
</div>
</div>
</figure>
</section>
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
<section class="section-contenuto section-contatti">
<div class="container">
<?php the_content(); ?>
</div>
</section>

<!--
<?php //echo do_shortcode('[servizi]'); ?>
<div class="container container-settori"><?php //echo do_shortcode('[settori]'); ?></div>-->
<?php  }
}
?>
<?php
get_footer();
?>
