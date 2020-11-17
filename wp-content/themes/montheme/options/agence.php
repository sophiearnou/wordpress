<?php
class AgenceMenuPage
{
    //on crée une constante qui sera à la fois le nom de la page et le nom du groupe comme çà on a pas à se répéter
    const GROUP = 'agence_options';

    public static function register()
    {
        //appel le hook on ecoute 'admin_menu' et lorsque cela va être executé on appelle la méthoide add_menu dans la class donc self::class, 'addMenu'
        add_action('admin_menu', [self::class, 'addMenu']);
        // on déclare les champs assosier à cette page on utilise le hook 'admin_init' et on lance la function 'registerSetting'
        add_action('admin_init', [self::class, 'registerSetting']);
        //permet dans l’administration d'avoir un champs spécifique ex: qui affiche une date
        add_action('admin_enqueue_scripts', [self::class, 'registerScripts']);
    }

    //on crée la function registerScripts
    //$suffix pour filtrer et n'afficher seulement ou on veut
    public static function registerScripts($suffix)
    {
        //on fait une condition on dit qu'on affiche seuelemnt si c'est égale à la partie "settings_page_agence_options"
        if ($suffix === 'settings_page_agence_options') {
            //on importe les scripts de la librairy  flatpickr
            //on va sur https://flatpickr.js.org/examples/ 
            //on clic sur Getting Started
            //on doit charger un css et ensuite du javascript on copie le https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css
            // [] dit qu'on a pas besion de dépendance, false car on met pas de version
            wp_register_style('flatpickr', 'https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css', [], false);
            //on charge le js true pour dire qu'on veut çà dans le footer
            wp_register_script('flatpickr', 'https://cdn.jsdelivr.net/npm/flatpickr', [], false, true);
            //on enregistre le chemin vers le fichier admin.js, get_template_directory_uri() permet de récupérer le chemin url
            wp_register_script('montheme_admin', get_template_directory_uri() . '/assets/admin.js', ['flatpickr'], false, true);
            //on importe le script
            wp_enqueue_script('montheme_admin');
            wp_enqueue_style('flatpickr');
        }
    }

    //on crée la function registerSetting

    public static function registerSetting()
    {
        // elle enregistre notre paramètre ex: agence horaire aller voir sur la doc register_setting
        //er param un groupe et le nom de l'option et on précise une valeur par défaut
        register_setting(self::GROUP, 'agence_horaire', ['default' => 'Salut']);
        register_setting(self::GROUP, 'agence_date');
        /* Pour avoir l’interface pour administrer on va devoir utiliser un système de section et de champs
avec add_setting_section() 1er param un id ex:’agence_option_section’ ensuite le titre ‘Paramètres’ et un callback qui va permettre de générer le contenu de la section ici on met une fonction() et en 3è params la page d’option qui est associé self::GROUP*/
        add_settings_section('agence_options_section', 'Paramètres', function () {
            echo "Vous pouvez ici gérer les paramètres liés à l'agence immobilière";
        }, self::GROUP);
        //on veut un champ qui va spécifier les horaires donc on fait un add_settings_field
        //en 4ème params la section liée 'agence_options_section' permet d'organiser les champs dans les différentes sections qu'on a définie
        add_settings_field('agence_options_horaire', "Horaires d'ouverture",  function () {
?>
            <!-- dans le nam on met le nom du champ -->
            <!-- get_option('agence_horaire') pour que l'administration puisse voir les info entrée -->
            <!-- on securise et empêche d'inserer des balise avec "esc_html" -->
            <textarea name="agence_horaire" cols="30" rows="10" style="width: 100%"><?= esc_html(get_option('agence_horaire')) ?></textarea>
        <?php
        }, self::GROUP, 'agence_options_section');

        add_settings_field('agence_options_date', "Date d'ouverture",  function () {
        ?>
            <!-- dans le nam on met le nom du champ -->
            <!-- get_option('agence_horaire') pour que l'administration puisse voir les info entrée -->
            <!-- avec value on récupère l'option -->
            <!-- on securise et empêche d'inserer des attribut avec "esc_attr" -->
            <input type="text" name="agence_date" value="<?= esc_attr(get_option('agence_date')) ?>" class="montheme_datepicker">
        <?php
        }, self::GROUP, 'agence_options_section');
    }


    // on crée la fonction addMenu
    public static function addMenu()
    {
        //1er params le titre de la page "Gestion de l'agence"s'affiche dans la partie title de la page,
        //2eme le menu title c'est ce qui va s'affiche dans la partie menu donc on met "agence"
        //3eme params les capability, les permission qu'il faut avoir pour consulter la page "manage_option" c'est les même permission qui permette d'accéder aux autres réglages
        // le menu slug est le nom de la page et il ne doit pas rentré en colision avec les noms qu'"on a déjà donc "agence_options", le dernier params et la function à appeler pour rendre le contenu de la page
        add_options_page("Gestion de l'agence", "Agence", "manage_options", self::GROUP, [self::class, 'render']);
    }

    // function qui affiche du contenu
    public static function render()
    {
        ?>
        <h1>Gestion de l'agence</h1>
        <!-- on dit qu'on veut récupérer l'option 'agence_horaire' -->
        <!-- <?= get_option('agence_horaire') ?> -->

        <form action="options.php" method='post'>
            <!-- pour rajouter un tas de champs 'settings_fields'-->
            <!-- pour afficher les champs 'do_settings_sections' et on passe en params les sections à afficher-->
            <!-- submit_button() permet de générer un boutton en respectant le style de wp-->
            <?php
            settings_fields(self::GROUP);
            do_settings_sections(self::GROUP);
            submit_button()
            ?>
        </form>
<?php
    }
}
