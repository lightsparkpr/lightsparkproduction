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
define( 'AUTH_KEY',         '<x FSq4PhR^s!vReT.3Dx=82ILjS/Y/KdmcbcQ<.2ENmd:Vl#I6w1P.HJ*XhE:PY' );
define( 'SECURE_AUTH_KEY',  'vS%@PSBC?mIq8Hv)Co}}jfJL1OSC-&|P].G8Wn*9-}r13(d1Y)~07UyEuA)lN{ H' );
define( 'LOGGED_IN_KEY',    '1dNAvi~C0|1$e+7nsDs->3rSxHN;$u/)Z-qum;{WL>1fSc^2X<upA;j^m*R8T]tA' );
define( 'NONCE_KEY',        '|QD`Zg}`/y,ntsS j(+YAGRvMA$}m#$WN1z{7M@^AF0f`>h(sgCSEZ6?vTjE<j-|' );
define( 'AUTH_SALT',        '#^|.g3)*hFXVS#?8CHKgv2!;55|xyJ8 !</HbHtK{V LU= h:I~G!V>%j:NDg&EI' );
define( 'SECURE_AUTH_SALT', 'Uw+vt5vwL|_S;Q0jZ&V<50Cck$k@U!(T8guEK3xz~/mLp!7toeFRn2cBx?c~E5T[' );
define( 'LOGGED_IN_SALT',   '6*60%B&EcSfl!}}OFg[K)4ef=_:yH`O60=Y0@86CsHiJFd4#XD`Ji0 x+vo)x1R<' );
define( 'NONCE_SALT',       'c$ *Ibw(wl!f(JN,{-$Fzr29.{A:,sJwEk+6vyxo5qr/at64bnm#Is*l2bwKXq/k' );

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
