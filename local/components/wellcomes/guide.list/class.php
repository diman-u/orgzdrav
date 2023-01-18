<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Loader;
use Bitrix\Iblock;
use Exception;
use Orgzdrav\Wellcomes\IblockSectionManager;

class WellcomesListComponent extends \CBitrixComponent
{
	public function onPrepareComponentParams($arParams)
    {
		$arParams['MODEL'] = $arParams['MODEL'] ?? 'none';
		$arParams['LIST_MODIFIERS'] = $arParams['LIST_MODIFIERS'] ?? [];

        return $arParams;
    }
	
	public function executeComponent()
    {
		$this->arResult = []; 
		$this->arResult['SECTION'] = false;
		$this->arResult['ITEMS'] = [];
			
		$nav = new \Bitrix\Main\UI\PageNavigation('nav');
		$nav->allowAllRecords(false)
			->setPageSize($this->arParams['LIMIT'])
			->initFromUri();
		
		$this->arResult['NAV'] = $nav;
		
		if ($this->StartResultCache(false, 'nav'.$nav->getOffset())) {
			try {
				if (!class_exists($this->arParams['MODEL'])) {
					throw new \Exception('Model class not found');
				}
				
				$this->processCurrentSection();
				
				$builder = $this->arParams['MODEL']::where($this->arParams['FILTER'])
					->select($this->arParams['SELECT'])
					->orderBy($this->arParams['SORT_BY'], $this->arParams['SORT_ORDER']);
					
				$result = $builder->paginate($nav->getLimit(), $nav->getOffset());
					
				$nav->setRecordCount($builder->count());
				
				foreach ($this->arParams['LIST_MODIFIERS'] as $modifierClass => $params) {
					if (!class_exists($modifierClass)) {
						continue;
					}
					
					$builder->getModel()->addEntityModifier((new $modifierClass(...$params)));
				}
				
				$this->arResult['guide'] = $builder->getModel()->getGuide();
				$this->arResult['ITEMS'] = $result->getCollection();
				$this->arResult['IDS'] = array_column($this->arResult['ITEMS'], 'id');	
			} catch (Exception $e) {
				//dd($e->getMessage());
			}
			
			if (empty($this->arResult['ITEMS'])) {
				$this->AbortResultCache();
			}
			
			$this->SetResultCacheKeys([
				'guide',
				'IDS',
				'SECTION'
			]);
			
			$this->IncludeComponentTemplate();
		}
		
		global $APPLICATION;
		
		if (!empty($this->arResult['SECTION'])) {	
			$APPLICATION->SetTitle($this->arResult['SECTION']['NAME']);
			$APPLICATION->SetPageProperty('title', $this->arResult['SECTION']['NAME']);
			
			$APPLICATION->AddChainItem($this->arResult['SECTION']['NAME']);
		}
	}
	
	private function processCurrentSection()
	{
		if (
			empty($this->arParams['SECTIONS'])
			|| empty($this->arParams['VARIABLES']['SECTION_CODE']) // [ 'SECTION_CODE' => 'about' ]
		) {
			return;
		}
		
		$currentSection = false;
				
		$list = IblockSectionManager::getList(
			$this->arParams['SECTIONS']['IBLOCK_ID'],
			$this->arParams['SECTIONS']['FILTER']
		);
				
		foreach ($list as $section) {
			if ($section['CODE'] == $this->arParams['VARIABLES']['SECTION_CODE']) {
				$currentSection = $section;
				break;
			}
		}
				
		if (!$currentSection) {
			$this->AbortResultCache();
			Iblock\Component\Tools::process404('Section not found', true, true, true);
		}
				
		$this->arResult['SECTION'] = $currentSection;
		$this->arParams['FILTER'] = array_merge(
			$this->arParams['FILTER'],
			$currentSection['FILTER']
		);
	}
}