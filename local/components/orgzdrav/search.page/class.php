<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Orgzdrav\Wellcomes\Models\Sengine;
use Orgzdrav\Wellcomes\Models\Support;
use Orgzdrav\Helper\Format;

class OrgzdravSearchPageComponent extends CBitrixComponent
{
    protected $newsList = [];
    protected $queryArt;
    protected $queryNews;
    protected $total;

    public function executeComponent()
    {
        $this->includeComponentTemplate();
    }

    public function queryResult($search, $total, $type = '', $offset) {

        if (empty($search)) {
            return ['error' => 'Пустая строка поиска'];
        }

        if (!isset($total) || empty($total)) {
            $total = 9;
        }

        if ($type == 'st1') {
            $this->queryNews = Sengine::search($search, 'strip1')->paginate($total, $offset);
            $this->total['NEWS'] = $this->total['ALL'] = Sengine::search($search, 'strip2')->count();
        }

        if ($type == 'st2') {
            $this->queryNews = Sengine::search($search, 'strip2')->paginate($total, $offset);
            $this->total['ARTICLES'] = $this->total['ALL'] = Sengine::search($search, 'strip1')->count();
        }

        if ($type == '') {
            $this->queryNews = Sengine::search($search, '')->paginate($total, $offset);
            $this->total['ARTICLES'] = Sengine::search($search, 'strip1')->count();
            $this->total['NEWS'] = Sengine::search($search, 'strip2')->count();
            $this->total['ALL'] = $this->total['ARTICLES'] + $this->total['NEWS'];
        }
    }

    public function geNewsID()
    {
        if (empty($this->queryNews)) {
            return false;
        }

        foreach ($this->queryNews->getCollection() as $key => $item) {

            if (strpos($item[0], 'wcs_news/') === false) {
                $this->queryArt[$key] = $item[0];
            } else {
                $this->newsList[] = [
                    'ID' => str_replace('wcs_news/', '', $item[0]),
                    'TYPE' => 'wcs_news'
                ];
            }
        }

        $this->getArticlesID();

        if (empty($this->newsList)) {
            return false;
        }

        return $this->newsList;
    }

    public function getArticlesID() {

        $index = 0;
        if (empty($this->queryArt)) {
            return false;
        }

        $articles = Support::findIblockIds($this->queryArt);

        foreach ($this->queryArt as $key => $item) {
            $this->newsList[$key] = [
                'ID' => $articles[$index],
                'TYPE' => 'iblock'
            ];
            $index++;
        }
    }

    public function getTerms()
    {
        $terms = [];
        foreach($this->queryNews->thesaurus->value->term as $item){
            $terms[] = $item->string->__toString();
        }

        return $terms;
    }

    public function getTermDesc()
    {
        if (!isset($this->queryNews->thesaurus)) {
            return false;
        }

        return (string) $this->queryNews->thesaurus->value->definition->string;
    }

    public function getCountArticle()
    {
        if (!empty($this->total['ARTICLES'])) {
            $count = $this->total['ARTICLES'];
        } else {
            $count = (array) $this->queryNews->total;
            $count = $count[0];
        }

        return [
            'TITLE' => 'Статьи',
            'COUNT' => Format::number($count),
            'NUMBER' => $count
        ];
    }

    public function getCountNews()
    {
        if (!empty($this->total['NEWS'])) {
            $count = $this->total['NEWS'];
        } else {
            $count = (array) $this->queryNews->total;
            $count = $count[0];
        }

        return [
            'TITLE' => 'Новости',
            'COUNT' => Format::number($count),
            'NUMBER' => $count
        ];
    }

    public function getRecordCount() {
        return $this->total['ALL'];
    }
}