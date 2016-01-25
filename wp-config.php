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
define('REVISR_GIT_PATH', '/usr/bin/git'); // Added by Revisr
define('DB_NAME', 'jejufoodwinefestival');

/** MySQL database username */
define('DB_USER', 'motiontree');

/** MySQL database password */
define('DB_PASSWORD', 'mt393939');

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
define('AUTH_KEY',         'L,WWO0LO|rl89|<-qT| =w $[-fpL|Y(G?zC-G_3/2@O2<g$ATXSHTIaIh<X-efA');
define('SECURE_AUTH_KEY',  '+%Tg83BsYuB)fvrLanCvUXxcK^4-E]OL+a+#y 6u{LcL*3-U{Jiwq>k3x1j-ogvx');
define('LOGGED_IN_KEY',    'T#ign].B@hhGUrn-C|MKy~2+l@qC_CZ:*PG,e6uU}7nsK-[4BsE,Jl!NRY! 9WFf');
define('NONCE_KEY',        'j.~O_CU3$5.m-[<Ryl-P6PgLbq}b+,+[^.FP&7ab.5-s[BG2xV&7~UnDRSWkSvFf');
define('AUTH_SALT',        'jZ`@fM>YhEO9uR+>A@cnI}T*$r28x}o3/{d+/6Hp~MG$-0k:cA&Q*,M7|*C-J^:|');
define('SECURE_AUTH_SALT', 'lZk~Iv9J$>Thi!T4!d48KaD>+(}O^3i-Ki?<HV$$Fx#p,RlJ,[py !|jGR;}4~&m');
define('LOGGED_IN_SALT',   'eY0)$uK(:|C;Nb~xb vk+#x0f%aN[;^S%57bHc}:ZG-kNVQtarl_ZS*|*-xuF752');
define('NONCE_SALT',       '7g-)>p-njY~#V.f|P }:X2<l|0.6}rE@17bHa;nKS5.QU.Ne-eYsN>%3RyH+D>zs');

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
