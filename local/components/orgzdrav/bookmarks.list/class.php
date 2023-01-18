<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Loader;
use Orgzdrav\Tables\BookmarksTable;
use Bitrix\Main\Engine\CurrentUser;

class OrgzdravBookmarksComponent extends CBitrixComponent
{
    protected $elements = [];

    public function executeComponent()
    {
        Loader::includeModule('iblock');
        $this->arResult['ITEMS'] = $this->getBookmarks();

        $this->includeComponentTemplate();
    }

    public function getBookmarks()
    {
        $bookmarks = [];
        $query = BookmarksTable::getList(
            [
                'filter' => [
                    'USER_ID' => CurrentUser::get()->getId()
                ],
            ]
        );

        if (empty($items = $query->fetchAll())) {
            return false;
        }

        foreach ($items as $item) {
            $bookmarks[] = [
                'ID' => $item['ENTITY_ID'],
                'TYPE' => $item['TYPE'],
                'IBLOCK_ID' => $item['COLLECTION_ID']
            ];
        }

        return $bookmarks;
    }
}