<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class ASS_Admin_UI {

    private $results = [];

    public function __construct() {
        add_action( 'admin_menu', [ $this, 'register_menu' ] );
    }

    public function register_menu() {
        add_menu_page(
            __( 'WebTechee AccessScan', 'webtechee-accessscan' ),
            __( 'AccessScan', 'webtechee-accessscan' ),
            'manage_options',
            'webtechee-accessscan',
            [ $this, 'render_page' ],
            'dashicons-universal-access',
            80
        );
    }

    public function render_page() {

        if ( isset( $_POST['wtas_run_scan'] ) ) {

            if (
                ! isset( $_POST['wtas_nonce'] ) ||
                ! wp_verify_nonce( $_POST['wtas_nonce'], 'wtas_run_scan_action' )
            ) {
                return;
            }

            $scanner       = new ASS_Scanner();
            $this->results = $scanner->run();
        }
        ?>
        <div class="wrap">
            <h1><?php esc_html_e( 'WebTechee AccessScan', 'webtechee-accessscan' ); ?></h1>

            <p><?php esc_html_e(
                'Run an automated accessibility scan to detect common accessibility issues.',
                'webtechee-accessscan'
            ); ?></p>

            <form method="post">
                <?php wp_nonce_field( 'wtas_run_scan_action', 'wtas_nonce' ); ?>
                <p>
                    <input
                        type="submit"
                        name="wtas_run_scan"
                        class="button button-primary"
                        value="<?php esc_attr_e( 'Run Scan', 'webtechee-accessscan' ); ?>">
                </p>
            </form>

            <?php if ( ! empty( $this->results ) ) : ?>
                <h2><?php esc_html_e( 'Scan Results', 'webtechee-accessscan' ); ?></h2>
                <table class="widefat striped">
                    <thead>
                        <tr>
                            <th><?php esc_html_e( 'Element', 'webtechee-accessscan' ); ?></th>
                            <th><?php esc_html_e( 'Issue Type', 'webtechee-accessscan' ); ?></th>
                            <th><?php esc_html_e( 'Message', 'webtechee-accessscan' ); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ( $this->results as $row ) : ?>
                            <tr>
                                <td>
                                    <code style="white-space: pre-wrap; display: block; max-width: 600px;">
                                        <?php echo esc_html( $row['element'] ?? '-' ); ?>
                                    </code>
                                </td>
                                <td><?php echo esc_html( $row['issue_type'] ); ?></td>
                                <td><?php echo esc_html( $row['message'] ); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php elseif ( isset( $_POST['wtas_run_scan'] ) ) : ?>
                <p><?php esc_html_e(
                    'No accessibility issues detected.',
                    'webtechee-accessscan'
                ); ?></p>
            <?php endif; ?>
        </div>
        <?php
    }
}
