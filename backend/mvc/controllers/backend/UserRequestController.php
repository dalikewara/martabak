<?php namespace mvc\controllers\backend;

use mvc\controllers\backend\config\Requirement;

class UserRequestController extends \system\parents\Controller
{
    private $requirements;

    public function __construct()
    {
        $this->requirements = new Requirement;
    }

    public function home()
    {
        $home = $this->requirements->model->home->Clause(
            $this->requirements->sqlGenerator->where('filename', ':filename'))->BindParam(
            ['filename' => md5('default-home-layout') . '.php'])->Range(1)->Result()[0];
        $construction = $this->requirements->model->home->Clause(
            $this->requirements->sqlGenerator->where('filename', ':filename'))->BindParam(
            ['filename' => md5('default-under-construction-layout') . '.php'])->Range(1)->Result()[0];
        $homeStatus         = $home['status'];
        $constructionStatus = $construction['status'];

        // Validation process
        empty($homeStatus) ? ($homeStatus = 2) : ($homeStatus = $homeStatus);
        empty($constructionStatus) ? ($constructionStatus = 1) : ($constructionStatus = $constructionStatus);
        file_exists($this->requirements->index->paths()['storage'] . '/home' . '/' . $home['filename']) ? TRUE :
            fclose(fopen($this->requirements->index->paths()['storage'] . '/home' . '/' . $home['filename'], 'w'));
        file_exists($this->requirements->index->paths()['storage'] . '/home' . '/' .
            $construction['filename']) ? TRUE : fclose(fopen($this->requirements->index->paths()['storage'] .
            '/home' . '/' . $construction['filename'], 'w'));

        // Filtering home view
        if($homeStatus == 1)
        {
            return $this->LOAD_VIEW($this->requirements->index->views()['storage'] . '/home' . '/' .
                str_replace('.php', '', $home['filename']));
        }
        else
        {
            return $this->LOAD_VIEW($this->requirements->index->views()['storage'] . '/home' . '/' .
                str_replace('.php', '', $construction['filename']));
        }
    }

    public function contents()
    {
        return $this->LOAD_VIEW('backend/storage/' . rtrim($this->requirements->model->contents->
            Select('filename')->Clause($this->requirements->sqlGenerator->where('slug', ':slug'))->
            BindParam(['slug' => explode('?', $_SERVER['REQUEST_URI'])[0]])->Range(1)->Result()[0],
            '.php'));
    }
}
