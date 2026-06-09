<?php
/**
 * Реестр плагинов DevBrothers
 *
 * @package DevBrothers_Admin_Panel
 */

if (!defined('ABSPATH')) {
    exit;
}

class DevBrothers_Registry {

    /**
     * Full plugin catalog (installed plugins are filtered out later).
     *
     * @return array
     */
    public static function get_catalog() {
        $catalog = require DEVBROTHERS_PLUGIN_DIR . 'includes/devbrothers-plugins-manifest.php';

        /**
         * Filters the DevBrothers plugin catalog shown on the dashboard.
         *
         * @param array $catalog Plugin catalog entries.
         */
        $catalog = apply_filters('devbrothers_catalog_plugins', $catalog);

        return array_map([__CLASS__, 'normalize_catalog_entry'], $catalog);
    }

    /**
     * Plugins available for download but not yet installed.
     *
     * @return array
     */
    public static function get_available_plugins() {
        $installed     = devbrothers_panel()->get_registered_plugins();
        $installed_ids = array_keys($installed);

        $available = array_filter(
            self::get_catalog(),
            function ($plugin) use ($installed_ids) {
                return !in_array($plugin['id'], $installed_ids, true);
            }
        );

        usort($available, [__CLASS__, 'sort_catalog_entries']);

        return array_values($available);
    }

    /**
     * @return array{installed: int, available: int, total: int}
     */
    public static function get_statistics() {
        $installed = count(devbrothers_panel()->get_registered_plugins());
        $available = count(self::get_available_plugins());

        return [
            'installed' => $installed,
            'available' => $available,
            'total'     => $installed + $available,
        ];
    }

    /**
     * @param array $plugin Catalog entry.
     * @return array
     */
    private static function normalize_catalog_entry($plugin) {
        $source = $plugin['source'] ?? 'coming-soon';
        $status = $plugin['status'] ?? 'coming-soon';

        if ('wordpress-org' === $source) {
            $status = 'available';
        }

        if ('github' === $source && empty($plugin['download_url'])) {
            $status = 'coming-soon';
        }

        $plugin['source'] = $source;
        $plugin['status'] = $status;

        if ('available' === $status && empty($plugin['download_url'])) {
            if ('wordpress-org' === $source && !empty($plugin['slug'])) {
                $plugin['download_url'] = admin_url(
                    'plugin-install.php?tab=search&s=' . rawurlencode($plugin['slug'])
                );
            }
        }

        return $plugin;
    }

    /**
     * Available plugins first, coming-soon last; then alphabetical by name.
     *
     * @param array $a Catalog entry.
     * @param array $b Catalog entry.
     * @return int
     */
    private static function sort_catalog_entries($a, $b) {
        $order = [
            'available'    => 0,
            'coming-soon'  => 1,
        ];

        $a_order = $order[$a['status']] ?? 2;
        $b_order = $order[$b['status']] ?? 2;

        if ($a_order !== $b_order) {
            return $a_order <=> $b_order;
        }

        return strcasecmp($a['name'], $b['name']);
    }
}
