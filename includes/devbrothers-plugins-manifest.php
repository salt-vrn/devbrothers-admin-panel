<?php
/**
 * DevBrothers plugin catalog manifest.
 *
 * Each entry 'id' must match devbrothers_register_plugin() in the child plugin.
 *
 * @package DevBrothers_Admin_Panel
 */

if (!defined('ABSPATH')) {
    exit;
}

return [
    [
        'id'          => 'cyrillic-slugs',
        'slug'        => 'devbrothers-cyrillic-url',
        'name'        => __('Cyrillic URL', 'devbrothers-admin-panel'),
        'description' => __('Автоматическая транслитерация кириллических URL в латиницу', 'devbrothers-admin-panel'),
        'icon'        => 'dashicons-translation',
        'source'      => 'wordpress-org',
        'status'      => 'available',
    ],
    [
        'id'          => 'simple-translator',
        'slug'        => 'devbrothers-simple-translator',
        'name'        => __('Simple Translator', 'devbrothers-admin-panel'),
        'description' => __('Переключатель языков на базе Google Translate', 'devbrothers-admin-panel'),
        'icon'        => 'dashicons-translation',
        'source'      => 'wordpress-org',
        'status'      => 'available',
    ],
    [
        'id'          => 'auth',
        'slug'        => 'devbrothers-auth',
        'name'        => __('Auth', 'devbrothers-admin-panel'),
        'description' => __('Кастомные формы входа и регистрации с личным кабинетом', 'devbrothers-admin-panel'),
        'icon'        => 'dashicons-lock',
        'source'      => 'coming-soon',
        'status'      => 'coming-soon',
    ],
    [
        'id'          => 'smtp',
        'slug'        => 'devbrothers-smtp',
        'name'        => __('SMTP', 'devbrothers-admin-panel'),
        'description' => __('Отправка писем WordPress через ваш SMTP-сервер', 'devbrothers-admin-panel'),
        'icon'        => 'dashicons-email-alt',
        'source'      => 'coming-soon',
        'status'      => 'coming-soon',
    ],
    [
        'id'          => 'favicon',
        'slug'        => 'devbrothers-favicon',
        'name'        => __('Favicon Generator', 'devbrothers-admin-panel'),
        'description' => __('Генерация современного набора фавиконок из одного изображения', 'devbrothers-admin-panel'),
        'icon'        => 'dashicons-star-filled',
        'source'      => 'coming-soon',
        'status'      => 'coming-soon',
    ],
    [
        'id'          => 'beaver-kit',
        'slug'        => 'devbrothers-beaver-kit',
        'name'        => __('Beaver Kit', 'devbrothers-admin-panel'),
        'description' => __('Модули Beaver Builder, шаблоны и визуальные эффекты сайта', 'devbrothers-admin-panel'),
        'icon'        => 'dashicons-layout',
        'source'      => 'coming-soon',
        'status'      => 'coming-soon',
    ],
    [
        'id'          => 'popup',
        'slug'        => 'devbrothers-popup',
        'name'        => __('Site Popup', 'devbrothers-admin-panel'),
        'description' => __('Попапы с HTML-контентом, задержкой или по клику по якорю', 'devbrothers-admin-panel'),
        'icon'        => 'dashicons-welcome-view-site',
        'source'      => 'coming-soon',
        'status'      => 'coming-soon',
    ],
    [
        'id'          => 'privacy-policy',
        'slug'        => 'devbrothers-privacy-policy',
        'name'        => __('Privacy Policy', 'devbrothers-admin-panel'),
        'description' => __('Конструктор политики конфиденциальности с шорткодом и полями подстановки', 'devbrothers-admin-panel'),
        'icon'        => 'dashicons-privacy',
        'source'      => 'coming-soon',
        'status'      => 'coming-soon',
    ],
    [
        'id'          => 'optimization',
        'slug'        => 'devbrothers-optimization',
        'name'        => __('Optimization', 'devbrothers-admin-panel'),
        'description' => __('Поиск битых ссылок, отчёт по внешним ссылкам и атрибуты rel/target', 'devbrothers-admin-panel'),
        'icon'        => 'dashicons-chart-line',
        'source'      => 'coming-soon',
        'status'      => 'coming-soon',
    ],
    [
        'id'          => 'content-tooltips',
        'slug'        => 'devbrothers-content-tooltips',
        'name'        => __('Content Tooltips', 'devbrothers-admin-panel'),
        'description' => __('Гибкая система подсказок для контента', 'devbrothers-admin-panel'),
        'icon'        => 'dashicons-editor-help',
        'source'      => 'coming-soon',
        'status'      => 'coming-soon',
    ],
    [
        'id'          => 'counter-manager',
        'slug'        => 'devbrothers-counter-manager',
        'name'        => __('Counter Manager', 'devbrothers-admin-panel'),
        'description' => __('Управление счетчиками аналитики (Яндекс.Метрика, Google Analytics)', 'devbrothers-admin-panel'),
        'icon'        => 'dashicons-chart-line',
        'source'      => 'coming-soon',
        'status'      => 'coming-soon',
    ],
    [
        'id'          => 'security',
        'slug'        => 'devbrothers-security',
        'name'        => __('Security', 'devbrothers-admin-panel'),
        'description' => __('Комплексная защита WordPress сайта', 'devbrothers-admin-panel'),
        'icon'        => 'dashicons-shield',
        'source'      => 'coming-soon',
        'status'      => 'coming-soon',
    ],
    [
        'id'          => 'disable-comments',
        'slug'        => 'devbrothers-disable-comments',
        'name'        => __('Disable Comments', 'devbrothers-admin-panel'),
        'description' => __('Полное отключение комментариев на сайте', 'devbrothers-admin-panel'),
        'icon'        => 'dashicons-admin-comments',
        'source'      => 'coming-soon',
        'status'      => 'coming-soon',
    ],
];
