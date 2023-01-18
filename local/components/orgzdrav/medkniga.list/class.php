<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Automattic\WooCommerce\Client;
use Bitrix\Main\Loader;

class OrgzdravMedknigaListComponent extends \CBitrixComponent
{
	public function onPrepareComponentParams($arParams)
    {
		$arParams['LIMIT'] = $arParams['LIMIT'] ?? 12;

        return $arParams;
    }
	
	public function executeComponent()
    {
		$this->arResult = []; 
		$this->arResult['ITEMS'] = [];
			
		$nav = new \Bitrix\Main\UI\PageNavigation('nav');
		$nav->allowAllRecords(false)
			->setPageSize($this->arParams['LIMIT'])
			->initFromUri();
		
		$this->arResult['NAV'] = $nav;
		
        if ($this->StartResultCache(false, 'nav'.$nav->getOffset())) {
			
			try {
				$woocommerce = new Client(
					'https://medknigaservis.ru',
					'ck_575f8fa78353bb49235fc1ba589bffd35d868040',
					'cs_21023c78c9ff5cc84c07da2446d5311673a13748',
					[
						'wp_api' => true,
						'version' => 'wc/v3',
					]
				);
				
				$response = $woocommerce->get('products/categories/'.$this->arParams['CATEGORY_ID']);
				$nav->setRecordCount($response->count);
				unset($response);
				
				$response = $woocommerce->get('products',  [
					'category' => $this->arParams['CATEGORY_ID'],
					'per_page' => $nav->getLimit(),
					'page' => $nav->getCurrentPage()
				]);
				
				$this->arResult['ITEMS'] = $response;
				
				unset($response, $woocommerce);
			} catch (\Exception $e) {
				$this->AbortResultCache();
				return;
			}

            $this->includeComponentTemplate();
        }
    }
}