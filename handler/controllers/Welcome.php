<?php namespace controller;

class Welcome extends \framework\parents\Controller
{
    /**
    * This method is used to redirect request with '/' to it related view.
    *
    * @return   view   auth/login
    */
    public function home()
    {
        // Preparing variables
        $path = new \controller\config\Path;
        $model = new \controller\config\Model;
        $landing = $model->Landing->clause('WHERE filename=:filename')
            ->bindParams(['filename' => md5('homepage-landing') . '.php'])->get()[0];

        // If the homepage landing doesn't exists, we create new one.
        if(!file_exists($path->landing_storages . '/' . $landing->filename))
        {
             file_put_contents($path->landings_storage . '/' . $landing->filename,
                'This is homepage');
        }
        
        // Checking for homepage landing status.
        // If it exists but status isn't 1, then we will redirect it
        // to construction landing.
        if($landing->status == 1)
        {
            return Parent::LOAD_VIEW('/storages/landings/' . str_replace(
                '.php', '', $landing->filename));
        }
        else
        {
            // If the construction landing doesn't exists, we will create new one.
            if(!file_exists($path->landings_storage . '/' . md5(
                'construction-landing') . '.php'))
            {
                file_put_contents($path->landings_storage . '/' . md5(
                    'construction-landing') . '.php', 'This is construction');
            }
            
            return Parent::LOAD_VIEW('/storages/landings/' . md5(
                'construction-landing'));
        }
    }

    /**
    * This method is used to redirect request with '/login' to it related view.
    *
    * @return   view   auth/login
    */
    public function login()
    {
        // We checking for Protected Rule data first. If the user already has it,
        // then we will redirected to main page.
        if($this->CHECK_RULE('protected'))
        {
            header('Location: /');
        }
        else
        {
            $path = new \controller\config\Path;
            $uri = new \controller\config\Uri;

            return $this->LOAD_VIEW('auth/login', compact('path', 'uri'));
        }
    }
}
