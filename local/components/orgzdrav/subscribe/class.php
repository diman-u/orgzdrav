<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\UI\Extension;
use Bitrix\Main\Engine\Contract\Controllerable;
use Orgzdrav\Tables\SubscribesTable;
use Bitrix\Main\Engine\ActionFilter;
use Bitrix\Main\Type\DateTime;

class OrgzdravSubscribeComponent extends CBitrixComponent implements Controllerable
{
    public function executeComponent()
    {
        Extension::load("ui.vue");

        $this->includeComponentTemplate();
    }

    public function configureActions()
    {
        return [
            'checkEmail' => [
                'prefilters' => [
                    new ActionFilter\Csrf(),
                    new ActionFilter\HttpMethod(['POST']),
                    new ActionFilter\Authentication(),
                ],
            ]
        ];
    }

    public function checkEmailAction($email, $fio, $organization)
    {
        if (preg_match("/^(?:[a-z0-9]+(?:[-_.]?[a-z0-9]+)?@[a-z0-9_.-]+(?:\.?[a-z0-9]+)?\.[a-z]{2,5})$/i", $email)) {

            SubscribesTable::add([
                'fio' => $fio,
                'email' => $email,
                'organization' => $organization,
                'created_at' => new DateTime()
            ]);
        }

        return false;
    }
}