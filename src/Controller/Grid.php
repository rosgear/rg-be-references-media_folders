<?php
/**
 * Этот файл является частью расширения модуля веб-приложения RosGear.
 * 
 * @link https://rosgear.ru/
 * @copyright Copyright (c) 2015 RosGear
 * @license https://rosgear.ru/license/
 */

namespace Rg\Backend\References\MediaFolders\Controller;

use Ge\Panel\Controller\TreeGridController;
use Rg\Backend\References\MediaFolders\Widget\TabTreeGrid;

/**
 *  Контроллер сетки структуры медиапапок.
 * 
 * @author Anton Tivonenko <anton.tivonenko@gmail.com>
 * @package Rg\Backend\References\MediaFolders\Controller
 * @since 1.0
 */
class Grid extends TreeGridController
{
    /**
     * {@inheritdoc}
     */
    public function createWidget(): TabTreeGrid
    {
        return new TabTreeGrid();
    }
}
