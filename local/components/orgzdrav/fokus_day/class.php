<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Orgzdrav\Tables\FokusDayTable;
use Orgzdrav\Wellcomes\Models\WcsNews;
use Orgzdrav\Tables\ViewCounterTable;

class OrgzdravFocusComponent extends CBitrixComponent
{
    public function executeComponent()
    {
		$this->arResult = [];
		
		if ($this->StartResultCache()) {
			$rez = FokusDayTable::getRow([]);
			
			try {
				if (!empty($rez['ELEMENT_ID'])) {
					$this->arResult = WcsNews::find($rez['ELEMENT_ID']);
				}
			} catch (\Exception $e) {}
			
			if (!$this->arResult) {
				$this->AbortResultCache();
				return;
			}
			
			$this->includeComponentTemplate();
		}
    }
}