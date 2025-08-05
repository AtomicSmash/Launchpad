<?php
/**
 * Mailtrap
 */

namespace Launchpad\Mailtrap;

if ( wp_get_environment_type() !== 'production' ) {
	/**
	 * Block emails on any non-production environment.
	 *
	 * @param \PHPMailer\PHPMailer\PHPMailer $phpmailer The class that makes PHP's mail() function work.
	 */
	function mailtrap( \PHPMailer\PHPMailer\PHPMailer $phpmailer ): void {
		// phpcs:disable WordPress.NamingConventions.ValidVariableName.UsedPropertyNotSnakeCase
		$phpmailer->isSMTP();
		$phpmailer->Host = 'sandbox.smtp.mailtrap.io';
		$phpmailer->SMTPAuth = true;
		$phpmailer->Port = 2525;
		$phpmailer->Username = \MAILTRAP_USERNAME;
		$phpmailer->Password = \MAILTRAP_PASSWORD;
	}
	add_action( 'phpmailer_init', __NAMESPACE__ . '\\mailtrap' );
}
