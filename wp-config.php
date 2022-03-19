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
define( 'DB_NAME', 'lightsparkproduction_db' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

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
define( 'AUTH_KEY',         'f$IVOAN=FrTH<>T%;<CG8<6O~]4S>sU)e|tx:Ck^R,[BN*q.~+yKT*V9:!s+zJ!}' );
define( 'SECURE_AUTH_KEY',  '$LSl+(j;tXe0c;tdl]P2k!y]~BO[Z#PK%KpAH6~|w]_&C@-egApQ&x@Kn13&!1l8' );
define( 'LOGGED_IN_KEY',    'BZd:CtlM,ERD[.KOrlVSkAp4|0)kIBn;UsOK0|/Mj>W)})UD*+:k2=&k9GFa&gyQ' );
define( 'NONCE_KEY',        'zm1f0oUgXL.K<n>1nf#g0_}0mCjs{M25h<;BMa;2jLL-M/]|go%C_s~AgW]UG/bI' );
define( 'AUTH_SALT',        '[3f$aw#Fiv=dy{rl8ddGmh0a(ueJVbd:)~F|vSpQ!Cvk5EM/Q+`d0{0[GWK{h[M8' );
define( 'SECURE_AUTH_SALT', 'tL~C>1oH1.W2=;,GK}hl7Y^Jjq3le0`|,a*i 2-+]>5Nmr k<W[}HfM6vZ)wC:FC' );
define( 'LOGGED_IN_SALT',   'Gx<>CE.:Kn^H(U!62YD;Y?B!]&`l-+m[LE_GdBrvU>GTOkMe~*n..<X%AE6dY1cM' );
define( 'NONCE_SALT',       'gx5A,j.MgVB^)Q_^`V_?tcXk9wqJ<)UMC8~(u]hUk}4m,=~WLr#i_1GGDv53uPTO' );

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
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
