<?php
// WP_Widget class interne de wp qui permet de gérer des widgets
class YoutubeWidget extends WP_Widget
{

    public function __construct()
    {
        // on appelle la méthode parente les arguments: id de base 'youtube_widget', le nom 'Youtube Widget' et les options si on en a
        parent::__construct('youtube_widget', 'Youtube Widget');
    }

    //a pour rôle d'afficher le contenu du widget
    //2params 1-les arguments passé lorsqu'on affiche la sidebar on récupère le before_title...., 2-l'instance qui permets de récupérer les information associé au widget
    public function widget($args, $instance)
    {
        // var_dump($args); var_dump($instance);
        //afficher le titre
        echo $args['before_widget'];
        if (isset($instance['title'])) {
            $title = apply_filters('widget_title', $instance['title']);
            echo $args['before_title'] . $title . $args['after_title'];
        }
        //afficher la vidéo
        $youtube = isset($instance['youtube']) ? $instance['youtube'] : '';
        echo '<iframe width="560" height="315" src="https://www.youtube.com/embed/' . esc_attr($youtube) . '" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
        echo $args['after_widget'];
    }

    //permet de gérer le formulaire
    public function form($instance)
    {
        $title = isset($instance['title']) ? $instance['title'] : '';
        $youtube = isset($instance['youtube']) ? $instance['youtube'] : '';
?>
        <p>
            <!-- get_field_id permet de récupérer l'id' -->
            <label for="<?= $this->get_field_id('title') ?>">Titre</label>
            <!-- get_field_name permet de récupérer le nom -->
            <!-- class="widefat pour préciser que le champ prend toute la largueur -->
            <input class="widefat" type="text" name="<?= $this->get_field_name('title') ?>" value="<?= esc_attr($title) ?>" id="<?= $this->get_field_name('title') ?>">
        </p>
        <p>
            <!-- dans le dasshbord apparence widget Youtube Widget, on peut juste mettre Id Youtube qui est après le = dans l'url de la vidéo de youtube -->
            <label for="<?= $this->get_field_id('youtube') ?>">Id Youtube</label>
            <input class="widefat" type="text" name="<?= $this->get_field_name('youtube') ?>" value="<?= esc_attr($youtube) ?>" id="<?= $this->get_field_name('youtube') ?>">
        </p>
<?php
    }

    //met à jour les information dans la base de donnée 
    //2pramas 1-$newInstance c'est les nouveaux paramètres qui vont être envoyé par le formulaire, 2-$oldInstance donne les anciens paramètre
    public function update($newInstance, $oldInstance)
    {
        //retourne un tableau qui contient les chose à mettre à jour
        return ['title' => $newInstance['title'], 'youtube' => $newInstance['youtube']];
    }
}
