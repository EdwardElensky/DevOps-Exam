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
 * This has been slightly modified (to read environment variables) for use in Docker.
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// IMPORTANT: this file needs to stay in-sync with https://github.com/WordPress/WordPress/blob/master/wp-config-sample.php
// (it gets parsed by the upstream wizard in https://github.com/WordPress/WordPress/blob/f27cb65e1ef25d11b535695a660e7282b98eb742/wp-admin/setup-config.php#L356-L392)

// a helper function to lookup "env_FILE", "env", then fallback
function getenv_docker($env, $default) {
	if ($fileEnv = getenv($env . '_FILE')) {
		return rtrim(file_get_contents($fileEnv), "\r\n");
	}
	else if (($val = getenv($env)) !== false) {
		return $val;
	}
	else {
		return $default;
	}
}

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', getenv_docker('WORDPRESS_DB_NAME', 'wordpress') );

/** MySQL database username */
define( 'DB_USER', getenv_docker('WORDPRESS_DB_USER', 'example username') );

/** MySQL database password */
define( 'DB_PASSWORD', getenv_docker('WORDPRESS_DB_PASSWORD', 'example password') );

/**
 * Docker image fallback values above are sourced from the official WordPress installation wizard:
 * https://github.com/WordPress/WordPress/blob/f9cc35ebad82753e9c86de322ea5c76a9001c7e2/wp-admin/setup-config.php#L216-L230
 * (However, using "example username" and "example password" in your database is strongly discouraged.  Please use strong, random credentials!)
 */

/** MySQL hostname */
define( 'DB_HOST', getenv_docker('WORDPRESS_DB_HOST', 'mysql') );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', getenv_docker('WORDPRESS_DB_CHARSET', 'utf8') );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', getenv_docker('WORDPRESS_DB_COLLATE', '') );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         getenv_docker('WORDPRESS_AUTH_KEY',         '5e51f7e928e9abb4ef3f3d9a4564cf460c952de5') );
define( 'SECURE_AUTH_KEY',  getenv_docker('WORDPRESS_SECURE_AUTH_KEY',  '620fe8c2d419b8d8ac295cfd1f3912a1dcdb4867') );
define( 'LOGGED_IN_KEY',    getenv_docker('WORDPRESS_LOGGED_IN_KEY',    '4862aade63678bb01338fb081ff424c21b10d7fd') );
define( 'NONCE_KEY',        getenv_docker('WORDPRESS_NONCE_KEY',        '09f74a330a00db501437526c7fd502825b45d96c') );
define( 'AUTH_SALT',        getenv_docker('WORDPRESS_AUTH_SALT',        'f11da51b8687585e57a716ed2b82a8a0156095c0') );
define( 'SECURE_AUTH_SALT', getenv_docker('WORDPRESS_SECURE_AUTH_SALT', 'a37fcba9d687baff40b5e8fe83a056aabe4d0335') );
define( 'LOGGED_IN_SALT',   getenv_docker('WORDPRESS_LOGGED_IN_SALT',   '5ad0e73d1c99a3b603e9010ea513cbf2ad4d2641') );
define( 'NONCE_SALT',       getenv_docker('WORDPRESS_NONCE_SALT',       'cd4639fa3c0cec1f3fa6ff267044077878c12825') );
// (See also https://wordpress.stackexchange.com/a/152905/199287)

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = getenv_docker('WORDPRESS_TABLE_PREFIX', 'wp_');

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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', !!getenv_docker('WORDPRESS_DEBUG', '') );

// If we're behind a proxy server and using HTTPS, we need to alert WordPress of that fact
// see also http://codex.wordpress.org/Administration_Over_SSL#Using_a_Reverse_Proxy
if (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') {
	$_SERVER['HTTPS'] = 'on';
}
// (we include this by default because reverse proxying is extremely common in container environments)

if ($configExtra = getenv_docker('WORDPRESS_CONFIG_EXTRA', '')) {
	eval($configExtra);
}

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
