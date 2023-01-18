<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Loader;

class OrgzdravSectionsVoteComponent extends CBitrixComponent
{
    public function executeComponent()
    {
        if (Loader::includeModule('vote')) {

            $arFilter = [
                'ACTIVE' => 'Y',
                'LAMP' => $this->arParams['LAMP']
            ];

            $rsVote = CVote::GetList($by = 's_id', $order = 'desc', $arFilter);

            while ($arVote = $rsVote->GetNext()) {
                $votes[] = [
                    'ID' => $arVote['ID'],
                    'CHANNEL_ID' => $arVote['CHANNEL_ID'],
                ];
            }

            if (!empty($this->arParams['LIMIT'])) {
                $votes = array_slice($votes, 0, $this->arParams['LIMIT']);
            }

            $this->arResult['ITEMS'] = $votes;
        }

        $this->includeComponentTemplate();
    }
}