<?php

require_once('walker/CommentWalker.php');
require_once('options/apparence.php');
function montheme_supports()
{
    //pour que le theme support le titre
    add_theme_support('title-tag');
    //pour que le theme support les images
    add_theme_support('post-thumbnails');
    //pour supporter les menus
    add_theme_support('menus');
    add_theme_support('html5');
    // register_nav_menu Permet d’enregistrer une nouvelle barre de navigation
    // premier paramètre id qui sera un id de localisation permet de savoir quel menu on veut afficher et 2ème description affiché au niveau du back office
    register_nav_menu('header', 'En tête du menu');
    register_nav_menu('footer', 'Pied de page');
    //support du format d'image
    //true pour croper donc si l'image n'a pas le bon ratio on centre
    add_image_size('post-thumbnail', 350, 215, true);
    // On peut remplacer des formats non utulisé par défaut dans wp
    //remove_image_size('medium');
    //add_image_size('medium', 500, 500);
}

//pour les styles bootstrap, js et jquey, popper
function montheme_register_assets()
{
    wp_register_style('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css', []);
    wp_register_script('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js', ['popper', 'jquery'], false, true);
    wp_register_script('popper', 'https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js', [], false, true);
    if (!is_customize_preview()) {
        wp_deregister_script('jquery');
        wp_register_script('jquery', 'https://code.jquery.com/jquery-3.5.1.slim.min.js', [], false, true);
    }

    wp_enqueue_style('bootstrap');
    wp_enqueue_script('bootstrap');
}

//2_filtre pour mettre | comme séparateur dans l'onglet
function montheme_title_separator()
{
    return '|';
}

//3_filtre
function montheme_document_title_parts($title)
{
    // //on obtient un tableau
    // var_dump($title);
    // die();

    //permet de filtrer ce qu'on met dans l'onglet
    // unset($title['tagline']);

    //si on veut rajout des pipes avec nom dans l'onglet
    $title['demo'] = 'Salut';
    return $title;
}

//2_filtre class de menu
//(array $classes): array    array sert à typer pour eviter les bug pas obligatoire
function montheme_menu_class(array $classes): array
{

    //on rajoute la class qu'on a dans bootstrap donc un nav-item
    $classes[] = 'nav-item';
    //il est important de retourner le premier paramètre car on est dans un filtre et non une action donc on doit tjs retourner quelque chose
    return $classes;

    // //permet de débuguer l'ensemble des arguments que l'on reçoit
    // var_dump(func_get_args());
    // die();
}

//2_filtre pour les liens de menu
function montheme_menu_link_class($attrs)
{
    //on rajoute la class qu'on a dans bootstrap donc un nav-link
    $attrs['class'] = 'nav-link';
    //il est important de retourner le premier paramètre car on est dans un filtre et non une action donc on doit tjs retourner quelque chose
    return $attrs;
}

// on crée une fonction pour personnaliser et générer la pagination
function montheme_pagination()
{
    // 'array' permet de récupérer l'ensemble des pages
    $pages = paginate_links(['type' => 'array']);
    //on fait une condition pour ne pas avoir d'erreur si pas besoin de pagination par rapport au nombre d'articles
    if ($pages === null) {
        return;
    }
    //my-4 pour avoir une marge en haut et en bas
    echo '<nav aria-label="Pagination" class="my-4">';
    //echo pour afficher le ul
    echo '<ul class="pagination">';

    // on parcours l'ensemble des pages avec foreach
    foreach ($pages as  $page) {
        //on crée une variable active on lui dit que ce sera string post et on cherche dans page le mot clé 'current' si çà n'a pas était retrouvé çà reoutrne false donc on met différent de false !==
        $active = strpos($page, 'current') !== false;
        //on rajoute une variable $class qui s'appelle page-item et si elle est active on rajoute à la class active
        $class = 'page-item';
        if ($active) {
            $class .= ' active';
        }

        //echo pour afficher le li et la conténation de la variable $class
        echo '<li class="' . $class . '">';
        // on affiche et on dit je veux que tu cherche page-numbers class par défaut de wp et je veux que tu la remplace par la class bootstrap page-link
        echo str_replace('page-numbers', 'page-link', $page);
        // on affiche la fermeture du </li>
        echo '<li>';
    }
    //var_dump($pages);
    // on affiche la fermeture du </ul>
    echo '</ul>';
    echo '</nav>';
}

//2_rajouter une taxodomie
//On crée la function montheme_init
function montheme_init()
{
    //on fait le register_taxonomy() qui crée nouvelle taxodomie
    //1er param le nom de la taxonomie c'est une clé on la nomme 'sport' 2e param on précise une chaine de caractere ou tableau qui sont les postes type qui sont supporté on veut mettre cela seulement sur les pages des articles donc on met 'post' en 3e param on a un tableau d'option qui permet de préciser tout un tras d'options Labels: spécifie le lable à utiliser ex le nom de la taxonomie name =>sport
    register_taxonomy('sport', 'post', [
        'labels' => [
            'name' => 'Sport',
            'singular_name'     => 'Sport',
            'plural_name'       => 'Sports',
            'search_items'      => 'Rechercher des sports',
            'all_items'         => 'Tous les sports',
            'edit_item'         => 'Editer le sport',
            'update_item'       => 'Mettre à jour le sport',
            'add_new_item'      => 'Ajouter un nouveau sport',
            'new_item_name'     => 'Ajouter un nouveau sport',
            'menu_name'         => 'Sport',
        ],
        //Pour que la Taxonomie soit accessible sur les articles
        //Permet de dire est ce que la taxonomie doit être inclus dans l’API REST cela doit être mis à True si on veut que la Taxonomie soit accessible dans l’éditeur de bloc
        'show_in_rest' => true,
        //Pour avoir des checkbox
        'hierarchical' => true,
        // show_in_menu permet d'afficher dans le menu d'administration de wp
        // show_in_nav_menus permets d'ajoute dans Apparence et Menus
        // show_ui permet d'afficher l'interface de gestion destaxodomie $public siginifie est ce qu'elle est accessible depuis le front
        //Permet d'afficher la gestion de la taxonomie au niveau de l'administration
        'show_admin_column' => true,

    ]);
    //permet d’enregistrer un nouveau contenu et avec dans la partie administrative on a un nouvel element Bien sous commentaires
    register_post_type('bien', [
        'label' => 'Bien',
        'public' => true,
        //position dans la barre de menu dashboard
        'menu_position' => 3,
        'menu_icon' => 'dashicons-building',
        'supports' => ['titre', 'editor', 'thumbnail'],
        //change le visuel met en bloc
        'show_in_rest' => true,
        //on veut une page d'archive
        'has_archive' => true,
    ]);
}


//1_rajouter une taxodomie
//On crée une nouvelle action que l’on va appeler init et brancher dessus une function que l’on va appeler montheme_init
add_action('init', 'montheme_init');
//after_setup_theme c'est un hook pour le titre dans l'onglet
add_action('after_setup_theme', 'montheme_supports');

//lorsque l'action wp_enqueue_scripts est appellé, je veux que tu appelles la function montheme_register_assets
add_action('wp_enqueue_scripts', 'montheme_register_assets');

//1_filtre ajout d'un filtre
add_filter('document_title_separator', 'montheme_title_separator');
//4_filtre
add_filter('document_title_parts', 'montheme_document_title_parts');
//1_filtre class de menu
add_filter('nav_menu_css_class', 'montheme_menu_class');
//1_filtre pour les liens de menu
add_filter('nav_menu_link_attributes', 'montheme_menu_link_class');


//on fait un require_once pour inclure le fichier sponso.php
require_once('metaboxes/sponso.php');
//on inclue la class AgenceMenuPage
require_once('options/agence.php');

SponsoMetaBox::register();
AgenceMenuPage::register();

//on se branche sur manage suivi du type de contenu ici bien suivi de _posts_columns, cela serza une function qui prendra en compte les colonnes et qui devra renvoyer les nouvelles colonne
add_filter('manage_bien_posts_columns', function ($columns) {
    return [
        'cb' => $columns['cb'],
        'thumbnail' => 'Miniature',
        'title' => $columns['title'],
        'date' => $columns['date']
    ];
});

//permet de récupérer l'image dans les colonne de l'administration des biens
add_filter('manage_bien_posts_custom_column', function ($column, $postId) {
    if ($column === 'thumbnail') {
        the_post_thumbnail('thumbnail', $postId);
    }
}, 10, 2);

//réduire la tailles des colonnes
add_action('admin_enqueue_scripts', function () {
    wp_enqueue_style('admin_montheme', get_template_directory_uri() . '/assets/admin.css');
});


//ajout colonne sponsoring on insert le sponsoring avant la colonne de date
add_filter('manage_post_posts_columns', function ($columns) {
    $newColumns = [];
    //on récupère la clé et la valeur
    foreach ($columns as $k => $v) {
        //on vérifie l'existance d'une clé
        if ($k === 'date') {
            //si on a la clé date on rajoute la new colonne sponso qui aura comme nom 'Article sponsorisé ?'
            $newColumns['sponso'] = 'Article sponsorisé ?';
        }
        $newColumns[$k] = $v;
    }
    return $newColumns;
});

//je stylise les colonnes
add_filter('manage_post_posts_custom_column', function ($column, $postId) {
    if ($column === 'sponso') {
        //si différent de vide
        if (!empty(get_post_meta($postId, SponsoMetaBox::META_KEY, true))) {
            $class = 'yes';
        } else {
            $class = 'no';
        }
        echo '<div class="bullet bullet-' . $class . '"></div>';
    }
}, 10, 2);


/**
 * @param WP_Query $query
 */
//on veut afficher que les articles sponsorié
function montheme_pre_get_posts($query)
{
    //is_main_query si ce n'est pas la requête principale

    if (is_admin() || !is_search() || !$query->is_main_query()) {
        return;
    }
    if (get_query_var('sponso') === '1') {
        $meta_query = $query->get('meta_query', []);
        $meta_query[] = [
            'key' => SponsoMetaBox::META_KEY,
            'compare' => 'EXISTS',
        ];
        $query->set('meta_query', $meta_query);
    }
}

function montheme_query_vars($params)
{
    $params[] = 'sponso';
    return $params;
    // var_dump($params);
    // die();
}
//j'apelle ma fonction montheme_pre_get_posts
add_action('pre_get_posts', 'montheme_pre_get_posts');
add_filter('query_vars', 'montheme_query_vars');


//on charge le fichier YoutubeWidget.php pour que le register_widget aille chercher la class YoutubeWidget
require_once 'widgets/YoutubeWidget.php';

//pour les widgets
function montheme_register_widget()
{
    //enregistrement de widget on met en paramètre le nom de la class
    register_widget(YoutubeWidget::class);

    register_sidebar([
        'id' => 'homepage',
        //pour la traduction on utilise "__" 1erparams la chaine à traduire 'Sidebar Accueil', 2èparams le domaine à utiliser. Le domaine correspond à une sorte de groupe, quand on crée un thème on crée un dommaine qui correspond au thème
        'name' => __('Sidebar Accueil', 'montheme'),
        //permet de spécifie ce que l'on insert avant le widget, %2$s veut dire 2 paramètre qui est une chaine de caractère
        'before_widget' => '<div class="p-4 %2$s" id="%1$s">',
        'after_widget' => '</div>',
        'before_title' => ' <h4 class="font-italic">',
        'after_title' => '</h4>',
    ]);
}
add_action('widgets_init', 'montheme_register_widget');

//pour stylisé les champs des commentaires
add_filter('comment_form_default_fields', function ($fields) {
    // var_dump($fields);

    $fields['email'] = <<<HTML
    <div class="form-group"><label for="email">Email</label><input class="form-control" name="email" id="email" required></div>
    HTML;
    return $fields;
});

// détecte lorsque notre thème est activé gràce au hook after_switch_theme
add_action('after_switch_theme', 'flush_rewrite_rules');
// lorsque notre thème est désactivé
add_action('switch_theme', 'flush_rewrite_rules');

//pour les traductions
add_action('after_setup_theme', function () {
    //on apelle une fonction qui va se charger d'appeler le theme
    //1er params le nom du theme et ensuite le chemin vers lequel il doit charger les choses
    load_theme_textdomain('montheme', get_template_directory() . '/languages');
});
