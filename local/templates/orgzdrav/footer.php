<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
				</section>
				<?$APPLICATION->IncludeComponent(
					"bitrix:main.include",
					"",
					Array(
						"AREA_FILE_SHOW" => "page", 
						"AREA_FILE_SUFFIX" => "inc", 
						"AREA_FILE_RECURSIVE" => "N", 
						"EDIT_MODE" => "html", 
					)
				);?>
			</main>
			<footer class="l-footer">
				<div class="grid grid--md-2">
                    <div class="grid__column">
                    <? $APPLICATION->IncludeComponent(
                        'bitrix:menu',
                        'bottom',
                        array(
                            'COMPONENT_TEMPLATE' => '.default',
                            'ROOT_MENU_TYPE' => 'bottom',
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
                    </div>
                    <div class="grid__column">
                        <? $APPLICATION->IncludeComponent(
                            'bitrix:menu',
                            'bottom',
                            array(
                                'COMPONENT_TEMPLATE' => '.default',
                                'ROOT_MENU_TYPE' => 'bottom1',
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
                    </div>
                    <div class="grid__column">
                        <? $APPLICATION->IncludeComponent(
                            'bitrix:menu',
                            'bottom',
                            array(
                                'COMPONENT_TEMPLATE' => '.default',
                                'ROOT_MENU_TYPE' => 'bottom2',
                                'MENU_CACHE_TYPE' => 'A',
                                'MENU_CACHE_TIME' => '604800',
                                'MENU_CACHE_USE_GROUPS' => 'Y',
                                'MENU_CACHE_GET_VARS' => array(),
                                'MAX_LEVEL' => '2',
                                'CHILD_MENU_TYPE' => 'right',
                                'USE_EXT' => 'Y',
                                'DELAY' => 'N',
                                'ALLOW_MULTI_SELECT' => 'N'
                            )
                        ); ?>
                    </div>

					<div class="grid__column">
						<p class="h4">Контакты</p>

						<div class="l-footer__contacts">
							<a class="is-tel" href="tel:+79779899900">8 (917) 550-48-75</a>
							<a href="mailto:info@оrgzdrav.com">info@оrgzdrav.com</a>
						</div>

<!--						<div class="socials">-->
<!--							<a href="" class="socials__item socials__item--yt"></a>-->
<!--							<a href="" class="socials__item socials__item--vk"></a>-->
<!--							<a href="" class="socials__item socials__item--tg"></a>-->
<!--						</div>-->

						<div class="l-footer__address"><?= $APPLICATION->GetDirProperty("ADDRESS"); ?></div>
						
						<?/*<p class="h4">Генеральный партнер</p>
						<a href="/sponsor/"><img src="<?= SITE_TEMPLATE_PATH ?>/assets/img/logo/janssen.svg" alt=""></a>*/?>
					</div>
				</div>
				<hr />
				<div class="l-footer__copyright">
					<p>&copy; <?= date('Y') ?> Оргздрав Эксперт. Все права защищены, копирование с сайта недопустимо.</p>
					<p><a href="https://www.vshouz.ru/" target="_blank" rel="nofollow">VSHOUZ.RU</a></p>
				</div>
    
			</footer>
		</div>
		<div id="panels"></div>
	</div>

<? 
if ($USER->IsAuthorized()): 
	$APPLICATION->IncludeComponent(
		'orgzdrav:controls',
		''
	);
elseif (defined('DEMO_CONTROLS')) :
	$APPLICATION->IncludeComponent(
		'orgzdrav:auth',
		''
	);
endif; 
?>

<?$APPLICATION->IncludeComponent(
	'orgzdrav:subscribe_pre',
	''
);?>
	
<?php /*
        $APPLICATION->IncludeComponent(
            'orgzdrav:profile',
            ''
        );
        ?>

        <? $APPLICATION->IncludeComponent(
            'orgzdrav:notifications',
            ''
        ); ?>

        <?php $APPLICATION->IncludeComponent(
            'orgzdrav:filter.show',
            ''
        ); ?>
		
		<div id="panels"></div>
    </div>
	
	<? if (!$USER->IsAuthorized()): ?>
		<?$APPLICATION->IncludeComponent(
			"orgzdrav:auth",
			"",
			[]
		);?>
	<? endif; */ ?>
	
	<?$APPLICATION->IncludeComponent(
		"bitrix:main.include",
		"",
		Array(
			"AREA_FILE_SHOW" => "file",
			"COMPONENT_TEMPLATE" => ".default",
			"EDIT_TEMPLATE" => "",
			"PATH" => "/include/counters.php"
		)
	);?>

</body>
</html>