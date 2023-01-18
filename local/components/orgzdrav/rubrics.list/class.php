<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Loader;
use Bitrix\Main\Engine\Contract\Controllerable;
use Bitrix\Main\Engine\ActionFilter;
use Orgzdrav\Subscribe;
use Bitrix\Main\Engine\CurrentUser;

class OrgzdravRubricsComponent extends CBitrixComponent implements Controllerable
{
    public function executeComponent()
    {
        $arrRubric = [4, 3];
//        dump($this->addorupdateAction($arrRubric));
//        dump($this->userCheckedAction());

        $this->includeComponentTemplate();
    }

    public static function load() {
        Loader::includeModule('subscribe');
        return new self();
    }

    public function configureActions()
    {
        return [
            'addorupdate' => [
                'prefilters' => [
                    new ActionFilter\Csrf(),
                    new ActionFilter\HttpMethod(['POST']),
                    new ActionFilter\Authentication(),
                ],
            ],
            'getAll' => [
                'prefilters' => [
                    new ActionFilter\Csrf(),
                    new ActionFilter\HttpMethod(['POST']),
                    new ActionFilter\Authentication(),
                ],
            ],
            'userChecked' => [
                'prefilters' => [
                    new ActionFilter\Csrf(),
                    new ActionFilter\HttpMethod(['POST']),
                    new ActionFilter\Authentication(),
                ],
            ]
        ];
    }

    private function userCountSubscribe() {
        $obj = OrgzdravRubricsComponent::load();
        $arSubscription = CSubscription::GetRubricArray($obj->getIDTable());
        return count($arSubscription);
    }

    public function getAllAction()
    {
        Loader::includeModule('subscribe');

        $rubrics = [];
        $rsRubric = CRubric::GetList(
                ["SORT" => "ASC", "NAME" => "ASC"],
                ["ACTIVE" => "Y"]
        );

        while($arRubric = $rsRubric->GetNext())
        {
            $rubrics[] = [
                'ID' => $arRubric['ID'],
                'NAME' => $arRubric['NAME'],
            ];
        }

        return [
            'elements' => $rubrics
        ];
    }

    private function getIDTable() {
        $subscr = \CSubscription::GetList(
            [],
            [
                'EMAIL' => CurrentUser::get()->getEmail()
            ]
        );

        while($sub = $subscr->Fetch()) {
            return $sub['ID'];
        }
    }

    public function userCheckedAction()
    {
        $obj = OrgzdravRubricsComponent::load();
        $subscriptionID = $obj->getIDTable();

        return [
            'elements' => CSubscription::GetRubricArray($subscriptionID)
        ];
    }

    public function addorupdateAction($arrRubric) {

        $obj = OrgzdravRubricsComponent::load();

        if ($obj->userCountSubscribe() == 0) {
            // add
            $rez = (new Subscribe())->subscribeAdd($arrRubric);
        } else {
            // update
            $rez = (new Subscribe())->subscribeUpdate($obj->getIDTable(), $arrRubric);
        }

        return $rez;
    }
}