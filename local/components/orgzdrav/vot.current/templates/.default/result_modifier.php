<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

use Bitrix\Vote\Vote;
use Bitrix\Vote\UserTable;
use Bitrix\Main\Web\Cookie;
use Bitrix\Main\Application;

//if (!function_exists("_GetAnswerArray1"))
//{
//    function _GetAnswerArray1($FieldType, $arAnswers)
//    {
//        $arReturn = Array();
//        foreach ($arAnswers as $arAnswer)
//        {
//            if ($arAnswer["FIELD_TYPE"] == $FieldType)
//                $arReturn[] = $arAnswer;
//        }
//        return $arReturn;
//    }
//}


//$id = intval($arParams["VOTE_ID"]);
//
//$vote = new Vote($id);
//
//$request = [
//    'PUBLIC_VOTE_ID' => 2,
//    'VOTE_ID' => 2,
//    'vote_radio_2' => 6,
//    'bxajaxid' => '7243cc9b67703e30eca501ffd34bff67',
//    'sessid' => '331febe6bfa7f689ab74a0c3511d964e'
//];
//
//$rez = $vote->voteFor($request, []);
//dd($rez);

//$dbRes = EventQuestionTable::getList();
//
//foreach ($dbRes as $item) {
//    dump($item);
//}


