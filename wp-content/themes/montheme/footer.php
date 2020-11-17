</div>
<footer>
    <?php wp_nav_menu([
        'theme_location' => 'footer',
        'container' => false,
        'menu_class' => 'navbar-nav mr-auto'
    ]);
    //on veut utiliser le widget qu'on a crée pour les vidéo dans le footer grâce à la fonction the_widget
    // 1-l'instance c'est à dire ce qu'on doit envoyer avec un titre et youtube et l'id d'une vidéo youtube qui est après le = dans l'url de la vidéo de youtube
    //si on veut pas avoir des choses avant le titre on rajoute un 3-arguments avec 
    the_widget(YoutubeWidget::class, ['youtube' => 'e-NdjPo2udI'], ['after_widget' => '', 'before_widget' => '']);
    ?>
</footer>
<div>
    <!-- on affiche les horaires -->
    <?= get_option('agence_horaire') ?>
</div>
<?php wp_footer() ?>
</body>

</html>