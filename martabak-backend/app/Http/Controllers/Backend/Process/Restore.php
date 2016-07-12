<?php

namespace App\Http\Controllers\Backend\Process;

use App\Http\Controllers\Backend\Controller;
use App\Http\Controllers\Backend\Config\Error;
use App\Http\Controllers\Backend\Config\Model;
use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;

class Restore extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->error = new Error;
        $this->table = new Model;
    }

    public function index(Request $request)
    {
        // If request method == POST and user is exist ------------------------
        if($_SERVER['REQUEST_METHOD'] == 'POST' AND isset(Auth::user()->username))
        {
            $process  = $request->input(md5('process-option'));
            $trashType = $request->input(md5('trash-type'));

            switch($trashType)
            {
                case md5('post'):
                    $type     = 'post';
                    $tables   = $this->table->trashes->where('type', $type)->get();
                    $contents = $this->table->posts->all();
                    break;

                case md5('page'):
                    $type     = 'page';
                    $tables   = $this->table->trashes->where('type', $type)->get();
                    $contents = $this->table->pages->all();
                    break;

                case md5('tag'):
                    $type     = 'tag';
                    $tables   = $this->table->trashes->where('type', $type)->get();
                    $contents = $this->table->tags->all();
                    break;

                case md5('category'):
                    $type     = 'category';
                    $tables   = $this->table->trashes->where('type', $type)->get();
                    $contents = $this->table->categories->all();
                    break;

                default:
                    break;
            }

            if($process == md5('yesIWantToRestore'))
            {
                if($tables != NULL)
                {
                    foreach($tables as $table)
                    {
                        if($request->input(md5('trash') . '-' . md5($table->id)) != NULL OR $request->input(md5('all')) == md5('yes'))
                        {
                            if(count($contents) != 0)
                            {
                                $x = 0;

                                foreach($contents as $content)
                                {
                                    $idConflicts[$x] = $content->id;

                                    $x++;
                                }
                            }
                            else
                            {
                                $idConflicts = array('a', 'b', 'c');
                            }

                            if(!in_array($table->meta_1, $idConflicts))
                            {
                                switch($trashType)
                                {
                                    case md5('post'):
                                        $this->table->posts->insert(
                                        [
                                            'id'            => $table->meta_1,
                                            'user_id'       => $table->meta_2,
                                            'title'         => $table->meta_3,
                                            'slug'          => $table->meta_4,
                                            'content'       => $table->meta_5,
                                            'status_id'     => $table->meta_6,
                                            'allow_comment' => $table->meta_7,
                                            'created_at'    => $table->meta_8,
                                            'updated_at'    => $table->meta_9
                                        ]);

                                        if($table->meta_10 != NULL)
                                        {
                                            $id        = explode(',', $table->meta_10);
                                            $tagId     = explode(',', $table->meta_11);
                                            $postId    = explode(',', $table->meta_12);
                                            $createdAt = explode(',', $table->meta_13);
                                            $updatedAt = explode(',', $table->meta_14);

                                            $id = count($id);

                                            for($x = 0; $x < $id; $x++)
                                            {
                                                $this->table->postTags->insert(
                                                [
                                                  'post_id'    => $postId[$x],
                                                  'tag_id'     => $tagId[$x],
                                                  'created_at' => $createdAt[$x],
                                                  'updated_at' => $updatedAt[$x]
                                                ]);
                                            }
                                        }

                                        if($table->meta_15 != NULL)
                                        {
                                            $id         = explode(',', $table->meta_15);
                                            $categoryId = explode(',', $table->meta_16);
                                            $postId     = explode(',', $table->meta_17);
                                            $createdAt  = explode(',', $table->meta_18);
                                            $updatedAt  = explode(',', $table->meta_19);

                                            $id = count($id);

                                            for($x = 0; $x < $id; $x++)
                                            {
                                                $this->table->postCategories->insert(
                                                [
                                                  'post_id'     => $postId[$x],
                                                  'category_id' => $categoryId[$x],
                                                  'created_at'  => $createdAt[$x],
                                                  'updated_at'  => $updatedAt[$x]
                                                ]);
                                            }
                                        }
                                        break;

                                    case md5('page'):
                                        $this->table->pages->insert(
                                        [
                                            'id'            => $table->meta_1,
                                            'user_id'       => $table->meta_2,
                                            'title'         => $table->meta_3,
                                            'slug'          => $table->meta_4,
                                            'content'       => $table->meta_5,
                                            'type_id'       => $table->meta_6,
                                            'status_id'     => $table->meta_7,
                                            'allow_comment' => $table->meta_8,
                                            'created_at'    => $table->meta_9,
                                            'updated_at'    => $table->meta_10
                                        ]);
                                        break;

                                    case md5('tag'):
                                        $this->table->tags->insert(
                                        [
                                            'id'         => $table->meta_1,
                                            'tag_name'   => $table->meta_2,
                                            'tag_slug'   => $table->meta_3,
                                            'created_at' => $table->meta_4,
                                            'updated_at' => $table->meta_5
                                        ]);

                                        if($table->meta_6 != NULL)
                                        {
                                            $id        = explode(',', $table->meta_6);
                                            $postId    = explode(',', $table->meta_7);
                                            $tagId     = explode(',', $table->meta_8);
                                            $createdAt = explode(',', $table->meta_9);
                                            $updatedAt = explode(',', $table->meta_10);

                                            $id = count($id);

                                            for($x = 0; $x < $id; $x++)
                                            {
                                                $this->table->postTags->insert(
                                                [
                                                  'post_id'    => $postId[$x],
                                                  'tag_id'     => $tagId[$x],
                                                  'created_at' => $createdAt[$x],
                                                  'updated_at' => $updatedAt[$x]
                                                ]);

                                                $x++;
                                            }
                                        }
                                        break;

                                    case md5('category'):
                                        $this->table->categories->insert(
                                        [
                                            'id'                   => $table->meta_1,
                                            'category_name'        => $table->meta_2,
                                            'category_slug'        => $table->meta_3,
                                            'category_description' => $table->meta_4,
                                            'created_at'           => $table->meta_5,
                                            'updated_at'           => $table->meta_6
                                        ]);

                                        if($table->meta_7 != NULL)
                                        {
                                            $id         = explode(',', $table->meta_7);
                                            $postId     = explode(',', $table->meta_8);
                                            $categoryId = explode(',', $table->meta_9);
                                            $createdAt  = explode(',', $table->meta_10);
                                            $updatedAt  = explode(',', $table->meta_11);

                                            $id = count($id);

                                            for($x = 0; $x < $id; $x++)
                                            {
                                                $this->table->postTags->insert(
                                                [
                                                  'post_id'    => $postId[$x],
                                                  'tag_id'     => $categoryId[$x],
                                                  'created_at' => $createdAt[$x],
                                                  'updated_at' => $updatedAt[$x]
                                                ]);

                                                $x++;
                                            }
                                        }
                                        break;

                                    default:
                                        break;
                                }
                            }

                            if($tables->find($table->id)->delete())
                            {
                                $this->error->err = 0;
                            }
                            else
                            {
                                $this->error->errDelete = '<p>Delete failed.</p>';
                                $this->error->err       = 1;
                            }
                        }
                    }
                }
                else
                {
                    $this->error->errTable ='<p>Table not found.</p>';
                    $this->error->err      = 1;
                }
            }
            else
            {
                $this->error->errProcess = '<p>Undefined process.</p>';
                $this->error->err         = 1;
            }
        }

        // If request method == GET or (not POST) and user is not exist
        else
        {
            $this->error->errMethod = '<p>Method not allowed.</p>';
            $this->error->err       = 1;
        }
        // END request method and user checker---------------------------------

        // Final error handling
        if($this->error->err == 0)
        {
            $report = 'success';
        }
        else
        {
            $report = $this->error->errMethod . $this->error->errTable .
                      $this->error->errProcess . $this->error->errDelete;
        }

        // Done
        return $report;
    }
}
