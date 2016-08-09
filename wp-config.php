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
define('DB_NAME', 'rice_online');

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
define('AUTH_KEY',         'f@EKKCt<v<w&w&1+ASV#&hC=N}iUbZ)T`42ri5A7xDpgq e|r]kuXA1R9%Ld7,g[');
define('SECURE_AUTH_KEY',  'IudCXmY9*Ric:_6~Q%o:$/Sa+P2usNL-4vB`Nq2xrLzY`0_Nc)ueTK?*p>^_0HxZ');
define('LOGGED_IN_KEY',    ']G2f]4|`=:9->VG`#0AB@Kf(esz^{^*Gim%qL1|:EGQ1bg.PN1QpC)Q=0JQ6lAG1');
define('NONCE_KEY',        '(m]5R ](@Nf$3No3I?K]%[Bz9,]2E5oWp%AdpC9j,#1&!^o${%,8Y:xUor|-.G>(');
define('AUTH_SALT',        'TA_c+$4GLF_!(M{B=-93$}Ld$X{VSS}&H[CaNu+,%Q9g[;B#4 &>i9gh5m}08LQo');
define('SECURE_AUTH_SALT', 'y}xDUu]Jzzc^/aA~0pwVW3H=,$afk}*lq ;F<fzJ~WBuPma_bxofEmsk0^qu!B)q');
define('LOGGED_IN_SALT',   'gvGLIcwwf5^eOfmr]]Q_S:l-CDB0_63]dlqp&;!`eU=(m3R$}< 8gbCPcm*NQzH7');
define('NONCE_SALT',       'Jvr5`ni*XI8f2gD+Kd 4Dc{n4vw/YhLg8N3hs}4{fQ_q5bX@GkJkk42pO#RakJH9');

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
