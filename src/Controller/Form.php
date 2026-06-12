<?php
/**
 * Этот файл является частью расширения модуля веб-приложения RosGear.
 * 
 * @link https://rosgear.ru/
 * @copyright Copyright (c) 2015 RosGear
 * @license https://rosgear.ru/license/
 */

namespace Rg\Backend\References\MediaFolders\Controller;

use Ge;
use Ge\Panel\Controller\FormController;
use Rg\Backend\References\MediaFolders\Model\MediaFolder;
use Rg\Backend\References\MediaFolders\Widget\EditWindow;

/**
 * Контроллер формы структуры медиапапок.
 * 
 * @author Anton Tivonenko <anton.tivonenko@gmail.com>
 * @package Rg\Backend\References\MediaFolders\Controller
 * @since 1.0
 */
class Form extends FormController
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
    public function init(): void
    {
        parent::init();

        $this
            ->on(self::EVENT_BEFORE_ACTION, function ($controller, $action, &$result) {
                if ($action === 'view') {
                    /** @var int|null $appendTo */
                    $appendTo = Ge::$app->request->getQuery('appendTo', 0, 'int');
                    if ($appendTo !== 0) {
                        /** @var MediaFolder $mediaFolder */
                        $mediaFolder =  (new MediaFolder)->get((int) $appendTo);
                        if ($mediaFolder === null) {
                            $this->getResponse()
                                ->meta->error(Ge::t('app', 'Parameter "{0}" not specified', ['appendTo']));
                            $result = false;
                            return;
                        }
                        $this->appendTo = $mediaFolder->getAttributes();
                    }
                }
            });
    }

    /**
     * {@inheritdoc}
     */
    public function createWidget(): EditWindow
    {
        return new EditWindow(['appendTo' => $this->appendTo]);
    }
}
