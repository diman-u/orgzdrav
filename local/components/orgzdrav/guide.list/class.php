<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Loader;

class OrgzdravDemoListComponent extends \CBitrixComponent
{
    public function onPrepareComponentParams($arParams)
    {
        $arParams['GUIDE'] = $arParams['GUIDE'] ?: false;
        $arParams['SEF_FOLDER'] = $arParams['SEF_FOLDER'] ?: '/';

        return $arParams;
    }
	
	public function executeComponent()
    {
		$this->prepareData();
		$this->includeComponentTemplate();
    }

    public function prepareData()
    {
		$client = new \Orgzdrav\Gate22\WellcomesClient('orgzdrav', 'test');
		
		$params = [];
		
		if (!empty($this->arParams['GUIDE'])) {
			$params['guide'] = $this->arParams['GUIDE'];
		}
		if (!empty($this->arParams['FIELDS'])) {
			$params['fields'] = implode(',', $this->arParams['FIELDS']);
		}
		if (!empty($this->arParams['LIMIT'])) {
			$params['paginate'] = (int) $this->arParams['LIMIT'];
		}
		
        $result = $client->db('sel', $params, true);
		
		foreach ($result as $item) {
			$item['detail_url'] = $this->arParams['SEF_FOLDER'].$item['id'].'/';
			
			$this->arResult["ITEMS"][] = $item;
		}
    }
}