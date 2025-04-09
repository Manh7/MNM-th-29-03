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
define( 'DB_NAME', 'dat' );

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
define( 'AUTH_KEY',         '6BrP{L$UiQaluqtCOmiI%%0N;F-SX|%T;9(I|(Y$c*Y>muzePA5)E:$NA59$-9f0' );
define( 'SECURE_AUTH_KEY',  's_42(|,NBe/Jh(Zd<Lumb$B}5]GDFxhCC0i WX$p7z0Q~ w[A+Ogdge2kG%*hbSW' );
define( 'LOGGED_IN_KEY',    '><r3b c7A.tx%vDIuU ^zQCs!nc`]2e4f!jgo+Fcv#oKdu,(eK?;)+7g5.iYo[>h' );
define( 'NONCE_KEY',        'EE5.@Jxw7C%L.MiX-[0$O-SaEq8Yx<A/`00C*wx(vwn0C/J}W|K@xW^SbJF7/}`o' );
define( 'AUTH_SALT',        ',~<NTBHwv6W]zRFj7^TBH& xPbeJ/LfW4Fj^zy-^vH(T<q@h>*#.H7o}zIxH<Ni@' );
define( 'SECURE_AUTH_SALT', 'cejd5/:`:_t!>}9K$c-e)1R1Lpc@N,ivivqud2q#G4Em~ IHswr?WYhhyPvrN<0B' );
define( 'LOGGED_IN_SALT',   '(#zSk-4Dm`2g;h_!s{2P_Ij^>Ed(:%9 ^F_9Sz3>(mphDA<36&TNu}{TNl` jsGX' );
define( 'NONCE_SALT',       'Pfwr.r&gGVG1F>:K7E0g@>z,fq$![5Ob{_UUZ}56m>.dEZ?P?T9[L1&cIhNfSy6 ' );

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
