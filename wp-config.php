<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpress' );

/** MySQL database username */
define( 'DB_USER', 'dungthinh' );

/** MySQL database password */
define( 'DB_PASSWORD', 'S01@wind6' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/* Multisite */ 
define( 'WP_ALLOW_MULTISITE', false );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'WgSpa#xj57qr6h2a%CGGI!P6+m(H4sF[09*.3:kP%KT8T8{5tta/T{nTl+wckOZZ');
define('SECURE_AUTH_KEY',  'EuC/)1J?z38}A+jE+9oo0q@+6H!xwxKK=3#PzD6bf~zB&aegK7RY%#JcE&YMXqH=');
define('LOGGED_IN_KEY',    'M9xF6Qj9Da^i#}3#g-J;>nA^Jyx5kp+TGfd0OC6R,>_^b6#(liY!AB{Hz@jN=+H|');
define('NONCE_KEY',        ';ljki8-}4$@o%H!S^p|GL[ccXBeZ,|xi+xmeL>[y>1)~r,a/e.ou/?;-it?>%2L5');
define('AUTH_SALT',        'h@7cer/6k~RD_|roz.G6-[|F<6h~eS~>3QfmqfGsy*r}z|j9# Ud68FcI^|}i_$1');
define('SECURE_AUTH_SALT', 'yFX>@M2keYYAM))T0Qwgj2B+i~R<$Ug.|F2,/P?-(=$d_^$S|9pmg8vb)W]C}UT/');
define('LOGGED_IN_SALT',   'fg}dBxTr;r<{EO_v_,b-:|=hb+W4-ZW&O4<>X23=>OrK+Pd#ZVE6p[!X]?2K(*u8');
define('NONCE_SALT',       'V+|>cS/y<s?&4*TiQ+2iNgw7aQ23&Qi,AC<0J#BKdiQU5si4aq&zj5,af90]jIc<');

/**#@-*/

/**
 * WordPress Database Table prefix.
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
define( 'WP_DEBUG', true );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
