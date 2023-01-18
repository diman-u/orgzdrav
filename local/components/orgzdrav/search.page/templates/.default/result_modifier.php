<?php

use Bitrix\Main\Context;
use Bitrix\Main\UI\PageNavigation;

$count = 9;
$request = Context::getCurrent()->getRequest();
$search = new OrgzdravSearchPageComponent();
$nav = new PageNavigation('navs');
$nav->allowAllRecords(true)
    ->setPageSize($count)
    ->initFromUri();
$search->queryResult($request->get('search'), $count, $request->get('type'), $nav->getOffset());

$listNews = $search->geNewsID();
$listArticles = $search->getArticlesID();

if (empty($listNews) && empty($listArticles)) {
    $arResult['NOT_FOUND'] = 'Ничего не найдено.';
} else {
    $arResult['TYPE'] = $request->get('type');
    $arResult['DATA_SEARCH'] = [
        'ARTICLES' => $listArticles,
        'NEWS' => $listNews
    ];

    $arResult['SEARCH_TERMS'] = [
        'PARAMS' => [
            'SEARCH' => $request->get('search'),
            'TOTAL' => $request->get('total')
        ],
        'TERMS' => $search->getTerms(),
        'COUNTS' => [
            'st1' => $search->getCountArticle(),
            'st2' => $search->getCountNews(),
        ],
        'DESC' => $search->getTermDesc()
    ];


    // убираем одинаковые строки
    $arResult['SEARCH_TERMS']['TERMS'] = array_filter(
        $arResult['SEARCH_TERMS']['TERMS'],
        function($value) use ($request) {
            return 0 !== strcmp($value, trim($request->get('search')));
        }
    );

    $nav->setRecordCount($search->getRecordCount());
    $arResult['NAV'] = $nav;
}
