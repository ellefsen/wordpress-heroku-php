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

require_once(__DIR__ . '/../vendor/autoload.php');
// (new \Dotenv\Dotenv(__DIR__.'/../'))->load();

if ( file_exists( dirname( __FILE__ ) . '/local-config.php' ) ) {

	/** Declare Dev-mode for WordPress */
	define( 'WP_LOCAL_DEV', true );

	/** Include config for dev environment */
	include( dirname( __FILE__ ) . '/local-config.php' );

} else {

	$url = parse_url(getenv("CLEARDB_DATABASE_URL"));

	/** The name of the database for WordPress */
	define("DB_NAME", trim($url["path"], "/"));

	/** MySQL database username */
	define("DB_USER", trim($url["user"]));

	/** MySQL database password */
	define("DB_PASSWORD", trim($url["pass"]));

	/** MySQL hostname */
	define("DB_HOST", trim($url["host"]));

	/** MySQL database port  */
	// define("DB_PORT", trim($url["port"]));

	/** Database Charset to use in creating database tables. */
	define("DB_CHARSET", "utf8");

	/** Allows both foobar.com and foobar.herokuapp.com to load media assets correctly. Also adds /wp/ to give WordPress its own directory. */
	define("WP_SITEURL", "http://" . $_SERVER["HTTP_HOST"] . "/wp/");
	define("WP_HOME", "http://" . $_SERVER["HTTP_HOST"]);

	define("FORCE_SSL_LOGIN", getenv("FORCE_SSL_LOGIN") == "true");
	define("FORCE_SSL_ADMIN", getenv("FORCE_SSL_ADMIN") == "true");
	if ($_SERVER["HTTP_X_FORWARDED_PROTO"] == "https")
	  $_SERVER["HTTPS"] = "on";

	/** Enable the WordPress Object Cache */
	define("WP_CACHE", getenv("WP_CACHE") == "true");

	/** Disable the built-in cron job */
	define("DISABLE_WP_CRON", getenv("DISABLE_WP_CRON") == "true");

	/** Disable automatic updates, they won't survive restarting and scaling dynos */
	define("AUTOMATIC_UPDATER_DISABLED", true );

	/**  Prevent File Modifications */
	define ("DISALLOW_FILE_EDIT", true );

	/**  Prevent installation of themes or plugins */
	define("DISALLOW_FILE_MODS", true );

	/** For developers: WordPress debugging mode. */
	define("WP_DEBUG", getenv("WP_DEBUG") == "true");

}

/** The Database Collate type. Don't change this if in doubt. */
define("DB_COLLATE", "");

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'put your unique phrase here');
define('SECURE_AUTH_KEY',  'put your unique phrase here');
define('LOGGED_IN_KEY',    'put your unique phrase here');
define('NONCE_KEY',        'put your unique phrase here');
define('AUTH_SALT',        'put your unique phrase here');
define('SECURE_AUTH_SALT', 'put your unique phrase here');
define('LOGGED_IN_SALT',   'put your unique phrase here');
define('NONCE_SALT',       'put your unique phrase here');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = "wp_";

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to "de_DE" to enable German
 * language support.
 */
define("WPLANG", "");

/**
 * AWS Plugin Auth Keys
 */
define( "AWS_ACCESS_KEY_ID", getenv("AWS_ACCESS_KEY_ID") );
define( "AWS_SECRET_ACCESS_KEY", getenv("AWS_SECRET_ACCESS_KEY") );

/* That"s all, stop editing! Happy blogging. */

define( "WP_CONTENT_DIR", $_SERVER['DOCUMENT_ROOT'] . "/content" );
define( "WP_CONTENT_URL", "http://" . $_SERVER['HTTP_HOST'] . "/content" );

/** Absolute path to the WordPress directory. */
if ( !defined("ABSPATH") )
  define("ABSPATH", dirname(__FILE__) . "/");

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . "wp-settings.php");
