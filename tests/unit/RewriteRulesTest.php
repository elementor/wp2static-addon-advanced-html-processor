<?php

namespace WP2Static;

use PHPUnit\Framework\TestCase;

final class RewriteRulesTest extends TestCase{

    /**
     * @dataProvider generateProvider
     */
    public function testgenerate( $site_url, $destination_url, $expectation) {
        $rewriteRules =
           RewriteRules::generate( $site_url, $destination_url );

        $this->assertEquals(
            $expectation,
            $rewriteRules
        );
    }

    public function testgetRulesReturnsEmptyArrayWhenEmptyArg() {
        $rewriteRules =
           RewriteRules::getUserRewriteRules( '' );

        $this->assertEquals(
            [],
            $rewriteRules
        );
    }

    public function generateProvider() {
        return [
           'naked domain site and destination' =>  [
                'http://mywpsite.com/',
                'https://mylivesite.com/',
                [
                    'site_url_patterns' => [
                        'http://mywpsite.com',
                        'http:\/\/mywpsite.com',
                    ],
                    'destination_url_patterns' => [
                        'https://mylivesite.com',
                        'https:\/\/mylivesite.com',
                    ],
                ],
            ],
           'subdomain site, subdir destination' =>  [
                'http://dev.mywpsite.com/',
                'https://mylivesite.com/static/',
                [
                    'site_url_patterns' => [
                        'http://dev.mywpsite.com',
                        'http:\/\/dev.mywpsite.com',
                    ],
                    'destination_url_patterns' => [
                        'https://mylivesite.com/static',
                        'https:\/\/mylivesite.com\/static',
                    ],
                ],
            ],
        ];
    }

    /**
     * @dataProvider getUserRewriteRulesProvider
     */
    public function testgetUserRewriteRules( $user_rewrite_rules, $expectation) {
        $rewriteRules =
           RewriteRules::getUserRewriteRules( $user_rewrite_rules );

        $this->assertEquals(
            $expectation,
            $rewriteRules
        );
    }

    public function getUserRewriteRulesProvider() {
        return [
           'puts shortest paths first' =>  [
                'wp-content/themes/,content/ui/' . PHP_EOL .
                'content/ui/twentyseventeen/,content/ui/theme/' . PHP_EOL .
                'https://somedomain.com,https://mycdn.com' . PHP_EOL .
                'wp-includes/,inc/' . PHP_EOL,
                [
                    'from' => [
                        'wp-includes/',
                        'wp-content/themes/',
                        'https://somedomain.com',
                        'content/ui/twentyseventeen/',
                    ],
                    'to' => [
                        'inc/',
                        'content/ui/',
                        'https://mycdn.com',
                        'content/ui/theme/',
                    ],
                ],
            ],
        ];
    }
}
