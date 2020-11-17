<?php

//chargement des styles
//lorsque l'action wp_enqueue_scripts est appellé, je veux que tu appelles la function montheme_register_assets
add_action('wp_enqueue_scripts', function () {
    //pour prendre en compte le css du theme enfant
    wp_enqueue_style('montheme-child', get_stylesheet_uri());
    //on déenregistre les scripts, permet de désactiver ce qui a été fait par un theme parent
    //wp_deregister_style('bootstrap');
    //11 correspond à la priorité on met une supérieur pour ce cela soit prit en compte
}, 11);

//pour les traductions-c
add_action('after_setup_theme', function () {
    //on apelle une fonction qui va se charger d'appeler le theme
    //1er params le nom du theme et ensuite le chemin vers lequel il doit charger les choses
    load_child_theme_textdomain('montheme-enfant', get_stylesheet_directory() . '/languages');
});


add_filter('montheme_search_title', function () {
    //permet quand tu fait une recherche d'afficher le nom de ta recherche en sous titre
    return 'Recherche : %s';
});
