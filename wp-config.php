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
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'CHRAVE1');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'Fey~`|pj*]x1Au#G@6uOD|21X!d,{sI^6T:JfSkny$hzZY}|%+Bah>/F?/Dq]%xq');
define('SECURE_AUTH_KEY',  '5FcZRbBurO5?80o]`n|E0*.tf*<g@ViI>IBg;62GIY-}o~D6C%joI/?~Z_Kmo|wk');
define('LOGGED_IN_KEY',    'j3p41#G+}][#xWqNt$-_JA(/=4MIM)>98G;+N*Lv8E1TCeBBJ5#3p7F#)h)9@Z?q');
define('NONCE_KEY',        'K^YW l7RcHY6#d7+Gs9:(u|LAD`dDH=,ZR-5 ;y>GbIj*A-sy(pF&x0Uf+-P~cdZ');
define('AUTH_SALT',        '8A2=|G.22[.s/_mdl/HM)0i`P5~WMuTx^j&OA(09pFyqau@s=J]VYnn&1xbC4Ih>');
define('SECURE_AUTH_SALT', 'xM{AE^4UzlFk0f7`+U67@J/JO5_~RFFK5X*uLYV@u+ve]d]v#h-#_WPp$anO|}*[');
define('LOGGED_IN_SALT',   'ka;baPa)h/769|Mj6@Q3wF6ya~;Ju-rKH:;=5%#wPD6P:gh41j/c`lM`JSgt_[2u');
define('NONCE_SALT',       'eMcflxqP9gjR9LBtJDk*^eN@[;2?jskT0iOKb:| ^=|JUv@-Y/fIeV}nW1d8kLz>');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
