<?php
/**
 * Этот файл является частью модуля веб-приложения RosGear.
 * 
 * @link https://rosgear.ru/
 * @copyright Copyright (c) 2015 RosGear
 * @license https://rosgear.ru/license/
 */

namespace Rg\Backend\References\MediaFolders\Model;

use Ge\Panel\Data\Model\FormModel;

/**
 * Модель данных профиля медиапапки.
 * 
 * @author Anton Tivonenko <anton.tivonenko@gmail.com>
 * @package Rg\Backend\References\MediaFolders\Model
 * @since 1.0
 */
class GridRow extends FormModel
{
    /**
     * {@inheritdoc}
     */
    public function getDataManagerConfig(): array
    {
        return [
            'tableName'  => '{{reference_media_folders}}',
            'primaryKey' => 'id',
            'fields'     => [
                ['id'],
                ['visible', 'alias' => 'isVisible']
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function init(): void
    {
        parent::init();

        $this
            ->on(self::EVENT_AFTER_SAVE, function ($isInsert, $columns, $result, $message) {
                /** @var \Ge\Panel\Http\Response $response */
                $response = $this->response();
                if ($message['success']) {
                    if (isset($columns['visible'])) {
                        $visible = (int) $columns['visible'];
                        $message['message'] = $this->t('Media folder - ' . ($visible > 0 ? 'show' : 'hide'));
                        $message['title']   = $this->t($visible > 0 ? 'Show' : 'Hide');
                    }
                }
                // всплывающие сообщение
                $response
                    ->meta
                        ->cmdPopupMsg($message['message'], $message['title'], $message['type']);
            });
    }
}
