<?php
/**
 * La configuration de base de votre installation WordPress.
 *
 * Ce fichier est utilisé par le script de création de wp-config.php pendant
 * le processus d’installation. Vous n’avez pas à utiliser le site web, vous
 * pouvez simplement renommer ce fichier en « wp-config.php » et remplir les
 * valeurs.
 *
 * Ce fichier contient les réglages de configuration suivants :
 *
 * Réglages MySQL
 * Préfixe de table
 * Clés secrètes
 * Langue utilisée
 * ABSPATH
 *
 * @link https://fr.wordpress.org/support/article/editing-wp-config-php/.
 *
 * @package WordPress
 */

// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
define( 'DB_NAME', 'grafikart_child' );

/** Utilisateur de la base de données MySQL. */
define( 'DB_USER', 'root' );

/** Mot de passe de la base de données MySQL. */
define( 'DB_PASSWORD', '' );

/** Adresse de l’hébergement MySQL. */
define( 'DB_HOST', 'localhost' );

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/**
 * Type de collation de la base de données.
 * N’y touchez que si vous savez ce que vous faites.
 */
define( 'DB_COLLATE', '' );

/**#@+
 * Clés uniques d’authentification et salage.
 *
 * Remplacez les valeurs par défaut par des phrases uniques !
 * Vous pouvez générer des phrases aléatoires en utilisant
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ le service de clés secrètes de WordPress.org}.
 * Vous pouvez modifier ces phrases à n’importe quel moment, afin d’invalider tous les cookies existants.
 * Cela forcera également tous les utilisateurs à se reconnecter.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '63H0BBC?QR.]getY$U4:nr7dS^1cUnI!rC{4]:h*57z=3RSbMVG+I,D1N)|cCdbW' );
define( 'SECURE_AUTH_KEY',  'O&iul/Jid+,qNGZOs[QL]v6!h1}W]_j9Q#*:~(K=5N-G G*!C,w_H#4GxiU@Y+IZ' );
define( 'LOGGED_IN_KEY',    'zSJ|khHFm-g9;h[Cl+LC)9kFWtC{M8R!o/^4:3cu.aU`fdJ]!z6A)b0W, >/xH@Y' );
define( 'NONCE_KEY',        'S6Ha1(XcNBhq_O`o7H-12[X~^!p&9p:N9|z;(rzKh<T=ny-`_U.D$r!=[tB]U#1D' );
define( 'AUTH_SALT',        'MT8l,t@^`L_*>!g*?cyH|3%{4}sy~H91V`fPZ8_`Wza|q,U6Pfu`4MiFkOQ7?9 N' );
define( 'SECURE_AUTH_SALT', 'M7d}a^<g6j-.MD`nyD:,_`q^}uSEB,NtdC0^JkD0%<Xzbv6$)Jf9->LN@0)-hqds' );
define( 'LOGGED_IN_SALT',   '&uD,@wdB`Deahoz?z`7,PV(di$e]? [tNcOS<tLi14-OWOPL42S2k!<UE8Z,00vQ' );
define( 'NONCE_SALT',       '7&A1Fd95?^o&0&[G?IS2.4[16bDJgrY,6aP9,FawE0wBqG1!inFJ~~nPz-C-3dPU' );
/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique.
 * N’utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés !
 */
$table_prefix = 'gc_';

/**
 * Pour les développeurs : le mode déboguage de WordPress.
 *
 * En passant la valeur suivante à "true", vous activez l’affichage des
 * notifications d’erreurs pendant vos essais.
 * Il est fortement recommandé que les développeurs d’extensions et
 * de thèmes se servent de WP_DEBUG dans leur environnement de
 * développement.
 *
 * Pour plus d’information sur les autres constantes qui peuvent être utilisées
 * pour le déboguage, rendez-vous sur le Codex.
 *
 * @link https://fr.wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* C’est tout, ne touchez pas à ce qui suit ! Bonne publication. */

/** Chemin absolu vers le dossier de WordPress. */
if ( ! defined( 'ABSPATH' ) )
  define( 'ABSPATH', dirname( __FILE__ ) . '/' );

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once( ABSPATH . 'wp-settings.php' );
