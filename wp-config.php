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
define('DB_NAME', 'otmensendieck');
// define('DB_NAME', 'DB2776094');

/** MySQL database username */
define('DB_USER', 'root');
// define('DB_USER', 'U2776094');

/** MySQL database password */
define('DB_PASSWORD', '');
// define('DB_PASSWORD', 'Caribean-22');

/** MySQL hostname */
define('DB_HOST', 'localhost');
// define('DB_HOST', 'rdbms.strato.de');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         'Uba%9^*0+M?U!m+/QCpo|-UK&qJ-T5[)+tv{TR,4fFJtl3eWD-RaJOZ0`!<&u/4(');
define('SECURE_AUTH_KEY',  'nsO2|Cu4;{-Ni9j:4blU|~.V1*QZ|Q5!*dPpUM#>4B`<f.E.rVcLCT?/PWRS]1_G');
define('LOGGED_IN_KEY',    ';s.GP?M^[3Lp(wCG>(F2CU2>m^_UR1957X@r=q&8 @:Y_SB0S)q#4t.mNKU=rk5p');
define('NONCE_KEY',        '4:&xj1wr6K_|o7XYbbHGR;53hK9+pRKl*By}(fk+LRL?-hZ405`.kPzb54u2|1d ');
define('AUTH_SALT',        '2#Rx|7xot,{=9n|++@j1}{X4]{Vv*gXT=l>&T2=m!daC>qX*YoL]U^M%T-[B&d?i');
define('SECURE_AUTH_SALT', '^Oc=rSx}Nh0XxVe4>=VnZ=B&qV|ZY<dNSQ4o0<q00_KC:7xf<([(kQ/p!)<@o]dw');
define('LOGGED_IN_SALT',   '=v8L 6;F8z|)2.cy3sUtRB%L]pkR8|FEv5E}|pe/V<odFM?`<++h<*sFLbS|OZ{%');
define('NONCE_SALT',       '~@=7g??*cmxdf.?{XLbV^:^wD1ElwB=_1Cigl$|!W }d^NMl+:0_-$p~1f[kJD@|');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'otm_';

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
