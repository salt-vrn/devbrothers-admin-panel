<?php
/**
 * Shared sidebar navigation partial.
 *
 * Expected variables:
 *   $devbrothers_active_page       — 'dashboard' or a plugin ID
 *   $devbrothers_installed_plugins — array from devbrothers_panel()->get_registered_plugins()
 *
 * @package DevBrothers_Admin_Panel
 */

if (!defined('ABSPATH')) {
    exit;
}
?>
<div class="devbrothers-sidebar">
    <div class="devbrothers-logo">
        <span class="dashicons dashicons-admin-tools"></span>
        <h2><?php esc_html_e('DevBrothers', 'devbrothers-admin-panel'); ?></h2>
    </div>

    <nav class="devbrothers-nav">
        <a href="<?php echo esc_url(admin_url('admin.php?page=devbrothers')); ?>"
           class="devbrothers-nav-item <?php echo ('dashboard' === $devbrothers_active_page) ? 'active' : ''; ?>">
            <span class="dashicons dashicons-dashboard"></span>
            <span class="devbrothers-nav-item-title"><?php esc_html_e('Консоль', 'devbrothers-admin-panel'); ?></span>
        </a>

        <?php if (!empty($devbrothers_installed_plugins)) : ?>
            <div class="devbrothers-nav-divider"><?php esc_html_e('Установленные плагины', 'devbrothers-admin-panel'); ?></div>

            <?php foreach ($devbrothers_installed_plugins as $devbrothers_p) : ?>
                <a href="<?php echo esc_url(admin_url('admin.php?page=devbrothers-plugin-' . $devbrothers_p['id'])); ?>"
                   class="devbrothers-nav-item <?php echo ($devbrothers_active_page === $devbrothers_p['id']) ? 'active' : ''; ?>">
                    <span class="dashicons <?php echo esc_attr($devbrothers_p['icon']); ?>"></span>
                    <div class="devbrothers-nav-item-text">
                        <span class="devbrothers-nav-item-title"><?php echo esc_html($devbrothers_p['name_ru'] ?? $devbrothers_p['name']); ?></span>
                        <?php if (!empty($devbrothers_p['name']) && $devbrothers_p['name'] !== ($devbrothers_p['name_ru'] ?? '')) : ?>
                            <span class="devbrothers-nav-item-subtitle"><?php echo esc_html($devbrothers_p['name']); ?></span>
                        <?php endif; ?>
                    </div>
                </a>
            <?php endforeach; ?>
        <?php endif; ?>
    </nav>
</div>
