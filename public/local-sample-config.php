<?php
/*
 * This is a sample local-config.php file
 * In it, you *must* include the four main database defines
 * 
 * You may include other settings here that you only want enabled on your local development checkouts
 */



/** The name of the database for WordPress */
define("DB_NAME", "database" );

/** MySQL database username */
define("DB_USER", "root" );

/** MySQL database password */
define("DB_PASSWORD", "root" );

/** MySQL hostname */
define("DB_HOST", "localhost" ); // Probably "localhost"


/** You could also hijack the CLEARDB environment variable if you set this in the .env file */
// CLEARDB_DATABASE_URL=mysql://root:123abc@127.0.0.1/my_wordpress_heroku_database_name

/*

	$url = parse_url(getenv("CLEARDB_DATABASE_URL"));

	define("DB_NAME", trim($url["path"], "/"));
	define("DB_USER", trim($url["user"]));
	define("DB_PASSWORD", trim($url["pass"]));
	define("DB_HOST", trim($url["host"]));

*/


define("SAVEQUERIES", true );

define("WP_DEBUG", true );

/** Writes the error log to /content/debug.log */
define("WP_DEBUG_LOG", true );
define("WP_DEBUG_DISPLAY", false );
//@ini_set( "display_errors", 0 );

define("WP_POST_REVISIONS", 3 );