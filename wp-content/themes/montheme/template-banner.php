<?php

/**
 * Template Name: Page avec bannière
 * Template Post Type: page, post
 */
?>

<?php get_header() ?>
<!-- si il y a des post alors tant qu'il y en a affiche les postes -->
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <p>Ici la bannière</p>
        <h1><?php the_title() ?></h1>
        <!-- on utilise the_post_thumbnail_url() pour pouvoir mettre du style avec une hauteur et largeur -->
        <p><img src="<?php the_post_thumbnail_url() ?> " alt="" style="width:100%; heigth:auto;"></p>

        <?php the_content() ?>
<?php endwhile;
endif; ?>

<?php get_footer() ?>