<?php
// permet de rajouter des sections et des panneaux à l'interface personnalisé
add_action('customize_register', function (WP_Customize_Manager $manager) {
    //ajout d'une nouvelle section
    $manager->add_section('montheme_apparence', [
        'title' => 'Personnalisation de l\'apparence',
    ]);

    $manager->add_setting('header_background', [
        'default' => '#FF0000',
        //pour que les changement soit sans rechargement de pages
        'transport' => 'postMessage',
        //pour nettoyer les données
        'sanitize_callback' => 'sanitize_hex_color'
    ]);
    //permet de rentrer la couleur de fond avec un color picker
    $manager->add_control(new WP_Customize_Color_Control($manager, 'header_background', [
        'section' => 'montheme_apparence',
        'label' => 'Couleur de l\'en tête'
    ]));
});
//on enregistre ce JavaScript gràce au hook customize_preview_init.
add_action('customize_preview_init', function () {
    wp_enqueue_script('montheme_apparence', get_template_directory_uri() . '/assets/apparence.js', ['jquery', 'customize-preview'], '', true);
});
