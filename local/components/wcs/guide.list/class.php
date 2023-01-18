<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Loader;
use Orgzdrav\Tables\ViewCounterTable;
use Bitrix\Main\Type\DateTime;

class WcsListComponent extends \CBitrixComponent
{
	const VIEW_COUNTER_KEY = 'view_counter';
	
    public function onPrepareComponentParams($arParams)
    {
        $arParams['GUIDE'] = $arParams['GUIDE'] ?: false;
        $arParams['FIELDS'] = $arParams['FIELDS'] ?: [];
        $arParams['SEF_FOLDER'] = $arParams['SEF_FOLDER'] ?: '/';
        $arParams['DISABLED'] = $arParams['DISABLED'] ?: [];
        $arParams['USE_COUNTER'] = $arParams['USE_COUNTER'] ?: false;
		
		if (!empty($arParams['DISABLED']) && is_scalar($arParams['DISABLED'])) {
			$arParams['DISABLED'] = [$arParams['DISABLED']];
		}
		
		if (false === $arParams['USE_COUNTER']) {
			$key = array_search(self::VIEW_COUNTER_KEY, $arParams['FIELDS']);
			
			if (false !== $key) {
				$arParams['USE_COUNTER'] = true;
				unset($arParams['FIELDS'][$key]);
			}
		}

        return $arParams;
    }
	
	public function executeComponent()
    {
        global $APPLICATION;

		if (0 === strpos($this->arParams['GUIDE'], 'vshouz')) {
            $this->prepareDataVshouz();
		} else {
			$this->prepareData();
		}

		if (mb_strpos($APPLICATION->GetCurDir(), 'arhive')) {
            $this->arResult['ARHIVE'] = 'Y';
        }
		
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
			if (in_array($item['id'], $this->arParams['DISABLED'])) {
				continue;
			}
			
			$item['detail_url'] = $this->arParams['SEF_FOLDER'].$item['id'].'/';
			
			if ($this->arParams['USE_COUNTER']) {
				$item[self::VIEW_COUNTER_KEY] = ViewCounterTable::getCurrentCount($this->arParams['GUIDE'], $item['id']);
			}
			
			$this->arResult["ITEMS"][] = $item;
		}
    }

    public function prepareDataVshouz()
    {
        static $idList = [];
        static $cache = [];

        $iblockId = array_pop(explode(':', $this->arParams['GUIDE']));
        if (!isset($cache[$iblockId])) {
            $client = new \Orgzdrav\Gate22\VshouzClient();
            $cache[$iblockId] = $client->list($iblockId);
        }
        $result = $cache[$iblockId];

        if (!empty($idList)) {
            $result = array_filter($result, function($post) use ($idList) {
                return !in_array($post['ID'], $idList);
            });
        }
        /*if (!empty($this->arParams['LIMIT'])) {
            $result = array_slice($result, 0, (int) $this->arParams['LIMIT']);
        }*/
		
		$this->arResult['ITEMS'] = [];
		$this->arResult['ARHIVE_ITEMS'] = [];

        foreach ($result as $post) {
            if (in_array($post['ID'], $this->arParams['DISABLED'])) {
                continue;
            }

            $idList[] = $post['ID'];

            $item = [];
            $item['id'] = $post['ID'];
            $item['idx_key_date'] = $post['ACTIVE_FROM'] ?? $post['DATE_CREATE'];
			$item['idx_key_date_end'] = $post['ACTIVE_TO'] ?? false;
            $item['header'] = $post['NAME'];
            $item['annotation'] = $post['PREVIEW_TEXT'];
            $item['photos']['asis'] = $post['PREVIEW_PICTURE'];

            $item['detail_url'] = $this->arParams['SEF_FOLDER'].$item['id'].'/';

            foreach ($post['PROPERTIES'] as $key => $value) {
                $item[strtolower($key)]['value'] = $value;
            }

            $today = DateTime::createFromUserTime(date('d.m.Y'));
            $articleDayBegin = DateTime::createFromUserTime($item['idx_key_date']);

			if ($today < $articleDayBegin) {
                $this->arResult['ITEMS'][] = $item;
            } else {
                $this->arResult['ARHIVE_ITEMS'][] = $item;
            }
        }

        $this->arResult['ITEMS'] = $this->sortItemesTest($this->arResult['ITEMS']);
        $this->arResult['ARHIVE_ITEMS'] = $this->sortItemesTest($this->arResult['ARHIVE_ITEMS'], 'DESC');
		
		if (!empty($this->arParams['LIMIT'])) {
            $this->arResult['ITEMS'] = array_slice($this->arResult['ITEMS'], 0, (int) $this->arParams['LIMIT']);
        }
    }

    public function sortItemesTest($items, $sort = 'ASC')
    {
        $arrSort = [];

        foreach ($items as $item) {
            $articleDayBegin = DateTime::createFromUserTime($item['idx_key_date']);
            $arrSort[$articleDayBegin->getTimestamp()] = $item;
        }

        if ($sort == 'ASC') {
            ksort($arrSort);
            return $arrSort;
        } else {
            krsort($arrSort);
            return $arrSort;
        }

    }

    public function sortItems()
    {
        if (!empty($this->arParams['SORT']) && is_array($this->arParams['SORT'])) {
            foreach ($this->arParams['SORT'] as $sortField) {
                if ('idx_key_date' === $sortField) {
                    usort($this->arResult['ITEMS'], function($a, $b) use ($sortField) {
                        return -(strtotime($a[$sortField]) <=> strtotime($b[$sortField]));
                    });
                }
            }
        }
    }
}