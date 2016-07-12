<?php

namespace App\Http\Controllers\Backend\Homeland;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Backend\Controller;
use App\Http\Controllers\Backend\Config\Model;
use Auth;

class Trash extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->table = new Model;
    }

    public function content($content)
    {
        $trashes    = $this->table->trashes->orderBy('id', 'DESC')->where('type', $content)->get();
        $totalTrash = count($trashes);

        return view('admin.extended.trash-content', compact('trashes', 'totalTrash', 'content'));
    }
}
