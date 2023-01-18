<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Engine\Contract\Controllerable;
use Bitrix\Main\UI\Extension;
use Bitrix\Main\UserTable;
use Bitrix\Main\Engine\CurrentUser;
use Bitrix\Main\Engine\ActionFilter;
use Bitrix\Main\Engine\ActionFilter\Csrf;
use Bitrix\Main\Entity\Validator;
use Orgzdrav\Errors\ErrorsValidation;
use Bitrix\Highloadblock as HL;
use Bitrix\Main\Loader;
use Orgzdrav\Tables\UserSubscribeTable;
use Bitrix\Main\Type\DateTime;

class OrgzdravProfileComponent extends CBitrixComponent implements Controllerable
{
    protected $errors = [];
    protected const HLBLOCK_SUSCRIBE = 1;

	public function executeComponent()
    {
		Extension::load("ui.vue");

        /**
         * Получение полей профиля пользователя
         */
        $this->arResult['SETTINGS'] = UserTable::getRow([
            'filter' => [
                'ID' => CurrentUser::get()->getId()
            ],
            'select' => [
                'LAST_NAME',
                'NAME',
                'SECOND_NAME',
                'PERSONAL_PHONE',
                'EMAIL',
                'WORK_COMPANY',
                'WORK_POSITION',
                'WORK_STATE',
                'WORK_CITY',
                'PERSONAL_PROFESSION',
                'UF_RANK',
                'UF_ACADEMIC_DEGREE',
                'UF_WORK_ADDRESS',
            ]
        ]);

//        $this->arResult['SUBSCRIBE'] = $this->getSubscribe();
		
		$this->includeComponentTemplate();
    }

    public function validateByLength($valueField, $errorText, $titleField = '')
    {
        if (empty($valueField)) {
            array_push($this->errors, [$titleField => $errorText]);
        }
    }

    public function validateNewPassword($password, $titleField)
    {
        if (mb_strlen($password) < 8) {
            array_push($this->errors, [$titleField => ErrorsValidation::SHORT_PASSWORD]);
            return;
        }

        if(! preg_match("/([0-9]+)/", $password))
        {
            array_push($this->errors, [$titleField => ErrorsValidation::NO_NUMBERS]);
            return;
        }

        if(! preg_match("/([A-Z]+)/", $password))
        {
            array_push($this->errors, [$titleField => ErrorsValidation::NO_UPPER_WORDS]);
        }
    }

    public function configureActions()
    {
        return [
            'all' => [
                'prefilters' => [
                    new ActionFilter\HttpMethod(['POST']),
                    new ActionFilter\Authentication(),
                ],
            ],
            'check' => [
                'prefilters' => [
                    new ActionFilter\HttpMethod(['POST']),
                    new ActionFilter\Authentication(),
                ],
            ],
            'update' => [
                'prefilters' => [
                    new ActionFilter\Csrf(),
                    new ActionFilter\HttpMethod(['POST']),
                    new ActionFilter\Authentication(),
                ],
            ],
            'changePassword' => [
                'prefilters' => [
                    new ActionFilter\Csrf(),
                    new ActionFilter\HttpMethod(['POST']),
                    new ActionFilter\Authentication(),
                ],
            ],
            'list' => [
                'prefilters' => [
                    new ActionFilter\Csrf(),
                    new ActionFilter\HttpMethod(['POST']),
                    new ActionFilter\Authentication(),
                ],
            ]
        ];
    }

    public function allAction()
    {
        Loader::includeSharewareModule('highloadblock');
        $hlblock = HL\HighloadBlockTable::getById(static::HLBLOCK_SUSCRIBE)->fetch();
        $entity = HL\HighloadBlockTable::compileEntity($hlblock);
        $entity_data_class = $entity->getDataClass();
        $result = $entity_data_class::getList([]);
        return [
            'all' => $result->fetchAll()
        ];
    }

    public function checkAction()
    {
        $userSubscribe = UserSubscribeTable::getRow([
            'filter' => [
                'USER_ID' => CurrentUser::get()->getId()
            ],
            'select' => ['SUBSCRIBE_ID']
        ]);

        if (!empty($userSubscribe)) {
            return [
                'check' => explode(';', $userSubscribe['SUBSCRIBE_ID'])
            ];
        }
    }

    /*public function updateAction($userData)
    {
		if (!CurrentUser::get()->getId()) {
			return [
                'errors' => ['Системная ошибка']
            ];
		}
		
        $this->errors = [];
	    $this->validateByLength($userData['NAME'], ErrorsValidation::EMPTY_FIELD_NAME, 'NAME');
	    $this->validateByLength($userData['LAST_NAME'], ErrorsValidation::EMPTY_FIELD_LASTNAME, 'LAST_NAME');
	    $this->validateByLength($userData['EMAIL'], ErrorsValidation::EMPTY_FIELD_EMAIL, 'EMAIL');
		
		/** первое - обновление wellcomes */
		/*if (empty($this->errors)) {
			$wellcomesUser = WellcomesUser::login($userData['EMAIL']);
			
			$status = $wellcomesUser->update([
				'firstname' => $userData['NAME'],
				'middlename' => $userData['SECOND_NAME'],
				'surname' => $userData['LAST_NAME'],
				'email' => $userData['EMAIL'],
				'phone' => $userData['PERSONAL_PHONE'],
				'ru_subject_id' => $userData['WORK_STATE'],
				'ru_local_id' => $userData['WORK_CITY'],
				'dadata_org_id' => $userData['UF_DADATA_ORG_ID'],
				'ont_spec_nom_id' => $userData['PERSONAL_PROFESSION'],
				'job_title' => $userData['WORK_POSITION'],
			]);
			
			if (!$status) {
				array_push($this->errors, ['' => 'Не удалось обновить акаунт!']);
			}
		}
		
		/** второе - обновление внутри сайта
	    if (empty($this->errors)) {
            $user = new CUser;
            $user->Update(
                CurrentUser::get()->getId(),
                [
                    'NAME' => $userData['NAME'],
                    'LAST_NAME' => $userData['LAST_NAME'],
                    'SECOND_NAME' => $userData['SECOND_NAME'],
                    'PERSONAL_PHONE' => $userData['PERSONAL_PHONE'],
                    'EMAIL' => $userData['EMAIL'],
                    'WORK_COMPANY' => $userData['WORK_COMPANY'],
                    'WORK_POSITION' => $userData['WORK_POSITION'],
                    'WORK_STATE' => $userData['WORK_STATE'],
                    'WORK_CITY' => $userData['WORK_CITY'],
                    'PERSONAL_PROFESSION' => $userData['PERSONAL_PROFESSION'],
                    'UF_RANK' => $userData['UF_RANK'],
                    'UF_ACADEMIC_DEGREE' => $userData['UF_ACADEMIC_DEGREE'],
                    'UF_WORK_ADDRESS' => $userData['UF_WORK_ADDRESS'],
                    
					'UF_DADATA_ORG_ID' => $userData['UF_DADATA_ORG_ID'],
					'UF_SUBJECT_ID' => $userData['WORK_STATE'],
					'UF_LOCAL_ID' => $userData['WORK_CITY'],
                ]
            );

            if (!empty($user->LAST_ERROR)) {
                array_push($this->errors, ['' => strip_tags($user->LAST_ERROR)]);
            }
        }

	    if (!empty($this->errors)) {
            return [
                'errors' => $this->errors
            ];
        }

        return [
            'success' => true
        ];
    }*/

    /*public function changePasswordAction($currentPassword, $newPassword, $repeatPassword)
    {
        $this->errors = [];
        $this->validateByLength($currentPassword, ErrorsValidation::EMPTY_FIELD_CURRENT_PASSWORD, 'currentPassword');
        $this->validateByLength($newPassword, ErrorsValidation::EMPTY_FIELD_NEW_PASSWORD, 'newPassword');
        $this->validateByLength($repeatPassword, ErrorsValidation::EMPTY_FIELD_REPEAT_PASSWORD, 'repeatPassword');

        $user = new CUser;
        $authResult = $user->Login($user->GetLogin(), $currentPassword, 'Y');

        if (empty($authResult['MESSAGE'])) {
            $this->validateNewPassword($newPassword, 'newPassword');
        } else {
            array_push($this->errors, ['' => ErrorsValidation::INCORRECT_CURRENT_PASSWORD]);
        }

        if (empty($this->errors)) {
            $fields = [
                'PASSWORD'          => $newPassword,
                'CONFIRM_PASSWORD'  => $repeatPassword
            ];
            $user->Update($user->GetID(), $fields);
        }

        if ($user->LAST_ERROR) {
            array_push($this->errors, ['' => strip_tags($user->LAST_ERROR)]);
        }

        if (!empty($this->errors)) {
            return [
                'errors' => $this->errors
            ];
        }

        return [
            'success' => true
        ];
    }*/

    public function hasSubscribe()
    {
        $list = UserSubscribeTable::getRow([
            'filter' => [
                'USER_ID' => CurrentUser::get()->getId()
            ]
        ]);

        if (!empty($list)) {
            return $list['ID'];
        }

        return false;
    }

    public function addSubscribe($userSubscribe)
    {
        $result = UserSubscribeTable::add([
            'USER_ID' => CurrentUser::get()->getId(),
            'SUBSCRIBE_ID' => implode(';', $userSubscribe),
            'CREATED' => new DateTime()
        ]);

        if (!$result->isSuccess()) {
            return [
                'errors' => $result->getErrorMessages()
            ];
        }
    }

    public function listAction($userSubscribe)
    {
        $rezID = $this->hasSubscribe();

        if (! $rezID) {
            $this->addSubscribe($userSubscribe);
        } else {
            UserSubscribeTable::update($rezID, [
                'SUBSCRIBE_ID' => implode(';', $userSubscribe)
            ]);
        }

        return [
            'success' => true
        ];
    }
	
	public function profileAction()
    {
		if (!CurrentUser::get()->getId()) {
			return false;
		}
		
		$userData = UserTable::getRow([
            'filter' => [
                'ID' => CurrentUser::get()->getId()
            ],
            'select' => [
                'LAST_NAME',
                'NAME',
                'SECOND_NAME',
                'PERSONAL_PHONE',
                'EMAIL',
                'WORK_COMPANY',
                'WORK_POSITION',
                'WORK_STATE',
                'WORK_CITY',
                'PERSONAL_PROFESSION',
                'UF_RANK',
                'UF_ACADEMIC_DEGREE',
                'UF_WORK_ADDRESS',
				'PERSONAL_PHOTO'
            ]
        ]);
		
		if (!empty($userData['PERSONAL_PHOTO'])) {
			$userData['PERSONAL_PHOTO'] = \CFile::GetPath($userData['PERSONAL_PHOTO']);
		}
		
		return $userData;
    }
}