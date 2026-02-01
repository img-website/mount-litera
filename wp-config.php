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
define( 'DB_NAME', 'mount-litera' );

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
define( 'AUTH_KEY',         'c;ZGg@<T Y1`H?8_kfjI7DJ|I/fGx<|<kZ/N4:SX$109Y?Sk),^9vsMty*VgSTa~' );
define( 'SECURE_AUTH_KEY',  'i]Enc Y+u?fhY3DyFSK&N=<0Bji.bWHoXy,,RS`xiz9OX8:Q}Cb._^PSJf!i}ALM' );
define( 'LOGGED_IN_KEY',    '}$[FXS.HXS7mTD(-Cn0J`1c!5MdB9w&;iz%5@*ycgxD.9U~XUf|J;9iCr);tgbzA' );
define( 'NONCE_KEY',        '!RrcDyqz}|I .sI}na[2qWzBV8}wRE5lVm>-(,gcW:%B-:!U2%W~^C_wB3f6IIp+' );
define( 'AUTH_SALT',        '}xZ-9?hF7T}gT(2yp0cVWa<8b=#KBiqR]I);dP BG^>KM)xM$*`O2x^sZ:dAI}`<' );
define( 'SECURE_AUTH_SALT', 'fnu?$o(VFg;b7B: U.z(et.hK`vPE&@[-uRt#DVe-(JTB1/adtJ98}}}i+Q,<#o9' );
define( 'LOGGED_IN_SALT',   'h(#E3BI!{$h70SGzE$x2zK>}O&ajXlQc9.=<R7oG+5aR9FTEAoXI^2I_6MZeUuIc' );
define( 'NONCE_SALT',       '>KOtxr:K(b<s[u_b6tHk:AU!xAewW,A){faW=rCpbe?sH:*>48+z ygy.%ul84#N' );

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
$table_prefix = 'mlzs_';

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
/* API keys (YouTube, Google Maps) are managed via Settings > Env in WordPress admin. */

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
