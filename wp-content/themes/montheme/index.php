<?php get_header() ?>


<!-- on récupère le tableau des terms,on veut utiliser les terms de la taxonomy sport, -->
<?php $sports = get_terms(['taxonomy' => 'sport']); ?>
<ul class="nav nav-pills my-4">
    <!-- on boucle sur les terms pour récuperer tout les terms
pour chaque sport on veut afficher un li-->
    <?php foreach ($sports as $sport) : ?>
        <!-- si on fait ?= $sport->name on récupère le nom du sport -->
        <li class="nav-item">
            <!-- get_term_link($sport) pour que mes liens de taxonomie fonctionnne-->
            <!-- is_tax permet de vérifier si la requete actuelle concerne une taxonomie-->
            <!-- donc on fait une condition ici c'est du ternaire is_tax('sport', $sport->term_id) ? 'active' : '' , cela veut dire si on a une taxonomie 'sport' $sport correspond à l'id de la taxonomie, term_id permet de récupérer l'id -->
            <!-- donc si celà à cette class on rajoute ('active' ? 'active' ), sinon (:) on met rien-->
            <a href="<?= get_term_link($sport) ?>" class="nav-link <?= is_tax('sport', $sport->term_id) ? 'active' : '' ?>"><?= $sport->name ?></a>
        </li>
    <?php endforeach; ?>
</ul>

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