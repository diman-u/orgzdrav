<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Loader;
use Bitrix\Iblock;
use Vshouz\XData\EntityModifier;
use Exception;

class XDataDetailComponent extends \CBitrixComponent
{
	public function onPrepareComponentParams($arParams)
    {
		$arParams['FROM'] = $arParams['FROM'] ?? 'none';
		$arParams['ENTITY_ID'] = $arParams['ENTITY_ID'] ?? 0;

        return $arParams;
    }
	
	public function executeComponent()
    {
		if ($this->StartResultCache()) {
			$entity = false;
			
			try {
				$entity = $this->getEntity($this->arParams['ENTITY_ID']);
				
				if (
					$entity
					&& !empty($this->arParams['SECTION_CODE'])
					&& empty($entity['SECTION'])
					&& !empty($this->arParams['SECTIONS']['ALLOW_ALL'])
					&& 'all' === $this->arParams['SECTION_CODE']
				) {
					$entity['SECTION'] = [
						'NAME' => 'Все'
					];
				}
				
				if (
					$entity 
					&& !empty($this->arParams['SECTION_CODE'])
					&& empty($entity['SECTION'])
				) {
					$entity = false;
				}
			} catch (Exception $e) {
				$entity = false;
			}
			
			if (!$entity) {
				$this->AbortResultCache();
				Iblock\Component\Tools::process404('Error loading element', true, true, true);
			}
			
			$this->arResult = $entity;
			$this->IncludeComponentTemplate();
		}
		
		
		global $APPLICATION;
		
		if (!empty($this->arResult['SECTION'])) {
			$sectionPageUrl = !empty($this->arResult['SECTION']['CODE'])
				? sprintf('%s%s/', $this->arParams['SEF_FOLDER'], $this->arResult['SECTION']['CODE'])
				: '';
				
			$APPLICATION->AddChainItem($this->arResult['SECTION']['NAME'], $sectionPageUrl);
		}
			
		if (
			!empty($this->arParams['SEO']['title'])
			&& !empty($this->arResult[$this->arParams['SEO']['title']])
		) {
			$APPLICATION->SetTitle($this->arResult[$this->arParams['SEO']['title']]);
			$APPLICATION->SetPageProperty('title', $this->arResult[$this->arParams['SEO']['title']]);
			
			$APPLICATION->AddChainItem($this->arResult[$this->arParams['SEO']['title']]);
		}
		
		if (
			!empty($this->arParams['SEO']['description'])
			&& !empty($this->arResult[$this->arParams['SEO']['description']])
		) {
			$obParser = new \CTextParser;
            
            $temp = $obParser->html_cut($this->arResult[$this->arParams['SEO']['description']], 300);
            $temp = str_replace("\n", '', strip_tags($temp));
            $temp = preg_replace('/\s+/', ' ', $temp);
			
			$APPLICATION->SetPageProperty('description', $temp);
		}
	}

    public function getNewsByID($ID)
    {
        $this->arParams['DRIVER'] = 'Wcs';
        $this->arParams['FROM'] = 'wcs_news';
        return $this->getEntity($ID);
	}
	
	private function getEntity($entityId)
	{
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
				
		return $query
			->from($this->arParams['FROM'])
			->where(['id' => $entityId])
			->one();
	}
}