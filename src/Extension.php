<?php
/**
 * Расширение модуля веб-приложения RosGear.
 * 
 * @link https://rosgear.ru/
 * @copyright Copyright (c) 2015 RosGear
 * @license https://rosgear.ru/license/
 */

namespace Rg\Backend\References\MediaFolders;

/**
 * Расширение "Структура медиапапок".
 * 
 * Организация медиапапок материалов в структуру.
 * 
 * Расширение принадлежит модулю "Справочники".
 * 
 * @author Anton Tivonenko <anton.tivonenko@gmail.com>
 * @package Rg\Backend\References\MediaFolders
 * @since 1.0
 */
class Extension extends \Ge\Panel\Extension\Extension
{
    /**
     * {@inheritdoc}
     */
    public string $id = 'rg.be.references.media_folders';

    /**
     * {@inheritdoc}
     */
    public string $defaultController = 'grid';

    /**
     * {@inheritdoc}
     */
    public function init(): void
    {
        parent::init();

        /*$this->on('rg.be.mediafiles:onDeskView', function ($module, $widget) {
            $widget->addCss('1111KKKKKKKKKKKKKKK.css');
            //die('oooooooooooooooo');
        });*/
    }
}