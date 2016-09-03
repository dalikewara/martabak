<?php namespace mvc\controllers\backend\config;

use mvc\controllers\universal\SQLGenerator;

class Error
{
    private $model, $langs, $indexLang, $sql;
    public $errRequest, $errType, $errStatus, $errPrefixEmpty, $errRouteEmpty,
           $errPrefixFormat, $errRouteFormat, $errMethod, $errValueEmpty, $errValueFormat,
           $errSlugEmpty, $errSlugFormat, $errEmailEmpty, $errEmailFormat, $errUsernameEmpty, $errUsernameFormat,
           $errPasswordEmpty, $errPasswordFormat, $errPasswordAllEmpty, $errFullnameEmpty, $errFullnameFormat,
           $errPasswordMatch, $errConfirmationMatch, $errToken;

   /**
   * @return   mixed
   */
    public function __construct()
    {
        // Defining properties
        $this->sql       = new SQLGenerator;
        $this->model     = new Model;
        $this->langs     = new Lang;
        $this->indexLang = $this->model->settings->Select('value')->Clause(
            $this->sql->where('meta', ':meta'))->BindParam(['meta' => 'lang'])
            ->Range(1)->Result()[0];

        // Generate error messages
        $this->errRequest = $this->langs->errors($this->langs->indications()['request']
            ['status'][$this->indexLang])['errUndefined'][$this->indexLang];
        $this->errType = $this->langs->errors($this->langs->indications()['type']
            ['status'][$this->indexLang])['errUndefined'][$this->indexLang];
        $this->errStatus = $this->langs->errors($this->langs->indications()['status']
            ['status'][$this->indexLang])['errUndefined'][$this->indexLang];
        $this->errMethod = $this->langs->errors($this->langs->indications()['method']
            ['status'][$this->indexLang])['errUndefined'][$this->indexLang];
        $this->errPrefixEmpty = $this->langs->errors($this->langs->indications()['prefix']
            ['status'][$this->indexLang])['errNotEmpty'][$this->indexLang];
        $this->errRouteEmpty = $this->langs->errors($this->langs->indications()['route']
            ['status'][$this->indexLang])['errNotEmpty'][$this->indexLang];
        $this->errPrefixFormat = $this->langs->errors($this->langs->indications()['prefix']
            ['status'][$this->indexLang])['errWrongFormat'][$this->indexLang];
        $this->errRouteFormat = $this->langs->errors($this->langs->indications()['route']
            ['status'][$this->indexLang])['errWrongFormat'][$this->indexLang];
        $this->errValueEmpty = $this->langs->errors($this->langs->indications()['value']
            ['status'][$this->indexLang])['errNotEmpty'][$this->indexLang];
        $this->errValueFormat = $this->langs->errors($this->langs->indications()['value']
            ['status'][$this->indexLang])['errWrongFormat'][$this->indexLang];
        $this->errSlugEmpty = $this->langs->errors($this->langs->indications()['slug']
            ['status'][$this->indexLang])['errNotEmpty'][$this->indexLang];
        $this->errSlugFormat = $this->langs->errors($this->langs->indications()['slug']
            ['status'][$this->indexLang])['errWrongFormat'][$this->indexLang];
        $this->errEmailEmpty = $this->langs->errors($this->langs->indications()['email']
            ['status'][$this->indexLang])['errNotEmpty'][$this->indexLang];
        $this->errEmailFormat = $this->langs->errors($this->langs->indications()['email']
            ['status'][$this->indexLang])['errWrongFormat'][$this->indexLang];
        $this->errUsernameEmpty = $this->langs->errors($this->langs->indications()['username']
            ['status'][$this->indexLang])['errNotEmpty'][$this->indexLang];
        $this->errUsernameFormat = $this->langs->errors($this->langs->indications()['username']
            ['status'][$this->indexLang])['errWrongFormat'][$this->indexLang];
        $this->errPasswordEmpty = $this->langs->errors($this->langs->indications()['password']
            ['status'][$this->indexLang])['errNotEmpty'][$this->indexLang];
        $this->errPasswordAllEmpty = $this->langs->errors($this->langs->indications()['password']
            ['status'][$this->indexLang])['errPassword']['allInputEmpty'][$this->indexLang];
        $this->errPasswordFormat = $this->langs->errors($this->langs->indications()['password']
            ['status'][$this->indexLang])['errWrongFormat'][$this->indexLang];
        $this->errPasswordMatch = $this->langs->errors($this->langs->indications()['password']
            ['status'][$this->indexLang])['errPassword']['doesNotMatch'][$this->indexLang];
        $this->errConfirmationMatch = $this->langs->errors($this->langs->indications()['password']
            ['status'][$this->indexLang])['errPassword']['confirmationDoesNotMatch'][$this->indexLang];
        $this->errFullnameEmpty = $this->langs->errors($this->langs->indications()['fullname']
            ['status'][$this->indexLang])['errNotEmpty'][$this->indexLang];
        $this->errFullnameFormat = $this->langs->errors($this->langs->indications()['fullname']
            ['status'][$this->indexLang])['errWrongFormat'][$this->indexLang];
        $this->errToken = $this->langs->errors($this->langs->indications()['token']
            ['status'][$this->indexLang])['errUndefined'][$this->indexLang];
    }
}
