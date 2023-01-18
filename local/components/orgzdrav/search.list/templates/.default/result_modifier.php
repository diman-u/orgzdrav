<?php

use Bitrix\Main\Context;
use Bitrix\Main\UI\PageNavigation;

$request = Context::getCurrent()->getRequest();
$search = new OrgzdravSearchComponent();

$nav = new PageNavigation("nav");

if (!empty($request->get('type'))) {
    $nav->allowAllRecords(true)
        ->setPageSize(12)
        ->initFromUri();
    $search->queryResult($request->get('search'), 12, $request->get('type'), $nav->getOffset());

} else {
    $search->queryResult($request->get('search'), 6, '', $nav->getOffset());
}

$listArticles = $search->getArticles();
$listNews = $search->getDetailNews();

if (empty($listArticles) && empty($listNews)) {
    $arResult['NOT_FOUND'] = 'Ничего не найдено.';
} else {
    $arResult['TYPE'] = $request->get('type');
    $arResult['DATA_SEARCH'] = [
        'ARTICLES' => $search->getArticles(),
        'NEWS' => $search->getDetailNews(),
        'LIST_ARTICLE_ID' => $search->listArticlesID(),
        'LIST_NEWS_ID' => $search->listNewsID(),
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

    $nav->setRecordCount($arResult['SEARCH_TERMS']['COUNTS']['st2']['NUMBER']);
    $arResult['NAV'] = $nav;
}