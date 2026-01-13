<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class WTAC_Admin_UI {

    private $results = [];

    public function __construct() {
        add_action( 'admin_menu', [ $this, 'register_menu' ] );
    }

    public function register_menu() {
        add_menu_page(
            __( 'WebTechee AccessScan', 'accessibility-site-scanner' ),
            __( 'AccessScan', 'accessibility-site-scanner' ),
            'manage_options',
            'webtechee-accessscan',
            [ $this, 'render_page' ],
            'dashicons-universal-access',
            80
        );
    }

    public function render_page() {

        if ( isset( $_POST['wtac_run_scan'] ) ) {

            if (
                ! isset( $_POST['wtac_nonce'] ) ||
                ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['wtac_nonce'] ) ), 'wtac_run_scan_action' )
            ) {
                return;
            }

            $scanner       = new WTAC_Scanner();
            $this->results = $scanner->run();
        }
        ?>
        <div class="wrap">
            <h1><?php esc_html_e( 'WebTechee AccessScan', 'accessibility-site-scanner' ); ?></h1>

            <p><?php esc_html_e(
                'Run an automated accessibility scan to detect common accessibility issues.',
                'accessibility-site-scanner'
            ); ?></p>

            <form method="post">
                <?php wp_nonce_field( 'wtac_run_scan_action', 'wtac_nonce' ); ?>
                <p>
                    <input
                        type="submit"
                        name="wtac_run_scan"
                        class="button button-primary"
                        value="<?php esc_attr_e( 'Run Scan', 'accessibility-site-scanner' ); ?>">
                </p>
            </form>

            <?php if ( ! empty( $this->results ) ) : ?>
                <h2><?php esc_html_e( 'Scan Results', 'accessibility-site-scanner' ); ?></h2>
                <table class="widefat striped">
                    <thead>
                        <tr>
                            <th><?php esc_html_e( 'Element', 'accessibility-site-scanner' ); ?></th>
                            <th><?php esc_html_e( 'Issue Type', 'accessibility-site-scanner' ); ?></th>
                            <th><?php esc_html_e( 'Message', 'accessibility-site-scanner' ); ?></th>
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
            <?php elseif ( isset( $_POST['wtac_run_scan'] ) ) : ?>
                <p><?php esc_html_e(
                    'No accessibility issues detected.',
                    'accessibility-site-scanner'
                ); ?></p>
            <?php endif; ?>
        </div>
        <?php
    }
}
