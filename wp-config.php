<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link http://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'novtgu8m_trips');

/** MySQL database username */
define('DB_USER', 'novtgu8m_trips');

/** MySQL database password */
define('DB_PASSWORD', 'P)!B4S71a5');

/** MySQL hostname */
define('DB_HOST', 'localhost');

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
define('AUTH_KEY',         '7inlh24s5cjjf3u0jjg12qlb5fefex4x6kzisu8bxnj9rayhqjaqemddlu7vdurs');
define('SECURE_AUTH_KEY',  'igmgnhg8vflm4ix6shbif8rfmvwqhzwnxpnw6yh3xgpproimfr1aqnobjslktbnj');
define('LOGGED_IN_KEY',    'nsfo0lebb6xltibevmtthkexpkosaorjukefed7g4ommsreh1i1uuzpuso0diw6i');
define('NONCE_KEY',        'ymqdchlysmdw6qaym5zsabyvyj7iqhxan6wngxclsevuaxlyqjohzaplzozngdmz');
define('AUTH_SALT',        'fzalnxnwkbjzpf2wuxiid9hesntnxzjohj0ow9pspankbxeggg5kqrunbn9p8zx3');
define('SECURE_AUTH_SALT', 'vaby2jbotrdssoxrnqqgklrddrhjyk2giiziywygdsabx016dleordmnvwgm09oo');
define('LOGGED_IN_SALT',   'gxwxgp7pffjmqlkiabyc8redijnh6ktfyn0oa58umvi86npkx3cug62ns4jjblti');
define('NONCE_SALT',       'rqpfspqqjuhzeh4jjzas0ex22tadx1b3cunlcon0e77elz40jjigklfbb32odcws');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
