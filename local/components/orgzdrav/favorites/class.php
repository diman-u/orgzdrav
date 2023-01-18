<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\UI\Extension;
use Bitrix\Main\Engine\Contract\Controllerable;
use Orgzdrav\Tables\FavoritesTable;
use Bitrix\Main\Engine\ActionFilter;
use Bitrix\Main\Engine\ActionFilter\Csrf;
use Bitrix\Main\Engine\CurrentUser;
use Bitrix\Main\Web\Cookie;
use Bitrix\Main\Application;

class OrgzdravFavoritesComponent extends CBitrixComponent implements Controllerable
{
    public function executeComponent()
    {
        Extension::load("ui.vue");

        global $USER;

        if ($USER->IsAuthorized()) {
            $this->arResult['USER_FAVORITES'] = $this->getUserFavoritesFromDB();
        } else {
            $this->arResult['USER_FAVORITES'] = $this->getUserFavoritesFromCookie();
        }
//        dd($this->arResult['USER_FAVORITES']);
        $this->includeComponentTemplate();
    }

    public function getUserFavoritesFromDB()
    {
        CBitrixComponent::includeComponentClass("orgzdrav:xdata.detail");
        $news = new XDataDetailComponent();

        foreach($this->getAll() as $item) {
            $arrNews[] = $news->getNewsByID($item['ELEMENT_ID']);
        }

        return $arrNews;
    }

    public function getUserFavoritesFromCookie()
    {
        CBitrixComponent::includeComponentClass("orgzdrav:xdata.detail");
        $news = new XDataDetailComponent();

        foreach($this->getFromCookie() as $item) {
            $arrNews[] = $news->getNewsByID($item);
        }

        return $arrNews;
    }

    public function getAll()
    {
        $favorites =  FavoritesTable::getList([
            'filter' => [
                'USER_ID' => CurrentUser::get()->getId()
            ],
            'select' => ['ID', 'ENTITY_TYPE', 'ELEMENT_ID']
        ])->fetchAll();

        if (!empty($favorites)) {
            return $favorites;
        }
    }

    public function getFromCookie()
    {
        $request = Application::getInstance()->getContext()->getRequest();
        return json_decode($request->getCookie('Favorites'));
    }

    public function configureActions()
    {
        return [
            'add' => [
                'prefilters' => [],
            ],
            'delete' => [
                'prefilters' => [],
            ],
        ];
    }

    public function addAction($favoriteID, $favoriteType)
    {
        global $USER;

        if ($USER->IsAuthorized()) {
            $this->addToDB($favoriteID, $favoriteType);
        } else {
            $this->addToCookies($favoriteID, $favoriteType);
        }
    }

    public function deleteAction($favoriteID)
    {
        global $USER;

        if ($USER->IsAuthorized()) {
            $this->delToDB($favoriteID);
        } else {

            $newData = $this->findAndDelFromCookie($favoriteID);
            return json_encode(array_values($newData));
            $cookie = new Cookie('Favorites', json_encode(array_values($newData)), time() + 86400);
            Application::getInstance()->getContext()->getResponse()->addCookie($cookie);
        }
    }

    public function addToDB($favoriteID, $favoriteType)
    {
        if (! $this->uniqueFavoriteToDB($favoriteID)) {
            return false;
        }

        $result = FavoritesTable::add([
            'USER_ID' => CurrentUser::get()->getId(),
            'ENTITY_TYPE' => $favoriteType,
            'ELEMENT_ID' => $favoriteID,
        ]);

        if (!$result->isSuccess()) {
            return [
                'errors' => $result->getErrorMessages()
            ];
        }

        return [
            'success' => true
        ];
    }

    public function delToDB($favoriteID)
    {
        $favorites = FavoritesTable::getRow([
            'filter' => [
                'USER_ID' => CurrentUser::get()->getId(),
                'ELEMENT_ID' => $favoriteID
            ],
            'select' => ['ID']
        ]);

        if (!empty($favorites)) {
            FavoritesTable::delete($favorites['ID']);
        }

        return [
            'success' => true
        ];
    }

    public function uniqueFavoriteToDB($favoriteID)
    {
        $favorites = FavoritesTable::getRow([
            'filter' => [
                'USER_ID' => CurrentUser::get()->getId(),
                'ELEMENT_ID' => $favoriteID
            ],
            'select' => ['ID']
        ]);

        if (!empty($favorites)) {
            return false;
        }

        return true;
    }

    public function addToCookies($favoriteID)
    {
        $data = [$favoriteID];
        $dataCookie = $this->getFromCookie();
        if (!empty($dataCookie)) {
            $data = array_merge($dataCookie, $data);
        }

        $cookie = new Cookie('Favorites', json_encode($data), time() + 86400);
        Application::getInstance()->getContext()->getResponse()->addCookie($cookie);
    }

    public function delToCookies($favoriteID)
    {
        $newData = $this->findAndDelFromCookie($favoriteID);
        $cookie = new Cookie('Favorites', json_encode(array_values($newData)), time() + 86400);
        Application::getInstance()->getContext()->getResponse()->addCookie($cookie);
    }

    public function findAndDelFromCookie($favoriteID) {
        $arrData = $this->getFromCookie();

        if (in_array($favoriteID, $arrData)) {
            $key = array_search($favoriteID, $arrData);
            unset($arrData[$key]);
        }
        return $arrData;
    }
}