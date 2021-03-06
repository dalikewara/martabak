<?php namespace controller\backend;

use controller\config\Path;
use controller\config\Uri;
use controller\config\Model;

class Welcome extends \framework\parents\Controller
{
    // The following variables have access in this class only.
    private $path, $uri, $model;

    function __construct()
    {
        // Prepared requirements
        $this->path = new Path;
        $this->uri = new Uri;
        $this->model = new Model;
    }

    /**
    * This method is used to redirect request with '/dashboard' to it related view.
    *
    * @return   view   backend/dashboard
    */
    public function dashboard()
    {
        $path = $this->path;
        $uri = $this->uri;
        $note = $this->model->Note->clause("ORDER BY id DESC")->get(1);
        $totals = [
            'routes' => count($this->model->Route->get()),
            'pages' => count($this->model->Page->get()),
            'notes' => count($this->model->Note->get()),
            'controllers' => count($this->model->Controller->get()),
            'metas' => count($this->model->Meta->get()),
            'layouts' => count($this->model->Layout->get()),
        ];

        return Parent::LOAD_VIEW('backend/dashboard', compact('path', 'uri', 'note',
            'totals'));
    }

    /**
    * This method is used to redirect request with '/add-note' to it related view.
    *
    * @return   view   backend/dashboard
    */
    public function contents($content)
    {
        $path = $this->path;
        $uri = $this->uri;
        $layouts = $this->model->Layout->get();
        $routes = $this->model->Route->get();
        $data = null;
        $landings = ['homepage-landing', 'construction-landing'];

        if($content === 'landing' AND isset($_GET['template']) AND in_array($_GET['template'], $landings))
        {
            $data = htmlspecialchars(file_get_contents($this->path->landings_storage . '/' .
                $this->model->Landing->select('filename')->clause('WHERE filename=:name')
                ->bindParams(['name' => md5($_GET['template']) . '.php'])->get(1)[0]->filename));
        }

        return Parent::LOAD_VIEW($this->uri->{'_' . $content}[1], compact('path',
            'uri', 'data', 'landings', 'layouts', 'routes'));
    }

    /**
    * @param    string   $content
    * @return   mixed
    */
    public function preview($content)
    {
        $data = isset($_GET['data']) ? $_GET['data'] : false;

        $rewrite = fopen($this->path->layouts . '/custom-preview.php', 'w');
        fwrite($rewrite, $data);
        fclose($rewrite);

        return ($content === 'preview') ? Parent::LOAD_VIEW('layouts/preview') :
            Parent::LOAD_VIEW('layouts/custom-preview', compact('data'));
    }
}
