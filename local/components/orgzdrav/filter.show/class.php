<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Application;
use Bitrix\Main\UI\Extension;
use Bitrix\Main\Engine\Contract\Controllerable;
use Bitrix\Main\Engine\ActionFilter;
use Bitrix\Main\Engine\ActionFilter\Csrf;
use Bitrix\Highloadblock as HL;
use Bitrix\Main\Loader;
use Bitrix\Main\Type\DateTime;
use Orgzdrav\Tables\UserFilterTable;
use Bitrix\Main\Engine\CurrentUser;

class OrgzdravFilterShowComponent extends CBitrixComponent implements Controllerable
{
    protected const HLBLOCK_NEWSFILTER = 2;

    public function executeComponent()
    {
        Loader::includeSharewareModule('highloadblock');
        Extension::load("ui.vue");

        $chkCategories = $this->getUserFilterCategory();
        $chkCategories = explode(';', $chkCategories['FILTER_CATEGORIES']);

        $this->arResult['NEWS_CATEGORY'] = $this->getFilterCategory();
        $this->arResult['CHECK_CATEGORIES'] = $chkCategories;

        $this->includeComponentTemplate();
    }

    public function getFilterCategory()
    {
        $hlblock = HL\HighloadBlockTable::getById(static::HLBLOCK_NEWSFILTER)->fetch();
        $entity = HL\HighloadBlockTable::compileEntity($hlblock);
        $entity_data_class = $entity->getDataClass();
        $result = $entity_data_class::getList([]);
        $newsCategory = $result->fetchAll();

        return $newsCategory;
    }

    public function getUserFilterCategory()
    {
        return UserFilterTable::getRow([
            'filter' => [
                'USER_ID' => CurrentUser::get()->getId()
            ],
            'select' => ['FILTER_CATEGORIES']
        ]);
    }

    public function configureActions()
    {
        return [
            'add' => [
                'prefilters' => [
                    new ActionFilter\Csrf(),
                    new ActionFilter\HttpMethod(['POST']),
                    new ActionFilter\Authentication(),
                ],
            ],

            'all' => [
                'prefilters' => [],
            ],

            'check' => [
                'prefilters' => [],
            ]
        ];
    }

    public function addAction($categories, $dateBegin, $dateEnd)
    {
        $this->deleteUserCategories();

        $result = UserFilterTable::add([
            'USER_ID' => CurrentUser::get()->getId(),
            'FILTER_CATEGORIES' => implode(';', $categories),
            'DATE_BEGIN' => $dateBegin,
            'DATE_END' => $dateEnd
        ]);

        if (!$result->isSuccess()) {
            return [
                'error' => $result->getErrorMessages()
            ];
        }

        return [
            'success' => true
        ];
    }

    public function allAction()
    {
        Loader::includeSharewareModule('highloadblock');
        $hlblock = HL\HighloadBlockTable::getById(static::HLBLOCK_NEWSFILTER)->fetch();
        $entity = HL\HighloadBlockTable::compileEntity($hlblock);
        $entity_data_class = $entity->getDataClass();
        $result = $entity_data_class::getList([]);
        return [
            'all' => $result->fetchAll()
        ];
    }

    public function checkAction()
    {
        $dataQuery = UserFilterTable::getRow(
            [
                'select' => [
                    'FILTER_CATEGORIES', 'DATE_BEGIN', 'DATE_END'
                ],
                'filter' => [
                    'USER_ID' => CurrentUser::get()->getId(),
                ]
            ]
        );

        if (!empty($dataQuery)) {
            return [
                'check' => explode(';', $dataQuery['FILTER_CATEGORIES']),
                'dateBegin' => $dataQuery['DATE_BEGIN'],
                'dateEnd' => $dataQuery['DATE_END'],
            ];
        }
    }

    public function deleteUserCategories()
    {
        $filterCategories = UserFilterTable::getList([
            'filter' => [
                'USER_ID' => CurrentUser::get()->getId()
            ],
            'select' => ['ID']
        ])->fetchAll();

        if (!empty($filterCategories)) {
            foreach ($filterCategories as $item) {
                UserFilterTable::delete($item['ID']);
            }
        }

        return [
            'success' => true
        ];
    }

    /**
     * Сохранение в сессию выбранных категорий фильтра
     */
    public function saveCategoriesAction($categories)
    {
        if (empty($categories)) {
            return false;
        }

        $session = Application::getInstance()->getSession();

        if (!$session->has('filter_category'))
        {
            $session->set('filter_category', $categories);
        }
    }
}