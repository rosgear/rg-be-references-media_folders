<?php
/**
 * Этот файл является частью модуля веб-приложения RosGear.
 * 
 * @link https://rosgear.ru/
 * @copyright Copyright (c) 2015 RosGear
 * @license https://rosgear.ru/license/
 */

namespace Rg\Backend\References\MediaFolders\Model;

use Ge;
use Ge\Db\Sql;
use Ge\Panel\Data\Model\Combo\ComboModel;

/**
 * Модель данных выпадающего списка медиапапок.
 * 
 * @author Anton Tivonenko <anton.tivonenko@gmail.com>
 * @package Rg\Backend\References\MediaFolders\Model
 * @since 1.0
 */
class MediaFolderCombo extends ComboModel
{
    /**
     * Показывать только родительские узлы.
     * 
     * @var bool
     */
    protected bool $onlyParent = false;

    /**
     * {@inheritdoc}
     */
    public function getDataManagerConfig(): array
    {
        return [
            'tableName'  => '{{reference_media_folders}}',
            'primaryKey' => 'id',
            'order'      => ['index' => 'ASC'],
            'searchBy'   => 'name',
            'fields' => [
                ['name']
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function init(): void
    {
        parent::init();

        // добавление записи "показывать только родит-е узлы"
        $this->onlyParent = Ge::$app->request->getQuery('onlyParent', false, 'bool');
    }

    /**
     * {@inheritdoc}
     */
    public function buildFilter(Sql\AbstractSql $operator): void
    {
        if ($this->onlyParent) {
            $operator->where(['parent_id' => null]);
        }
        if ($this->search) {
            $operator->where->like($this->dataManager->searchBy, '%' . $this->search . '%');
        }
    }
}
