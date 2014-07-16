<div class="aws-content aws-addons">

	<?php
	$addons = array(
		'amazon-s3-and-cloudfront' => array(
			'title' => __( 'Amazon S3 and CloudFront', 'amazon-web-services' ),
			'path' => 'amazon-s3-and-cloudfront/wordpress-s3.php'
		)
	);

	foreach ( $addons as $slug => $addon ) :
		$details_url = self_admin_url( 'plugin-install.php?tab=plugin-information&amp;plugin=' . $slug . '&amp;TB_iframe=true&amp;width=600&amp;height=550' );
		?>

		<article class="addon as3cf">
			<div class="info">
				<h1><?php echo $addon['title']; ?></h1>
				<ul class="actions">
					<li><a class="thickbox" href="<?php echo $details_url; ?>"><?php _e( 'View Details', 'amazon-web-services' ); ?></a></li>
					<?php
					if ( file_exists( WP_PLUGIN_DIR . '/' . $addon['path'] ) ) {
						echo '<li><span>' . _x( 'Already Installed', 'amazon-web-services' ) . '</span></li>';
					}
					else {
						echo '<li><a class="install-now" href="' . $this->get_plugin_install_url( $slug ) . '">' . __( 'Install Now', 'amazon-web-services' ) . '</a></li>';
					}
					?>
				</ul>
			</div>
		</article>

		<?php
	endforeach;
	?>

</div>