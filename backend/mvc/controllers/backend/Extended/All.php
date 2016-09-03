<?php namespace mvc\controllers\backend\Extended;

use mvc\controllers\backend\config\Requirement;
use mvc\controllers\universal\Tokenizer;

class All extends \system\parents\Controller
{
    private $requirements, $model, $getRequest, $sqlGenerator, $tokenizer;

    /**
    * @return   mixed
    */
    public function __construct()
    {
        $this->requirements = new Requirement;
        $this->tokenizer    = new Tokenizer;
        $this->getRequest   = $this->requirements->index->getRequest();
        $this->sqlGenerator = $this->requirements->sqlGenerator;
    }

    /**
    * @param    string   $type
    * @return   array
    */
    public function index($type)
    {
        // Filtering types
        switch($type)
        {
            case 'routes':
                $title         = 'prefix';
                $edit          = '';
                $statusPrefix  = '';
                $statusCustomP = '';
                break;
            case 'contents':
                $title         = 'title';
                $edit          = $this->requirements->requestEdit;
                $statusPrefix  = 'status';
                $statusCustomP = ' AND status=';
                break;
            case 'layouts':
                $title         = 'prefix';
                $edit          = '';
                $statusPrefix  = '';
                $statusCustomP = '';
                break;
        }

        // Defining properties
        $this->model  = $this->requirements->model->$type;
        $tables       = $this->model;
        $getSearch    = $this->getRequest['search'];
        $getSorted    = $this->getRequest['sorted_by'];
        $getStatus    = $this->getRequest['status'];
        $getPaginate  = $this->getRequest['paginate'];
        $getPage      = $this->getRequest['page'];
        $orderBy      = 'id';
        $search = $whereInQuery = '';
        $status       = (isset($_GET[$getStatus]) AND !empty($_GET[$getStatus])) ? $_GET[$getStatus] : 1;
        $sortedBy     = (isset($_GET[$getSorted]) AND !empty($_GET[$getSorted])) ? $_GET[$getSorted] : 'latest';
        $sortedBy     = (($sortedBy === 'latest') OR ($sortedBy === 'newer')) ? 'DESC' :
            (($sortedBy === 'older') ? 'ASC' : (($sortedBy == 'title') ? 'title' : 'DESC'));
        $orderBy      = ($sortedBy == 'title') ? $title : $orderBy;
        $sortedBy     = ($sortedBy == 'title') ? 'ASC' : $sortedBy;
        $paginate     = (isset($_GET[$getPaginate]) AND !empty($_GET[$getPaginate])) ? $_GET[$getPaginate] : 5;
        $page         = (isset($_GET[$getPage]) AND !empty($_GET[$getPage])) ? $_GET[$getPage] : 1;
        $statusQuery  = ($statusCustomP == '') ? '' : $this->sqlGenerator->where($statusPrefix, $status);
        $orderByQuery = $this->sqlGenerator->orderBy($orderBy, $sortedBy);

        // Generate Search
        if(!empty($_GET[$getSearch]) AND $_GET[$getSearch] != '')
        {
            $search      = str_replace('+', ' ', $_GET[$getSearch]);
            $searchMatch = [];
            $searchMatchBad[0] = [];
            $x           = 0;

            foreach($tables->All() as $table)
            {
                if(preg_match('/(' . $search . ')/i', $table[$title]))
                {
                    $searchMatch[$x] = $table[$title];
                    $x++;
                }
                else
                {
                    $searchMatchBad[0] = $_GET[$getSearch];
                }
            }

            empty($searchMatch) ? $searchMatch = $searchMatchBad : FALSE;

            $whereInQuery = $this->sqlGenerator->whereIn($title, $searchMatch);
            $statusQuery  = ($statusCustomP == '') ? "" : "{$statusCustomP}'{$status}' ";
        }

        // Get query clause
        $clauseQuery = $whereInQuery . $statusQuery . $orderByQuery;

        // Generate Pagination
        $contents       = $tables->Clause($clauseQuery)->Result();
        $dataPagination = Parent::PAGINATION_DATA($contents, $paginate);
        $contents       = (isset($dataPagination[$page])) ? $dataPagination[$page] :
            ((count($dataPagination) > 0) ? $dataPagination[1] : array());
        $pagination = Parent::PAGINATION_STYLE_NUMBER($dataPagination, $paginate, $page);
        $langs      = $this->requirements->langs;
        $indexLang  = $this->requirements->indexLang;

        // Filtering contents data
        ($type == 'layouts') ? ($contents = array_map(function($a){return array_merge($a,
            ['content' => file_get_contents($this->requirements->index->paths()['storage'] .
            "/layouts" . '/' . $a['filename'])]);}, $contents)) : FALSE;

        $token = $this->tokenizer->getTokenFromDB(new \mvc\models\Token, 'token',
            $this->requirements->sqlGenerator->where('user_id',
            $this->requirements->model->users->Select('id')->Clause(
            $this->requirements->sqlGenerator->where('username', ':username'))
            ->BindParam(['username' => $this->GET_RULE('auth')[1]])->Range(1)
            ->Result()[0]));

        return Parent::LOAD_VIEW("backend/extended/all-{$type}",
            compact('contents', 'pagination', 'edit', 'langs', 'indexLang',
            'token'));
    }
}
