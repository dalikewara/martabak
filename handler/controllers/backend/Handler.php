<?php namespace controller\backend;

use controller\backend\Process;

class Handler extends \framework\parents\Controller
{
    // The following variable have access to this class only.
    private $process, $post;

    public function __construct()
    {
        // Initialize Process object.
        $this->process = new Process;
        // Checking for $_POST data.
        $this->post = isset($_POST) ? $_POST : [];
    }

    /**
    * Handle to insert contents
    *
    * @param    string   $content
    * @return   mixed
    */
    public function create($content)
    {
        // Do the process
        $this->process->init($this->post, $content, 'insert');
    }

    /**
    * Handle to update contents
    *
    * @param    string   $content
    * @return   mixed
    */
    public function update($content)
    {
        // Do the process
        $this->process->init($this->post, $content, 'update');
    }

    /**
    * Handle to delete contents
    *
    * @param    string   $content
    * @return   mixed
    */
    public function delete($content)
    {
        // Do the process
        $this->process->init($this->post, $content, 'delete');
    }
}
