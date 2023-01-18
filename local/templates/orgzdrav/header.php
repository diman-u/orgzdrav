<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @const SITE_ID */
/** @const SITE_TEMPLATE_PATH */

$showNavBlock = ('N' == $APPLICATION->GetProperty('HIDE_NAV_CHAIN', 'N')) && !(defined('HIDE_NAV_CHAIN') && true === HIDE_NAV_CHAIN);

?><!doctype html>
<html>
<head>
    <meta charset="UTF-8" />
    <title><? $APPLICATION->ShowTitle(); ?></title>
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
	<link rel="manifest" href="/site.webmanifest">
	<link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
	<meta name="msapplication-TileColor" content="#da532c">
	<meta name="theme-color" content="#ffffff">
    <?
    $APPLICATION->ShowHead();

    CJSCore::Init(['ajax']);

    \Bitrix\Main\Page\Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . '/assets/css/styles.css');
	
	#\Bitrix\Main\Page\Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . '/assets/js/jquery-3.6.0.min.js');
	#\Bitrix\Main\Page\Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . '/assets/js/mustache.min.js');
	\Bitrix\Main\Page\Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . '/assets/js/app.js');
	\Bitrix\Main\Page\Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . '/assets/js/app.counters.js');
    ?>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@500;600;700&display=swap" rel="stylesheet">
	
</head>
<body>
    <div id="panel"><? $APPLICATION->ShowPanel(); ?></div>
	<div class="main offcanvas">
        <div class="main__sidebar offcanvas__sidebar theme-dark">
            <div class="main__sidebar-inner">
				<div class="sidebar-logo">
					<p>Портал&nbsp;для&nbsp;лиц, принимающих решения <span>в&nbsp;здравоохранении</span></p>
					<a href="/">
						<img src="<?= SITE_TEMPLATE_PATH ?>/assets/img/logo_n.png" alt="" />
					</a>
				</div>
				<? $APPLICATION->IncludeComponent(
					'bitrix:menu',
					'sidebar',
					array(
						'COMPONENT_TEMPLATE' => '.default',
						'ROOT_MENU_TYPE' => 'top',
						'MENU_CACHE_TYPE' => 'A',
						'MENU_CACHE_TIME' => '604800',
						'MENU_CACHE_USE_GROUPS' => 'Y',
						'MENU_CACHE_GET_VARS' => array(),
						'MAX_LEVEL' => '2',
						'CHILD_MENU_TYPE' => 'left',
						'USE_EXT' => 'Y',
						'DELAY' => 'N',
						'ALLOW_MULTI_SELECT' => 'N'
					)
				); ?>
				<?$APPLICATION->IncludeComponent(
					"bitrix:main.include",
					"",
					Array(
						"AREA_FILE_SHOW" => "file",
						"COMPONENT_TEMPLATE" => ".default",
						"EDIT_TEMPLATE" => "",
						"PATH" => "/include/sidebar-blocks.php"
					)
				);?>
            </div>
        </div>
		<div class="main__content offcanvas__content">
			<header class="l-header">
				<div class="navbar" id="navbar">
					<div class="navbar__item u-hide-lg">
						<a class="btn-round js-offcanvas-toggle" href="#">
							<span class="icon icon--md-burger"></span>
						</a>
					</div>
					<div class="navbar__item navbar__item--main">
						<form class="top-search u-show-md" action="/search/">
							<div class="top-search__line">
								<input type="text" name="search" placeholder="Что вы ищете?">
								<input type="submit" value="Найти" />
							</div>
						</form>
						<button type="button" class="btn-round u-hide-md js-search-toggle">
							<span class="icon icon--md-search"></span>
						</button>
					</div>
					<? if ($USER->IsAuthorized()): ?>
						<div id="controls" class="navbar__end"></div>
					<? elseif (defined('DEMO_CONTROLS')): ?>
						<div id="orgzdrav-auth-controls" class="navbar__end"></div>
					<? endif; ?>
				</div>
			</header>
			<? /*<header class="l-header">
				<div class="navbar" id="navbar">
					<div class="navbar__item u-hide-lg">
						<a class="btn-round js-offcanvas-toggle" href="#">
							<span class="icon icon--burger"></span>
						</a>
					</div>
					
					<div class="navbar__item navbar__item--complex">
						<form class="top-search u-show-md">
							<div class="top-search__line">
								<input type="text" placeholder="Что вы ищете?">
								<input type="submit" value="Найти" />
							</div>
                            <button type="button" class="top-search__filter js-panel-toggle" data-panel="filter">
                                <span class="u-show-md">Фильтр</span>
                            </button>
						</form>
						<a class="btn-round u-hide-md js-search-toggle" href="#">
							<span class="icon icon--md-search"></span>
						</a>
					</div>
					
					<? if ($USER->IsAuthorized()): ?>

                        <div class="navbar__item">
                            <button class="btn-round js-panel-toggle" data-panel="notifications">
                                <span class="icon icon--md-bell"></span>
                                <span class="btn-round__badge">1</span>
                            </button>
                        </div>

						<div class="navbar__item">
							<a class="btn-round" href="#">
								<span class="icon icon--md-bookmark"></span>
							</a>
						</div>
						<div class="navbar__item">
                            <button class="btn-round btn-round--img js-panel-toggle" data-panel="user">
								<img src="<?= SITE_TEMPLATE_PATH ?>/assets/img/demo/user.jpg" alt="">
                            </button>
						</div>
					<? else : ?>
						<div id="orgzdrav-auth-controls"></div>
					<? endif; ?>
				</div>
			</header>*/ ?>
			<main role="main">
				<section class="main-content">
				<? if ($showNavBlock) : ?>
                    <?$APPLICATION->IncludeComponent(
                        "bitrix:breadcrumb",
                        "",
                        Array(
                            "START_FROM" => 1, 
                            "PATH" => "", 
                            "SITE_ID" => "" 
                        )
                    );?>
                    <? $APPLICATION->AddBufferContent('displayContentTitle'); ?>
                <? endif; ?>