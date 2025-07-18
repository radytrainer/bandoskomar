<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'bondoskomar_db' );

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
define( 'AUTH_KEY',         'Z/6SSDEJpbf12U9g+3[l] jM4{5FOhS9AaVF8G&tz{$u1pzb1#Rh`^=0)fL7$uLr' );
define( 'SECURE_AUTH_KEY',  'X1~.,d.7@q+oqkywS(.(qKT3#WPsPQROQjNxHDBo~jGMu1v?A@#|{vsj$P~_xlA)' );
define( 'LOGGED_IN_KEY',    'HJdo?c!76@PyX:u`$0hx:A7J*q)Hnu6b>>5aD!RJHV[>>X--x8WVbXtRf1iI)g_Z' );
define( 'NONCE_KEY',        'R?RyzD?ob,{;&:N)Dj<jBs^MOPCy}MO:Phl[342NgW`1<$rbxg2bBaM$oR.s!a*k' );
define( 'AUTH_SALT',        'H_26`6Ra<F?D~Rztxg,WWM-S<97hg/lzC_}AFaNu)G> QyhU#2#|h7mD8t<1n{UX' );
define( 'SECURE_AUTH_SALT', 'yTX)gP20k`qaS)M)HDKz3*Bv=C9AY)?0o&PwC=W*Ah2|m;d^:H_1)*eWmoo6+#G5' );
define( 'LOGGED_IN_SALT',   'hkFPM_jEksv|R4@S*Wl!0~.I5{ra%=ch1U{~:ieW7x6T7L}KIoM6^oQ#?9C?Ha5>' );
define( 'NONCE_SALT',       '<{mDY2e(&9$;n]jH.S-fh4Aq>d~aZrvGp)6ln7~0Zb/=|0bJ sP @WRNyJ{oR^%P' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
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
