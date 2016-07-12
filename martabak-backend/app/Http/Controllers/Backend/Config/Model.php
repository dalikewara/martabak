<?php

namespace App\Http\Controllers\Backend\Config;

use DB;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Role;
use App\Models\Status;
use App\Models\Tag;
use App\Models\Theme;
use App\Models\Trash;
use App\Models\User;
use App\Models\Page;
use App\Models\Layout;
use App\Models\Color;
use App\Models\Route;
use App\Models\Content;
use App\Models\Website;
use App\Models\Notification;
use App\Models\Guest;
use App\Models\Media;

class Model
{
    public $categories, $comments, $posts, $roles, $statuses, $tags, $themes,
          $trashes, $users, $pages, $layouts, $routes, $contents,
          $websites, $notifications, $guests, $media, $colors;

    // Pivot tables
    public $postCategories, $postComments, $postTags;

    public function __construct()
    {
        $this->categories    = new Category;
        $this->comments      = new Comment;
        $this->posts         = new Post;
        $this->roles         = new Role;
        $this->statuses      = new Status;
        $this->tags          = new Tag;
        $this->themes        = new Theme;
        $this->trashes       = new Trash;
        $this->users         = new User;
        $this->pages         = new Page;
        $this->layouts       = new Layout;
        $this->routes        = new Route;
        $this->contents      = new Content;
        $this->websites      = new Website;
        $this->notifications = new Notification;
        $this->guests        = new Guest;
        $this->media         = new Media;
        $this->colors        = new Color;

        // Pivot tables
        $this->postCategories = DB::table('category_post');
        $this->postComments   = DB::table('post_comment');
        $this->postTags       = DB::table('post_tag');
    }
}
