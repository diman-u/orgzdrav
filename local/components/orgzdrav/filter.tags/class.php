<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\UI\Extension;
use Bitrix\Main\Engine\Contract\Controllerable;
use Bitrix\Main\Engine\ActionFilter;
use Bitrix\Main\Engine\ActionFilter\Csrf;
use Bitrix\Highloadblock as HL;
use Bitrix\Main\Loader;
use Orgzdrav\Tables\UserFilterTable;
use Bitrix\Main\Engine\CurrentUser;
use Bitrix\Main\Type\DateTime;

class OrgzdravFilterTagsComponent extends CBitrixComponent implements Controllerable
{
    protected const HLBLOCK_NEWSFILTER = 2;

    public function executeComponent()
    {
        Loader::includeSharewareModule('highloadblock');
        Extension::load("ui.vue");

        $chkCategories = $this->getUserFilterCategory();
        $chkCategories = explode(';', $chkCategories['FILTER_CATEGORIES']);

        foreach ($allCategories = $this->getFilterCategory() as $key => $item) {
            if (in_array($item['ID'], $chkCategories)) {
                $allCategories[$key]['ACTIVE'] = 1;
            } else {
                unset($allCategories[$key]);
            }
        }

        $this->arResult['NEWS_CATEGORY'] = $allCategories;
        $this->arResult['USER_FILTER'] = $this->getUserFilterCategory();

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
        $dateBegin = '';
        $dateEnd = '';

        $dataFilter = UserFilterTable::getRow([
            'filter' => [
                'USER_ID' => CurrentUser::get()->getId()
            ],
            'select' => ['FILTER_CATEGORIES', 'DATE_BEGIN', 'DATE_END']
        ]);

        if (!empty($dataFilter['DATE_BEGIN'])) {
            $objDateBegin = DateTime::createFromTimestamp($dataFilter['DATE_BEGIN']);
            $dateBegin = $objDateBegin->format('d M Y');
        }

        if (!empty($dataFilter['DATE_END'])) {
            $objDateEnd = DateTime::createFromTimestamp($dataFilter['DATE_END']);
            $dateEnd = $objDateEnd->format('d M Y');
        }

        return [
            'FILTER_CATEGORIES' => $dataFilter['FILTER_CATEGORIES'],
            'DATE_BEGIN' => $dateBegin,
            'DATE_END' => $dateEnd
        ];
    }

    public function configureActions()
    {
        return [
            'method' => [
                'prefilters' => [
                    new ActionFilter\Csrf(),
                    new ActionFilter\HttpMethod(['POST']),
                    new ActionFilter\Authentication(),
                ],
            ]
        ];
    }
}