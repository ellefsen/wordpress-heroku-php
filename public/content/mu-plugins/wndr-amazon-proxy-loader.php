<?php // mu-plugins/load.php

/*
Plugin Name: Amazon S3 and CloudFront for Wordpress on Heroku
Description: Loads the AWS Libs with S3 and CloudFront support.
Version: 1.0
Author: Kim Ellefsen
Author URI: http://www.wndr.no
License: MIT
*/

require_once WPMU_PLUGIN_DIR.'/amazon-web-services/amazon-web-services.php';
require_once WPMU_PLUGIN_DIR.'/amazon-s3-and-cloudfront/wordpress-s3.php';
