
    public function removeWPCruft() : void {
        if ( file_exists( $this->archive_path . '/xmlrpc.php' ) ) {
            unlink( $this->archive_path . '/xmlrpc.php' );
        }

        if ( file_exists( $this->archive_path . '/wp-login.php' ) ) {
            unlink( $this->archive_path . '/wp-login.php' );
        }

        FilesHelper::delete_dir_with_files(
            $this->archive_path . '/wp-json/'
        );
    }

