<?php
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
<img src="/foto/<?=$hero_image?>.jpg" class="img-featured-image" alt="<?=get_the_title();?>" title="<?=get_the_title();?>"
srcset="/foto/<?=$hero_image?>-320x106.jpg 320w,
/foto/<?=$hero_image?>-1024-342.jpg 1024w,
/foto/<?=$hero_image?>-1920x640.jpg 1920w"
sizes="(max-width: 321px) 320px,
(max-width: 1024px) 1024px,
1920px" />
<div class="overlay"></div>
<div class="container has-text-left">
<div class="column is-three-quarters-mobile">
<h1 class="title is-size-4-mobile"><?php $ancora_testuale = get_post_meta(get_the_id(), 'ancora_testuale', true); echo $ancora_testuale; ?></h1>
</figure>
</section>
<?php the_content(); ?>
<?php  }} ?>

<?php
get_footer();
?>
