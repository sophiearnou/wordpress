<?php

class SponsoMetaBox
{
    //on crée une constente pour le noom du champ ce qui permet de changer celà plus rapidement
    const META_KEY = 'montheme_sponso';
    //clé pour la sécurité
    const NONCE = '_montheme_sponso_none';


    //permet d'enregistrer la boite de meta
    public static function register()
    {
        //1_meta donnée action qui permet de créer une nouvelle boîte qui va venir dans l’administration qui permet de rentrer des méts données
        //self::class on utilise un tableau qui contient en clé le nom de la class self::class et en 2eme paramètre la fonction a appeler 'add', 10 c'est la priorité et 2 c'est le nombre d'argument accepté
        add_action('add_meta_boxes', [self::class, 'add'], 10, 2);
        //1_action qui permet d'afficher la méta donnée, save_post est une action appelé quand un article est sauvegardé et self::class on utilise un tableau qui contient en clé le nom de la class self::class et en 2eme paramètre la fonction a appeler 'add'
        add_action('save_post', [self::class, 'save']);
    }


    //on crée la function add de [self::class, 'add']
    //2_meta donnée je crée la add elle a pour simple role d'enregistrer les méta données
    public static function add($postType, $post)
    {
        // si le post type et de type post et les permission dans ce cas on peut rajouter notre metabox
        if ($postType === 'post' && current_user_can('publish_posts', $post)) {
            //add_meta_box()permet de rajouter de nouveaux méta
            //elle doit avoir un id spécifique 'montheme_sponso',1 titre 'Sponsoring'et ensuite une fonction qui sera appelé pour générer cette méta box on veut qu'il utilise le nom de la class et appler la méthode render, en 4 paramètre on peut préciser les écran sur lequel apparait notre système plusieurs ecran correspondent à différent type de page içi on met celà en place sur la gestion des article donc 'post' et side pour la position de la boite sur le coté
            add_meta_box(self::META_KEY, 'Sponsoring', [self::class, 'render'], 'post', 'side');
        }
    }

    //on crée la function render de [self::class, 'render']
    //3_meta donnée fonction qui sera appelé pour générer cette méta box
    public static function render($post)
    {
        //on affiche le contenu
        // echo 'Salut les gens';

        //on récupère la valeur on veut l'id de l'article entrain d'être éditer donc $post-ID
        $value = get_post_meta($post->ID, self::META_KEY, true);
        //1erparamètre la clé qui correspond au nonm de l'action et 2e paramètre le nom du champ
        wp_nonce_field(self::NONCE, self::NONCE);
?>
        <!-- au cas ou l'utilisateur n'a pas coché la cas avant on crée un nouvel input hidden -->
        <!-- ?= self::META_KEY ?> correspond à la clé du nom de la constente-->
        <input type="hidden" value="0" name="<?= self::META_KEY ?>">
        <!-- checked($value, '1') cela permet automatiquement de rajouter l'attribut check si les 2 valeurs passé en paramètre sont identique-->
        <input type="checkbox" value="1" name="<?= self::META_KEY ?>" <?php checked($value, '1') ?>>
        <!-- on precise que c'est un label qui aura pour id "monthemesponso" avec for-->
        <label for="monthemesponso">Cet article est sponsorisé ?</label>
<?php

    }


    //on crée la function save de [self::class, 'render']
    //la function prend en paraètre l'article qu'on est entrain de sauvegarder $post et elle doit faire un traitement qui permet de sauvegarder l'article
    public static function save($post)
    {
        //on peut se greffer et détecter si au niveau de la variable post j'ai cette clé là
        //on verifie que la clé qui s'appelle montheme_sponso existe au niveau de $_POST
        //&& current_user_can('publish_post', $post) veut dire il faut que l'utilisateur est le droit d'publier notre article ici
        //wp_verify_nonce($_POST[self::NONCE], self::NONCE) pour la sécurité il vérifie si c'est wp qui envoie le formulaire
        if (array_key_exists(self::META_KEY, $_POST) && current_user_can('publish_post', $post) && wp_verify_nonce($_POST[self::NONCE], self::NONCE)) {
            //var_dump et die pour voir ce qu'on récupère
            // var_dump($_POST);
            // die();

            //donc si dans $_POST laclé montheme_sponso est égal à 0
            if ($_POST[self::META_KEY] === '0') {
                //on supprime la meta donnée
                delete_post_meta($post, self::META_KEY);
            } else {
                //update_post_meta permet de mettre à jour la meta donnée si elle existe déjà et d'ajouter si elle existe pas. le 1 correspond à la valeur pour dire qu'il est sponsorisé
                update_post_meta($post, self::META_KEY, 1);
            }
        }
    }
}
