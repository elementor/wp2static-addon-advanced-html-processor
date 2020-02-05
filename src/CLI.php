<?php

namespace WP2StaticAdvancedDetection;

use WP_CLI;


/**
 * WP2StaticAdvancedDetection WP-CLI commands
 *
 * Registers WP-CLI commands for WP2StaticAdvancedDetection under main wp2static cmd
 *
 * Usage: wp wp2static zip get_path|get_url
 */
class CLI {

    /**
     * Zip commands
     *
     * @param string[] $args CLI args
     * @param string[] $assoc_args CLI args
     */
    public function zip (
        array $args,
        array $assoc_args
    ) : void {
        $action = isset( $args[0] ) ? $args[0] : null;

        if ( empty( $action ) ) {
            WP_CLI::error( 'Missing required argument: <get_path|get_url>' );
        }

        if ( $action === 'get_path' ) {
            $zip_path = \WP2Static\SiteInfo::getPath( 'uploads' ) .
                'wp2static-processed-site.zip';
            WP_CLI::line( $zip_path );
        }

        if ( $action === 'get_url' ) {
            $zip_url = \WP2Static\SiteInfo::getUrl( 'uploads' ) .
                'wp2static-processed-site.zip';
            WP_CLI::line( $zip_url );
        }
    }
}

