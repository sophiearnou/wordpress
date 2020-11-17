<?php
//on crée une variable qui va stocker le nbre de commentaire grace à get_comments_number() permet de récuperer le nombre de commentaires
//absint car la fonction renvoi une chaine de caractère donc on doit convertir en nbre entier

use MonTheme\CommentWalker;

$count = absint(get_comments_number());
?>
<!-- 
on crée une condition -->
<!-- on affiche le nbre de commentaire avec une condition si count > 0 on affiche le s autrement rien -->

<?php if ($count > 0) : ?>
    <!-- on utilise la traduction -->
    <h2><?= sprintf(_n('%s Commentaire', '%s Commentaires', $count, 'montheme'), $count); ?></h2>
<?php else : ?>
    <h2>Laisser un commentaire</h2>
<?php endif ?>

<!-- on vérifie que les commentaires sont ouverts -->
<?php if (comments_open()) : ?>
    <!-- on affiche le formulaire -->
    <!-- title_reply pour le titre -->
    <?php comment_form(['title_reply' => '']) ?>
<?php endif ?>
<!-- wp_list_comments pour afficher la liste des commentaires -->
<?php wp_list_comments(['style' => 'div', 'walker' => new CommentWalker()]) ?>
<!-- mise en place de la pagination celà génère les liens lier à la pagination pour les commentaires-->
<?php paginate_comments_links() ?>