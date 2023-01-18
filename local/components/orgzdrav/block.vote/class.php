<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Config\Configuration;
use Bitrix\Main\Loader;
use Bitrix\Iblock\ElementTable;

class OrgzdravBlockVoteComponent extends CBitrixComponent
{
    protected $IB_ID = 25;
    protected $CHANNEL_ID = 2;

    public function executeComponent()
    {
        if ($this->StartResultCache()) {

            $survey_id = Configuration::getInstance()->get('orgzdrav_survey');

            $curServey = [];

            if (!empty($survey_id)) {

                if ( !Loader::includeModule('iblock')) {
                    $this->AbortResultCache();
                    ShowError('Модуль «ИБ» не установлен');
                    return;
                }

                $curServey = ElementTable::getList(
                    [
                        'select' => [
                            'ID', 'NAME', 'IBLOCK_SECTION_ID', 'DETAIL_PAGE_URL' => 'IBLOCK.DETAIL_PAGE_URL'
                        ],
                        'filter' => [
                            'IBLOCK_ID' => $this->IB_ID,
                            'ID' => $survey_id,
                            'ACTIVE' => 'Y'
                        ]
                    ]
                )->fetch();
                $curServey['LINK'] = CIBlock::ReplaceDetailUrl($curServey['DETAIL_PAGE_URL'], $curServey, false, 'E');

            }

            if (!empty($curServey)) {
                $curServey['TITLE'] = Configuration::getInstance()->get('survey_title');
                $this->arResult['VOTE'] = $curServey;

            } else {
                $arVote = [];
                $arVote['TITLE'] = Configuration::getInstance()->get('survey_title');
                $arVote['LINK'] = '/#polls';
                $this->arResult['VOTE'] = $arVote;
            }

            $this->includeComponentTemplate();
        }
    }
}