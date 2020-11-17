<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- wp_head Permet d'inserrer toute les infos à mettre en entête ctrl clic dessus pour voir le def-->
    <?php wp_head() ?>
</head>

<body>
    <!-- mb-4 pour marge en bas -->
    <!-- pour afficher le titre du site bloginfo('name') -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4" style="background-color:  <?= get_theme_mod('header_background'); ?>!important">

        <a class="navbar-brand" href="#"><?php bloginfo('name') ?>
        </a>
        <!-- afficher l'option des sections et des panneaux à l'interface personnalisé -->

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- affiche le menu avec theme_location on met le même nom qu'on a mit dans le register_nav_menu donc header -->
            <!-- 'container' => false pour retirer la div wp autour du ul -->
            <!-- 'menu_class' => 'navbar-nav mr-auto' pour changer la class du ul on récupère la class de bootstrap -->
            <?php wp_nav_menu([
                'theme_location' => 'header',
                'container' => false,
                'menu_class' => 'navbar-nav mr-auto'
            ]) ?>


            <!--
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Dropdown
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                </li>
            </ul>
            -->

            <!-- la fonction get_search_form qui va retourner le code HTML d’un formulaire de recherche il faut afficher les chose donc on met un echo on écrit ?= au ?php-->
            <?= get_search_form() ?>
        </div>
    </nav>

    <div class="container">