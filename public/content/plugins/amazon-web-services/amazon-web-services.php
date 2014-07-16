<?php
/*
Plugin Name: Amazon Web Services
Plugin URI: http://wordpress.org/extend/plugins/amazon-web-services/
Description: Includes the Amazon Web Services PHP libraries, stores access keys, and allows other plugins to hook into it
Author: Brad Touesnard
Version: 0.1
Author URI: http://bradt.ca/
*/

// Copyright (c) 2013 Brad Touesnard. All rights reserved.
//
// Released under the GPL license
// http://www.opensource.org/licenses/gpl-license.php
//
// **********************************************************************
// This program is distributed in the hope that it will be useful, but
// WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
// **********************************************************************

function amazon_web_services_incompatibile( $msg ) {
	require_once ABSPATH . '/wp-admin/includes/plugin.php';
	deactivate_plugins( __FILE__ );
    wp_die( $msg );
}

if ( is_admin() && ( !defined( 'DOING_AJAX' ) || !DOING_AJAX ) ) {
	if ( version_compare( PHP_VERSION, '5.3.3', '<' ) ) {
		amazon_web_services_incompatibile( __( 'The official Amazon Web Services SDK requires PHP 5.3.3 or higher. The plugin has now disabled itself.', 'amazon-web-services' ) );
	}
	elseif ( !function_exists( 'curl_version' ) 
		|| !( $curl = curl_version() ) || empty( $curl['version'] ) || empty( $curl['features'] )
		|| version_compare( $curl['version'], '7.16.2', '<' ) )
	{
		amazon_web_services_incompatibile( __( 'The official Amazon Web Services SDK requires cURL 7.16.2+. The plugin has now disabled itself.', 'amazon-web-services' ) );
	}
	elseif ( !( $curl['features'] & CURL_VERSION_SSL ) ) {
		amazon_web_services_incompatibile( __( 'The official Amazon Web Services SDK requires that cURL is compiled with OpenSSL. The plugin has now disabled itself.', 'amazon-web-services' ) );
	}
	elseif ( !( $curl['features'] & CURL_VERSION_LIBZ ) ) {
		amazon_web_services_incompatibile( __( 'The official Amazon Web Services SDK requires that cURL is compiled with zlib. The plugin has now disabled itself.', 'amazon-web-services' ) );
	}
}

require_once 'classes/aws-plugin-base.php';
require_once 'classes/amazon-web-services.php';
require_once 'vendor/aws/aws-autoloader.php';

function amazon_web_services_init() {
    global $amazon_web_services;
    $amazon_web_services = new Amazon_Web_Services( __FILE__ );
}

add_action( 'init', 'amazon_web_services_init' );

function amazon_web_services_activation() {
	// Migrate keys over from old Amazon S3 and CloudFront plugin settings
	if ( !( $as3cf = get_option( 'tantan_wordpress_s3' ) ) ) {
		return;
	}

	if ( !isset( $as3cf['key'] ) || !isset( $as3cf['secret'] ) ) {
		return;
	}

	if ( !get_site_option( Amazon_Web_Services::SETTINGS_KEY ) ) {
		add_site_option( Amazon_Web_Services::SETTINGS_KEY, array(
			'access_key_id' => $as3cf['key'],
			'secret_access_key' => $as3cf['secret']
		) );
	}

	unset( $as3cf['key'] );
	unset( $as3cf['secret'] );

	update_option( 'tantan_wordpress_s3', $as3cf );
}
register_activation_hook( __FILE__, 'amazon_web_services_activation' );