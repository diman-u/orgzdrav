<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Loader;

class VshouzGalleryComponent extends \CBitrixComponent
{
    public function onPrepareComponentParams($arParams)
    {
        if (is_scalar($arParams['COLLECTION']) && false !== strpos($arParams['COLLECTION'], ',')) {
            $arParams['COLLECTION'] = explode(',', $arParams['COLLECTION']);
            $arParams['COLLECTION'] = array_map('trim', $arParams['COLLECTION']);
        }
        $arParams['COLLECTION'] = is_scalar($arParams['COLLECTION']) ? [$arParams['COLLECTION']] : $arParams['COLLECTION'];

        return $arParams;
    }

    public function executeComponent()
    {
        $this->arResult["COLLECTIONS"] = $this->arResult["ITEMS"] = [];

        if (Loader::includeModule('fileman')) {
            CMedialib::Init();

            foreach ($this->arParams['COLLECTION'] as $collectionId) {
                $res = CMedialibCollection::GetList([
                    'arFilter' => [
                        'ID' => $collectionId
                    ]
                ]);

                if ($res) {
                    $name = $res[0]['NAME'];
                    if (preg_match('/^[^:]+: *(.+)$/i', $name, $m)) {
                        $name =trim($m[1]);
                    }
                    $this->arResult["COLLECTIONS"][$res[0]['ID']] = $name;
                }
            }

            $collection = CMedialibItem::GetList([
                'arCollections' => $this->arParams['COLLECTION']
            ]);
            foreach ($collection as $item) {
                if ('image' != $item['TYPE']) {
                    continue;
                }

                $this->arResult["ITEMS"][$item['COLLECTION_ID']][$item['FILE_NAME']] = $item;
            }
            unset($collection, $item);
            
            foreach ($this->arResult["ITEMS"] as $collectionId => $list) {
                ksort($this->arResult["ITEMS"][$collectionId], SORT_LOCALE_STRING);
            }
        }

        $this->includeComponentTemplate();
    }
}