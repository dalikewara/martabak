<?php namespace controller\backend;

use controller\config\Allowed;
use controller\config\Http;
use controller\config\Path;

class Landing
{
    private $allowed, $http, $path, $data;
    
    function __construct()
    {
        $this->http = new Http;
        $this->allowed = new Allowed;
        $this->path = new Path;
    }
    
    public function handler($landing)
    {
        // Checking for http connection.
        // If User or Protected Rule data doesn't exists, or method request
        // isn't valid, the processes bellow will be stopped at here.
        $this->http->check();
        // Checking for available contents of Landing pages.
        // If the Landing is not available, the processes bellow will be stopped
        // at here.
        $this->allowed->check('landings', $landing);
        
        // Getting data.
        $this->data = isset($_POST['content']) ? $_POST['content'] : 
            die('Illegal content!');
        
        // Handle to update Landing data.
        file_put_contents($this->path->landings_storage . '/' . 
            md5($landing . '-landing') . '.php', $this->data);
            
        // If this line is reached, so the process was done perfectly.
        die('ok');
    }
    
    public function status($landing)
    {
    }
}
