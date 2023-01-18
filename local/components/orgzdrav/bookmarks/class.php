<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Iblock\ElementTable;
use Bitrix\Main\Type\DateTime;
use Bitrix\Main\Engine\Contract\Controllerable;
use Bitrix\Main\Engine\CurrentUser;
use Bitrix\Main\Engine\ActionFilter;
use Bitrix\Main\Engine\ActionFilter\Csrf;
use Bitrix\Main\Loader;
use Orgzdrav\Tables\BookmarksTable;
use Bitrix\Main\Application;
use Bitrix\Main\Data\Cache;

class OrgzdravBookmarksComponent extends CBitrixComponent implements Controllerable
{
    protected const IBLOCK_BOOKMARKS = 15;
    protected $errors = [];
    protected $currentUID = 0;

	public function executeComponent()
    {
        Loader::includeModule('iblock');
        $this->currentUID = CurrentUser::get()->getId();
        $this->arResult['BOOKMARKS'] = $this->getBookmarks();
		$this->includeComponentTemplate();
    }

    public function configureActions()
    {
        return [
            'add' => [
                'prefilters' => [
                    new ActionFilter\Csrf(),
                    new ActionFilter\HttpMethod(['POST']),
                    new ActionFilter\Authentication(),
                ],
            ],
            'getAll' => [
                'prefilters' => [
                    new ActionFilter\Csrf(),
                    new ActionFilter\HttpMethod(['POST']),
                    new ActionFilter\Authentication(),
                ],
            ],
            'delete' => [
                'prefilters' => [
                    new ActionFilter\Csrf(),
                    new ActionFilter\HttpMethod(['POST']),
                    new ActionFilter\Authentication(),
                ],
            ]
        ];
    }

    public function getBookmarks()
    {
        $cache = Cache::createInstance();
        $taggedCache = Application::getInstance()->getTaggedCache();

        $cachePath = 'bookmarks';
        $cacheTtl = $this->arParams['SHOW_ELEMENTS'] ? (int)$this->arParams['SHOW_ELEMENTS'] : 3600;
        $cacheKey = $this->currentUID . '__bookmarks';

        if ($cache->initCache($cacheTtl, $cacheKey, $cachePath)) {
            $bookmarks = $cache->getVars();
        } elseif ($cache->startDataCache()) {

            $taggedCache->startTagCache($cachePath);

            $query = ElementTable::getList(
                [
                    'select' => ['ID', 'NAME', 'PREVIEW_TEXT'],
                    'filter' => [
                        'IBLOCK_ID' => static::IBLOCK_BOOKMARKS
                    ],
                    'order' => []
                ]
            );

            foreach ($query->fetchAll() as $item) {
                $bookmarks[] = $item;
            }

            $cacheInvalid = false;
            if ($cacheInvalid) {
                $taggedCache->abortTagCache();
                $cache->abortDataCache();
            }

            $taggedCache->endTagCache();
            $cache->endDataCache($bookmarks);
        }

        return $bookmarks;
    }

    public function getAllAction()
    {
        $query = BookmarksTable::getList(
            [
                'select' => ['*'],
                'filter' => [
                    'USER_ID' => CurrentUser::get()->getId()
                ],
            ]
        );

        foreach ($query->fetchAll() as $item) {
            $bookmarks[] = $item;
        }

        return $bookmarks;
    }

    public function addAction($type, $entityID, $guide)
    {
        $result = BookmarksTable::add([
            'USER_ID' => CurrentUser::get()->getId(),
//            'TYPE' => $type,
            'ENTITY_ID' => $entityID,
            'COLLECTION_ID' => $guide,
            'CREATED' => new DateTime()
        ]);

        if (!$result->isSuccess()) {
            array_push($this->errors, $result->getErrorMessages());
        }

        if (!empty($this->errors)) {
            return [
                'errors' => $this->errors
            ];
        }

        return [
            'success' => true
        ];
    }

    public function deleteAction($ID)
    {
        BookmarksTable::delete($ID);

        return [
            'success' => true
        ];
    }

    public function clearUserCache()
    {
        $taggedCache = Application::getInstance()->getTaggedCache();
        $taggedCache->clearByTag($this->currentUID . '__bookmarks');
    }
}