 <div class="card">
     <!-- pour afficher l'image the_post_thumbnail()-->
     <!-- le premier paramètre coresspond à la taille on peut mettre medium si on souhaite pas avoir de grosse image autrement corespond à la taille originale 'post-thumbnail' ensuite on a des attributs et styles css-->
     <?php the_post_thumbnail('post-thumbnail', ['class' => 'card-img-top', 'alt' => '', 'style' => 'height:auto;']) ?>
     <div class="card-body">
         <!-- pour afficher les titre the_title() -->
         <h5 class="card-title"><?php the_title() ?></h5>
         <!-- pour afficher les catégories the_category() -->
         <h6 class="card-subtitle mb-2 text-muted"><?php the_category() ?></h6>
         <!-- the_terms pour afficher les termes associé à une taxonomies 
                        1er parametre 1 id qui correspond à l’article donc la function get_the_ID, 2è paramètre la toxonimie à utiliser 'sport'. On veut que avant il y est un <li> et entre les éléments </li><li> et fermer le </li>-->
         <ul>
             <?php
                the_terms(get_the_ID(), 'sport', '<li>', '</li><li>', '</li>');
                ?>
         </ul>

         <!-- pour récupérer l'extrait associer à un article' -->
         <p class="card-text">
             <?php the_excerpt() ?></p>
         <!-- avec un lien a href on peut avec the_permalink() générer le lien vers un permalink -->
         <a href="<?php the_permalink() ?>" class="card-link">Voir plus</a>
     </div>
 </div>