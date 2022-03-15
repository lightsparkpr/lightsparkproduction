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
define( 'AUTH_KEY',         '-S%.t1eX(;>kD:7L9I%4!{f|24-l0CsB@@)_b_kGa8VIVStFG}pZA;v^j{3vg(.[' );
define( 'SECURE_AUTH_KEY',  'w]_LzcU8bE%GdDVsTwk> n4rm?)-W=.~49C4^|]j~8f5UaR,D!QzJERUqH5tU~vU' );
define( 'LOGGED_IN_KEY',    'D/IdekEv,:y[qUn,1;WP)}UB,meul5wCQ6=sQ+:|/f}o#IJw.L0Cc/3Y;3C)XROU' );
define( 'NONCE_KEY',        ')7#jvJ!$*IG JBOk}=d_Y*#v#gfUrWDaOf$G8*@GM $#Zb|^{B#/ivzXZ?bYab*@' );
define( 'AUTH_SALT',        ' Dt|yaI}ZJNT[8=K(erLNv&h>BGQ0W;F4yk,PoTV<vg3sLDBQ}]6JlD[b4$-j~/>' );
define( 'SECURE_AUTH_SALT', 'a7B9E]EQgYSO:#/3 fGR<]J@I*(G@bMZJ<)go@ymZ%iU!5):05d/M?9xr[_~+BAZ' );
define( 'LOGGED_IN_SALT',   'G-#A]D#:.VZ+}^-!GWhm3m822$L)mnP*M{l;LWR(B$Z/&/*9oLFtn|z#6xrM/~>)' );
define( 'NONCE_SALT',       '3XTPJtT,-0H:_*Q<)Kr#NZc?Fzv#lEKRD0)WM)y{1?-<0`MM6M9S4b%vltYpEN!]' );

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
