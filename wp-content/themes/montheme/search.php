<?php get_header() ?>

<form class="form-inline">
    <input type="search" name="s" class="form-control mb-2 mr-sm-2" value="<?= get_search_query() ?>" placeholder="Votre recherche">

    <div class="form-check mb-2 mr-sm-2">
        <input class="form-check-input" type="checkbox" value="1" name="sponso" id="inlineFormCheck" <?= checked('1', get_query_var('sponso')) ?>>
        <label class="form-check-label" for="inlineFormCheck">
            Articles sponsorisé seulement
        </label>
    </div>

    <button type="submit" class="btn btn-primary mb-2">Rechercher</button>
</form>
<!-- je veux que tu appliques un filtre 1er params un nom de filtre 'montheme_search_title'suivi de la valeur "Résultat pour votre recherche et on rajoute le mot clé %s  et en sd params  get_search_query() permet de récupérer ce qui a été demandé par l’utilisateur -->
<h1 class="mb-4"><?= sprintf(apply_filters('montheme_search_title', "Résultat pour votre recherche \"%s\""), get_search_query()) ?></h1>

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