<?php

/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

$scheme = 'http';
if (isset($_SERVER['FORCE_SSL']) && filter_var($_SERVER['FORCE_SSL'], FILTER_VALIDATE_BOOLEAN)) {
  $scheme = 'https';
} elseif (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') {
  $scheme = 'https';
}

$domain = $_SERVER['HTTP_HOST'];
if (isset($_SERVER['ALLOWED_DOMAINS']) && $_SERVER['ALLOWED_DOMAINS']) {
  $allowed = array_map('trim', explode(',', $_SERVER['ALLOWED_DOMAINS']));
  if (!in_array($domain, $allowed) && isset($_SERVER['PRIMARY_DOMAIN']) && $_SERVER['PRIMARY_DOMAIN']) {
    $domain = $_SERVER['PRIMARY_DOMAIN'];
  }
} elseif (isset($_SERVER['PRIMARY_DOMAIN']) && $_SERVER['PRIMARY_DOMAIN']) {
  $domain = $_SERVER['PRIMARY_DOMAIN'];
}

// set site urls
define('WP_HOME', $scheme . '://' . $domain);
define('WP_SITEURL', $scheme . '://' . $domain);

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', $_ENV['WORDPRESS_DB_NAME']);

/** MySQL database username */
define('DB_USER', $_ENV['WORDPRESS_DB_USER']);

/** MySQL database password */
define('DB_PASSWORD', $_ENV['WORDPRESS_DB_PASSWORD']);

/** MySQL hostname */
define('DB_HOST', $_ENV['WORDPRESS_DB_HOST']);

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
define('AUTH_KEY',         'c3b/181&fX3S&+GV%!c9');
define('SECURE_AUTH_KEY',  'hrnL& kTYM4MK2w5YO=5');
define('LOGGED_IN_KEY',    'UYLhIgP(5$r$tS8gLUb6');
define('NONCE_KEY',        '%zJIVmyZ5LI4f%46k+7W');
define('AUTH_SALT',        '$y*W8Z4p)d#aF+W)aXcd');
define('SECURE_AUTH_SALT', 'KtZpyMrKjU#wp$k4Ac8B');
define('LOGGED_IN_SALT',   'yWqM8fxYwxFU9c&s$TT8');
define('NONCE_SALT',       'jaNz@NKBVs#%SFcGJxN9');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'bg_';
//define( 'FORCE_SSL_LOGIN', 1 );
define('FORCE_SSL_ADMIN', false);

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 */
// Enable WP_DEBUG mode
define('WP_DEBUG', true);

// Enable Debug logging to the /wp-content/debug.log file
define('WP_DEBUG_LOG', true);

// Disable display of errors and warnings
define('WP_DEBUG_DISPLAY', false);
@ini_set('display_errors', 0);

// Use dev versions of core JS and CSS files (only needed if you are modifying these core files)
define('SCRIPT_DEBUG', true);

//define( 'WP_CACHE', true );
define('FS_METHOD', 'direct');
define('FS_CHMOD_DIR', (0705 & ~umask()));
define('FS_CHMOD_FILE', (0604 & ~umask()));


/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if (!defined('ABSPATH'))
  define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
