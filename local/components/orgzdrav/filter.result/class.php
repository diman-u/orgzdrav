<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\UI\Extension;
use Bitrix\Main\Engine\Contract\Controllerable;
use Orgzdrav\Tables\NotificationsTable;
use Bitrix\Main\Engine\ActionFilter;
use Bitrix\Main\Engine\ActionFilter\Csrf;

class OrgzdravFilterResultComponent extends CBitrixComponent implements Controllerable
{
    public function executeComponent()
    {
        Extension::load("ui.vue");

        $this->includeComponentTemplate();
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