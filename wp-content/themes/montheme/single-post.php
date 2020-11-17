<?php get_header() ?>
<!-- si il y a des post alors tant qu'il y en a affiche les postes -->
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <h1><?php the_title() ?></h1>
        <!-- get_the_ID() pour l'id en coursdans la class SponsoMetaBox et on utilise la clé META_KEY, 3eme paramètre single qui est true-->
        <?php if (get_post_meta(get_the_ID(), SponsoMetaBox::META_KEY, true) === '1') : ?>
            <div class="alert alert-info">Cet article est sponsorisé</div>
        <?php endif ?>

        <!-- on utilise the_post_thumbnail_url() pour pouvoir mettre du style avec une hauteur et largeur -->
        <p><img src="<?php the_post_thumbnail_url() ?> " alt="" style="width:100%; heigth:auto;"></p>

        <!-- pour faire des commentaires sous les articles -->
        <?php the_content() ?>

        <?php
        // condition pour voir si les commentaires sont ouverts et on vérifie qu'il y a un nbre de commentaires >à 0
        //get_comments_number permet de récupérer le nbre de commentaires
        if (comments_open() || get_comments_number()) {
            //comments_template() permet de charger le template qui est responsable d'afficher les commentaires par default iol s'appelle comment.php
            comments_template();
        }
        ?>

        <!-- <php var_dump(get_the_ID()); ?> -->

        <h2>Articles relatifs</h2>

        <div class="row">
            <!-- on récupère différents enregistrement -->
            <?php
            $sports = array_map(function ($term) {
                return $term->term_id;
            }, get_the_terms(get_post(), 'sport'));

            $query = new WP_Query([
                'post__not_in' => [get_the_ID()],
                'post_type' => 'post',
                'posts_per_page' => 3,
                'orderby' => 'rand',
                'tax_query' => [
                    [
                        'taxonomy' => 'sport',
                        'terms' => $sports,
                    ]

                ],
                //permet de sortir seulement les articles sponsorisé
                'meta_query' => [
                    [
                        'key' => SponsoMetaBox::META_KEY,
                        'compare' => 'EXISTS'
                    ]
                ]
            ]);
            while ($query->have_posts()) : $query->the_post();
            ?>
                <div class="col-sm-4">
                    <!-- on charge card de card.php qui contient la card et à un style pour les articles 'post', get_template_part permet d’inclure un autre élément différence par rapport au include cela permet de surcharger les page avec d’autre système si plutard on souhaite changer -->
                    <!-- donc si il trouve un fichier card-post il l'utilisera autrement il utilise card.php -->
                    <?php get_template_part('parts/card', 'post'); ?>
                </div>
            <?php endwhile;
            wp_reset_postdata(); ?>
        </div>
<?php endwhile;
endif; ?>

<?php get_footer() ?>