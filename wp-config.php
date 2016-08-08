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
define('DB_NAME', 'macmeanoffer');

/** MySQL database username */
define('DB_USER', 'mmao');

/** MySQL database password */
define('DB_PASSWORD', 'MMAOsql%^&123');

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
define('AUTH_KEY',         'hCe/J@^r`|rS3tRH8ei%p4aZaaQ9K@AA!7dcdqMhC])w-&S>*t;sI,|,qa3[pu|u');
define('SECURE_AUTH_KEY',  '+FqARna-01#!}fsklQFa02#tHGHR^%7-(W@m~v_}x.7 #WS{i .edv8=jv7Zmo:n');
define('LOGGED_IN_KEY',    '9ne_liB^b0n]}nrB!4g)1YOpOT-[?d=|sfZiBsbn9H2%HKDuwN$([dEb>1-`INi@');
define('NONCE_KEY',        '7S;DVVo}<P_=5J>;58?77v<.wn]arL<3D6u9=*^ H8+f*t;Q$k#p n(5i *3j=<*');
define('AUTH_SALT',        'Gjr2Ym._zNFF)o2u^t|j-&R0di%0!042km.:jd2:$ey=XC z@xj|NW!f<ct}o-`O');
define('SECURE_AUTH_SALT', '764N@ok+-sbSp71W9{VzNbK=rkW(Zxj++JdyynaCW/fwz7kMcS[9E22|b^=rhY_^');
define('LOGGED_IN_SALT',   '2V-]yhsY`#wL>&Kq)/v EFu,WKmd:XGci9(wjvS-+51Kk)-Uf2Zw.)R.]Sxt12fe');
define('NONCE_SALT',       'X-7NyCIhU+5Bst+po650(-oBfVJ2uYn6Kcp)f^Ob_`FMX3qF]~+1{24Tc,X`7<Y3');

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
define('WP_DEBUG', true);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

