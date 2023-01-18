<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

use Bitrix\Main\Engine\Controller;
use Bitrix\Main\Engine\ActionFilter;
use Bitrix\Main\Engine\CurrentUser;
use Bitrix\Main\Error;
use Bitrix\Main\UserTable;
use Orgzdrav\Tables\BookmarksTable;
use Orgzdrav\Tables\NotificationsTable;

class OrgzdravControlsController extends Controller
{
	protected function getDefaultPreFilters()
	{
		return [
			new ActionFilter\Csrf(),
			new ActionFilter\HttpMethod(['POST']),
			new ActionFilter\Authentication()
		];
	}
	
	public function loadAction()
	{
		/** user */
		$userData = UserTable::getRow([
            'filter' => [
                'ID' => CurrentUser::get()->getId()
            ],
            'select' => [
                'NAME',
                'LAST_NAME',
                'SECOND_NAME',
				'PERSONAL_PHOTO'
            ]
        ]);
		
		if (!empty($userData['PERSONAL_PHOTO'])) {
			$userData['PERSONAL_PHOTO'] = \CFile::GetPath($userData['PERSONAL_PHOTO']);
		}
		
		/** notifications */
		$notifications = NotificationsTable::getCount([
			'USER_ID' => CurrentUser::get()->getId(),
			'ACTIVE' => 1
		]);
		
		/** bookmarks */
		$bookmarks = BookmarksTable::getList([
			'select' => ['ENTITY_ID', 'TYPE'],
			'filter' => [
				'USER_ID' => CurrentUser::get()->getId()
			]
		])->fetchAll();
		
		return [
			'user' => $userData,
			'bookmarks' => $bookmarks,
			'notifications' => $notifications
		];
	}
	
	public function addBookmarkAction($entityId, $type)
	{
		$result = BookmarksTable::add([
			'USER_ID' => CurrentUser::get()->getId(),
			'ENTITY_ID' => (int) $entityId, 
			'TYPE' => trim($type)
		]);
		
		return $result->isSuccess();
	}
	
	public function delBookmarkAction($entityId, $type)
	{
		$res = BookmarksTable::getList([
			'select' => ['ID'],
			'filter' => [
				'USER_ID' => CurrentUser::get()->getId(),
				'ENTITY_ID' => (int) $entityId, 
				'TYPE' => trim($type)
			]
		]);
		
		while ($row = $res->fetch()) {
			BookmarksTable::delete($row['ID']);
		}
		
		unset($row, $res);
		
		return true;
	}
}