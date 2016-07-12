<?php

namespace App\Http\Controllers\Backend\Homeland;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Backend\Controller;
use App\Http\Controllers\Backend\Config\Model;
use Auth;

class Relation extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->table = new Model;
    }

    public function content($content)
    {
        if(!empty($_GET['relation']) AND !empty($_GET['id']))
        {
            $id       = $_GET['id'];
            $relation = $_GET['relation'];
            $x        = 0;

            switch($content)
            {
                case 'tag':
                    switch($relation)
                    {
                        case 'post':
                            $pivots = $this->table->postTags;
                            $meta1  = 'post_id';
                            break;

                        case 'page':
                            $pivots = $this->table->pageTags;
                            $meta1  = 'page_id';
                            break;

                        default:
                            break;
                    }

                    $meta2  = 'tag_id';
                    $name   = 'tag_name';
                    $tables = $this->table->tags;
                    break;

                case 'category':
                    switch($relation)
                    {
                        case 'post':
                            $pivots = $this->table->postCategories;
                            $meta1  = 'post_id';
                            break;

                        case 'page':
                            $pivots = $this->table->pageCategories;
                            $meta1  = 'page_id';
                            break;

                        default:
                            break;
                    }

                    $meta2  = 'category_id';
                    $name   = 'category_name';
                    $tables = $this->table->categories;
                    break;

                case 'post':
                    switch($relation)
                    {
                        case 'tag':
                            $pivots = $this->table->postTags;
                            $meta1  = 'tag_id';
                            break;

                        case 'category':
                            $pivots = $this->table->postCategories;
                            $meta1  = 'category_id';
                            break;

                        default:
                            break;
                    }

                    $meta2  = 'post_id';
                    $name   = 'title';
                    $tables = $this->table->posts;
                    break;

                default:
                    break;
            }

            if(!empty($pivots->get()))
            {
                foreach($pivots->get() as $pivot)
                {
                    if($pivot->$meta1 == $id)
                    {
                        $meta1Lists[$x] = $pivot->$meta2;
                    }
                    else
                    {
                        $meta1Lists[$x] = 'Undefinied';
                    }

                    $x++;
                }
            }
            else
            {
                $meta1Lists[0] = 'No relations found.';
            }

            return view('admin.extended.contents-relations', compact('id', 'tables', 'meta1Lists', 'name', 'content'));
        }
    }
}
