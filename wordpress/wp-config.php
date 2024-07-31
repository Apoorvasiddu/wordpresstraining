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
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpress_training' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost:3307' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

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
define( 'AUTH_KEY',         '{8_jV.^gQ,ac*uR@EfLTO>,5[7gYbY5GWOw|KV?{7Ho>OI|m%Lp@eoGXTm0Jho!^' );
define( 'SECURE_AUTH_KEY',  '{m4<T(O:OLXqpg@MNDxAl[)ht}P.=5D-^7U_tqp6o#so,vdq*iurwlp^*ru|yo+L' );
define( 'LOGGED_IN_KEY',    '4Q7YOR) ?R^3uJ)&Mfdrqa4! BLH>O[~E>l2{}tP&4yu?`kbNo[(7$p]P`1%D; 9' );
define( 'NONCE_KEY',        'r1lJvAYWR}8(^:@#w@UxNHP/mnH7f96$BI9q7H{ 4C.3I,#}vQFfx[7Ny@B|U-qF' );
define( 'AUTH_SALT',        'h{~bt}s|R$>Y</Zx(f;>}wNK~n!ZJcsjvlN8.0Dvl1hP@*asa}Cxo8b+RBZ.:([Q' );
define( 'SECURE_AUTH_SALT', 'CaqYTIx$/ec[:w)(>_)*..,|^W.4*O!W-(o3]L:+B!Q%Eo,S~&d|SyO.d4_1}`-y' );
define( 'LOGGED_IN_SALT',   '}U#]o@^iS2Z(S}1=u.HpoJu6f+L^EV=hy-KFO+NRp@~|f#NWr~;8*]d[zVcB{ _L' );
define( 'NONCE_SALT',       '|CH(s@R5?JL+U,B0@A*r6)EReAh{PE~CYe%Q89XAPD)k<1?BIp+~CSUk!oMe[)RS' );


define('WP_DEBUG_LOG', true);
define('WP_DEBUG_DISPLAY', true);
@ini_set('display_errors', 1);

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wptraining_';

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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';


// SMTP configuration settings
define( 'SMTP_HOST', 'mailexchange.v2soft.com' );
define( 'SMTP_PORT', '587' );
define( 'SMTP_SECURE', 'tls' ); // Options: 'ssl', 'tls', or '' (for no encryption)
define( 'SMTP_AUTH', true ); // Set to true if your SMTP server requires authentication
define( 'SMTP_USER', 'employmedev@v2soft.com' ); // Replace with your SMTP username
define( 'SMTP_PASSWORD', '0Q7EbJJ97jcuYHGD' ); // Replace with your SMTP password
define( 'SMTP_FROM', 'employmedev@v2soft.com' ); // Replace with your FROM email
define( 'SMTP_FROMNAME', 'Apoorva' ); // Replace with your FROM name
