<?php
/**
 * Этот файл является частью расширения модуля веб-приложения RosGear.
 * 
 * @link https://rosgear.ru/
 * @copyright Copyright (c) 2015 RosGear
 * @license https://rosgear.ru/license/
 */

namespace Rg\Backend\References\MediaFolders\Widget;

use Ge;
use Ge\Panel\Helper\ExtGridTree;
use Ge\Panel\Helper\ExtCombo;
use Ge\Panel\Helper\HtmlGrid;
use Ge\Panel\Helper\HtmlNavigator as HtmlNav;

/**
 * Виджет для формирования интерфейса вкладки с древовидной сеткой данных.
 * 
 * @author Anton Tivonenko <anton.tivonenko@gmail.com>
 * @package Rg\Backend\References\MediaFolders\Model
 * @since 1.0
 */
class TabTreeGrid extends \Ge\Panel\Widget\TabTreeGrid
{
    /**
     * {@inheritdoc}
     */
    protected function init(): void
    {
        parent::init();

        // столбцы (Ge.view.grid.Tree.columns GeJS)
        $this->treeGrid->columns = [
            ExtGridTree::columnAction(),
            [
                'text'      => '№',
                'tooltip'   => '#Index number',
                'dataIndex' => 'asIndex',
                'filter'    => ['type' => 'numeric'],
                'width'     => 60
            ],
            [
                'xtype'     => 'treecolumn',
                'text'      => ExtGridTree::columnInfoIcon($this->creator->t('Name')),
                'tooltip'  => '#The name that will be displayed in the component interfaces (dialog boxes, etc.)',
                'cellTip'   => HtmlGrid::tags([
                    HtmlGrid::header('{name}'),
                    HtmlGrid::fieldLabel($this->creator->t('Index number'), '{asIndex}'),
                    HtmlGrid::fieldLabel($this->creator->t('Alias'), '{alias}'),
                    HtmlGrid::tplIf(
                        'profileName',
                        HtmlGrid::fieldLabel($this->creator->t('Profile'), '{profileName}')
                    ),
                    HtmlGrid::tplIf(
                        'path',
                        HtmlGrid::fieldLabel($this->creator->t('Path'), '{path}')
                    ),
                    HtmlGrid::fieldLabel($this->creator->t('Number of child media folders'), '{count}'),
                    HtmlGrid::fieldLabel(
                        $this->creator->t('Show'),
                        HtmlGrid::tplChecked('isVisible==1')
                    )
                ]),
                'dataIndex' => 'name',
                'filter'    => ['type' => 'string'],
                'width'     => 230
            ],
            [
                'text'      => '#Profile',
                'dataIndex' => 'profileName',
                'tooltip'   => '#Folder profile name',
                'cellTip'   => '{profileName}',
                'filter'    => ['type' => 'string'],
                'width'     => 150
            ],
            [
                'text'      => '#Alias',
                'dataIndex' => 'alias',
                'cellTip'   => '{alias}',
                'filter'    => ['type' => 'string'],
                'width'     => 150
            ],
            [
                'text'      => '#Path',
                'dataIndex' => 'path',
                'tooltip'   => '#Local path to a directory (folder)',
                'cellTip'   => '{path}',
                'filter'    => ['type' => 'string'],
                'width'     => 180
            ],
            [
                'text'      => ExtGridTree::columnIcon('g-icon-m_nodes', 'svg'),
                'tooltip'   => '#Number of child media folders',
                'align'     => 'center',
                'dataIndex' => 'count',
                'filter'    => ['type' => 'numeric'],
                'width'     => 60
            ],
            [
                'text'      => ExtGridTree::columnIcon('g-icon-m_visible', 'svg'),
                'tooltip'   => '#Show / hide media folders',
                'xtype'     => 'g-gridcolumn-switch',
                'selector'  => 'treepanel',
                'dataIndex' => 'isVisible',
                'filter'    => ['type' => 'boolean']
            ]
        ];

        // панель инструментов (Ge.view.grid.Tree.tbar GeJS)
        $this->treeGrid->tbar = [
            'padding' => 1,
            'items'   => ExtGridTree::buttonGroups([
                'edit' => [
                    'items' => [
                        'add' => [
                            'tooltip' => '#Adding a new media folder'
                        ],
                        'delete' => [
                            'tooltip' => '#Deleting selected media folders'
                        ],
                        'cleanup' => [
                            'tooltip' => '#Delete all media folders'
                        ],
                        '-',
                        'edit',
                        'select' => [
                            'tooltip' => '#Select all media folders in a list'
                        ],
                        '-',
                        'refresh'
                    ]
                ],
                'columns',
                'search' => [
                    'items' => [
                        'help',
                        'search',
                        // инструмент "Фильтр"
                        'filter' => ExtGridTree::popupFilter([
                            ExtCombo::trigger('#Root media folders', 'parentId', 'folders', false, Ge::alias('@routeOne', '/trigger/combo'))
                        ], [
                            'defaults' => ['labelWidth' => 150],
                            'action'   => Ge::alias('@routeOne', '/grid/filter'),
                        ])
                    ]
                ]
            ], [
                'route' => Ge::alias('@route')
            ])
        ];

        

        // контекстное меню записи (Ge.view.grid.Tree.popupMenu GeJS)
        $this->treeGrid->popupMenu = [
            'items' => [
                [
                    'text'        => '#Edit media folder',
                    'iconCls'     => 'g-icon-svg g-icon-m_edit g-icon-m_color_default',
                    'handlerArgs' => [
                        'route'   => Ge::alias('@route', '/form/view/{id}'),
                        'pattern' => 'grid.popupMenu.activeRecord'
                    ],
                    'handler' => 'loadWidget'
                ],
                '-',
                [
                    'text'        => '#Add to media folder',
                    'iconCls'     => 'g-icon-svg g-icon-m_add g-icon-m_color_default',
                    'handlerArgs' => [
                        'route'   => Ge::alias('@route', '/form/view?appendTo={id}'),
                        'pattern' => 'grid.popupMenu.activeRecord'
                    ],
                    'handler' => 'loadWidget'
                ]
            ]
        ];

        // поле аудита записи
        $this->treeGrid->logField = 'name';
        // плагины сетки
        $this->treeGrid->plugins = 'gridfilters';
        // класс CSS применяемый к элементу body сетки
        $this->treeGrid->bodyCls = 'g-grid_background';
        // количество строк в сетке
        $this->treeGrid->store->pageSize = 50;
        $this->treeGrid->columnLines  = true;
        $this->treeGrid->rowLines     = true;
        $this->treeGrid->lines        = true;
        $this->treeGrid->singleExpand = false;

        // панель навигации (Ge.view.navigator.Info GeJS)
        $this->navigator->info['tpl'] = HtmlNav::tags([
            HtmlNav::header('{name}'),
            HtmlNav::fieldLabel($this->creator->t('Index number'), '{asIndex}'),
            HtmlNav::fieldLabel($this->creator->t('Alias'), '{alias}'),
            HtmlNav::tplIf(
                'profileName',
                HtmlNav::fieldLabel($this->creator->t('Profile'), '{profileName}')
            ),
            HtmlNav::tplIf(
                'path',
                HtmlNav::fieldLabel($this->creator->t('Path'), '{path}')
            ),
            HtmlNav::fieldLabel($this->creator->t('Number of child media folders'), '{count}'),
            HtmlNav::fieldLabel(
                $this->creator->t('Show'),
                HtmlNav::tplChecked('isVisible==1')
            ),
            HtmlNav::widgetButton(
                $this->creator->t('Edit media folder'),
                ['route' => Ge::alias('@route', '/form/view/{id}'), 'long' => true],
                ['title' => $this->creator->t('Edit media folder')]
            ),
            HtmlNav::widgetButton(
                $this->creator->t('Add to media fodler'),
                ['route' => Ge::alias('@route', '/form/view?appendTo={id}'), 'long' => true],
                ['title' => $this->creator->t('Add to media fodler')]
            )
        ]);

        $this
            ->addCss('/grid.css')
            ->addCss('/folders.css')
            ->addRequire('Ge.view.grid.column.Switch');
    }
}
