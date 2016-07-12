<?php

namespace App\Http\Controllers\Backend\Process;

use App\Http\Controllers\Backend\Controller;
use App\Http\Controllers\Backend\Config\Error;
use App\Http\Controllers\Backend\Config\Model;
use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;

class Setting extends Controller
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
            $process     = $request->input(md5('process-option'));
            $processType = $request->input(md5('process-type'));
            $dateNow      = date('Y-m-d') . ' ' . date('H:s:i');

            if($process == md5('yesIWantToSetting'))
            {
                switch($processType)
                {
                    case md5('general'):
                        $contentShowPost                  = $request->input(md5('content-show-post'));
                        $contentPostsPerPage              = $request->input(md5('content-posts-per-page'));
                        $contentShowArticleAs             = $request->input(md5('content-show-article-as'));
                        $contentShowTag                   = $request->input(md5('content-show-tag'));
                        $contentShowCategory              = $request->input(md5('content-show-category'));
                        $contentShowMedia                 = $request->input(md5('content-show-media'));
                        $contentDefaultPostCategory       = $request->input(md5('content-default-post-category'));
                        $contentAllowPostComment          = $request->input(md5('content-allow-post-comment'));
                        $contentAllowPageComment          = $request->input(md5('content-allow-page-comment'));
                        $contentCommentConfiguration      = $request->input(md5('content-comment-configuration'));
                        $contentCommentModeration         = $request->input(md5('content-comment-moderation'));
                        $contentCommentBlacklist          = $request->input(md5('content-comment-blacklist'));
                        $contentCommentersPictures        = $request->input(md5('content-display-picture-for-commenters'));
                        $contentCommentersDefaultPictures = $request->input(md5('content-default-commenters-picture'));
                        $contentRememberCommenters        = $request->input(md5('content-remember-commenters'));
                        $websiteTitle                     = $request->input(md5('website-title'));
                        $websiteHeading                   = $request->input(md5('website-heading'));
                        $websiteSlogan                    = $request->input(md5('website-slogan'));
                        $websiteHtmlMeta                  = $request->input(md5('website-html-meta'));
                        $contentArray                     = array($contentShowPost, $contentShowTag, $contentShowCategory, $contentShowMedia,
                                                                  $contentAllowPostComment, $contentAllowPageComment, $contentCommentersPictures,
                                                                  $contentRememberCommenters);
                        $contentArrayIndex                = array('$contentShowPost', '$contentShowTag', '$contentShowCategory', '$contentShowMedia',
                                                                  '$contentAllowPostComment', '$contentAllowPageComment', '$contentCommentersPictures',
                                                                  '$contentRememberCommenters');
                        $contentTables                    = $this->table->contents;
                        $websiteTables                    = $this->table->websites;

                        if($contentTables != NULL AND $websiteTables != NULL)
                        {
                            // Content
                            switch($contentShowArticleAs)
                            {
                                case md5('summary'):
                                    $contentShowArticleAs = 1;
                                    break;

                                default:
                                    $contentShowArticleAs = 0;
                                    break;
                            }

                            switch($contentCommentConfiguration)
                            {
                                case md5('manual'):
                                    $contentCommentConfiguration = 1;
                                    break;

                                default:
                                    $contentCommentConfiguration = 0;
                                    break;
                            }

                            for($i = 0; $i < count($contentArray); $i++)
                            {
                                switch($contentArray[$i])
                                {
                                    case md5('yes'):
                                        $contentYes = 1;

                                        switch($contentArrayIndex[$i])
                                        {
                                            case '$contentShowPost':
                                                $contentShowPost = $contentYes;
                                                break;

                                            case '$contentShowTag':
                                                $contentShowTag = $contentYes;
                                                break;

                                            case '$contentShowCategory':
                                                $contentShowCategory = $contentYes;
                                                break;

                                            case '$contentShowMedia':
                                                $contentShowMedia = $contentYes;
                                                break;

                                            case '$contentAllowPostComment':
                                                $contentAllowPostComment = $contentYes;
                                                break;

                                            case '$contentAllowPageComment':
                                                $contentAllowPageComment = $contentYes;
                                                break;

                                            case '$contentCommentersPictures':
                                                $contentCommentersPictures = $contentYes;
                                                break;

                                            case '$contentRememberCommenters':
                                                $contentRememberCommenters = $contentYes;
                                                break;

                                            default:
                                                break;
                                        }
                                        break;

                                    default:
                                        $contentNo = 0;

                                        switch($contentArrayIndex[$i])
                                        {
                                            case '$contentShowPost':
                                                $contentShowPost = $contentNo;
                                                break;

                                            case '$contentShowTag':
                                                $contentShowTag = $contentNo;
                                                break;

                                            case '$contentShowCategory':
                                                $contentShowCategory = $contentNo;
                                                break;

                                            case '$contentShowMedia':
                                                $contentShowMedia = $contentNo;
                                                break;

                                            case '$contentAllowPostComment':
                                                $contentAllowPostComment = $contentNo;
                                                break;

                                            case '$contentAllowPageComment':
                                                $contentAllowPageComment = $contentNo;
                                                break;

                                            case '$contentCommentersPictures':
                                                $contentCommentersPictures = $contentNo;
                                                break;

                                            case '$contentRememberCommenters':
                                                $contentRememberCommenters = $contentNo;
                                                break;

                                            default:
                                                break;
                                        }
                                        break;
                                }
                            }

                            // Saving -----------------------------------------
                            // Content
                            if(($default = $contentTables->find(1)) != NULL)
                            {
                                $default->show_post                      = $contentShowPost;
                                $default->posts_per_page                 = $contentPostsPerPage;
                                $default->show_article_as                = $contentShowArticleAs;
                                $default->show_tag                       = $contentShowTag;
                                $default->show_category                  = $contentShowCategory;
                                $default->show_media                     = $contentShowMedia;
                                $default->default_post_category          = $contentDefaultPostCategory;
                                $default->allow_post_comment             = $contentAllowPostComment;
                                $default->allow_page_comment             = $contentAllowPageComment;
                                $default->comment_configuration          = $contentCommentConfiguration;
                                $default->comment_moderation             = $contentCommentModeration;
                                $default->comment_blacklist              = $contentCommentBlacklist;
                                $default->display_picture_for_commenters = $contentCommentersPictures;
                                $default->default_commenters_picture     = $contentCommentersDefaultPictures;
                                $default->remember_commenters            = $contentRememberCommenters;
                                $default->updated_at                     = $dateNow;

                                $default->save();
                            }
                            else
                            {
                                $contentTables->id                             = 1;
                                $contentTables->show_post                      = $contentShowPost;
                                $contentTables->posts_per_page                 = $contentPostsPerPage;
                                $contentTables->show_article_as                = $contentShowArticleAs;
                                $contentTables->show_tag                       = $contentShowTag;
                                $contentTables->show_category                  = $contentShowCategory;
                                $contentTables->show_media                     = $contentShowMedia;
                                $contentTables->default_post_category          = $contentDefaultPostCategory;
                                $contentTables->allow_post_comment             = $contentAllowPostComment;
                                $contentTables->allow_page_comment             = $contentAllowPageComment;
                                $contentTables->comment_configuration          = $contentCommentConfiguration;
                                $contentTables->comment_moderation             = $contentCommentModeration;
                                $contentTables->comment_blacklist              = $contentCommentBlacklist;
                                $contentTables->display_picture_for_commenters = $contentCommentersPictures;
                                $contentTables->default_commenters_picture     = $contentCommentersDefaultPictures;
                                $contentTables->remember_commenters            = $contentRememberCommenters;
                                $contentTables->created_at                     = $dateNow;
                                $contentTables->updated_at                     = $dateNow;

                                $contentTables->save();
                            }

                            // Website
                            if(($default = $websiteTables->find(1)) != NULL)
                            {
                                $default->title      = $websiteTitle;
                                $default->heading    = $websiteHeading;
                                $default->slogan     = $websiteSlogan;
                                $default->meta       = $websiteHtmlMeta;
                                $default->updated_at = $dateNow;

                                $default->save();
                            }
                            else
                            {
                                $websiteTables->id         = 1;
                                $websiteTables->title      = $websiteTitle;
                                $websiteTables->heading    = $websiteHeading;
                                $websiteTables->slogan     = $websiteSlogan;
                                $websiteTables->meta       = $websiteHtmlMeta;
                                $websiteTables->created_at = $dateNow;
                                $websiteTables->updated_at = $dateNow;

                                $websiteTables->save();
                            }
                        }
                        else
                        {
                            //
                        }
                        break;

                    case md5('profile'):
                        $fullname              = $request->input(md5('profile-fullname'));
                        $username              = $request->input(md5('profile-username'));
                        $email                 = $request->input(md5('profile-email'));
                        $displayProfilePicture = $request->input(md5('profile-display-profile-picture'));
                        $profilePicture        = $request->input(md5('profile-picture'));
                        $profileTables         = $this->table->users;

                        switch($displayProfilePicture)
                        {
                            case md5('yes'):
                                $displayProfilePicture = 1;
                                break;

                            default:
                                $displayProfilePicture = 0;
                                break;
                        }

                        if($profileTables != NULL)
                        {
                            // Saving -----------------------------------------
                            // Route
                            if(($default = $profileTables->find(1)) != NULL)
                            {
                                $default->fullname                = $fullname;
                                $default->username                = $username;
                                $default->email                   = $email;
                                $default->display_profile_picture = $displayProfilePicture;

                                if($profilePicture != '')
                                {
                                    $default->profile_picture = $profilePicture;
                                }

                                $default->save();
                            }
                        }
                        else
                        {
                            //
                        }
                        break;

                    case md5('route'):
                        $homelandRoute = $request->input(md5('homeland-route'));
                        $postRoute     = $request->input(md5('post-route'));
                        $tagRoute      = $request->input(md5('tag-route'));
                        $categoryRoute = $request->input(md5('category-route'));
                        $pageRoute     = $request->input(md5('page-route'));
                        $mediaRoute    = $request->input(md5('media-route'));
                        $routeTables   = $this->table->routes;

                        if($routeTables != NULL)
                        {
                            // Saving -----------------------------------------
                            // Route
                            if(($default = $routeTables->find(1)) != NULL)
                            {
                                $default->homeland_route = $homelandRoute;
                                $default->post_route     = $postRoute;
                                $default->tag_route      = $tagRoute;
                                $default->category_route = $categoryRoute;
                                $default->page_route     = $pageRoute;
                                $default->media_route    = $mediaRoute;
                                $default->updated_at     = $dateNow;

                                $default->save();
                            }
                            else
                            {
                                $routeTables->id             = 1;
                                $routeTables->homeland_route = $homelandRoute;
                                $routeTables->post_route     = $postRoute;
                                $routeTables->tag_route      = $tagRoute;
                                $routeTables->category_route = $categoryRoute;
                                $routeTables->page_route     = $pageRoute;
                                $routeTables->media_route    = $mediaRoute;
                                $routeTables->created_at     = $dateNow;
                                $routeTables->updated_at     = $dateNow;

                                $routeTables->save();
                            }
                        }
                        else
                        {
                            //
                        }
                        break;

                    case md5('appearance'):
                        $themeColor         = $request->input(md5('main-theme-color'));
                        $headerPosition     = $request->input(md5('header-position'));
                        $navigationPosition = $request->input(md5('navigation-position'));
                        $colorTables        = $this->table->colors;
                        $layoutTables       = $this->table->layouts;

                        if($colorTables != NULL AND $layoutTables != NULL)
                        {
                            // Colors
                            switch($themeColor)
                            {
                                case md5('black'):
                                    $themeColor = 'black';
                                    break;

                                case md5('orange'):
                                    $themeColor = 'orange';
                                    break;

                                case md5('red'):
                                    $themeColor = 'red';
                                    break;

                                case md5('green'):
                                    $themeColor = 'green';
                                    break;

                                case md5('blue'):
                                    $themeColor = 'blue';
                                    break;

                                case md5('yellow'):
                                    $themeColor = 'yellow';
                                    break;

                                case md5('white'):
                                    $themeColor = 'white';
                                    break;

                                case md5('custom-optional-1'):
                                    $themeColor = 'custom-optional-1';
                                    break;

                                case md5('custom-optional-2'):
                                    $themeColor = 'custom-optional-2';
                                    break;

                                case md5('custom-optional-3'):
                                    $themeColor = 'custom-optional-3';
                                    break;

                                case md5('custom-optional-4'):
                                    $themeColor = 'custom-optional-4';
                                    break;

                                case md5('custom-optional-5'):
                                    $themeColor = 'custom-optional-5';
                                    break;

                                case md5('custom'):
                                    $themeColor = 'custom';
                                    break;

                                default:
                                    break;
                            }

                            // Layout header
                            switch($headerPosition)
                            {
                                case md5('header-top'):
                                    $headerPosition = 'header-top';
                                    break;

                                case md5('header-bottom'):
                                    $headerPosition = 'header-bottom';
                                    break;

                                default:
                                    break;
                            }

                            // Layout navigation
                            switch($navigationPosition)
                            {
                                case md5('navigation-right'):
                                    $navigationPosition = 'navigation-right';
                                    break;

                                case md5('navigation-left'):
                                    $navigationPosition = 'navigation-left';
                                    break;

                                default:
                                    break;
                            }

                            // Saving -----------------------------------------
                            // Color
                            if(($default = $colorTables->find(1)) != NULL)
                            {
                                $default->theme_color = $themeColor;
                                $default->updated_at  = $dateNow;

                                $default->save();
                            }
                            else
                            {
                                $colorTables->id          = 1;
                                $colorTables->theme_color = $themeColor;
                                $colorTables->created_at  = $dateNow;
                                $colorTables->updated_at  = $dateNow;

                                $colorTables->save();
                            }

                            // Layout
                            if(($default = $layoutTables->find(1)) != NULL)
                            {
                                $default->navigation_position = $navigationPosition;
                                $default->header_position     = $headerPosition;
                                $default->updated_at          = $dateNow;

                                $default->save();
                            }
                            else
                            {
                                $layoutTables->id                  = 1;
                                $layoutTables->navigation_position = $navigationPosition;
                                $layoutTables->header_position     = $headerPosition;
                                $layoutTables->created_at          = $dateNow;
                                $layoutTables->updated_at          = $dateNow;

                                $layoutTables->save();
                            }
                        }
                        else
                        {
                            //
                        }
                        break;

                    default:
                        break;
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
