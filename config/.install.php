<?php
/**
 * Этот файл является частью расширения модуля веб-приложения RosGear.
 * 
 * Файл конфигурации установки расширения.
 * 
 * @link https://rosgear.ru/
 * @copyright Copyright (c) 2015 RosGear
 * @license https://rosgear.ru/license/
 */

return [
    'id'          => 'rg.be.references.media_folders',
    'moduleId'    => 'rg.be.references',
    'name'        => 'Media folder structure',
    'description' => 'Organizing media folders of materials into a structure',
    'namespace'   => 'Rg\Backend\References\MediaFolders',
    'path'        => '/rg/rg.be.references.media_folders',
    'route'       => 'media-folders',
    'locales'     => ['ru_RU', 'en_GB'],
    'permissions' => ['any', 'info'],
    'events'      => ['rg.be.mediafiles:onDeskView'],
    'required'    => [
        ['php', 'version' => '8.2'],
        ['app', 'code' => 'RG CMS'],
        ['app', 'code' => 'RG CRM'],
        ['module', 'id' => 'rg.be.references'],
        ['extension', 'id' => 'rg.be.references.folder_profiles']
    ]
];
