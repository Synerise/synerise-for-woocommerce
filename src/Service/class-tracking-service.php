<?php
/**
 * Synerise for WooCommerce Tracking
 *
 * @package     Synerise_For_WooCommerce/Classes/
 * @version     1.0.0
 */

namespace Synerise\Integration\Service;

use Synerise\DataManagement\Model\TrackingCodeCreationByDomainRequest;
use Synerise\Integration\Synerise_For_Woocommerce;
use WC_Product_Variable;

if (!defined('ABSPATH')) {
    exit;
}

class Tracking_Service
{
    const APPLICATION_NAME = 'woocommerce';

    const TRACKER_HOSTS = array(
        "AZURE" => array(
            'value' => 'web.snrbox.com',
            'label' => 'AZURE'
        ),
        "GEB" => array(
            'value' => 'web.geb.snrbox.com',
            'label' => 'GCP'
        ),
    );

    public static function is_tracking_enabled(): bool
    {
        return (bool)Synerise_For_Woocommerce::get_setting('page_tracking_enabled');
    }

    public static function is_event_enabled($event): bool
    {
        $eventsEnabled = Synerise_For_Woocommerce::get_setting('event_tracking_events');
        $index = array_search($event, array_column($eventsEnabled, 'value'));

        if ($index !== FALSE) {
            return true;
        } else {
            return false;
        }
    }

    public static function add_or_remove_tracking_code($cookie_domain)
    {
        if (!$cookie_domain) {
            return Synerise_For_Woocommerce::remove_setting('page_tracking_code');
        }

        $trackerApi = Synerise_For_Woocommerce::get_tracker_api_factory()->create();
        $response = $trackerApi->getOrCreateByDomain(
            new TrackingCodeCreationByDomainRequest(['domain' => $cookie_domain])
        );

        return Synerise_For_Woocommerce::save_setting('page_tracking_code', $response->getCode());
    }

    public static function print_script()
    {
        $customScript = Synerise_For_Woocommerce::get_setting('page_tracking_custom_script_enabled');
        if ($customScript) {
            $script = Synerise_For_Woocommerce::get_setting('page_tracking_custom_script');
            if (!empty($script)) {
                echo $script;
            }
        } else {
            $scriptOptions = self::getScriptOptions();
            if ($scriptOptions) { ?>
                <script>
                    function onSyneriseLoad() {
                        SR.init({<?php echo $scriptOptions ?>});
                    }

                    (function (s, y, n, e, r, i, se) {
                        s['SyneriseObjectNamespace'] = r;
                        s[r] = s[r] || [],
                            s[r]._t = 1 * new Date(), s[r]._i = 0, s[r]._l = i;
                        var z = y.createElement(n),
                            se = y.getElementsByTagName(n)[0];
                        z.async = 1;
                        z.src = e;
                        se.parentNode.insertBefore(z, se);
                        z.onload = z.onreadystatechange = function () {
                            var rdy = z.readyState;
                            if (!rdy || /complete|loaded/.test(z.readyState)) {
                                s[i]();
                                z.onload = null;
                                z.onreadystatechange = null;
                            }
                        };
                    })(window, document, 'script',
                        '//<?php echo self::get_tracking_host() ?>/synerise-javascript-sdk.min.js', 'SR', 'onSyneriseLoad');
                </script>
            <?php }
        }
    }

    protected static function getScriptOptions()
    {
        $options = [];
        $trackerKey = Synerise_For_Woocommerce::get_setting('page_tracking_code');
        if ($trackerKey) {
            $options[] = "'trackerKey': '$trackerKey'";
        }

        $cookieDomain = Synerise_For_Woocommerce::get_setting('page_tracking_cookie_domain');
        if ($cookieDomain) {
            $options[] = "'domain': '$cookieDomain'";
        }

        return implode(', ', $options);
    }

    /**
     * @return string
     * @since 1.0.10
     */
    public static function get_tracking_host(): string
    {
        $host = Synerise_For_Woocommerce::get_setting('page_tracking_tracker_host');
        if ($host) {
            return $host;
        } else {
            return self::TRACKER_HOSTS['AZURE']['value'];
        }
    }

    public static function add_variation_change_script()
    {
        global $product;
        if ($product instanceof WC_Product_Variable) {
            wp_enqueue_script('synerise-for-woocommerce-tracking', SYNERISE_FOR_WOOCOMMERCE_PUBLIC_URL . '/js/' . 'synerise-for-woocommerce-tracking.js', array(), time(), false);
            wp_localize_script('synerise-for-woocommerce-tracking', 'rest', [
                'url' => get_rest_url() . 'synerise-for-woocommerce' . '/v1/',
                'nonce' => wp_create_nonce('wp_rest')
            ]);
        }
    }

    public static function should_include_snrs_params()
    {
        return (bool)Synerise_For_Woocommerce::get_setting('event_tracking_snrs_params_include');
    }
}
