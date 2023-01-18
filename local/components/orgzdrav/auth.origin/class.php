<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Application;
use Bitrix\Main\Loader;
use Bitrix\Main\Engine\Contract\Controllerable;
use Bitrix\Main\Engine\ActionFilter;
use Bitrix\Main\Engine\ActionFilter\Csrf;
use Orgzdrav\Errors\ErrorsValidation;

class OrgzdravAuthComponent extends \CBitrixComponent implements Controllerable
{
    private $errors = [];

    public function onPrepareComponentParams($arParams)
    {
        return $arParams;
    }
	
	public function executeComponent()
    {
		\Bitrix\Main\UI\Extension::load("ui.vue");
		
		$this->includeComponentTemplate();
    }

    public function validateByLength($valueField, $errorText, $titleField = '')
    {
        if (empty($valueField)) {
            array_push($this->errors, [$titleField => $errorText]);
        }
    }

    public function emailValidate($email, $errorText, $titleField = '')
    {
        if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
            array_push($this->errors, [$titleField => $errorText]);
        }
    }

    public function validateByPassEquals($password, $password_confirm)
    {
        if ($password != $password_confirm) {
            array_push($this->errors, [$password_confirm => ErrorsValidation::PASSWORDS_REPEAT_NO_EQUALS]);
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
            'registration' => [
                'prefilters' => [
                    new ActionFilter\Csrf(),
                    new ActionFilter\HttpMethod(['POST'])
                ],
            ]
        ];
    }

    public function registrationAction($form, $remember = false)
    {
        if ($form['step'] == 1) {
            $this->validateByLength($form['NAME'], ErrorsValidation::EMPTY_FIELD_NAME, 'NAME');
            $this->validateByLength($form['LAST_NAME'], ErrorsValidation::EMPTY_FIELD_LASTNAME, 'LAST_NAME');
            $this->validateByLength($form['EMAIL'], ErrorsValidation::EMPTY_FIELD_EMAIL, 'EMAIL');
            $this->validateByLength($form['PERSONAL_PHONE'], ErrorsValidation::EMPTY_FIELD_PHONE, 'PERSONAL_PHONE');
            $this->emailValidate($form['EMAIL'], ErrorsValidation::EMAIL_INCORRECT, 'EMAIL');
            $this->phoneValidate($form['PERSONAL_PHONE'], ErrorsValidation::EMAIL_INCORRECT, 'EMAIL');
        }

        if ($form['step'] == 2) {
            $this->validateByLength($form['PERSONAL_PROFESSION'], ErrorsValidation::EMPTY_FIELD_PERSONAL_PROFESSION, 'PERSONAL_PROFESSION');
            $this->validateByLength($form['WORK_COMPANY'], ErrorsValidation::EMPTY_FIELD_WORK_COMPANY, 'WORK_COMPANY');
            $this->validateByLength($form['WORK_POSITION'], ErrorsValidation::EMPTY_FIELD_WORK_POSITION, 'WORK_POSITION');
            $this->validateByLength($form['WORK_COUNTRY'], ErrorsValidation::EMPTY_FIELD_WORK_COUNTRY, 'WORK_COUNTRY');
            $this->validateByLength($form['WORK_CITY'], ErrorsValidation::EMPTY_FIELD_WORK_CITY, 'WORK_CITY');
        }

        if ($form['step'] == 3) {
            $this->validateByLength($form['PASSWORD'], ErrorsValidation::EMPTY_FIELD_NEW_PASSWORD, 'PASSWORD');
            $this->validateByLength($form['PASSWORD_CONFIRM'], ErrorsValidation::EMPTY_FIELD_REPEAT_PASSWORD, 'PASSWORD_CONFIRM');
            $this->validateByPassEquals($form['PASSWORD'], $form['PASSWORD_CONFIRM']);
            $this->validateNewPassword($form['PASSWORD'], 'PASSWORD');

            // Проверка по базе wellcoms
            $well = true;
            if(!$well) {
                return false;
            }

            if (!empty($this->errors)) {
                return [
                    'errors' => $this->errors
                ];
            }

            $user = new CUser;
            $ID = $user->Add($form);

            if (intval($ID) > 0) {
                return [
                    'errors' => '',
                    'message' => 'Пользователь ' .$ID. ' успешно зарегистрирован',
                    'success' => true
                ];
            }

            // Ошибки при создании пользователя
            foreach (explode('.<br>', $user->LAST_ERROR) as $item) {
                if (!empty($item)) {
                    $this->errors[] = $item;
                }
            }
        }

        return [
            'errors' => $this->errors
        ];

//        if (is_string($remember)) {
//            $remember = 'true' === $remember;
//        }

    }
}