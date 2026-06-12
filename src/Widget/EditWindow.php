<?php
/**
 * Этот файл является частью расширения модуля веб-приложения RosGear.
 * 
 * @link https://rosgear.ru/
 * @copyright Copyright (c) 2015 RosGear
 * @license https://rosgear.ru/license/
 */

namespace Rg\Backend\References\MediaFolders\Widget;

use Ge\Panel\Helper\ExtCombo;

/**
 * Виджет для формирования интерфейса окна редактирования записи.
 * 
 * @author Anton Tivonenko <anton.tivonenko@gmail.com>
 * @package Rg\Backend\References\MediaFolders\Widget
 * @since 1.0
 */
class EditWindow extends \Ge\Panel\Widget\EditWindow
{
    /**
     * Атрибуты медиапапки в которую добавляют.
     * 
     * @var array
     */
    protected array $appendTo = [];

    /**
     * {@inheritdoc}
     */
    public array $passParams = ['appendTo'];

    /**
     * {@inheritdoc}
     */
    protected function init(): void
    {
        parent::init();

        /** @var array $comboSmallIcons Меленький значок */
        $comboSmallIcons = ExtCombo::icons('#Small icon', 'asSmallIcon', false, [
            'url'  => $this->creator->getRelativeAssetsUrl() . '/images/folders',
            'path' =>  $this->creator->getAssetsPath() . '/images/folders',
            'mask' => ['*.svg', '*.png']
        ]);

        /** @var array $comboIcons Средний значок */
        $comboIcons = ExtCombo::icons('#Medium icon', 'asIcon', false, [
            'url'  => $this->creator->getRelativeAssetsUrl() . '/images/folders',
            'path' =>  $this->creator->getAssetsPath() . '/images/folders',
            'mask' => ['*.svg', '*.png']
        ]);

        // панель формы (Ge.view.form.Panel GeJS)
        $this->form->autoScroll = true;
        $this->form->bodyPadding = 10;
        $this->form->router->route = $this->creator->route('/form');
        $this->form->defaults = [
            'labelAlign' => 'right',
            'labelWdith' => 120
        ];

        // добавить в медиапапку
        if ($this->appendTo) {
            $this->title = $this->creator->t(
                '{form.appendTo}', ['name' => $this->appendTo['name']]
            );

            $this->form->loadJSONFile('/form-append-to', 'items', [
                '@parentId'        => $this->appendTo['id'],
                '@index'           => $this->appendTo['count'] + 1,
                '@comboSmallIcons' => $comboSmallIcons,
                '@comboIcons'      => $comboIcons
            ]);
            $this->form->router->rules['add'] = '{route}/add?appendTo=' . $this->appendTo['id'];
        } else
            $this->form->loadJSONFile('/form', 'items', [
                '@comboSmallIcons' => $comboSmallIcons,
                '@comboIcons'      => $comboIcons
            ]);

        // окно компонента (Ext.window.Window Sencha ExtJS)
        $this->width = 520;
        $this->autoHeight = true;
        $this->resizable = false;
    }
}
