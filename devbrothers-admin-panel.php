<?php
/**
 * Plugin Name: DevBrothers Admin Panel
 * Plugin URI: https://devbrothers.ru/admin-panel/
 * Description: Centralized admin panel for all DevBrothers plugins. Single access point for settings, information, and management of the plugin ecosystem.
 * Version: 1.0.2
 * Author: DevBrothers
 * Author URI: https://devbrothers.ru
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: devbrothers-admin-panel
 * Requires at least: 5.8
 * Tested up to: 6.9
 * Requires PHP: 7.4
 */

if (!defined('ABSPATH')) {
    exit;
}

define('DEVBROTHERS_VERSION', '1.0.2');
define('DEVBROTHERS_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('DEVBROTHERS_PLUGIN_URL', plugin_dir_url(__FILE__));
define('DEVBROTHERS_PLUGIN_BASENAME', plugin_basename(__FILE__));

class DevBrothers_Admin_Panel {

    /**
     * @var DevBrothers_Admin_Panel
     */
    private static $instance = null;

    /**
     * @var array
     */
    private $registered_plugins = [];

    public static function get_instance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function __construct() {
        $this->load_dependencies();
        $this->init_hooks();
    }

    private function load_dependencies() {
        require_once DEVBROTHERS_PLUGIN_DIR . 'includes/class-devbrothers-registry.php';
    }

    private function init_hooks() {
        add_action('admin_menu', [$this, 'create_admin_menu']);
        add_action('admin_enqueue_scripts', [$this, 'enqueue_admin_assets']);
        add_action('init', [$this, 'allow_plugin_registration'], 0);
    }

    /**
     * Fires devbrothers_ready so child plugins can register.
     * Called on init (priority 0) to ensure translations are loaded (WP 6.7+).
     */
    public function allow_plugin_registration() {
        do_action('devbrothers_ready');
    }

    /**
     * @param array $args Plugin parameters.
     * @return bool
     */
    public function register_plugin($args) {
        $defaults = [
            'id'                => '',
            'name'              => '',
            'name_ru'           => '',
            'description'       => '',
            'version'           => '1.0.0',
            'icon'              => 'dashicons-admin-plugins',
            'settings_callback' => null,
            'categories'        => [],
            'author'            => 'DevBrothers',
            'status'            => 'active',
        ];

        $plugin = wp_parse_args($args, $defaults);

        if (empty($plugin['name_ru'])) {
            $plugin['name_ru'] = $plugin['name'];
        }

        if (empty($plugin['id']) || empty($plugin['name'])) {
            return false;
        }

        if (!is_callable($plugin['settings_callback'])) {
            return false;
        }

        $this->registered_plugins[$plugin['id']] = $plugin;
        return true;
    }

    public function get_registered_plugins() {
        return $this->registered_plugins;
    }

    public function get_plugin($plugin_id) {
        return isset($this->registered_plugins[$plugin_id])
            ? $this->registered_plugins[$plugin_id]
            : null;
    }

    public function create_admin_menu() {
        add_menu_page(
            __('DevBrothers', 'devbrothers-admin-panel'),
            __('DevBrothers', 'devbrothers-admin-panel'),
            'manage_options',
            'devbrothers',
            [$this, 'render_main_page'],
            'dashicons-admin-tools',
            65
        );

        add_submenu_page(
            'devbrothers',
            __('Dashboard', 'devbrothers-admin-panel'),
            __('Dashboard', 'devbrothers-admin-panel'),
            'manage_options',
            'devbrothers',
            [$this, 'render_main_page']
        );

        foreach ($this->registered_plugins as $plugin) {
            add_submenu_page(
                'devbrothers',
                $plugin['name'],
                $plugin['name'],
                'manage_options',
                'devbrothers-plugin-' . $plugin['id'],
                function () use ($plugin) {
                    $this->render_plugin_page($plugin);
                }
            );
        }
    }

    public function enqueue_admin_assets($hook) {
        if (strpos($hook, 'devbrothers') === false) {
            return;
        }

        wp_enqueue_style(
            'devbrothers-admin',
            DEVBROTHERS_PLUGIN_URL . 'assets/css/devbrothers-admin.css',
            [],
            DEVBROTHERS_VERSION
        );

        wp_enqueue_script(
            'devbrothers-admin',
            DEVBROTHERS_PLUGIN_URL . 'assets/js/devbrothers-admin.js',
            ['jquery'],
            DEVBROTHERS_VERSION,
            true
        );

        /**
         * Fires on DevBrothers admin pages so child plugins can load their assets.
         *
         * @param string $hook Current admin page hook suffix.
         */
        do_action('devbrothers_admin_enqueue_scripts', $hook);
    }

    public function render_main_page() {
        include DEVBROTHERS_PLUGIN_DIR . 'includes/views/dashboard.php';
    }

    public function render_plugin_page($plugin) {
        include DEVBROTHERS_PLUGIN_DIR . 'includes/views/plugin-settings.php';
    }
}

function devbrothers_panel() {
    return DevBrothers_Admin_Panel::get_instance();
}

function devbrothers_register_plugin($args) {
    return devbrothers_panel()->register_plugin($args);
}

/**
 * Renders the universal DevBrothers plugin header (title and support).
 *
 * @param array|null $plugin Plugin data array or null for dashboard.
 */
function devbrothers_render_plugin_header($plugin = null) {
    if ($plugin === null) {
        $plugin = [
            'name_ru'     => __('Консоль', 'devbrothers-admin-panel'),
            'name'        => 'Dashboard',
            'description' => __('Единая панель управления всеми вашими плагинами DevBrothers', 'devbrothers-admin-panel'),
            'icon'        => 'dashicons-dashboard',
        ];
    }
    ?>
    <div class="devbrothers-header">
        <div class="devbrothers-header-title">
            <span class="dashicons <?php echo esc_attr($plugin['icon']); ?>"></span>
            <div>
                <h1>
                    <?php echo esc_html($plugin['name_ru'] ?? $plugin['name']); ?>
                    <?php if (!empty($plugin['name']) && isset($plugin['name_ru']) && $plugin['name'] !== $plugin['name_ru']) : ?>
                        <span class="devbrothers-header-title-subtitle"><?php echo esc_html($plugin['name']); ?></span>
                    <?php endif; ?>
                </h1>
                <p class="devbrothers-subtitle"><?php echo esc_html($plugin['description']); ?></p>
            </div>
        </div>

        <div class="devbrothers-header-support">
            <a href="mailto:support@devbrothers.ru" class="devbrothers-header-support-email">
                support@devbrothers.ru
            </a>
            <p class="devbrothers-header-support-label">
                <?php esc_html_e('Молниеносная поддержка', 'devbrothers-admin-panel'); ?>
            </p>
        </div>
    </div>
    <?php
}

add_action('plugins_loaded', 'devbrothers_panel', 10);
