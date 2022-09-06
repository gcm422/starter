<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'pzeuiqce_01' );

/** Database username */
define( 'DB_USER', 'pzeuiqce_01' );

/** Database password */
define( 'DB_PASSWORD', 'Greenclick1*' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'JjjAvPrVoQvGGyMBslcQVkv0TkyKPNq3BOc5bPDflq8e8dag8ZS0YYhoMNNdneu3');
define('SECURE_AUTH_KEY',  'iiJ1mbRdnzlm2qEsuK6slHzeu51cshddWUIHKPtcQpFW812U5Wd1idzRLz1hkpDC');
define('LOGGED_IN_KEY',    '3Q1SAbJYWVz0QW8ckkih3lwxhqiHP3F1VJ75C1ApaPn8UxdVx7fRGnVRXmrErH61');
define('NONCE_KEY',        'jhLTQ8Mi8gMrcI6U4LIubukKiZNPYgwMS87uOJF1gBlHypgeBvt3weB8JJJUvcYF');
define('AUTH_SALT',        'h9RCRkHeFvDc21GKLFodySTrwIJElBEhPaWl68SErQYVAW4Gj17jU5UDrI5G8Rqf');
define('SECURE_AUTH_SALT', 'CzQZcz078zTLtcd4584FWZRRLZTa8gTYQatHWvKvRqfUsAJaKBDDkP4xo87HEZvt');
define('LOGGED_IN_SALT',   'W2k6ehwUyjsOnRfbRlitfVkLbsmsRNMQgCVCtJe1kzRgjte6gbpjf9GxvNIH37bL');
define('NONCE_SALT',       'Mg87daZBtsaIQCJqngxw92jjpIFfXuEA18m6VAeeeV2dLHCOqrZl1O8qn78ryzYU');

/**
 * Other customizations.
 */
define('FS_METHOD','direct');
define('FS_CHMOD_DIR',0755);
define('FS_CHMOD_FILE',0644);
/* by greenclick 3 di 3*/
//define('WP_TEMP_DIR',dirname(__FILE__).'/wp-content/uploads');
define('WP_TEMP_DIR',dirname(__FILE__).'/foto');
/*end by greenclick*/

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
 /*by greenclick sezione 1 di 3*/
define( 'WP_DEBUG', true );
define( 'WP_DEBUG_LOG', false );
define( 'WP_DEBUG_DISPLAY', true );
/*end by greenclick*/

/* Add any custom values between this line and the "stop editing" line. */


/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/*by greenclick sezione 2 di 3*/
define( 'UPLOADS', 'foto' );
define ('WP_CONTENT_FOLDERNAME', 'sito'); //wp-content rinominata
define ('WP_CONTENT_DIR', ABSPATH . WP_CONTENT_FOLDERNAME); //assieme alla riga sopra
define('WP_SITEURL', 'https://' . $_SERVER['HTTP_HOST'] . '/');//assieme a qeulla sopra
define('WP_CONTENT_URL', WP_SITEURL . WP_CONTENT_FOLDERNAME); //assieme a quella sopra per wp-content
define('AUTOSAVE_INTERVAL', 86400 ); // secondi
define('WP_POST_REVISIONS', false );
define( 'WP_AUTO_UPDATE_CORE', false ); //disabilita auto update
define( 'WP_DISABLE_FATAL_ERROR_HANDLER', true );
define( 'WP_PLUGIN_DIR',   dirname( __FILE__ ) . '/sito/add-ons' ); //rinomino wp plugins
define( 'WP_PLUGIN_URL',   'https://' . $_SERVER['HTTP_HOST'] . '/sito/add-ons' );
/*end by greenclick*/

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
