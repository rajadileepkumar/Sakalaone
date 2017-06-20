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
define('DB_NAME', 'sample2');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');
define('WP_SITEURL','http://localhost:8080/sample1');
define('WP_HOME','http://localhost:8080/sample1');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '?h,}p>~?x{{m;aM-Rs}_f5hJ%n+-m|;-`=FY0ZPA3l6SMS|3oCs][i]`^9%* S[3');
define('SECURE_AUTH_KEY',  'OaT-uHv.KoT1hLN^~uN{OWEwU[2P_$?7~H,f(UQu7_6Fy&p,><+l[epBY/y?rzm-');
define('LOGGED_IN_KEY',    'vq~[=d&D+^+Rk5n;M;}2fW@_x 3t:iEcE8|$zO2; C@.rr%TK,y2/R! /_?RKT=9');
define('NONCE_KEY',        '}%Db=]v+C-2^97TLAo,QnT5>ZvO;_0@nwGC|iIZ,D{L`Ts9W~4=d?#!vumq+/+Ho');
define('AUTH_SALT',        '+1c|YS8x@GsAJ;J{X.ZtL ITYr/ZJK_<LYa+Vt+]5``?iFA&N1]v}1:{3o[-y#lk');
define('SECURE_AUTH_SALT', 'ulY7=P[]9?D9mdLUXPB6bI,3@/|1m$MiwzTJ*R=6r?h+$(W_uY(=m~R+3(.&xW+D');
define('LOGGED_IN_SALT',   'hzDCyYi&eOaTpWF{Nkefexx* R)(2N{<Q5&He5@D3)=T(G*z6WK]Wz|Aq93M]*|g');
define('NONCE_SALT',       '3[+c-gC@L[)Z:<zNP:L|t^,n[+=aXc)K=o sKENlH+hecHk~}@svf`]EX krj~N2');
define('WP_HOME','http://localhost/sample1/');
define('WP_SITEURL','http://localhost/sample1/');

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

set_time_limit(300);
/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
