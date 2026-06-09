<?php
/**
 * Страница настроек плагина
 *
 * @package DevBrothers_Admin_Panel
 */

if (!defined('ABSPATH')) {
    exit;
}

if (!current_user_can('manage_options')) {
    wp_die(esc_html__('You do not have sufficient permissions to access this page.', 'devbrothers-admin-panel'));
}

// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound -- $plugin передается из render_plugin_page()
$devbrothers_plugin            = $plugin;
$devbrothers_installed_plugins = devbrothers_panel()->get_registered_plugins();
$devbrothers_active_page       = $devbrothers_plugin['id'];
?>

<div class="devbrothers-wrapper">
    <?php include __DIR__ . '/sidebar.php'; ?>

    <div class="devbrothers-content">
        <?php devbrothers_render_plugin_header($devbrothers_plugin); ?>

        <div class="devbrothers-plugin-page">
            <?php if (!empty($devbrothers_plugin['categories'])) : ?>
            <div class="devbrothers-anchors">
                <div class="devbrothers-anchors-sticky">
                    <h3><?php esc_html_e('Категории настроек', 'devbrothers-admin-panel'); ?></h3>
                    <nav class="devbrothers-anchors-nav">
                        <?php foreach ($devbrothers_plugin['categories'] as $devbrothers_category) : ?>
                            <a href="#<?php echo esc_attr($devbrothers_category['id']); ?>"
                               class="devbrothers-anchor-link"
                               data-anchor="<?php echo esc_attr($devbrothers_category['id']); ?>">
                                <?php if (!empty($devbrothers_category['icon'])) : ?>
                                    <span class="dashicons <?php echo esc_attr($devbrothers_category['icon']); ?>"></span>
                                <?php endif; ?>
                                <?php echo esc_html($devbrothers_category['name']); ?>
                            </a>
                        <?php endforeach; ?>
                    </nav>
                </div>
            </div>
            <?php endif; ?>

            <div class="devbrothers-plugin-content">
                <div class="devbrothers-settings-wrapper">
                    <?php
                    if (is_callable($devbrothers_plugin['settings_callback'])) {
                        call_user_func($devbrothers_plugin['settings_callback']);
                    } else {
                        echo '<div class="notice notice-error"><p>' .
                             esc_html__('Ошибка: функция настроек не найдена', 'devbrothers-admin-panel') .
                             '</p></div>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
