<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\UI\Extension;
use Bitrix\Main\UI\PageNavigation;
use Bitrix\Main\Engine\CurrentUser;
use Bitrix\Main\Engine\Contract\Controllerable;
use Bitrix\Main\Engine\ActionFilter;
use Bitrix\Main\Engine\ActionFilter\Csrf;
use Orgzdrav\Helper\Format;
use Orgzdrav\Tables\NotificationsTable;

class OrgzdravNotificationsComponent extends CBitrixComponent implements Controllerable
{
    protected $errorUpdate = [];

    public function executeComponent()
    {
        Extension::load("ui.vue");

        $this->includeComponentTemplate();
    }

    public function add($userID, $dateCreate, $title, $text) {

        $result = NotificationsTable::add([
            'USER_ID' => $userID,
            'CREATED' => $dateCreate,
            'TITLE' => $title,
            'TEXT' => $text,
        ]);

        if (!$result->isSuccess()) {
            return [
                'status' => 'error'
            ];
        }
    }

    public function getAll() {

        $nav = new PageNavigation("nav-notifications");
        $nav->allowAllRecords(true)
            ->setPageSize(20)
            ->initFromUri();

        $query = NotificationsTable::getList(
            [
                'select' => [
                    'USER_ID', 'CREATED', 'TITLE', 'TEXT', 'ACTIVE'
                ],
                'filter' => [
                    'USER_ID' => CurrentUser::get()->getId()
                ],
                'offset' => $nav->getOffset(),
                'limit' => $nav->getLimit(),
                'count_total' => true
            ]
        );

        return $query->fetchAll();

        $nav->setRecordCount($query->getCount());

        $this->arResult['ROWS'] = $query->fetchAll();
        $this->arResult['NAV'] = $nav;
    }

    public function configureActions()
    {
        return [
            'getAllByUserID' => [
                'prefilters' => [
                    new ActionFilter\Csrf(),
                    new ActionFilter\HttpMethod(['POST']),
                    new ActionFilter\Authentication(),
                ]
            ],
        ];
    }

    public function setStatus($ID)
    {
        $rezult = NotificationsTable::update($ID, [
            'ACTIVE' => 0
        ]);

        if (! $rezult->isSuccess()) {
            $this->errorUpdate[] = $rezult->getErrorMessages();
        }

        return [
            'success' => $rezult->isSuccess()
        ];
    }

    public function getAllByUserIDAction()
    {
        $nav = new PageNavigation("nav-notifications");
        $nav->allowAllRecords(true)
            ->setPageSize(20)
            ->initFromUri();

        $dataQuery = NotificationsTable::getList(
            [
                'select' => [
                    'ID', 'USER_ID', 'CREATED', 'TITLE', 'TEXT', 'ACTIVE', 'CONFIG'
                ],
                'filter' => [
                    'USER_ID' => CurrentUser::get()->getId()
                ],
				'order' => [
					'ID' => 'DESC',
				],
                'offset' => $nav->getOffset(),
                'limit' => $nav->getLimit(),
                'count_total' => true
            ]
        )->fetchAll();

        foreach ($dataQuery as $key => $item) {
            $this->setStatus($item['ID']);
			
            //$dataQuery[$key]['ACTIVE'] = 0;
            $dataQuery[$key]['CREATED'] = (new Format())->getFormatDate(MakeTimeStamp($item['CREATED']));
        }

        if (empty($this->errorUpdate)) {
            return ['notifications' => $dataQuery];
        }

        return false;
    }
}