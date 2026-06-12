<?php
/**
 * Этот файл является частью расширения модуля веб-приложения RosGear.
 * 
 * Файл конфигурации расширения.
 * 
 * @link https://rosgear.ru/
 * @copyright Copyright (c) 2015 RosGear
 * @license https://rosgear.ru/license/
 */

return [
    'translator' => [
        'locale'   => 'auto',
        'patterns' => [
            'text' => [
                'basePath' => __DIR__ . '/../lang',
                'pattern'   => 'text-%s.php'
            ]
        ],
        'autoload' => ['text'],
        'external' => [BACKEND]
    ],

    'accessRules' => [
        // для авторизованных пользователей панели управления
        [ // разрешение "Полный доступ" (any)
            'allow',
            'permission'  => 'any',
            'controllers' => [
                'Grid'    => ['data', 'view', 'update', 'delete', 'clear', 'filter'],
                'Form'    => ['data', 'view', 'add', 'update', 'delete'],
                'Trigger' => ['combo'],
                'Search'  => ['data', 'view']
            ],
            'users' => ['@backend']
        ],
        [ // разрешение "Информация о расширении" (info)
            'allow',
            'permission'  => 'info',
            'controllers' => ['Info'],
            'users'       => ['@backend']
        ],
        [ // для всех остальных, доступа нет
            'deny'
        ]
    ],

    'viewManager' => [
        'id'          => 'rg-references-mediafolders-{name}',
        'useTheme'    => true,
        'useLocalize' => true,
        'viewMap'     => [
            // информация о расширении
            'info' => [
                'viewFile'      => '//backend/extension-info.phtml', 
                'forceLocalize' => true
            ],
            'form'         => '/form.json',
            'formAppendTo' => '/form-append-to.json'
        ]
    ]
];
