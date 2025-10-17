<?php
/**
 * Roles and capabilities
 */

namespace Launchpad\RolesAndCapabilities;

/**
 * Add or change custom roles
 */
function update_custom_roles(): void {
	if ( get_option( 'add_as_client_role' ) < 1 ) {
		if ( get_role( 'as-client' ) ) {
			remove_role( 'as-client' );
		}
		$as_client_role = add_role( 'as-client', 'AS Client', get_role( 'editor' )->capabilities );
		// Let clients to edit template parts etc.
		$as_client_role->add_cap( 'edit_theme_options' );
		// Add gravity forms access to all users
		$as_client_role->add_cap( 'gform_full_access' );
		// Add access to edit users
		$as_client_role->add_cap( 'list_users' );
		$as_client_role->add_cap( 'promote_users' );
		$as_client_role->add_cap( 'remove_users' );
		$as_client_role->add_cap( 'edit_users' );
		$as_client_role->add_cap( 'add_users' );
		$as_client_role->add_cap( 'create_users' );
		$as_client_role->add_cap( 'delete_users' );

		update_option( 'add_as_client_role', 1 );
	}
	if ( get_option( 'add_tester_role' ) < 1 ) {
		if ( get_role( 'tester' ) ) {
			remove_role( 'tester' );
		}
		add_role( 'tester', 'Tester', get_role( 'as-client' )->capabilities );
		update_option( 'add_tester_role', 1 );
	}
}
add_action( 'init', __NAMESPACE__ . '\\update_custom_roles' );
