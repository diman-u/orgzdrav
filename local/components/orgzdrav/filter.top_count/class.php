<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\UI\Extension;
use Bitrix\Main\Engine\Contract\Controllerable;
use Bitrix\Main\Engine\ActionFilter;
use Bitrix\Main\Engine\ActionFilter\Csrf;
use Bitrix\Highloadblock as HL;
use Bitrix\Main\Loader;

class OrgzdravTopFilterComponent extends CBitrixComponent implements Controllerable
{
    protected const HLBLOCK_NEWSFILTER = 2;

    public function executeComponent()
    {
        Extension::load("ui.vue");

        $this->includeComponentTemplate();
    }

    public function configureActions()
    {
        return [
            'getCountFilterNews' => [
                'prefilters' => [
                    new ActionFilter\Csrf(),
                    new ActionFilter\HttpMethod(['POST']),
                    new ActionFilter\Authentication(),
                ],
            ]
        ];
    }

    public function getCountFilterNewsAction()
    {
        Loader::includeSharewareModule('highloadblock');
        $hlblock = HL\HighloadBlockTable::getById(static::HLBLOCK_NEWSFILTER)->fetch();
        $entity = HL\HighloadBlockTable::compileEntity($hlblock);
        $entity_data_class = $entity->getDataClass();
        $result = $entity_data_class::getList([]);

        return [
            'success' => true,
            'count' => count($result->fetchAll())
        ];
    }
}