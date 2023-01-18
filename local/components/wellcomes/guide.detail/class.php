<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Loader;
use Bitrix\Iblock;
use Exception;
use Orgzdrav\Wellcomes\IblockSectionManager;

class WellcomesDetailComponent extends \CBitrixComponent
{
	public function onPrepareComponentParams($arParams)
    {
		$arParams['MODEL'] = $arParams['MODEL'] ?? 'none';
		$arParams['ENTITY_ID'] = $arParams['ENTITY_ID'] ?? 0;

        return $arParams;
    }
	
	public function executeComponent()
    {
		if ($this->StartResultCache()) {
			$this->arResult = [];
			
			try {
				if (!class_exists($this->arParams['MODEL'])) {
					throw new \Exception('Model class not found');
				}
				
				$this->arResult = $this->arParams['MODEL']::find($this->arParams['ENTITY_ID']);
			} catch (Exception $e) {}
			
			if (!$this->arResult) {
				$this->AbortResultCache();
				Iblock\Component\Tools::process404('Element not found', true, true, true);
			}
			
			$this->processCurrentSection();
			$this->arResult['SEO'] = $this->processResultSeo();
			
			$this->SetResultCacheKeys([
				'id', 
				'guide',
				'SECTION',
				'SEO'
			]);
			
			$this->IncludeComponentTemplate();
		}
		
		global $APPLICATION;
		
		if (!empty($this->arResult['SECTION'])) {
			$sectionPageUrl = !empty($this->arResult['SECTION']['CODE'])
				? sprintf('%s%s/', $this->arParams['SEF_FOLDER'], $this->arResult['SECTION']['CODE'])
				: '';
				
			$APPLICATION->AddChainItem($this->arResult['SECTION']['NAME'], $sectionPageUrl);
		}
			
		if (!empty($this->arResult['SEO']['title'])) {
			$APPLICATION->SetTitle($this->arResult['SEO']['title']);
			$APPLICATION->SetPageProperty('title', $this->arResult['SEO']['title']);
			
			$APPLICATION->AddChainItem($this->arResult['SEO']['title']);
		}
		
		if (!empty($this->arResult['SEO']['description'])) {
			$APPLICATION->SetPageProperty('description', $this->arResult['SEO']['description']);
		}
	}
	
	private function processResultSeo()
	{
		$result = [];
		
		/** title */
		if (
			!empty($this->arParams['SEO']['title'])
			&& !empty($this->arResult[$this->arParams['SEO']['title']])
		) {
			$result['title'] = $this->arResult[$this->arParams['SEO']['title']];
		}
		
		/** description */
		$descriptionKeys = $this->arParams['SEO']['description'] ?? [];
		if (!is_array($descriptionKeys)) {
			$descriptionKeys = [$descriptionKeys];
		}
		
		$obParser = new \CTextParser;
		foreach ($descriptionKeys as $key) {
			if (empty($this->arResult[$key])) {
				continue;
			}
			
			$value = $this->arResult[$key];
			if (false !== strpos($value, '&gt;')) {
				$value = html_entity_decode($value);
			}
			
			$temp = $obParser->html_cut($value, 300);
            $temp = str_replace("\n", '', strip_tags($temp));
			$temp = preg_replace('/\.[^{]+\{[^}]+\}/', '', $temp);
            $temp = preg_replace('/\s+/', ' ', $temp);
			$temp = trim($temp);
			
			if (empty($temp)) {
				continue;
			}
			
			$result['description'] = $temp;
			break;
		}
		
		return $result;
	}
	
	
	
	private function processCurrentSection()
	{
		if (
			empty($this->arParams['SECTIONS'])
			|| empty($this->arParams['VARIABLES']['SECTION_CODE'])
		) {
			return;
		}
		
		if (
			empty($this->arResult['SECTION'])
			&& !empty($this->arParams['SECTIONS']['ALLOW_ALL'])
			&& 'all' == $this->arParams['VARIABLES']['SECTION_CODE']
		) {
			$this->arResult['SECTIONS'] = [
				'NAME' => 'Все'
			];
			
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
		
		if (
			$currentSection
			&& $this->arResult['SECTION']['ID'] != $currentSection['ID']
		) {
			$this->AbortResultCache();
			LocalRedirect($this->arResult['DETAIL_PAGE_URL']);
		}
				
		if (
			!$currentSection
			|| empty($this->arResult['SECTION'])
			|| $this->arResult['SECTION']['ID'] != $currentSection['ID']
		) {
			$this->AbortResultCache();
			Iblock\Component\Tools::process404('Section not found', true, true, true);
		}
	}
}