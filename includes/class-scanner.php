<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class WTAC_Scanner {

    public function run() {
        $results = [];
        $urls    = $this->get_urls_to_scan();

        foreach ( $urls as $url ) {
            $response = wp_remote_get( esc_url_raw( $url ) );

            if ( is_wp_error( $response ) ) {
                continue;
            }

            $html = wp_remote_retrieve_body( $response );

            if ( empty( $html ) ) {
                continue;
            }

            // Missing image alt attributes
            if ( preg_match_all( '/<img[^>]*>/i', $html, $images ) ) {
                foreach ( $images[0] as $img ) {
                    if ( ! preg_match( '/alt\s*=\s*["\'].*?["\']/', $img ) ) {
                        $results[] = [
                                'issue_type' => 'missing_alt',
                                'message'    => sprintf(
                                    __( 'Image missing alt attribute on %s', 'accessibility-site-scanner' ),
                                    esc_url( $url )
                                ),
                                'element' => esc_html( $img ),
                            ];

                    }
                }
            }

            // Empty links
            if ( preg_match_all( '/<a[^>]*>(.*?)<\/a>/is', $html, $links ) ) {
                foreach ( $links[1] as $link_text ) {
                    if ( trim( wp_strip_all_tags( $link_text ) ) === '' ) {
                        $results[] = [
                            'issue_type' => 'empty_link',
                            'message'    => sprintf(
                                __( 'Empty link detected on %s', 'accessibility-site-scanner' ),
                                esc_url( $url )
                            ),
                            'element' => esc_html( $links[0][ array_search( $link_text, $links[1], true ) ] ),
                        ];

                    }
                }
            }
        }

        return $results;
    }

    private function get_urls_to_scan() {
        $urls = [];

        $posts = get_posts([
            'post_type'      => 'any',
            'post_status'    => 'publish',
            'posts_per_page' => 10,
        ]);

        foreach ( $posts as $post ) {
            $urls[] = get_permalink( $post );
        }

        return array_unique( $urls );
    }
}
