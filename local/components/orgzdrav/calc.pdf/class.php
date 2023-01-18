<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\UI\Extension;
use Bitrix\Main\Engine\Contract\Controllerable;

class OrgzdravCalcToPdfComponent extends CBitrixComponent implements Controllerable
{
    public function executeComponent()
    {
        Extension::load("ui.vue");

        $type = $this->arParams['TYPE'];
        $this->importPdfAction($type);

        $this->includeComponentTemplate();
    }

    public function configureActions()
    {
        return [
            'importPdf' => [
                'prefilters' => [],
            ]
        ];
    }

    public function importPdfAction($type, $data)
    {
        $content = json_decode($data);

        if (file_exists(__DIR__ . '/print/' . $type . '.php'))
        {
            $GLOBALS['APPLICATION']->RestartBuffer();

            $mpdf = new \Mpdf\Mpdf([
                'mode' => 'utf-8',
                'format' => 'A4',
                'tempDir' => __DIR__ . '/tmppdf'
            ]);

            ob_start();
            require_once __DIR__ . '/print/' . $type . '.php';
            $content = ob_get_clean();

            $mpdf->WriteHTML($content);
            $mpdf->Output('example000.pdf', 'I');
            exit;
        }
    }
}