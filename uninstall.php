<?php
/**
 * Fired when the plugin is uninstalled.
 *
 * @package DevBrothers_Admin_Panel
 */

if (!defined('WP_UNINSTALL_PLUGIN')) {
    exit;
}

// Отдельные плагины управляют своими опциями через собственные uninstall.php.
// Базовый плагин не хранит собственных опций в БД.
