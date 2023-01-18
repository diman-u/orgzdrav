<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Loader;
use Bitrix\Iblock;
use Vshouz\XData\EntityModifier;
use Vshouz\XData\IblockSectionManager;
use Vshouz\XData\QueryStateProxy;
use Exception;

class XDataListComponent extends \CBitrixComponent
{
	public function onPrepareComponentParams($arParams)
    {
		$arParams['FROM'] = $arParams['FROM'] ?? 'none';
		
		$arParams['SELECT'] = $arParams['SELECT'] ?? [];
		$arParams['FILTER'] = $arParams['FILTER'] ?? [];
		$arParams['SORT'] = $arParams['SORT'] ?? [];
        $arParams['LIMIT'] = $arParams['LIMIT'] ?? 30;

        return $arParams;
    }
	
	public function executeComponent()
    {
		$this->arResult['SECTION'] = false;
		$this->arResult['ITEMS'] = [];
			
		$nav = new \Bitrix\Main\UI\PageNavigation('nav-more');
		$nav->allowAllRecords(false)
			->setPageSize($this->arParams['LIMIT'])
			->initFromUri();
		
		$this->arResult['NAV'] = $nav;
		
		if ($this->StartResultCache(false, $nav->getCurrentPage())) {
			if (
				!empty($this->arParams['SECTIONS'])
				&& !empty($this->arParams['VARIABLES']['SECTION_CODE'])
			) {
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
				
				if (!$currentSection ) {
					Iblock\Component\Tools::process404('Section not found', true, true, true);
				}
				
				$this->arResult['SECTION'] = $currentSection;
				$this->arParams['FILTER'] = array_merge(
					$this->arParams['FILTER'],
					$currentSection['FILTER']
				);
			}
			
			try {
				$driver = ucfirst(strtolower($this->arParams['DRIVER']));
				
				$connectionClass = '\Vshouz\XData\\'.$driver.'\Connection';
				if (!class_exists($connectionClass)) {
					throw new \Exception('Connection class not found');
				}
				
				$queryClass = '\Vshouz\XData\\'.$driver.'\Query';
				if (!class_exists($queryClass)) {
					throw new \Exception('Query class not found');
				}
				
				$connection = new $connectionClass();
				$query = (new $queryClass($connection));
				
				if (!empty($this->arParams['SECTIONS'])) {
					$query->addEntityModifier((new EntityModifier\IblockSection(
						$this->arParams['SECTIONS']['IBLOCK_ID'],
						$this->arParams['SECTIONS']['FILTER']
					)));
				}
				if (!empty($this->arParams['SEF_URL_TEMPLATES']['detail'])) {
					$query->addEntityModifier((new EntityModifier\DetailPageUrl(
						$this->arParams['SEF_FOLDER'].$this->arParams['SEF_URL_TEMPLATES']['detail']
					)));
				}
				if (!empty($this->arParams['SEO']['created'])) {
					$query->addEntityModifier((new EntityModifier\DateCreated(
						$this->arParams['SEO']['created'],
						$this->arParams['DATE_FORMAT']
					)));
				}
				
				$query
					->select($this->arParams['SELECT'])
					->from($this->arParams['FROM'])
					->where($this->arParams['FILTER'])
					->orderBy($this->arParams['SORT'])
					->limit($nav->getLimit())
					->offset($nav->getOffset());
					
				
				$queryProxy = new QueryStateProxy($query);
				
				$result = $queryProxy->all();
				$nav->setRecordCount($queryProxy->count());
				
				unset($queryProxy, $query, $connection);
				
			} catch (Exception $e) {
				$this->AbortResultCache();
				$result = [];
			}
				
			$this->arResult['ITEMS'] = $result;
			
			$this->IncludeComponentTemplate();
		}
		
		if ($this->arResult['SECTION']) {
			global $APPLICATION;
			
			$APPLICATION->SetTitle($this->arResult['SECTION']['NAME']);
			$APPLICATION->SetPageProperty('title', $this->arResult['SECTION']['NAME']);
			
			$APPLICATION->AddChainItem($this->arResult['SECTION']['NAME']);
		}
	}
}