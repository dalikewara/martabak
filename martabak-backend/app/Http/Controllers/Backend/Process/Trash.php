<?php

namespace App\Http\Controllers\Backend\Process;

use App\Http\Controllers\Backend\Controller;
use App\Http\Controllers\Backend\Config\Error;
use App\Http\Controllers\Backend\Config\Model;
use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;

class Trash extends Controller
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
            $trashes     = $this->table->trashes;
            $process    = $request->input(md5('process-option'));
            $processAct = $request->input(md5('process-option-trash'));
            $type        = $request->input(md5('process-type'));
            $catchs      = NULL;
            $x           = 0;
            $dateNow     = date('Y-m-d') . ' ' . date('H:i:s');

            // Type identifier
            switch($type)
            {
                case md5('post'):
                    $type                = 'post';
                    $tables              = $this->table->posts;
                    $tableRelations[0]   = $this->table->postTags;
                    $tableRelations[1]   = $this->table->postCategories;
                    $typeRelationId      = $type . '_id';
                    $typeRelationPost[0] = 'tag_id';
                    $typeRelationPost[1] = 'category_id';
                    break;
                case md5('page'):
                    $type   = 'page';
                    $tables = $this->table->pages;
                    break;
                case md5('tag'):
                    $type              = 'tag';
                    $tables            = $this->table->tags;
                    $tableRelations[0] = $this->table->postTags;
                    $tableRelations[1] = NULL;
                    $typeRelationId    = $type . '_id';
                    break;
                case md5('category'):
                    $type              = 'category';
                    $tables            = $this->table->categories;
                    $tableRelations[0] = $this->table->postCategories;
                    $tableRelations[1] = NULL;
                    $typeRelationId    = $type . '_id';
                    break;
                default:
                    $tables = NULL;
                    break;
            }

            if($process == md5('yesIWantToTrash') OR $processAct == md5('yesIWantToTrash'))
            {
                if($tables != NULL)
                {
                    // Action selected
                    if(!empty($request->input(md5('id'))))
                    {
                        $actArray = explode(',', $request->input(md5('id')));
                    }
                    else
                    {
                        $actArray = array('a', 'b', 'c');
                    }

                    foreach($tables->all() as $table)
                    {
                        if($request->input(md5($type) . '-' . md5($table->id)) != NULL OR $request->input(md5('all')) == md5('yes') OR in_array(md5($table->id), $actArray))
                        {
                            // Catch conflict twice id
                            if(count($this->table->trashes->where('type', $type)->get()) != 0)
                            {
                                $a = 0;

                                foreach($this->table->trashes->where('type', $type)->get() as $content)
                                {
                                    $idConflicts[$a] = $content->meta_1;

                                    $a++;
                                }
                            }
                            else
                            {
                                $idConflicts = array('a', 'b', 'c');
                            }

                            // Trashing
                            if(!in_array($table->id, $idConflicts))
                            {
                                if($type != 'page')
                                {
                                    for($y = 0; $y < 2; $y++)
                                    {
                                        $z = 0;

                                        if(!empty($tableRelations[$y]))
                                        {
                                            foreach($tableRelations[$y]->get() as $relation)
                                            {
                                                if($relation->$typeRelationId == $table->id AND $relation->$typeRelationId != NULL)
                                                {
                                                    $relationId[$y][$z]     = $relation->id;
                                                    $relationTypeId[$y][$z] = $relation->$typeRelationId;

                                                    switch($type)
                                                    {
                                                        case 'post':
                                                            if($y == 0)
                                                            {
                                                                $relationUntypeId[$y][$z] = $relation->tag_id;
                                                            }
                                                            if($y == 1)
                                                            {
                                                                $relationUntypeId[$y][$z] = $relation->category_id;
                                                            }
                                                            break;
                                                        default:
                                                            $relationUntypeId[$y][$z]  = $relation->post_id;
                                                            break;
                                                    }
                                                    $relationCreatedAt[$y][$z] = $relation->created_at;
                                                    $relationUpdatedAt[$y][$z] = $relation->updated_at;
                                                }
                                                else
                                                {
                                                    $relationId[$y][$z]        = 'n';
                                                    $relationUntypeId[$y][$z]  = 'n';
                                                    $relationTypeId[$y][$z]    = 'n';
                                                    $relationCreatedAt[$y][$z] = 'n';
                                                    $relationUpdatedAt[$y][$z] = 'n';
                                                    unset($relationId[$y][$z]);
                                                    unset($relationUntypeId[$y][$z]);
                                                    unset($relationTypeId[$y][$z]);
                                                    unset($relationCreatedAt[$y][$z]);
                                                    unset($relationUpdatedAt[$y][$z]);
                                                }

                                                $z++;
                                            }

                                            if(!empty($relationId[$y]))
                                            {
                                                $relationId[$y] = implode(',', $relationId[$y]);
                                            }
                                            else
                                            {
                                                $relationId[$y] = '';
                                            }

                                            if(!empty($relationUntypeId[$y]))
                                            {
                                                $relationUntypeId[$y] = implode(',', $relationUntypeId[$y]);
                                            }
                                            else
                                            {
                                                $relationUntypeId[$y] = '';
                                            }

                                            if(!empty($relationTypeId[$y]))
                                            {
                                                $relationTypeId[$y] = implode(',', $relationTypeId[$y]);
                                            }
                                            else
                                            {
                                                $relationTypeId[$y] = '';
                                            }

                                            if(!empty($relationCreatedAt[$y]))
                                            {
                                                $relationCreatedAt[$y] = implode(',', $relationCreatedAt[$y]);
                                            }
                                            else
                                            {
                                                $relationCreatedAt[$y] = '';
                                            }

                                            if(!empty($relationUpdatedAt[$y]))
                                            {
                                                $relationUpdatedAt[$y] = implode(',', $relationUpdatedAt[$y]);
                                            }
                                            else
                                            {
                                                $relationUpdatedAt[$y] = '';
                                            }
                                        }
                                        else
                                        {
                                            $relationId[$y]        = '';
                                            $relationUntypeId[$y]  = '';
                                            $relationTypeId[$y]    = '';
                                            $relationCreatedAt[$y] = '';
                                            $relationUpdatedAt[$y] = '';
                                        }
                                    }


                                    // Inserting data to trash
                                    switch($type)
                                    {
                                        case 'post':
                                            $trashes->insert(
                                            [
                                                'type'       => $type,
                                                'meta_1'     => $table->id,
                                                'meta_2'     => $table->user_id,
                                                'meta_3'     => $table->title,
                                                'meta_4'     => $table->slug,
                                                'meta_5'     => $table->content,
                                                'meta_6'     => $table->status_id,
                                                'meta_7'     => $table->allow_comment,
                                                'meta_8'     => $table->created_at,
                                                'meta_9'     => $table->updated_at,
                                                'meta_10'    => $relationId[0],
                                                'meta_11'    => $relationUntypeId[0],
                                                'meta_12'    => $relationTypeId[0],
                                                'meta_13'    => $relationCreatedAt[0],
                                                'meta_14'    => $relationUpdatedAt[0],
                                                'meta_15'    => $relationId[1],
                                                'meta_16'    => $relationUntypeId[1],
                                                'meta_17'    => $relationTypeId[1],
                                                'meta_18'    => $relationCreatedAt[1],
                                                'meta_19'    => $relationUpdatedAt[1],
                                                'created_at' => $dateNow,
                                                'updated_at' => $dateNow
                                            ]);
                                            break;
                                        case 'page':
                                            //
                                            break;
                                        case 'tag':
                                            $trashes->insert(
                                            [
                                                'type'       => $type,
                                                'meta_1'     => $table->id,
                                                'meta_2'     => $table->tag_name,
                                                'meta_3'     => $table->tag_slug,
                                                'meta_4'     => $table->created_at,
                                                'meta_5'     => $table->updated_at,
                                                'meta_6'     => $relationId[0],
                                                'meta_7'     => $relationUntypeId[0],
                                                'meta_8'     => $relationTypeId[0],
                                                'meta_9'     => $relationCreatedAt[0],
                                                'meta_10'    => $relationUpdatedAt[0],
                                                'created_at' => $dateNow,
                                                'updated_at' => $dateNow
                                            ]);
                                            break;
                                        case 'category':
                                            $trashes->insert(
                                            [
                                                'type'       => $type,
                                                'meta_1'     => $table->id,
                                                'meta_2'     => $table->category_name,
                                                'meta_3'     => $table->category_slug,
                                                'meta_4'     => $table->category_description,
                                                'meta_5'     => $table->created_at,
                                                'meta_6'     => $table->updated_at,
                                                'meta_7'     => $relationId[0],
                                                'meta_8'     => $relationUntypeId[0],
                                                'meta_9'     => $relationTypeId[0],
                                                'meta_10'    => $relationCreatedAt[0],
                                                'meta_11'    => $relationUpdatedAt[0],
                                                'created_at' => $dateNow,
                                                'updated_at' => $dateNow
                                            ]);
                                            break;
                                        default:
                                            break;
                                    }

                                    // Unset relation variabels
                                    unset($relationId);
                                    unset($relationUntypeId);
                                    unset($relationTypeId);
                                    unset($relationCreatedAt);
                                    unset($relationUpdatedAt);

                                    // Deleting
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
                                else
                                {
                                    $trashes->insert(
                                    [
                                        'type'       => $type,
                                        'meta_1'     => $table->id,
                                        'meta_2'     => $table->user_id,
                                        'meta_3'     => $table->title,
                                        'meta_4'     => $table->slug,
                                        'meta_5'     => $table->content,
                                        'meta_6'     => $table->type_id,
                                        'meta_7'     => $table->status_id,
                                        'meta_8'     => $table->allow_comment,
                                        'meta_9'     => $table->created_at,
                                        'meta_10'    => $table->updated_at,
                                        'created_at' => $dateNow,
                                        'updated_at' => $dateNow
                                    ]);

                                    // Deleting
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

                                // Set variabels to delete relations
                                $catchs[$x] = $table->id;

                                $x++;
                            }
                        }
                    }

                    // Deleting relations
                    if($catchs != NULL)
                    {
                        if($type != 'page')
                        {
                            foreach($catchs as $catch)
                            {
                                $tableRelations[0]->orWhere($typeRelationId, $catch)->delete();
                            }

                            if($type == 'post')
                            {
                                foreach($catchs as $catch)
                                {
                                    $tableRelations[1]->orWhere($typeRelationId, $catch)->delete();
                                }
                            }
                        }
                    }
                }
                else
                {
                    $this->error->errTable = '<p>Invalid table.</p>';
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

        // Save decision and final error handling
        if($this->error->err == 0)
        {
            $report = 'success';
        }
        else
        {
            $report = $this->error->errMethod . $this->error->errProcess .
                      $this->error->errTable . $this->error->errDelete;
        }

        // Done
        return $report;
    }
}
