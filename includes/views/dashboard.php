<?php
/**
 * Dashboard - главная страница DevBrothers
 *
 * @package DevBrothers_Admin_Panel
 */

if (!defined('ABSPATH')) {
    exit;
}

if (!current_user_can('manage_options')) {
    wp_die(esc_html__('You do not have sufficient permissions to access this page.', 'devbrothers-admin-panel'));
}

$devbrothers_stats             = DevBrothers_Registry::get_statistics();
$devbrothers_installed_plugins = devbrothers_panel()->get_registered_plugins();
$devbrothers_available_plugins = DevBrothers_Registry::get_available_plugins();
$devbrothers_active_page       = 'dashboard';
?>

<div class="devbrothers-wrapper">
    <?php include __DIR__ . '/sidebar.php'; ?>

    <div class="devbrothers-content">
        <?php devbrothers_render_plugin_header(); ?>

        <!-- Статистика -->
        <div class="devbrothers-stats-grid">
            <div class="devbrothers-stat-card">
                <div class="devbrothers-stat-icon">
                    <span class="dashicons dashicons-admin-plugins"></span>
                </div>
                <div class="devbrothers-stat-content">
                    <div class="devbrothers-stat-value"><?php echo esc_html($devbrothers_stats['installed']); ?></div>
                    <div class="devbrothers-stat-label"><?php esc_html_e('Установлено', 'devbrothers-admin-panel'); ?></div>
                </div>
            </div>

            <div class="devbrothers-stat-card">
                <div class="devbrothers-stat-icon devbrothers-stat-icon-secondary">
                    <span class="dashicons dashicons-download"></span>
                </div>
                <div class="devbrothers-stat-content">
                    <div class="devbrothers-stat-value"><?php echo esc_html($devbrothers_stats['available']); ?></div>
                    <div class="devbrothers-stat-label"><?php esc_html_e('Доступно', 'devbrothers-admin-panel'); ?></div>
                </div>
            </div>

            <div class="devbrothers-stat-card">
                <div class="devbrothers-stat-icon devbrothers-stat-icon-success">
                    <span class="dashicons dashicons-yes-alt"></span>
                </div>
                <div class="devbrothers-stat-content">
                    <div class="devbrothers-stat-value"><?php echo esc_html($devbrothers_stats['total']); ?></div>
                    <div class="devbrothers-stat-label"><?php esc_html_e('Всего плагинов', 'devbrothers-admin-panel'); ?></div>
                </div>
            </div>
        </div>

        <!-- Информационные блоки -->
        <div class="devbrothers-info-blocks">
            <div class="devbrothers-info-card devbrothers-info-card-primary">
                <div class="devbrothers-info-header">
                    <span class="dashicons dashicons-info"></span>
                    <h3><?php esc_html_e('О DevBrothers', 'devbrothers-admin-panel'); ?></h3>
                </div>
                <div class="devbrothers-info-body">
                    <p><?php esc_html_e('DevBrothers - это экосистема профессиональных плагинов для WordPress, разработанных с учётом лучших практик безопасности, производительности и удобства использования.', 'devbrothers-admin-panel'); ?></p>
                    <p><?php esc_html_e('Все наши плагины интегрируются в единую панель управления, что обеспечивает централизованный контроль и простоту настройки.', 'devbrothers-admin-panel'); ?></p>
                </div>
            </div>

            <div class="devbrothers-info-card">
                <div class="devbrothers-info-header">
                    <span class="dashicons dashicons-megaphone"></span>
                    <h3><?php esc_html_e('Последние новости', 'devbrothers-admin-panel'); ?></h3>
                </div>
                <div class="devbrothers-info-body">
                    <ul class="devbrothers-news-list">
                        <li>
                            <strong><?php esc_html_e('Версия 1.0.0', 'devbrothers-admin-panel'); ?></strong>
                            <span><?php esc_html_e('Первый релиз панели управления DevBrothers', 'devbrothers-admin-panel'); ?></span>
                        </li>
                        <li>
                            <strong><?php esc_html_e('Новая архитектура', 'devbrothers-admin-panel'); ?></strong>
                            <span><?php esc_html_e('Модульная система для расширения функционала', 'devbrothers-admin-panel'); ?></span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Доступные плагины -->
        <?php if (!empty($devbrothers_available_plugins)) : ?>
        <div class="devbrothers-section">
            <h2><?php esc_html_e('Доступные плагины', 'devbrothers-admin-panel'); ?></h2>
            <p class="devbrothers-section-description">
                <?php esc_html_e('Расширьте функциональность вашего сайта с помощью дополнительных плагинов DevBrothers', 'devbrothers-admin-panel'); ?>
            </p>

            <div class="devbrothers-plugins-grid">
                <?php foreach ($devbrothers_available_plugins as $devbrothers_plugin) : ?>
                    <?php
                    $devbrothers_source = $devbrothers_plugin['source'] ?? 'coming-soon';
                    ?>
                    <div class="devbrothers-plugin-card">
                        <div class="devbrothers-plugin-icon">
                            <span class="dashicons <?php echo esc_attr($devbrothers_plugin['icon']); ?>"></span>
                        </div>

                        <?php if ('coming-soon' === $devbrothers_source) : ?>
                            <span class="devbrothers-plugin-badge devbrothers-plugin-badge-soon">
                                <?php esc_html_e('Скоро', 'devbrothers-admin-panel'); ?>
                            </span>
                        <?php elseif ('wordpress-org' === $devbrothers_source) : ?>
                            <span class="devbrothers-plugin-badge devbrothers-plugin-badge-org">
                                WordPress.org
                            </span>
                        <?php elseif ('github' === $devbrothers_source) : ?>
                            <span class="devbrothers-plugin-badge devbrothers-plugin-badge-github">
                                GitHub
                            </span>
                        <?php endif; ?>

                        <h3><?php echo esc_html($devbrothers_plugin['name']); ?></h3>
                        <p><?php echo esc_html($devbrothers_plugin['description']); ?></p>

                        <?php if ('coming-soon' === $devbrothers_plugin['status']) : ?>
                            <button class="button devbrothers-btn-coming-soon" disabled>
                                <span class="dashicons dashicons-clock"></span>
                                <?php esc_html_e('Скоро', 'devbrothers-admin-panel'); ?>
                            </button>
                        <?php elseif (!empty($devbrothers_plugin['download_url'])) : ?>
                            <?php
                            $devbrothers_is_org = ('wordpress-org' === $devbrothers_source);
                            ?>
                            <a href="<?php echo esc_url($devbrothers_plugin['download_url']); ?>"
                               class="button button-primary"
                               <?php echo $devbrothers_is_org ? '' : 'target="_blank" rel="noopener noreferrer"'; ?>>
                                <span class="dashicons dashicons-<?php echo $devbrothers_is_org ? 'admin-plugins' : 'download'; ?>"></span>
                                <?php
                                echo $devbrothers_is_org
                                    ? esc_html__('Установить', 'devbrothers-admin-panel')
                                    : esc_html__('Скачать', 'devbrothers-admin-panel');
                                ?>
                            </a>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>

        <!-- Установленные плагины -->
        <?php if (!empty($devbrothers_installed_plugins)) : ?>
        <div class="devbrothers-section">
            <h2><?php esc_html_e('Установленные плагины', 'devbrothers-admin-panel'); ?></h2>

            <div class="devbrothers-installed-list">
                <?php foreach ($devbrothers_installed_plugins as $devbrothers_plugin) : ?>
                    <div class="devbrothers-installed-item">
                        <div class="devbrothers-installed-info">
                            <span class="dashicons <?php echo esc_attr($devbrothers_plugin['icon']); ?>"></span>
                            <div>
                                <h4>
                                    <?php echo esc_html($devbrothers_plugin['name_ru'] ?? $devbrothers_plugin['name']); ?>
                                    <?php if (!empty($devbrothers_plugin['name']) && $devbrothers_plugin['name'] !== ($devbrothers_plugin['name_ru'] ?? '')) : ?>
                                        <span class="devbrothers-installed-subtitle"><?php echo esc_html($devbrothers_plugin['name']); ?></span>
                                    <?php endif; ?>
                                </h4>
                                <p><?php echo esc_html($devbrothers_plugin['description']); ?></p>
                            </div>
                        </div>
                        <div class="devbrothers-installed-actions">
                            <span class="devbrothers-version"><?php echo esc_html__('v', 'devbrothers-admin-panel') . esc_html($devbrothers_plugin['version']); ?></span>
                            <a href="<?php echo esc_url(admin_url('admin.php?page=devbrothers-plugin-' . $devbrothers_plugin['id'])); ?>"
                               class="button">
                                <?php esc_html_e('Настройки', 'devbrothers-admin-panel'); ?>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>
