<?php get_header() ?>

<h1>Voir tous nos biens</h1>
<!-- condition est ce qu'il y a des articles -->
<?php if (have_posts()) : ?>
    <div class="row">

        <?php while (have_posts()) : the_post(); ?>
            <div class="col-sm-4">
                <!-- on charge card de card.php qui contient la card et à un style pour les articles 'post', get_template_part permet d’inclure un autre élément différence par rapport au include cela permet de surcharger les page avec d’autre système si plutard on souhaite changer -->
                <!-- donc si il trouve un fichier card-post il l'utilisera autrement il utilise card.php -->
                <?php get_template_part('parts/card', 'post'); ?>
            </div>
        <?php endwhile ?>

    </div>
    <!-- on appelle la fonction qu'on a crée -->
    <?php montheme_pagination() ?>

    <!-- // pour avoir plusieurs page la pagination ?php the_posts_pagination()ou alors faire ?= paginate_link();-->
    <!-- on peut aussi au au de faire une pagination mettre page précedente et page suivante avec:
                        ?= next_posts_link(); ?
                        ?= previous_post_link(); ?elseon n'oubli pas les >< avant et après le code -->
    <?= paginate_links(); ?>
<?php else : ?>
    <h1>Pas d'articles</h1>
<?php endif; ?>

<?php get_footer() ?>