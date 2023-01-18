<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Orgzdrav\Wellcomes\Models\Sengine;
use Orgzdrav\Wellcomes\Models\WcsNews;
use Orgzdrav\Helper\Format;
use Orgzdrav\Tables\ViewCounterTable;

class OrgzdravSearchComponent extends CBitrixComponent
{
    protected $newsList = [];
    protected $articleList = [];
    protected $queryArt;
    protected $queryNews;
    protected $newsTotal;
    protected $articleTotal;
    protected $detailArticles;
    protected $detailNews;

    public function executeComponent()
    {
        $this->includeComponentTemplate();
    }

    public function queryResult($search, $total, $type = '', $offset) {

        if (empty($search)) {
            return ['error' => 'Пустая строка поиска'];
        }

        if (!isset($total) || empty($total)) {
            $total = 6;
        }

        if ($type == '') {
            $this->queryArt = Sengine::search($search, 'strip1')->paginate($total, $offset);
            $this->queryNews = Sengine::search($search, 'strip2')->paginate($total, $offset);
        }

        if ($type == 'st1') {
            $this->queryArt = Sengine::search($search, 'strip1')->paginate($total, $offset);
			
			if (0 === $offset) {
				$this->newsTotal = Sengine::search($search, 'strip2')->count();
			}
        }

        if ($type == 'st2') {
            $this->queryNews = Sengine::search($search, 'strip2')->paginate($total, $offset);
			
			if (0 === $offset) {
				$this->articleTotal = Sengine::search($search, 'strip1')->count();
			}
        }

    }

    public function loopNews()
    {
        if (empty($this->queryNews)) {
            return false;
        }

        foreach ($this->queryNews->getCollection() as $item) {

            if (strpos($item[0], 'wcs_news/') === false) {
            } else {
                $this->newsList[] = str_replace('wcs_news/', '', $item[0]);
            }
        }
    }

    public function getDetailNews()
    {
        $this->loopNews();

        if (empty($this->newsList)) {
            return false;
        }

        $arrNews = WcsNews::findMany($this->newsList);

        foreach ($this->newsList as $key => $item) {
            $arrNews[$key]['announcement'] = strip_tags(mb_substr($arrNews[$key]['text'], 0, 150)) . '...';
            $news[$item] = $arrNews[$key];
        }

        $this->detailNews = $news;

        return $this->detailNews;
    }

    public function getNewsList()
    {
        return $this->newsList;
    }
    public function getArticlesList() {
        return $this->articleList;
    }

    public function loopArticles()
    {
        if (empty($this->queryArt)) {
            return false;
        }

        foreach ($this->queryArt->getCollection() as $item) {

            if (strpos($item[0], 'doc/') === false) {
            } else {
                $this->articleList[] = str_replace('doc/', '', $item[0]);
            }
        }
    }

    public function getArticles() {

        $this->loopArticles();

        if (empty($this->articleList)) {
            return false;
        }

        foreach ($this->articleList as $key => $item) {
            $arrArticles[] = str_replace('doc/', '', $item);
        }

        $this->detailArticles = \Orgzdrav\Wellcomes\Models\Support::findIblockMany($arrArticles);

        return $this->detailArticles;
    }

    public function getTerms()
    {
        $terms = [];
        foreach($this->queryArt->thesaurus->value->term as $item){
            $terms[] = $item->string->__toString();
        }

        return $terms;
    }

    public function getCountArticle()
    {
        if (!empty($this->articleTotal)) {
            $count = $this->articleTotal;
        } else {
            $count = (array) $this->queryArt->total;
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
        if (!empty($this->newsTotal)) {
            $count = $this->newsTotal;
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

    public function getTermDesc()
    {
        if (!isset($this->queryArt->thesaurus)) {
            return false;
        }

        return (string) $this->queryArt->thesaurus->value->definition->string;
    }

    public function listArticlesID()
    {
        $list = [];

        foreach ($this->detailArticles as $item) {
            $list[(int)$item['ID']] = ViewCounterTable::getCurrentCount('IBLOCK', $item['ID']);
        }

        return $list;
    }

    public function listNewsID()
    {
        $list = [];

        foreach ($this->detailNews as $item) {
            $list[(int)$item['id']] = ViewCounterTable::getCurrentCount('wcs_news', $item['id']);
        }

        return $list;
    }
}